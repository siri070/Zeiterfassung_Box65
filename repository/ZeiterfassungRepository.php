<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:44
 */
require_once '../lib/Repository.php';
class ZeiterfassungRepository extends Repository
{
    protected $tableName = 'zeiterfassungen';

    public function create($sid,$abId,$aeId){
        $query = "INSERT INTO $this->tableName (mid,abId, aeId) VALUES (?,?,? )";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('iii', $sid, $abId,$aeId);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;


    }

    public function getTimeOfAll(){
        $query="SELECT * FROM `zeiterfassungen` JOIN arbeitsende ON zeiterfassungen.aeId= arbeitsende.aeId JOIN arbeitsbeginn ON arbeitsbeginn.abId = zeiterfassungen.abId JOIN mitarbeiter ON mitarbeiter.id = zeiterfassungen.mId ORDER BY beginn DESC ";
        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;

    }
    public function getTimeOfOne($sid){
        $query="SELECT * FROM `zeiterfassungen` JOIN arbeitsende ON zeiterfassungen.aeId= arbeitsende.aeId JOIN arbeitsbeginn ON arbeitsbeginn.abId = zeiterfassungen.abId JOIN mitarbeiter ON mitarbeiter.id = zeiterfassungen.mId WHERE mid= ? ORDER BY beginn DESC";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $sid);
        if(!$statement->execute()){
            throw new Exception($statement->error);
        }
        else{
            $resultat = $statement->get_result();
            $arbeitsZeiten = array();
            while ($zeit = $resultat->fetch_object()) {
                $arbeitsZeiten[]= $zeit;
            }
            return $arbeitsZeiten;
        }

    }

}