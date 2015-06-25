<?php
require_once("php/html.function.php");
require_once("php/db.class.php");

session_start();
if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
 header("Location:login.php");
}

htmlHeader("インストール");
?>

   <div id="wrapper">

<?php
//DBテーブル作成
$db=new DB();
$db->CreateTable();
echo "success";
?>

   </div><!--div id="wrapper"-->
 </body>
</html>


