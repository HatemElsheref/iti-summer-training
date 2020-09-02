<?php
namespace ITI\Database;

trait PDOTrait
{

    public  function  openConnection(){
        $connection=null;
        $connection=new \PDO('mysql:hostname='.$this->databaseHostname.';dbname='.$this->databaseName.';port='.$this->databasePort,$this->databaseUserName,$this->databasePassword);
        if($connection)
            return $connection;
        else
        return null;
    }

    public  function  closeConnection(){
        static::$connectionHandler->query('KILL CONNECTION_ID()');
        static::$connectionHandler=null;
    }

    public  function insert($information=null){
        if ($information and is_array($information)){
            $data=$information;
        }else{

            $data=$this->data;
        }
        $keys=static::prepareStatment(array_keys($data));
        $params=$this->bindParams(array_keys($data));
        var_dump($params);
        $SQL='INSERT INTO '.static::$tableName.$keys.' VALUES '.$params;
        var_dump($SQL);
        $statement=static::$connectionHandler->prepare($SQL);
        $statement=$this->bindValues($statement,$data);
        if($statement->execute()){
            return true;
        }
        return false;
    }

    public  function delete($id){
        if($this->find($id)){
           $SQL="DELETE FROM ".static::$tableName." WHERE ".static::$PK.'=:'.static::$PK;
           $statement=static::$connectionHandler->prepare($SQL);
           $statement->bindParam(":".static::$PK,$id,\PDO::PARAM_INT);
            if($statement->execute()){
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
        if($this->find($id)){
            $prepared=static::prepareForUpdate($newData);
            $SQL='UPDATE '.static::$tableName.$prepared.' WHERE '.static::$PK.'=:'.static::$PK;
            $statement=static::$connectionHandler->prepare($SQL);
            $statement->bindParam(":".static::$PK,$id,\PDO::PARAM_INT);
            if($statement->execute()){
                return true;
            }
            return false;
        }
        return false;
    }

    public  function find($id){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".static::$PK."=?";
        $statement=static::$connectionHandler->prepare($SQL);
        if ($statement->execute([$id])){
            if($statement->rowCount()>0){
                return true;
            }
            return false;
        }
        return false;
    }
    public  function findBy($column,$value){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".$column."=?";
        $statement=static::$connectionHandler->prepare($SQL);
        if ($statement->execute([$value])){
            if($statement->rowCount()>0){
                return true;
            }
            return false;
        }
        return false;
    }
    public  function findWithIgnore($column,$value,$ignore=null){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".$column."=? and $column!=?";
        $statement=static::$connectionHandler->prepare($SQL);
        if ($statement->execute([$value,$ignore])){
            return $statement->rowCount();
        }
        return false;
    }

    public  function getByPk($id){
        $SQL="SELECT * FROM ".static::$tableName." WHERE ".static::$PK."=:".static::$PK;
        $statement=static::$connectionHandler->prepare($SQL);
        $statement->bindParam(":".static::$PK,$id,\PDO::PARAM_INT);
        if($statement->execute()){
            if($statement->rowCount()>0){
                return $statement->fetchAll(\PDO::FETCH_CLASS,static::class)[0];
            }
            return null;
        }
        return null;
    }

    public  function all(){
        $SQL="SELECT * FROM ".static::$tableName;
        $statement=static::$connectionHandler->prepare($SQL);
        if($statement->execute()){
            return $statement->fetchAll(\PDO::FETCH_CLASS,static::class);
        }
        return null;
    }

    public  function count(){
        $SQL="SELECT COUNT(*) as total FROM ".static::$tableName;
        $statement=static::$connectionHandler->prepare($SQL);
        if($statement->execute()){
            return $statement->fetchAll(\PDO::FETCH_CLASS,static::class)[0]->total;
        }
        return null;

    }

    private function bindParams($keys){
        $sql=' (';
        foreach ($keys as $key){
            $sql.=':'.$key.',';
//            $sql.='?,';
        }
        return trim($sql,',').')';
    }

    private function bindValues(\PDOStatement $statement,$data){
        foreach ($data as $key=>$value){
            $currentType=$this->getParamType($key);
            $statement->bindValue(":$key",$value,$currentType);
            /*
             if (is_integer($key)){
                $statement->bindParam(":$key",$value,\PDO::PARAM_INT);
            }elseif (is_bool($key)){
                $statement->bindParam(":$key",$value,\PDO::PARAM_BOOL);
            }else{
                $statement->bindValue(":$key",$value,\PDO::PARAM_STR);
            }
            */

        }
        return $statement;
    }

    private function getParamType($key){

        switch (static::$tableSchema[$key]){
            case 2:
                return \PDO::PARAM_INT;
                break;
            case 4:
                return \PDO::PARAM_BOOL;
                break;
            default:
                return \PDO::PARAM_STR;
        }
    }

}