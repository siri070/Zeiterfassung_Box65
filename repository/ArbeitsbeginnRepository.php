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
        $query = "INSERT INTO $this->tableName (sid, beginn) VALUES (?, CURRENT_TIMESTAMP() )";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('i', $sid);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }
}