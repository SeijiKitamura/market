<?php
//新卒採用
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
$title="新卒採用事項";

//ページ説明文
$description=<<<EOF
今年の採用事項についての詳細をご案内しています。弊社では新入社員は大きく分けて
２つの職場に分けて配属されます。「生鮮・惣菜」もしくは「レジ」部門となります。
どちらを希望するかよく検討の上、応募ください。もちろん、途中から配属先の変更を
希望することも可能です。
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
    <h1>新卒採用募集事項</h1>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>2016年募集要項</h2>
    <table class="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <tbody>
      <tr>
       <td>募集職種</td>
       <td>部門担当として商品化及び商品管理業務。<br>または<br>POSレジのオペレーション及び接客のレジ業務</td>
      </tr>

      <tr>
       <td>採用人数</td>
       <td>生鮮2名　レジ2名</td>
      </tr>

      <tr>
       <td>選考方法</td>
       <td>筆記試験・面接</td>
      </tr>

      <tr>
       <td>初任給与</td>
       <td>185,000円</td>
      </tr>

      <tr>
       <td>賞与</td>
       <td>年2回（7月・12月）</td>
      </tr>

      <tr>
       <td>昇給</td>
       <td>年1回（4月）</td>
      </tr>

      <tr>
       <td>勤務時間</td>
       <td>交替勤務制（部門により異なる）・残業あり</td>
      </tr>

      <tr>
       <td>休日/(休暇)</td>
       <td>年間105日(年次有給休暇　初年度10日）</td>
      </tr>

      <tr>
       <td>勤務地</td>
       <td>東京都大田区</td>
      </tr>

      <tr>
       <td>福利厚生</td>
       <td>厚生年金・雇用保険・労災保険・介護保険</td>
      </tr>

      <tr>
       <td>応募資格</td>
       <td>2016年3月卒業見込みの高校生</td>
      </tr>

      <tr>
       <td>応募受付</td>
       <td>随時受付しています</td>
      </tr>

      <tr>
       <td>連絡先</td>
       <td>株式会社スーパーキタムラ　採用担当<br>電話番号:03-3778-1271<br>住所：東京都大田区南馬込4-21-10</td>
      </tr>
     </tbody>
    </table>
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
