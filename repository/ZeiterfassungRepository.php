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
        $query="SELECT * FROM $this->tableName as z JOIN arbeitsende as ae ON z.aeId = ae.aeId JOIN arbeitsbeginn as ab ON z.abId = ab.abId JOIN mitarbeiter as m ON m.id= z.zid ";
        $statement = ConnectionHandler::getConnection()->prepare($query);

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
    public function getTimeOfOne($sid){
        $query="SELECT * FROM $this->tableName as z JOIN arbeitsende as ae ON z.aeId = ae.aeId JOIN arbeitsbeginn as ab ON z.abId = ab.abId JOIN mitarbeiter as m ON m.id= z.zid WHERE mid= ?";
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