<?php
require_once("php/html.function.php");
session_start();
if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
 header("Location:login.php");
}
htmlHeader("メニュー");
?>

  <div id="wrapper">
   <div class="tablearea">
    <table class="ItemData">
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
      <tr id="strmas">
       <td>店舗マスタ</td>
       <td>店舗マスタをインポートします</td>
      </tr>
      <tr id="dpsmas">
       <td>メジャーマスタ</td>
       <td>メジャーマスタをインポートします</td>
      </tr>
      <tr id="linmas">
       <td>部門マスタ</td>
       <td>部門マスタをインポートします</td>
      </tr>
      <tr id="clsmas">
       <td>クラスマスタ</td>
       <td>クラスマスタをインポートします</td>
      </tr>
      <tr id="tirasi">
       <td>特売情報</td>
       <td>チラシ、メール、月間、カレンダーなどの特売情報をインポートします。</td>
      </tr>
      <tr>
       <td><a href="data.php">アクセスログ</a></td>
       <td><a href="data.php">各ページ、どのくらい閲覧されたかを知ることができます。</a></td>
      </tr>
     </tbody>
    </table>
   </div><!--div class="tablearea"-->
   
   <div class="msgarea">
   </div><!--div class="msgarea"-->

  </div><!--div id="wrapper"-->

<?php
//htmlFooter()
?>
 </body>

 <script>
$(function(){
 tableHover();
 dbinit();
 inpstrmas();
 inpdpsmas();
 inplinmas();
 inpclsmas();
 inptirasi();
 getlist();
});



 </script>
</html>
