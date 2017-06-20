<?php

// set page title and header
$page_title = "Update Task";
include_once "header.php"; 

//simple menu direction
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Task List</a>";
echo "</div>";

// get ID of the task to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.'); //get id from button edit of previous page(read_user.php) 
 
// include database and object files
include_once 'config/database.php'; //bb
include_once 'objects/task.php'; //bb
 
// prepare task object
$task = new Task($db);
 
// set ID property of task to be edited
$task->obj_task_id = $id;
 
// read the details of task to be read/edited
$task->readOne();

//once edited, all the updated/submitted data will be process here
if($_POST){
 
    // set task property values
    $task->obj_task_title = $_POST['txt_task_title'];
    $task->obj_task_description = $_POST['txt_task_description'];
    $task->obj_task_assignTo = $_POST['txt_task_assignTo'];
    $task->obj_task_submitTo = $_POST['txt_task_submitTo'];
    $task->obj_priorityLevel_id = $_POST['txt_priorityLevel_id'];
    $task->obj_task_dueDate = $_POST['txt_task_dueDate'];
    $task->obj_taskStatus_id = $_POST['txt_taskStatus_id'];
    $task->obj_taskType_id = $_POST['txt_taskType_id'];
    $task->obj_task_feedBack = $_POST['txt_task_feedBack'];
 
    // call update function and check if it is successfully executed
    if($task->update()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Task was updated.";
        echo "</div>";
    }
 
    // if fail to update, give error message
    else{
        echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Unable to update task.";
        echo "</div>";
    }
}

// the form to edit the task
?>
<form action='update_task.php?id=<?php echo $id; ?>' method='post'> 
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Task Title</td>
            <td><input type='text' name="txt_task_title" value='<?php echo $task->obj_task_title; ?>' class='form-control' required></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea rows="3" cols="50" name="txt_task_description" class='form-control' required><?php echo $task->obj_task_description; ?></textarea></td>
        </tr>
        <tr>
            <td>Assigned To</td>
            <td><input type='text' name="txt_task_assignTo" value='<?php echo $task->obj_task_assignTo; ?>' class='form-control' required></td>
        </tr>
        <tr>
            <td>Submit To</td>
            <td><input type='text' name="txt_task_submitTo" value='<?php echo $task->obj_task_submitTo; ?>' class='form-control' required></td>
        </tr>
        <!-- Priority Level here -->
        <tr>
            <td>Priority Level</td>
            <td>
            <?php
                // read the priorityLevel from the database
                include_once 'objects/priorityLevel.php';
                $priorityLevel = new PriorityLevel($db);
                $stmt = $priorityLevel->read();

                echo "<select class='form-control' name='txt_priorityLevel_id'>";
                echo "<option>Please select...</option>";
                // put them in a select drop-down
                while ($row_priorityLevel = $stmt->fetchArray())
                {
                    extract($row_priorityLevel);
                    // current priorityLevel of the task must be selected
                    if($task->obj_priorityLevel_id == $priorityLevel_id)
                    {
                        echo "<option value='$priorityLevel_id' selected>";
                    }
                    else
                    {
                        echo "<option value='$priorityLevel_id'>";
                    }
                    echo "$priorityLevel_name</option>";
                }
                echo "</select>";
            ?></td>
        </tr>
        <tr>
            <td>Due Date</td>
            <td>
            <?php $datetime = new DateTime($task->obj_task_dueDate); ?>
            <input type="datetime-local" name="txt_task_dueDate" placeholder="Time In" name="timein" value = "<?php echo $datetime->format('Y-m-d\TH:i:s'); ?>" class="form-control" />
            </td>
        </tr>
        <!-- task Status here -->
        <tr>
            <td>Status</td>
            <td>
            <?php
                // read the task status from the database
                include_once 'objects/taskStatus.php';
                $taskStatus = new TaskStatus($db);
                $stmt = $taskStatus->read();

                echo "<select class='form-control' name='txt_taskStatus_id'>";
                echo "<option>Please select...</option>";
                // put them in a select drop-down
                while ($row_taskStatus = $stmt->fetchArray())
                {
                    extract($row_taskStatus);
                    // current taskStatus of the task must be selected
                    if($task->obj_taskStatus_id == $taskStatus_id)
                    {
                        echo "<option value='$taskStatus_id' selected>";
                    }
                    else
                    {
                        echo "<option value='$taskStatus_id'>";
                    }
                    echo "$taskStatus_name</option>";
                }
                echo "</select>";
            ?></td>
        </tr>
        <tr>
            <td>Feedback</td>
            <td><textarea rows="3" cols="50" name="txt_task_feedBack" class='form-control' required><?php echo $task->obj_task_feedBack; ?></textarea></td>
        </tr>
        <!-- task Type here -->
        <tr>
            <td>Type</td>
            <td>
            <?php
                // read the task type from the database
                include_once 'objects/taskType.php';
                $taskType = new TaskType($db);
                $stmt = $taskType->read();

                echo "<select class='form-control' name='txt_taskType_id'>";
                echo "<option>Please select...</option>";
                // put them in a select drop-down
                while ($row_taskType = $stmt->fetchArray())
                {
                    extract($row_taskType);
                    // current taskType of the task must be selected
                    if($task->obj_taskType_id == $taskType_id)
                    {
                        echo "<option value='$taskType_id' selected>";
                    }
                    else
                    {
                        echo "<option value='$taskType_id'>";
                    }
                    echo "$taskType_name</option>";
                }
                echo "</select>";
            ?></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>

<?php  
include_once "footer.php";
?>
