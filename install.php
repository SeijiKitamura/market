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
if(DEBUG){
 $db=new DB();
 $db->CreateTable();
 echo "success";
}
else{
 echo "現在のモードでは初期化できません";
}
?>

   </div><!--div id="wrapper"-->
 </body>
</html>


