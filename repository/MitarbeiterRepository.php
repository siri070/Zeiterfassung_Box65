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

    function updateByID(){

    }

}