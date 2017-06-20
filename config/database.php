<?php

//create or connect sqlite db
$db_name = "task.db";

$db = new SQLite3($db_name);

if(!$db)
{
	die("database not created...");
}

?>