<?php 
    //create class ORM connection database
    class Mysqladapter
    {
    // create 3 varables 1-> array to 4 connect data 2-> link inside 4connecte data 3-> result  
        protected $_config=array();
        protected $_link ;
        protected $_result ;

            //constructor  method
        public function  __construct(array $config)
        {
            if(count ($config) !==4 )
            {
                throw new InValidArgumentException('Invalid parameter');
            }
            $this->_config = $config ;
        }
        //connect by my sql 
        public function connect()
        {
            if ($this->_link===null)
            {
                list($host , $user , $password , $database) = $this->_config;
                        if(!$this->_link = @mysqli_connect($host , $user , $password , $database))
                        {
                            throw new RuntimeException('error'.mysqli_connect_error());
                        }
                    unset($host , $user , $password , $database);  
            }
            return $this->_link ;
        }

        //execute specific query 
        public function query($query)
        {
            if(!is_string($query) || empty ($query))
            {
                throw new InvalidArgumentException('not valid');
            }
            
            $this->connect();
            
            if (!$this->_result = mysqli_query($this ->_link , $query ))
            {
                throw new RuntimeException('error' .$query. mysqli_error($this->_link) );
            }
            return $this->_result ;
        }

        //perfrom select statment
        public function select($table , $where=' ' , $fields='*' , $order=' ' , $limit=null , $offset=null )
        {
            $query =' SELECT ' .  $fields .   ' FROM ' . $table 
                . (($where  !== " ")  ? ' WHERE ' .   $where : ' ' )
                . (($limit !== null  )  ? ' LIMIT ' .   $limit : ' ' )
                . (($offset !== null && $limit !== null )  ? ' OFFSET ' .   $offset : ' ' )
                . (($order !== " ")  ? ' ORDER BY ' .   $order : ' ' );
                 $this->query($query);
                return $this->countRow();
                // echo $query;

        }

        //perform insert statement 
        public function insert($table , array $data )
        {
            $fields=implode(',',array_keys($data));
            $values=implode(',',array_map(array($this , 'quoteValue'),array_values($data)));
            $query='INSERT INTO '.$table.'('.$fields.')'.' VALUES('.$values.')';
            $this->query($query);
            return $this->getInsertId();
        }

        //perform delete statement 
        public function delete ($table,$where='')
        {
            $query='DELETE FROM' .$table .(($where) ? 'WHERE' .$where : '');
            $this->query($query);
            return $this->getAffectedRows();
        }

        //perform update statement 
        public function update($table,array $data , $where='')
        {

            $set=array();
            foreach($data as $field =>$value){
                $set[]=$field . '=' .$this->quoteValue($value);
            }
            $set=implode(',' , $set);
            $query='UPDATE ' .$table .' SET ' .$set .(($where)? ' WHERE ' .$where : '');
            $this->query($query);
            return $this->getAffectedRows();
        }
        //fetch single row from current result set (as associative array)
        public function fetch()
        {
            if($this->_result !==null)
            {
                if(($row=mysqli_fetch_array($this->_result,MYSQLI_ASSOC))===false)
                {
                    $this->freeResult();
                }
                return $row ;
            }
            return false;
        }

        //fetch All rows from current result set (as associative array)
        public function fetchAll()
        {
            if($this->_result !==null)
            {
                if(($all=mysqli_fetch_all($this->_result,MYSQLI_ASSOC))===false)
                {
                    $this->freeResult();
                }
                return $all ;
            }
            return false;
        }


        //Get th insertion ID (WITH INSERT STATMENT) / get last line insertion 
        public function getInsertId()
        {
            return $this->_link !==null ? mysqli_insert_id($this->_link) : null ;
            
        }


        //Get number of rows returned by current result set (WITH SELECT STATMENT)
        public function countRow(){
            return $this->_result !==null ? mysqli_num_rows($this->_result):0 ;
        }

//Get number of affected rows (WITH UPDATE / DELETE )

public function getAffectedRows(){
    return $this ->_link !==null ? mysqli_affected_rows ($this->_link):0;
}

//free up current result set (WITH FETCH / FETCH ALL )
public function freeResult(){
    if($this->_result === null){
        return false ;
    }
    Mysqli_free_result($this->_result);
    return true ;
}
        //escape specified value
        public function quoteValue($value)
        {
            $this->connect();
            if($value===null)
            {
                $value='NULL' ;
            }
            elseif(!is_numeric($value))
            {
                $value= "'"    .   mysqli_real_escape_string($this->_link , $value)  .  "'"  ; 
            }
            return $value ;
        }       
        //close DATABASE connection 
        public function disconnect(){
            if($this->_link===null){
                return false ;
            }
            mysqli_close($this->_link);
            $this->_link=null;
            return true ;
        }

        //close automatic database connection
        public function __destruct(){
            $this->disconnect();
        }
        //end class ORM
    }
?>