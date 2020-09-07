<?php


namespace ITI\Models;


class Product extends Model
{
    public $data;
    function __construct($data=null,$connection=null)
    {
        if ($connection){
            parent::__construct($connection);
        }
        $this->data=$data;
        static::$tableName='products';
        static::$PK='id';
        static::$tableSchema=[
            'name'=>static::$STRING,
//            'price'=>static::$FLOAT,
            'price'=>static::$STRING,
            'quantity'=>static::$INTEGER
        ];
    }
}