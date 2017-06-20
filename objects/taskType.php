<?php
class TaskType{
 
    // taskType db connection and table name
    private $conn;
    private $table_name = "taskType";
 
    // object properties
    public $obj_taskType_id;
    public $obj_taskType_name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used in select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    taskType_id, taskType_name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    taskType_id";  
 
        $stmt = $this->conn->query( $query );
 
        return $stmt;
    }
    
    //used to call and read the data for the user
    function readName(){

    $query = "SELECT taskType_name FROM " . $this->table_name . " WHERE taskType_id = ? limit 0,1";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->obj_taskType_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->obj_taskType_name = $row['taskType_name'];

    }
}




/* --------------------------------------------------------------------------------------------
class TaskType{
 
    // database connection and table name
    private $conn;
    private $table_name = "taskType";
 
    // object properties
    public $obj_taskType_id;
    public $obj_taskType_name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    taskType_id, taskType_name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    taskType_id";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
	
	function readName(){

	$query = "SELECT taskType_name FROM " . $this->table_name . " WHERE taskType_id = ? limit 0,1";
	$stmt = $this->conn->prepare( $query );
	$stmt->bindParam(1, $this->obj_taskType_id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	$this->obj_taskType_name = $row['taskType_name'];

	}
}
----------------------------------------------------------------------------------------------------------*/
?>