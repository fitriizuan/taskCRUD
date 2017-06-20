# taskCRUD
A simple PHP CRUD system for Task activity

This apps able to list all task, view, edit and delete selected task with SQLite as the db.
The db for this task is named as 'task'. There are 4 tables in this db which are namely as task, priorityLevel, taskStatus,taskType.
-------------------------------------------------------------------------------------------------------------------------------------
The tables and its field are as follows:

-Table task-
1.  task_id - pk, int, autoincrement --> act as the primary key for this table
2.  task_title - vc(100), not null --> the name and title of the task created
3.  task_description - text --> the description of the task created
4.  task_assignTo - vc(100), not  null --> to whom the task will be assigned to
5.  task_submitTo - vc(100), not null --> the one who give the task/to whom the task will be submitted to.
6.  priorityLevel_id - fk(priorityLevel), int, not null --> determine the priority Level of the task
7.  task_dueDate - timestamp, not null --> when is the due date of the task
8.  tastStatus_id - fk(taskStatus), int, not null --> the status of the task
9.  task_feedBack - text --> the feedback for the task completed given by the 'submitTo' 
10. taskType_id - fk(taskType), int, not null --> the type of the task given
11. task_editedAt - timestamp, default null --> date and time of when the task is changed/edited by the 'submitTo'. Auto updated in update operation query.

-Table priorityLevel-
1.  priorityLevel_id - pk, int, autoincrement --> act as primary key of  this table
2. priorityLevel_name - vc(100), not null --> the name of the priority Level eg: high, medium, low

-Table taskStatus-
1. taskStatus_id - pk, int, autoincrement --> act as primary key of this table
2. taskStatus_name - vc(100), not null --> the status name of the task  eg: On Going, Submitted, Pending, Cancelled, etc.

-Table taskType-
1. taskType_id - pk, int, autoincrement --> act as primary key of this table
2. taskType_name - vc(100), not null --> the type name of the task eg: Graphic & Video Editing, Meeting, Project Documentation, etc.

-------------------------------------------------------------------------------------------------------------------------------------
There are 13 files in this project. 
All the files will be explained briefly as follows:

1.  task.db - this file is the SQLite db for the task db.
2.  config/database.php - this file will connect the apps with the db.
3.  objects/task.php - All the properties and db operation(CRUD, etc.) of the task is in this file
4.  objects/priorityLevel - All the properties and db operation(CRUD, etc.) of the priorityLevel is in this file
5.  objects/taskStatus - All the properties and db operation(CRUD, etc.) of the taskStatus is in this file
6.  objects/taskType - All the properties and db operation(CRUD, etc.) of the taskType is in this file
7.  header.php - This file provide the header of the  apps. It also link the apps with bootstrap to use it as the UI for this apps.
8.  footer.php - This file provide the footer of the apps. 
9.  index.php - This is the beginning page of the projects. This file/page list briefly all the task in the db
10. add_task.php - This is the Add Task page. This file enable the user to add new task.
11. view_task.php - This is the View Task Page. This file enable the user to view the details of selected task.
12. update_task.php - This is the Update Task Page. This file enable the user to edit and update the changed task.
13. delete_task.php - This file provide delete operation of the selected task. The task can be deleted from the List Page.
