<?php
//配達
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
$title="配達サービス";

//ページ説明文
$description=<<<EOF
配達サービス実施中です。当店にてご購入された商品をご自宅まで配達。
馬込は坂が多くお荷物を持って帰るのが大変です。ぜひ、お気軽にご利用くださいませ。
送料は200円ですが3000円以上のお買い上げで送料無料となります。
配達地域、配達時間等についてはこのページをご覧ください。
EOF;

htmlHeader($title,$description);
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>配達サービス</h2>
    <img src="img/haitatuhead.png">
    <p>
お買い上げ商品をご自宅までお届けします。お会計時にレジ係員までお申し出ください。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>送料</h2>
    <p>
送料200円で配達いたします。さらにお買上金額3000円以上で送料!
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>配達地域</h2>
    <table class="ItemData">
     <tbody>
      <tr>
       <td>南馬込全域</td>
       <td>西馬込全域</td>
       <td>東馬込全域</td>
       <td>中馬込全域</td>
      </tr>
      <tr>
       <td>中央全域</td>
       <td>山王全域</td>
       <td>上池台全域</td>
       <td>仲池上全域</td>
      </tr>
      <tr>
       <td>池上1-5丁目</td>
       <td>大森北1,4,5丁目</td>
       <td>大森西1,4,7丁目</td>
      </tr>
     </tbody>
    </table>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>配達時間</h2>
    <table class="ItemData">
     <thead>
      <tr>
       <th>受付時間</th>
       <th>配達時間</th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <td> -12:30</td>
       <td> 11:00-13:00</td>
      </tr>
      <tr>
       <td> 12:00-15:00</td>
       <td> 15:00-17:00</td>
      </tr>
      <tr>
       <td> 15:00-18:00</td>
       <td> 17:00-19:00</td>
      </tr>
      <tr>
       <td> 18:00-22:00</td>
       <td> 10:00-12:00(翌日)</td>
      </tr>
     </tbody>
    </table>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>配達できないもの</h2>
    <p>
冷凍食品、アイスクリームは配達対象外とさせていただきます。
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>その他</h2>
    <p>
当サービスはお会計済みの商品が対象となっております。
お電話、FAXでのご注文は誠に申し訳ございませんが承っておりません。
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



