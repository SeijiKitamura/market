<?php
//お問い合せ方法
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="torihikisaki.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="お問い合せ方法";

//ページ説明文
$description=<<<EOF
株式会社スーパーキタムラへのメールでの連絡方法についてご案内いたします。
弊社では、各担当者は主に平日に交代制にてお休みを頂いております。
お電話での連絡等はそのお休みにあたってしまう場合がございますので、可能な
限りメールにてご連絡ください。
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
    <h2>お客様へ</h2>
    <p>
当店へのメールでのお問い合せには以下の方法で承っております。
     <blockquote>
連絡方法<br>
メール(info@kita-grp.co.jp)にて承ります。スパムメール対策としてメールの件名に「お客様サポート」と記入の上、メールを送信してください。
件名に「お客様サポート」が記入されていない場合、メールを送信いただきましても返信できない場合がございます。<br>
また、携帯電話からご送信する場合はドメイン指定のご確認をお願いいたします。<br>
「kita-grp.co.jpを許可する」としていただきますと、弊社からのメールが届きます。
     </blockquote>
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>面接をご希望の方へ</h2>
    <p>
新入社員、パート、アルバイトなど弊社でのお仕事をご希望されている方は以下の方法で承っております。
     <blockquote>
連絡方法<br>
メール(info@kita-grp.co.jp)にて承ります。スパムメール対策としてメールの件名に「面接希望」と記入の上、メールを送信してください。
件名に「面接希望」が記入されていない場合、メールを送信いただきましても返信できない場合がございます。
お手数をおかけしますが、何卒ご協力をお願い申し上げます。<br>
また、携帯電話からご送信する場合はドメイン指定のご確認をお願いいたします。<br>
「kita-grp.co.jpを許可する」としていただきますと、弊社からのメールが届きます。
     </blockquote>
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>取引先様へ</h2>
    <p>
株式会社スーパーキタムラでは地域のお客様の食生活を豊かにするために、新しい取引先様を探しております。
     <blockquote>
お支払いサイト<br>
市場関係・・・原則10日毎のお支払いとさせていただいております。請求書をご送付後、指定口座へお振り込みいたします。<br>
その他　・・・月末締めの翌月20日までにお支払いとさせて頂いております。請求書をご送付後、指定口座へお振り込みいたします。</br>
<br>
連絡方法<br>
メール(info@kita-grp.co.jp)にて承ります。スパムメール対策としてメールの件名に「取引希望」と記入の上、メールを送信してください。
件名に「取引希望」が記入されていない場合、メールを送信いただきましても返信できない場合がございます。
お手数をおかけしますが、何卒ご協力をお願い申し上げます。<br>
(誠に恐縮ですがお電話、FAX、郵送での受付は一切行っておりません。)
     </blockquote>
    </p>
   </div><!--div class="col1"-->

   <div class="col1">
    <h2>メディア関係の方へ</h2>
    <p>
当店への取材、撮影等のご相談については、以下の方法にて承っております。
     <blockquote>
連絡方法<br>
メール(info@kita-grp.co.jp)にて承ります。スパムメール対策としてメールの件名に「取材希望」と記入の上、メールを送信してください。
件名に「取材希望」が記入されていない場合、メールを送信いただきましても返信できない場合がございます。
お手数をおかけしますが、何卒ご協力をお願い申し上げます。<br>
(誠に恐縮ですがお電話、FAX、郵送での受付は一切行っておりません。)
     </blockquote>
    </p>

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

