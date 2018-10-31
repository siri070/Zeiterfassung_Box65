<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:44
 */
require_once '../lib/Repository.php';
class ArbeitsendeRepository extends Repository
{
    protected $tableName = 'arbeitsende';
    public function create($sid){
        $query = "INSERT INTO $this->tableName (sid, ende) VALUES (?,? )";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $datumZeit = date('Y n d h:i');
        $statement->bind_param('ii', $sid, $datumZeit);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }
}