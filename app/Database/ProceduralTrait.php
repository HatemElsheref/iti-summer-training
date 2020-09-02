<?php
namespace ITI\Database;


trait ProceduralTrait
{

    public  function  openConnection(){
        $connection=null;
        $connection=\mysqli_connect($this->databaseHostname,$this->databaseUserName,$this->databasePassword,$this->databaseName,$this->databasePort);

        if($connection)
            return $connection;
        else
            return null;
    }

    public  function closeConnection(){
        mysqli_close(static::$connectionHandler);
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
        if(\mysqli_query(static::$connectionHandler,$SQL)){
            return true;
        }
        return false;
    }

    public  function delete($id){
        if($this->find($id)){
         $SQL="DELETE FROM ".static::$tableName." WHERE ".static::$PK."=$id";
            if(mysqli_query(static::$connectionHandler,$SQL)){
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
            if(\mysqli_query(static::$connectionHandler,$SQL)){
                return true;
            }
            return false;
        }
        return false;
    }

    public  function find($id){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".static::$PK."=$id";
        $response=\mysqli_query(static::$connectionHandler,$SQL);
       if(\mysqli_num_rows($response)>0){
           return true;
       }
       return false;
    }
    public  function findBy($column,$value){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".$column."=".$value;
        $response=\mysqli_query(static::$connectionHandler,$SQL);
       if(\mysqli_num_rows($response)>0){
           return true;
       }
       return false;
    }
    public  function findWithIgnore($column,$value,$ignore=null){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".$column."=$value and $column!=$ignore";
        $response=\mysqli_query(static::$connectionHandler,$SQL);
        if ($response){
            return \mysqli_num_rows($response);
        }
        return false;
    }

    public  function getByPk($id){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".static::$PK."=$id";
        $response=\mysqli_query(static::$connectionHandler,$SQL);
        if(\mysqli_num_rows($response)>0){
            return mysqli_fetch_object($response);
        }
        return null;
    }

    public  function all(){
        $SQL="SELECT * FROM ".static::$tableName;
        $response=\mysqli_query(static::$connectionHandler,$SQL);
        $data=[];
        while ($row=mysqli_fetch_object($response)){
            array_push($data,$row);
        }
        return $data;
    }

    public  function count(){
        $SQL="SELECT COUNT(*) as total FROM ".static::$tableName;
        $response=\mysqli_query(static::$connectionHandler,$SQL);
        return \mysqli_fetch_assoc($response)['total'];

    }
}