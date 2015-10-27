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
       <td>チラシ</td>
       <td>チラシデータをインポートします</td>
      </tr>
      <tr id="mail">
       <td>メール</td>
       <td>メールデータをインポートします</td>
      </tr>
      <tr id="osusume">
       <td>おすすめ</td>
       <td>おすすめ商品をインポートします</td>
      </tr>
      <tr id="calendar">
       <td>カレンダー</td>
       <td>カレンダーをインポートします</td>
      </tr>
      <tr id="gotyumon">
       <td>ご注文</td>
       <td>ご注文をインポートします</td>
      </tr>
      <tr id="gekkan">
       <td>月間お買得品</td>
       <td>月間お買得品をインポートします</td>
      </tr>

     </tbody>
    </table>
   </div><!--div class="tablearea"-->
   
   <div class="msgarea">
   </div><!--div class="msgarea"-->

   <div class="tirasilist">
   </div><!--div class="tirasilist"-->

   <div class="maillist">
   </div><!--div class="maillist"-->

   <div class="osusumelist">
   </div><!--div class="osusumelist"-->


   <div class="calendarlist">
   </div><!--div class="calendarlist"-->

   <div class="gotyumonlist">
   </div><!--div class="gotyumonlist"-->

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
 inpmail();
 inposusume();
 inpcalendar();
 inpgotyumon();
 inpgekkan();
 getlist();
});



 </script>
</html>
