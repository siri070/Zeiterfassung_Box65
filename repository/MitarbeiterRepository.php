<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:44
 */
require_once '../lib/Repository.php';
class MitarbeiterRepository extends Repository
{
    protected $tableName = 'mitarbeiter';
    function create($vorname, $nachname, $susNR, $passwort){
        $password = password_hash($passwort,PASSWORD_DEFAULT);


        $query = "INSERT INTO $this->tableName (vorname, nachname, benutzername, passwort, admin) VALUES (?, ?, ?, ?, 0 )";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $vorname, $nachname, $susNR, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    function updateByID($vorname, $nachname, $susNR, $passwort , $id){

        $password = password_hash($passwort,PASSWORD_DEFAULT);
        $query = "UPDATE $this->tableName SET vorname = ? , nachname = ? , benutzername = ? , passwort = ? WHERE id = ? ";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssssi', $vorname, $nachname, $susNR, $password , $id);
        $statement->execute();
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

    }

    function login ($benutzername, $passwort){
        $query = "SELECT * FROM $this->tableName  WHERE benutzername = benutzername AND passwort = passwort";
        $result = $query->execute(array('benutzername' => $benutzername));
        $mitarbeiter = $query->fetch();

        if ($mitarbeiter !== false && password_verify($passwort, $mitarbeiter['passwort'])) {
            $_SESSION['mid'] = $mitarbeiter['id'];
            die('Ihre Arbgeitszeit hat gerade begonnen.');
        } else {
            $errorMessage = "Benutzername oder Passwort war ungültig<br>";
        }
    }

}