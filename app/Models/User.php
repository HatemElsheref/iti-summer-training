<?php
namespace ITI\Models;

class User extends Model
{
    public $data;
    public $viewDir='user';

    function __construct($data=null,$connection=null)
    {
        if ($connection){
            parent::__construct($connection);
        }
        $this->data=$data;
        static::$tableName='users';
        static::$PK='id';
        static::$tableSchema=[
            'name'=>static::$STRING,
            'email'=>static::$STRING,
            'password'=>static::$STRING,
            'avatar'=>static::$STRING,
            'extra'=>static::$STRING,
            'room_id'=>static::$INTEGER
        ];
    }

}









//in class
/*
    public $id;
    public $name;
    public $email;
    public $password;
    public $avatar;
    public $extra;
    public $room_id;
*/


// in constructor
/*
        $this->id       =$data['id']        ??null;
        $this->name     =$data['name']      ??'';
        $this->email    =$data['email']     ??'';
        $this->password =$data['password']  ??'';
        $this->avatar   =$data['avatar']    ??'';
        $this->extra    =$data['extra']     ??'';
        $this->room_id  =$data['room_id']   ??0;
*/