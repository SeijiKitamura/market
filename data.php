<?php
require_once("php/html.function.php");
session_start();
if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
 header("Location:login.php");
}
htmlHeader("データ表示|");
?>

  <div id="wrapper">
   <div class="col1">
    <h2>データメニュー</h2>
    <div class="footerBox">
     <ul>
      <li>アクセスログ</li>
     </ul>
    </div><!--div class="footerBox"-->
   </div><!--div class="col1"-->

<!-- ここから 月を選択できるようにする-->
   <div class="col1">
    <h2>年月</h2>
    <div class="nentuki">
     <ul class="naviul">
      <li></li>
      <li></li>
     </ul>
    </div><!--div class="nentuki"-->
   </div><!--div class="col1"-->

   <div class="msgarea">
   </div><!--div class="msgarea"-->
   <div class="clr"></div>
  </div><!--div id="wrapper"-->

<?php
//htmlFooter()
?>
 </body>

 <script>
$(function(){
  makeNenBox();
});

 </script>
</html>
