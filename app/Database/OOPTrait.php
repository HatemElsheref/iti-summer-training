<?php
namespace ITI\Database;


trait OOPTrait
{

    public  function  openConnection(){
        $connection=null;
        $connection=new \mysqli($this->databaseHostname,$this->databaseUserName,$this->databasePassword,$this->databaseName,$this->databasePort);
        if($connection->errno)
            return null;
        else
        return $connection;
    }

    public  function closeConnection(){
        static::$connectionHandler->close();
    }

    public  function insert($information=null){
        if ($information and is_array($information)){
            $data=$information;
        }else{

            $data=$this->data;
        }
        $keys=static::prepareStatment(array_keys($data));
        $values=static::prepareValues($data);
        $SQL='INSERT INTO '.static::$tableName.$keys.' VALUES '.$values;
        if(static::$connectionHandler->query($SQL)){
            return true;
        }
        return false;
    }

    public  function delete($id){
        if($this->find($id)){
           $SQL="DELETE FROM ".static::$tableName." WHERE ".static::$PK."=$id";
            if(static::$connectionHandler->query($SQL)){
                return true;
            }
            return false;
        }
        return false;
    }

    public  function update($id,$newData=null){
        if (!isset($newData) or !is_array($newData) or $newData==null){
            $newData=$this->data;
        }
        if(static::find($id)){
            $prepared=static::prepareForUpdate($newData);
            $SQL='UPDATE '.static::$tableName.$prepared.' WHERE '.static::$PK.'= '.$id;
            if(static::$connectionHandler->query($SQL)){
                return true;
            }
            return false;
        }
        return false;
    }

    public  function find($id){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".static::$PK."=$id";
        $response=static::$connectionHandler->query($SQL);
        if($response->num_rows>0){
            return true;
        }
        return false;
    }
    public  function findBy($column,$value){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".$column."=$value";
        $response=static::$connectionHandler->query($SQL);
        if($response->num_rows>0){
            return true;
        }
        return false;
    }
    public  function findWithIgnore($column,$value,$ignore=null){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".$column."=$value and $column!=$ignore";
        $response=static::$connectionHandler->query($SQL);
        if ($response){
            return $response->num_rows;
        }
        return false;
    }


    public  function getByPk($id){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".static::$PK."=$id";
        $response=static::$connectionHandler->query($SQL);
        if($response->num_rows>0){
            return $response->fetch_object();
        }
        return null;
    }

    public  function all(){
       $SQL="SELECT * FROM ".static::$tableName;
        $response=static::$connectionHandler->query($SQL);
        $data=[];
        while ($row=$response->fetch_object()){
            array_push($data,$row);
        }
        return $data;
    }

    public  function count(){
        $SQL="SELECT COUNT(*) as total FROM ".static::$tableName;
        $response=static::$connectionHandler->query($SQL);
        return $response->fetch_object()->total;
    }
}