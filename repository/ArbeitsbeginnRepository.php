<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:44
 */
require_once '../lib/Repository.php';
class ArbeitsbeginnRepository extends Repository
{
    protected $tableName = 'arbeitsbeginn';
    // sid und beginnzeit datetime
    public function create($sid){
        $query = "INSERT INTO $this->tableName (sid, beginn) VALUES (?,? )";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $t=time();
        $datumZeit = date('Y n d h:i',$t);
        $statement->bind_param('ii', $sid, $datumZeit);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }
}