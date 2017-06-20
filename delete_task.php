<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'config/database.php'; //bb
    include_once 'objects/task.php'; //bb
 
    // prepare task object
    $task = new Task($db);
 
    // set task id to be deleted
    $task->obj_task_id = $_POST['object_id'];
 
    // call delete function and check if it is successfully executed
    if($task->delete()){
        echo "Task was deleted.";
    }
 
    // if fail to delete task, give error message
    else{
        echo "Unable to delete task."+$task->obj_user_id+" lalala";
 
    }
}
?>