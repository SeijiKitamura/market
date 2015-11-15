<?php
//プライバシーポリシー
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="privacy.php";
aLog($_SERVER["REQUEST_URI"]);

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="サイトポリシー";

//ページ説明文
$description=<<<EOF
弊社の個人情報の取り扱い、個人情報保護方針の説明をさせて頂いております。
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
     <h2>個人情報の取り扱い</h2>
    <p>
株式会社スーパーキタムラ（以下「当社」といいます）は、お客さまの氏名・住所・電話番号等の個人を識別できる情報（以下「個人情報」といいます）の保護を事業運営上の最重要事項と位置づけ、常にその責任を認識し、保護に努めます。
    </p>
    <div class="footerBox">
     <h2>個人情報保護方針</h2>
     <ul>
      <li>1. 当社が、お客さまより個人情報をお預かりする場合は、利用目的を明らかにし、あらかじめお客さまにご了解いただいた上で、ご提供していただきます。</li>
      <li>2. 当社は、ご提供いただいた個人情報を、あらかじめお客さまからご了解いただている目的および当該業務以外では使用いたしません。</li>
      <li>3. 当社は、お客さまの個人情報への不正アクセスや漏洩、紛失、破壊、改ざん等の行為に対して適切な保護対策を実施し、安全管理に努めます。</li>
      <li>4. 当社は、個人情報の管理業務等の一部を業務委託先に委託する場合は、委託先に対しても、安全管理が図られるよう、必要な監査を行います。</li>
      <li>5. 当社は、お客さまの個人情報を、お客さまの同意を得ることなく、第三者に開示しません。ただし、「個人情報保護法」に基づく場合は、お客さまの同意を得ることなく、個人情報を開示することがあります。</li>
      <li>6. 当社は、お客さまご自身からの個人情報へのお問い合わせに対し、ご要望に従い、開示・訂正・削除等を厳正かつ迅速に対応いたします。</li>
      <li>7. 当社は、個人情報保護関連法規やその他社会的規範を遵守し、個人情報保護対策の継続的な維持向上に努めます。</li>
      <li>8. 当社は、個人情報保護基本方針を、関連する法規制等の制定・改定、経営環境や事業内容が変化した場合等、必要に応じて見直しを行い、継続的改善に努めます。</li>
     </ul>
    </div><!--div class="footerBox"-->

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
