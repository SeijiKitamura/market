<?php
require_once("php/html.function.php");
session_start();
if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
 header("Location:login.php");
}
htmlHeader("メニュー");
?>

  <div id="wrapper">
   <table>
    <thead>
     <tr>
      <th>項目</th>
      <th>内容</th>
     </tr>
    </thead>
    <tbody>
     <tr id="dbinit">
      <td>初期化</td>
      <td>すべてのデータを消去して最初からの状態にします
      </td>
     </tr>
     <tr id="tirasi">
      <td>チラシ</td>
      <td>チラシデータをインポートします</td>
     </tr>
    </tbody>
   </table>
  </div><!--div id="wrapper"-->

<?php
//htmlFooter()
?>
 </body>

 <script>
$(function(){
 tableHover();
 dbinit();
 inptirasi();
});



 </script>
</html>
