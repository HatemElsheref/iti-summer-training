<?php

namespace ITI\Database;
class Database implements  DatabaseInterface
{
    use ProceduralTrait;
//    use OOPTrait;
//    use PDOTrait;

    private  $databaseHostname;
    private  $databaseUserName;
    private  $databasePassword;
    private  $databaseName;
    private  $databasePort;
    private  $connection=null;

    public function __construct($options)
    {
        $this->databaseHostname=$options['HOSTNAME'];
        $this->databaseUserName=$options['USERNAME'];
        $this->databasePassword=$options['PASSWORD'];
        $this->databaseName=$options['DATABASE'];
        $this->databasePort=$options['PORT'];
        $this->connection=$this->openConnection();
    }

    protected function getConnection(){
        if (!$this->connection){
            return null;
        }
        return $this->connection;
    }


    protected static function prepareStatment($keys){
        $sql=' (';
        foreach ($keys as $key){
            $sql.=$key.',';
        }
        $sql=trim($sql,',');
        $sql.=') ';
        return $sql;
    }

    protected static function prepareValues($data){
        $sql=' (';
        foreach ($data as $key => $value){
            if(static::$tableSchema[$key]==static::$STRING){
                $sql.="'$value',";
            }else {
                $sql .= "$value,";
            }
        }
        $sql=trim($sql,',');
        $sql.=' ) ';
        return $sql;
    }

    protected function prepareForUpdate($data){
        $sql=' SET ';
        foreach ($data as $key => $value){
            if(static::$tableSchema[$key]==static::$STRING){
                $sql.="$key='$value',";
            }else {
                $sql .= "$key=$value,";
            }
        }
        $sql=trim($sql,',');
        return $sql;
    }



}