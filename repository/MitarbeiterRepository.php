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


    function readByKuerzel ($benutzername){
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE benutzername = ?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $benutzername);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;


    }
    function readByName ($vorname){
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE vorname = ?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $vorname);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;


    }
    function readBySnr ($snr){
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE benutzername = ?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $snr);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;


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