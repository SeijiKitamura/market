<?php
//商品について
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="aboutsite.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="商品について";

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

   <div class="col1">
    <h2>商品について</h2>
    <p>
ホームページ上に掲載しております商品は正確性を保つよう最善の努力をしておりますが、
場合によっては店頭にて販売しているものと差異が生じる場合がございます。
特に以下の点についてはホームページ上と店頭において差異が出やすい事象となっております。
この場合、誠に申し訳ございませんが店頭を優先させていただきます。
当店では今後もお客様により一層のサービスを提供できるよう努力してまいります。
何卒、よろしくお願い申し上げます。
    </p>
   </div><!--div class="col1"-->
   <div class="footerBox">
    <h2>差異の出やすい事象</h2>
    <ul>
     <li>実際の商品の内容(写真と違う)</li>
     <li>商品が売場になかった</li>
     <li>商品の産地、容量、値段</li>
     <li>商品名と写真が違う</li>
    </ul>
   </div><!--div class="footerBox"-->
   <div class="col1">
    <h2>消費税について</h2>
    <p>
表示しております商品はすべて消費税抜きの価格となっております。
お会計の際、別途消費税を加算させていただきます。
    </p>
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


