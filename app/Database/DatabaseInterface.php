<?php

namespace ITI\Database;
interface DatabaseInterface
{

    public  function openConnection();
    public  function closeConnection();
    public  function delete($id);
    public  function find($id);
    public  function findBy($column,$value);
    public  function findWithIgnore($column,$value,$ignore=null);
    public  function getByPk($id);
    public  function all();
    public  function count();
    public  function update($id,$data);
    public  function insert($data);

}