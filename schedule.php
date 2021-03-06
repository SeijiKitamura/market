<?php
//採用スケジュール
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

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
$description=<<<EOF
面接から採用までのスケジュールについてご案内しています。
まずは職場見学から始まります。
従業員一同みなさんの見学を心からお待ちしています。
EOF;

htmlHeader($title,$description);
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
      <li>応募資格:平成28年度(2017年3月)高等学校卒業が見込まれる方</li>
      <li>東京都大田区近郊にお住まいの方</li>
     </ul>
    </div>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>スケジュール</h2>
    <table class="ItemData">
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
    
    <p>
     新規高等学校卒業者は学校またはハローワークを通じてご応募ください。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul class="SinsotuNavi">
     <li><a href="saiyojisseki.php">戻る</a></li>
     <li><a href="sinsotu.php">目次</a></li>
    </ul>
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




