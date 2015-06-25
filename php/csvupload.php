<?php
require_once("import.function.php");

$tablename=$_POST["tablename"];
impPost2DB($tablename);

echo "success";
?>
