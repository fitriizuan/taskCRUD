<?php

// set page title and header
$page_title = "View Task";
include_once "header.php";

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Task List</a>";
echo "</div>";

// get ID of the task to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.'); //get id from button edit of previous page(read_user.php) 
 
// include database and object files
include_once 'config/database.php'; //bb
include_once 'objects/task.php'; //bb
 
// prepare task object
$task = new Task($db);
 
// set ID property of task to be read
$task->obj_task_id = $id;
 
// read the details of task to be read
$task->readOne();

// form to read the task properties
?>
 
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Task Title</td>
            <td><input type='text' value='<?php echo $task->obj_task_title; ?>' class='form-control' readonly></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea rows="3" cols="50" class='form-control' readonly><?php echo $task->obj_task_description; ?></textarea></td>
        </tr>
        <tr>
            <td>Assigned To</td>
            <td><input type='text' value='<?php echo $task->obj_task_assignTo; ?>' class='form-control' readonly></td>
        </tr>
        <tr>
            <td>Submit To</td>
            <td><input type='text' value='<?php echo $task->obj_task_submitTo; ?>' class='form-control' readonly></td>
        </tr>
        <!-- Priority Level here -->
        <tr>
            <td>Priority Level</td>
            <?php
                // read the task priorityLevel from the database
                include_once 'objects/priorityLevel.php';
                $priorityLevel = new PriorityLevel($db);
                $stmt = $priorityLevel->read();
                // put them in a select drop-down
                while ($row_priorityLevel = $stmt->fetchArray())
                {
                    extract($row_priorityLevel);
                    // current priorityLevel of the task must be selected
                    if($task->obj_priorityLevel_id == $priorityLevel_id)
                    {
                        ?>
                        <td><input type='text' value='<?php echo $priorityLevel_name; ?>' class='form-control' readonly></td>
                        <?php 
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
            ?>
        </tr>
        <tr>
            <td>Due Date</td>
            <td><input type="text" value='<?php echo $task->obj_task_dueDate; ?>' class='form-control' readonly></td>
        </tr>
        <!-- task Status here -->
        <tr>
            <td>Status</td>
            <?php
                // read the task status from the database
                include_once 'objects/taskStatus.php';
                $taskStatus = new TaskStatus($db);
                $stmt = $taskStatus->read();
                // put them in a select drop-down
                while ($row_taskStatus = $stmt->fetchArray())
                {
                    extract($row_taskStatus);
                    // current taskStatus of the task must be selected
                    if($task->obj_taskStatus_id == $taskStatus_id)
                    {
                        ?>
                        <td><input type='text' value='<?php echo $taskStatus_name; ?>' class='form-control' readonly></td>
                        <?php 
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
            ?>
        </tr>
        <tr>
            <td>Feedback</td>
            <td><textarea rows="3" cols="50" class='form-control' readonly><?php echo $task->obj_task_feedBack; ?></textarea></td>
        </tr>
        <!-- task Type here -->
        <tr>
            <td>Type</td>
            <?php
                // read the task type from the database
                include_once 'objects/taskType.php';
                $taskType = new TaskType($db);
                $stmt = $taskType->read();
                // put them in a select drop-down
                while ($row_taskType = $stmt->fetchArray())
                {
                    extract($row_taskType);
                    // current taskType of the task must be selected
                    if($task->obj_taskType_id == $taskType_id)
                    {
                        ?>
                        <td><input type='text' value='<?php echo $taskType_name; ?>' class='form-control' readonly></td>
                        <?php 
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
            ?>
        </tr>
        <tr>
            <td>Edited At</td>
            <?php 
            if($task->obj_task_editedAt == "")
            {
                echo "<td><input type='text' value='-' class='form-control' readonly></td>";
            }
            else
            {
                ?>
                    <td><input type='text' value='<?php echo $task->obj_task_editedAt; ?>' class='form-control' readonly></td>;
                <?php 
            }
            ?>
        </tr>
 
    </table>

<?php
include_once "footer.php";
?>