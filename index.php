<?php

// set page title and header
$page_title = "Task List";
include_once "header.php";

//simple menu direction
echo "<div class='right-button-margin'>";
    echo "<a href='add_task.php' class='btn btn-default pull-right'>Add Task</a>";
echo "</div>";

// include database and object files
include_once 'config/database.php';
include_once 'objects/task.php';
 
//prepare task object
$task = new Task($db);
 
//call function to read all task query
$stmt = $task->readAll();
//$num = $stmt->rowCount();
 
// display the tasks if there are any
if(!empty($stmt)){
 
    //prepare taskStatus object
    include_once 'objects/taskStatus.php';
    $taskStatus = new TaskStatus($db);
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Assign To</th>";
            echo "<th>Submit To</th>";
            echo "<th>Due Date</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetchArray()){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$task_title}</td>";
                echo "<td>{$task_assignTo}</td>";
                echo "<td>{$task_submitTo}</td>";
                echo "<td>{$task_dueDate}</td>";
				echo "<td>";
                    $taskStatus->obj_taskStatus_id = $taskStatus_id;
                    $taskStatus->readName();
                    echo $taskStatus->obj_taskStatus_name;
                echo "</td>";
					echo "<td>";
					// view, edit and delete button is here
                        echo "<a href='view_task.php?id={$task_id}' class='btn btn-default left-margin'>View</a>";
						echo "<a href='update_task.php?id={$task_id}' class='btn btn-default left-margin'>Edit</a>"; //bb
						echo '<a onclick="delFn('.$task_id.')" class="btn btn-default left-margin"> Delete </a>'; 
				echo "</td>";
            echo "</tr>";
 
        }
 
    echo "</table>";
 
}
 
// tell the user there are no data
else{
    echo "<div>There is No Data !</div>";
}
?>

<script>
//javascript to confirm delete command
function delFn(id)
{
    var q = confirm("Are you sure?");
 
    if (q == true){
 
		//alert('id--'+id);
        $.post('delete_task.php', //bb
		{ 
            object_id: id
        }, function(data){
            location.reload();
        }).fail(function() {
            alert('Unable to delete');
        });
 
    }
 }
</script>

<?php
include_once "footer.php";
?>