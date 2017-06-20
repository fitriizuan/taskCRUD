<?php

// set page title and header
$page_title = "Add Task";
include_once "header.php"; 

//simple menu direction
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Task List</a>"; 
echo "</div>";

	// get database connection
	include_once 'config/database.php'; 
	 

	// if the form was submitted
	if($_POST){
 
    // instantiate task object
    include_once 'objects/task.php'; //bb
    $task = new task($db);
 
    // set task property values
    $task->obj_task_title = $_POST['txt_task_title'];
    $task->obj_task_description = $_POST['txt_task_description'];
    $task->obj_task_assignTo = $_POST['txt_task_assignTo'];
	$task->obj_task_submitTo = $_POST['txt_task_submitTo'];
    $task->obj_priorityLevel_id = $_POST['txt_priorityLevel_id'];
    $task->obj_task_dueDate = $_POST['txt_task_dueDate'];
    $task->obj_taskStatus_id = $_POST['txt_taskStatus_id'];
    $task->obj_task_feedBack = $_POST['txt_task_feedBack'];
    $task->obj_taskType_id = $_POST['txt_taskType_id'];
 
    // create the task and check if it is succesfully executed
    if($task->create()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Task was added.";
        echo "</div>";
    }
 
    // if fail to add task, give error message
    else{
        echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Unable to add task.";
        echo "</div>";
    }
}

?>

<!-- HTML form for creating a task -->
<form action='add_task.php' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Task Title</td>
            <td><input type='text' name='txt_task_title' class='form-control' required></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea rows="3" cols="50" name='txt_task_description' class='form-control' required></textarea></td>
        </tr>
        <tr>
            <td>Assigned To</td>
            <td><input type='text' name='txt_task_assignTo' class='form-control' required></td>
        </tr>
        <tr>
            <td>Submit To</td>
            <td><input type='text' name='txt_task_submitTo' class='form-control' required></td>
        </tr>
		<tr>
			<td>Priority Level</td>
			<td>
			<?php
			// read the task priority Level from the database
			include_once 'objects/priorityLevel.php';
 
			$priorityLevel = new PriorityLevel($db);
			$stmt = $priorityLevel->read();
 
			// put them in a select drop-down
			echo "<select class='form-control' name='txt_priorityLevel_id'>";
			echo "<option>Select Priority Level...</option>";
 
			while ($row_priorityLevel = $stmt->fetchArray())
            {
    			extract($row_priorityLevel);
    			echo "<option value='{$priorityLevel_id}'>{$priorityLevel_name}</option>";
			}
			echo "</select>";
			?>
			</td>
		</tr>
        <tr>
            <td>Due Date</td>
            <td><input type="datetime-local" name='txt_task_dueDate' class='form-control' required></td>
        </tr>
        <!-- task Status from database will be here -->
        <tr>
            <td>Status</td>
            <td>
            <?php
            // read the task status from the database
            include_once 'objects/taskStatus.php';
 
            $taskStatus = new TaskStatus($db);
            $stmt = $taskStatus->read();
 
            // put them in a select drop-down
            echo "<select class='form-control' name='txt_taskStatus_id'>";
            echo "<option>Select Status...</option>";
 
            while ($row_taskStatus = $stmt->fetchArray()){
            extract($row_taskStatus);
            echo "<option value='{$taskStatus_id}'>{$taskStatus_name}</option>";
            }
            echo "</select>";
            ?>
            </td>
        </tr>
        <tr>
            <td>Feedback</td>
            <td><textarea rows="3" cols="50" name='txt_task_feedBack' class='form-control' required></textarea></td>
        </tr>
        <!-- task Type from database will be here -->
        <tr>
            <td>Type</td>
            <td>
            <?php
            // read the task status from the database
            include_once 'objects/taskType.php';
 
            $taskType = new TaskType($db);
            $stmt = $taskType->read();
 
            // put them in a select drop-down
            echo "<select class='form-control' name='txt_taskType_id'>";
            echo "<option>Select Status...</option>";
 
            while ($row_taskType = $stmt->fetchArray()){
            extract($row_taskType);
            echo "<option value='{$taskType_id}'>{$taskType_name}</option>";
            }
            echo "</select>";
            ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>

<?php
include_once "footer.php"; //bb
?>