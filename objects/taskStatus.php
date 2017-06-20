<?php

class TaskStatus{
 
    // taskStatus db connection and table name
    private $conn;
    private $table_name = "taskStatus";
 
    // object properties
    public $obj_taskStatus_id;
    public $obj_taskStatus_name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used in select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    taskStatus_id, taskStatus_name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    taskStatus_id";  
 
        $stmt = $this->conn->query( $query );
 
        return $stmt;
    }
    
    //used to call and read the data for the user
    function readName(){

    $query = "SELECT taskStatus_name FROM " . $this->table_name . " WHERE taskStatus_id = '$this->obj_taskStatus_id' limit 0,1";
    $stmt = $this->conn->query( $query );
    $row = $stmt->fetchArray();

    $this->obj_taskStatus_name = $row['taskStatus_name'];

    }
}





/* --------------------------------------------------------------------------------------------------
class TaskStatus{
 
    // database connection and table name
    private $conn;
    private $table_name = "taskStatus";
 
    // object properties
    public $obj_taskStatus_id;
    public $obj_taskStatus_name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    taskStatus_id, taskStatus_name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    taskStatus_id";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
	
	function readName(){

	$query = "SELECT taskStatus_name FROM " . $this->table_name . " WHERE taskStatus_id = ? limit 0,1";
	$stmt = $this->conn->prepare( $query );
	$stmt->bindParam(1, $this->obj_taskStatus_id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	$this->obj_taskStatus_name = $row['taskStatus_name'];

	}
}

----------------------------------------------------------------------------------------------------*/
?>