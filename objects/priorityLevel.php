<?php
class PriorityLevel{
 
    // priorityLevel db connection and table name
    private $conn;
    private $table_name = "priorityLevel";
 
    // object properties
    public $obj_priorityLevel_id;
    public $obj_priorityLevel_name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used in select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    priorityLevel_id, priorityLevel_name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    priorityLevel_id";  
 
        $stmt = $this->conn->query( $query );
 
        return $stmt;
    }
    
    //used to call and read the data for the user
    function readName(){

    $query = "SELECT priorityLevel_name FROM " . $this->table_name . " WHERE priorityLevel_id = ? limit 0,1";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->obj_priorityLevel_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->obj_priorityLevel_name = $row['priorityLevel_name'];

    }
}

?>