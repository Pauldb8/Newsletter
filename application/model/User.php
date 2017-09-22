<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/18/2017
 * Time: 3:05 PM
 */

class User implements Table
{

    protected $id;
    protected $name;
    protected $password;
    protected $login;

    const TABLE_NAME = "Users";

    public function __construct()
    {
    }


    public function getAttributes()
    {
        return get_object_vars($this);
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }

}