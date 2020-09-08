<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    const DEFAULT_IMAGE='https://source.unsplash.com/user/erondu/1600x900';
    protected $table='courses';
    protected $fillable=['name','code','price','instructor'];
    public function image(){
        if ($this->image===self::DEFAULT_IMAGE){
            return self::DEFAULT_IMAGE;
        }else{
            return url($this->image);
        }
    }
}
