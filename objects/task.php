<?php
class Task{
 
    // task db connection and table name
    private $conn;
    private $table_name = "task";
 
    // object properties
    public $obj_task_id;
    public $obj_task_title;
    public $obj_task_description;
    public $obj_task_assignTo;
    public $obj_task_submitTo;
    public $obj_priorityLevel_id;
    public $obj_task_dueDate;
    public $obj_taskStatus_id;
    public $obj_task_feedBack;
    public $obj_taskType_id;
    public $obj_task_editedAt;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create or add task operation
    function create(){
 
        //write query
        $query = "INSERT INTO task(task_title, task_description, task_assignTo, task_submitTo,
         priorityLevel_id, task_dueDate, taskStatus_id, task_feedBack, taskType_id) 
          VALUES('$this->obj_task_title', '$this->obj_task_description', '$this->obj_task_assignTo', '$this->obj_task_submitTo',
          '$this->obj_priorityLevel_id', '$this->obj_task_dueDate', '$this->obj_taskStatus_id', '$this->obj_task_feedBack', '$this->obj_taskType_id')";
  
        if($this->conn->exec($query)){
            return true;
        }else{
            return false;
        }
    }

	// call and list all the task in db operation
	function readAll(){
 
    $query = "SELECT * 
            FROM
                " . $this->table_name . "
            ORDER BY
                task_id DESC";
 
    $stmt = $this->conn->query( $query );
 
    return $stmt;
	}
	

    // call and read the selected task only operation
	function readOne(){
 
    $query = "SELECT * 
            FROM
                " . $this->table_name . "
            WHERE
                task_id = '$this->obj_task_id'
            LIMIT
                0,1";
 
    $stmt = $this->conn->query( $query );
 
    $row = $stmt->fetchArray();
 
    $this->obj_task_title = $row['task_title'];
    $this->obj_task_description = $row['task_description'];
    $this->obj_task_assignTo = $row['task_assignTo'];
    $this->obj_task_submitTo = $row['task_submitTo'];
    $this->obj_priorityLevel_id = $row['priorityLevel_id'];
    $this->obj_task_dueDate = $row['task_dueDate'];
    $this->obj_taskStatus_id = $row['taskStatus_id'];
    $this->obj_task_feedBack = $row['task_feedBack'];
    $this->obj_taskType_id = $row['taskType_id'];
    $this->obj_task_editedAt = $row['task_editedAt'];
	}
	

    //task update operation
	function update()
    {
 
        $query = "UPDATE task
                SET task_title = '$this->obj_task_title',
                task_description = '$this->obj_task_description',
                task_assignTo = '$this->obj_task_assignTo', 
                task_submitTo = '$this->obj_task_submitTo',
                priorityLevel_id = '$this->obj_priorityLevel_id',
                task_dueDate = '$this->obj_task_dueDate', 
                taskStatus_id = '$this->obj_taskStatus_id', 
                task_feedBack = '$this->obj_task_feedBack', 
                taskType_id = '$this->obj_taskType_id', 
                task_editedAt = DateTime('now')
                WHERE task_id = '$this->obj_task_id'";
 
        // execute the query
        if($this->conn->exec($query)){
            return true;
        }
        else
        {
            return false;
        }
	}
	
	// task delete opration
	function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE task_id = '$this->obj_task_id'";
 
    if($this->conn->exec($query)){
        return true;
    }else{
        return false;
    }
	}
}
?>














