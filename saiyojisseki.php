<?php
//採用実績
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="saiyojisseki.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="採用実績";

//ページ説明文
$description=<<<EOF
2009年以降入社した新入社員の採用実績と今も一緒に働いている人の数を表にまとめました。
出身別高校もあわせてご紹介中。今いる人はみんな優しい人ばかりです。
EOF;

htmlHeader($title,$description);

//print_r($item);
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <h1>採用実績と在籍者数</h1>
    <p>
     2015年10月現在の採用実績と在籍者数を掲載します。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>採用実績</h2>
    <div class="footerBox">
     <ul>
      <li>東京実業高等学校</li>
      <li>大森学園高等学校</li>
      <li>都立蒲田高等学校</li>
      <li>都立大森高等学校</li>
      <li>都立六郷工科高等学校</li>
     </ul>
    </div><!--div class="footerBox"-->
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>採用者数と在籍者数</h2>
    <table class="ItemData">
     <thead>
      <tr>
       <th>年</th>
       <th>採用者数</th>
       <th>在籍者数</th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <td>2009年</td>
       <td>1人</td>
       <td>0人</td>
      </tr>
      <tr>
       <td>2010年</td>
       <td>2人</td>
       <td>1人</td>
      </tr>
      <tr>
       <td>2011年</td>
       <td>3人</td>
       <td>2人</td>
      </tr>
      <tr>
       <td>2012年</td>
       <td>4人</td>
       <td>2人</td>
      </tr>
      <tr>
       <td>2013年</td>
       <td>2人</td>
       <td>2人</td>
      </tr>
      <tr>
       <td>2014年</td>
       <td>3人</td>
       <td>3人</td>
      </tr>
      <tr>
       <td>2015年</td>
       <td>2人</td>
       <td>2人</td>
      </tr>
     </tbody>
    </table>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul class="SinsotuNavi">
     <li><a href="interview.php">戻る</a></li>
     <li><a href="sinsotu.php">目次</a></li>
     <li><a href="schedule.php">次へ</a></li>
    </ul>
   </div><!--div class="col1"-->

   <div class="clr"></div>

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

