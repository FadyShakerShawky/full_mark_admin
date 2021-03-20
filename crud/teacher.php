<?php

require 'Mysqladapter.php';
require 'database_config.php';


class  Teacher extends Mysqladapter
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
    public function getAllTeacher()
    {
        $this->select($this->_table);
        return $this->fetchAll();
    }

    // select one  user of array
    public function getTeacherByUsertId($user_id)
    {
        $this->select($this->_table, '	u_id= '.$user_id);
        return $this->fetch();
    }

    // inser teacher
    public function addTeacher($user_data)
    {
        return $this->insert($this ->_table , $user_data);
    }

   
    // update teacher
    public function updateTeacher($user_data,$user_id){
        return $this->update($this ->_table , $user_data, '	u_id= ' .$user_id);
    }

    //delete teacher 
    public function deleteTeacher($user_id){
        return $this->delete($this ->_table ,'	u_id= ' .$user_id );

    }
    //search existing Teaer
    public function searchTeacher($keyword)
    {
        $this ->select($this->_table, " name LIKE '%$keyword%' OR email LIKE '%$keyword%' ");
        return $this ->fetchAll();
    }
}


?>