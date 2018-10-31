<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:44
 */
require_once '../lib/Repository.php';
require_once "../controller/MitarbeiterController.php";
class MitarbeiterRepository extends Repository
{
    protected $tableName = 'mitarbeiter';


    function login ($benutzername, $passwort, $admin){
       // $query = "SELECT * FROM $this->tableName  WHERE benutzername = benutzername AND passwort = passwort";
        $query = "SELECT * FROM $this->tableName  WHERE benutzername = $benutzername";
        $result = $query->execute(array('benutzername' => $benutzername));
        $mitarbeiter = $query->fetch();

        if ($mitarbeiter !== $benutzername && password_verify($passwort, $mitarbeiter['passwort'])) {
            $_SESSION['mid'] = $mitarbeiter['id'];
            die('Ihre Arbgeitszeit hat gerade begonnen.');
        } else if ($mitarbeiter !== $benutzername && password_verify($passwort, $mitarbeiter['passwort']) && $admin = 1 ) {
            header("Location".$GLOBALS ['appurl'] . '/Zeiterfassung/adminIndex' );
        }
        else{
            $errorMessage = "Benutzername oder Passwort war ungültig<br>";
        }
    }



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

    function logout(){

   if(session_destroy()) {
      header("Location:" .$GLOBALS['appurl']."/login/");
   }
    }


}