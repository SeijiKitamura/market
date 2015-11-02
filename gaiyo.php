<?php
//アクセス
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="gaiyo.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="会社概要";

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
    <h1>会社概要</h1>
    <img class="backimage" src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    <h2>概要</h2>
    <div class="footerBox">
    <ul>
<?php
echo "<li>株式会社".CORPNAME."</li>";
echo "<li>".PRESIDENT."</li>";
echo "<li>事業内容:".JIGYO."</li>";
echo "<li>資本金：".SIHONKIN."</li>";
echo "<li>従業員：".WORKMEN."</li>";
echo "<li>店舗数：".STORECOUNT."</li>";
?>
    </ul>
    </div><!--div class="footerBox"-->
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>沿革</h2>
    <table id="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <thead>
      <tr>
       <th>年月</th>
       <th>内容</th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <td>1958年</td>
       <td> 北村商店設立。店舗面積9坪。 </td>
      </tr>
      <tr>
       <td>1965年6月</td>
       <td> たばこ・塩販売開始。</td>
      </tr>
      <tr>
       <td>1965年7月</td>
       <td>
        有限会社 兼菊北村商店を設立し、株式会社 北村商店から食料品部門を分離。資本金100万円。
       </td>
      </tr>
      <tr>
       <td>1971年6月</td>
       <td> お酒販売開始。</td>
      <tr>
       <td>1981年10月</td>
       <td> スーパーマーケットとして開店。この日から現在まで1日も休むことなく営業中。店舗面積120坪。</td>
      </tr>
      <tr>
       <td>1983年11月</td>
       <td> お米販売開始。 </td>
      </tr>
      <tr>
       <td>1986年2月</td>
       <td>
        株式会社 スーパーキタムラを設立し、有限会社 兼菊北村商店から食料品部門を分離。資本金1000万円。
       </td>
      </tr>
      <tr>
       <td>1993年3月</td>
       <td> 増築。店舗面積250坪。(現在の店舗面積に至る)</td>
      </tr>
      <tr>
       <td>1997年6月</td>
       <td> 中央店開店。</td>
      </tr>
      <tr>
       <td>2000年1月</td>
       <td> 中央店閉店。 </td>
      </tr>
      <tr>
       <td>2002年6月</td>
       <td> 売場改装。自家製パン工場、「シェノール」開始。 </td>
      </tr>
      <tr>
       <td>2003年</td>
       <td> 売場改装。対面販売方式の天ぷらフライコーナー開始。 </td>
      </tr>
      <tr>
       <td>2003年12月</td>
       <td> 株式会社スーパーキタムラの資本金を4000万円へ増資。 </td>
      </tr>
      <tr>
       <td>2004年10月</td>
       <td> 売場改装。精肉、鮮魚売場に冷蔵平ケースを導入し売場拡大。 </td>
      </tr>
      <tr>
       <td>2007年9月</td>
       <td> 株式会社スーパーキタムラの資本金を9900万円へ増資。 </td>
      </tr>
      <tr>
       <td>2010年8月</td>
       <td> 売場改装。精肉売場を青果売場横へ移動。 </td>
      </tr>
      <tr>
       <td>2010年9月</td>
       <td> 配達サービス開始。 </td>
      </tr>
      <tr>
       <td>2012年10月</td>
       <td>ホーム館閉店</td>
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



