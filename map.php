<?php
//アクセス
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="map.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="アクセス";

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
    <h2>アクセスマップ</h2>
    <p>地図をクリックとGoogleMapが開きます</p>
    <div class="PC">
    <a href="https://maps.google.com/maps?q=東京都大田区南馬込4-21-10">
     <img src="img/staticmap.png">
    </a>
    </div>

    <div class="SP">
    <a href="comgooglemaps://maps.google.com/maps?q=東京都大田区南馬込4-21-10">
     <img src="img/staticmap.png">
    </a>
    </div>

   </div><!--div class="col1"-->

   <div class="col1">
    <h2>駐車場</h2>
    <img src="img/carpark2.jpg">
    <p>40台分の無料駐車場があります。坂の多い馬込ですからお車でのご来店をおすすめします。もちろん、駐輪場もあります。</p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>ご提供サービス</h2>
    <p>
     クレジットカード/Suica/PASUMO/QUICPay/大田区共通商品券/ビール券/
     たばこ/切手/はがき/キタムラ商品券/
     宅配便（クロネコ・佐川急便）/写真プリント/電子レンジ/配達
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



