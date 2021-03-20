<?php

require 'Mysqladapter.php';
require 'database_config.php';


class  Student extends Mysqladapter
{
    //set the table name
    private $_table = 'studednts';

    public function __construct()
    {
        //Add from the datebase configrution file
        global $config;

        //call the parent constructor
        parent::__construct($config);
    }

    //select  all students of array
    public function getAllStudents()
    {
        $this->select($this->_table);
        return $this->fetchAll();
    }

    // select one  student using user id
    public function getStudentByUsertId($user_id)
    {
        $this->select($this->_table, 'u_id= '.$user_id);
        return $this->fetch();
    }
     // select one  student using student id
    public function getStudentByStudentId($student_id)
    {
        $this->select($this->_table, 's_id= '.$student_id);
        return $this->fetch();
    }
    // inser user
    public function addStudent($user_data)
    {
        return $this->insert($this ->_table , $user_data);
    }

    // update user
    public function updateStudent($user_data,$user_id){
        return $this->update($this ->_table , $user_data, 'u_id= ' .$user_id);
    }

    //delete user 
    public function deleteStudent($user_id){
        return $this->delete($this ->_table ,'u_id= ' . $user_id );
    }
    //search existing users
    public function searchUsers($keyword)
    {
        $this ->select($this->_table, " u_fname LIKE '%$keyword%' OR u_email LIKE '%$keyword%' OR u_lname LIKE '%$keyword%' ");
        return $this ->fetchAll();
    }
}


?>