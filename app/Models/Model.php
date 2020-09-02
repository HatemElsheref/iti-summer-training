<?php

namespace ITI\Models;
use ITI\Database\Database;
abstract class Model extends Database
{

    protected static $tableName;
    protected static $PK;
    public static $tableSchema;
    protected static $STRING=1;
    protected static $INTEGER=2;
    protected static $FLOAT=3;
    protected static $BOOLEAN=4;
    public static $connectionHandler=null;
    public function __construct($connection)
    {
        self::$connectionHandler=$connection->getConnection();
        if(!self::$connectionHandler){
            trigger_error('Error In Connection ');
        }

    }


}