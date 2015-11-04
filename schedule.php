<?php
//採用スケジュール
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="schedule.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="採用までのスケジュール";

//ページ説明文
$description="";
htmlHeader($title,$description);

//print_r($item);
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="clr"></div>

   <div class="col1">
    <h1>応募条件とスケジュール</h1>
    <p>
応募条件とスケジュールについて説明します。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>応募条件</h2>
    <div class="footerBox">
     <ul>
      <li>応募資格:平成27年度(2016年3月)高等学校卒業が見込まれる方</li>
      <li>東京都大田区近郊にお住まいの方</li>
     </ul>
    </div>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>スケジュール</h2>
    <table id="ItemData">
     <tbody>
      <tr>
       <td>1. 職場見学</td>
       <td> 随時受付中。ご希望の方は当社採用担当まで連絡ください。</td>
      </td>
      <tr>
       <td>2. 面接・筆記試験</td>
       <td>志望動機等を伺います。その後、筆記試験を行います。</td>
      </tr>
      <tr>
      <td>3. 採用通知</td>
      <td>面接後、1週間程度でご自宅に郵送いたします。</td>
      </tr>
      <tr>
       <td>4. 入社前準備説明会</td>
       <td> 入社式にむけて準備しておくことなどを説明いたします。</td>
      </tr>
      <tr>
       <td>5. 入社式</td>
       <td>当社にてささやかな入社式を行います。</td>
      </tr>
     </tbody>
    </table>
<a href="interview.php">次ページ　インタビュー</a>
   </div><!--div class="col1"-->
<?php
htmlSNSButton();
?>
   <div class="clr"></div>

   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->
 </body>
<script>
$(function(){
});
</script>
</html>




