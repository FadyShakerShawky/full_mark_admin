<?php

require 'Mysqladapter.php';
require 'database_config.php';


class  User extends Mysqladapter
{
    //set the table name
    private $_table = 'users';

    public function __construct()
    {
        //Add from the datebase configrution file
        global $config;

        //call the parent constructor
        parent::__construct($config);
    }

    //select  all users of array
    public function getUsers()
    {
        $this->select($this->_table);
        return $this->fetchAll();
    }

    // select one  user of array
    public function getUser($user_id)
    {
        $this->select($this->_table, 'u_id= '.$user_id);
        return $this->fetch();
    }

    // inser user
    public function addUser($user_data)
    {
        return $this->insert($this ->_table , $user_data);
    }

    // update user
    public function updateUser($user_data,$user_id){
        return $this->update($this ->_table , $user_data, 'u_id= ' .$user_id);
    }

    //delete user 
    public function deleteUser($user_id){
        return $this->delete($this ->_table ,'u_id= ' .$user_id );

    }
    //search existing users
    public function searchUsers($keyword)
    {
        $this ->select($this->_table, " u_fname LIKE '%$keyword%' OR u_email LIKE '%$keyword%' OR u_lname LIKE '%$keyword%' ");
        return $this ->fetchAll();
    }
}


?>