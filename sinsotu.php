<?php
//新卒採用
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="sinsotu.php";
aLog($_SERVER["REQUEST_URI"]);

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="新卒採用";

//ページ説明文
$description=<<<EOF
新入社員採用についてまとめました。こちらのページに書いてある内容を参考に
していただければと思います。「なぜ新入社員を採用するのか」「採用方針」などを
わかりやすくまとめたページとなっています。入社後のステップアップ、先輩社員へのインタビューも掲載中。
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
    <a href="saiyoujikou.php">
     <h1>新卒採用募集事項</h1>
     <p>
      2016年についての詳細はこちらです。
     </p>
    </a>
   </div><!--div class="col1"-->

   <div class="col1">
    <a href="kyujinriyu.php">
     <h2>求人理由</h2>
     <div class="footerBox">
      <ul>
       <li>創業からの考え方</li>
       <li>今、挑戦していること</li>
       <li>実現したいこと</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->

   <div class="col1">
    <a href="saiyohousin.php">
     <h2>採用方針</h2>
     <div class="footerBox">
      <ul>
       <li>基礎となる考え方</li>
       <li>仕事は楽しく</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->

   <div class="col1">
    <a href="sagyonaiyo.php">
     <h2>作業内容について</h2>
     <div class="footerBox">
      <ul>
       <li>生鮮・惣菜</li>
       <li>レジ</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->

   <div class="col1">
    <a href="stepup.php">
     <h2>ステップアップ</h2>
     <div class="footerBox">
      <ul>
       <li>1〜3年目</li>
       <li>4〜5年目</li>
       <li>6年目〜</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->
   <div class="clr"></div>

   <div class="col1">
    <a href="communication.php">
     <h2>コミュニケーション</h2>
     <div class="footerBox">
      <ul>
       <li>新入社員歓迎会</li>
       <li>山中湖保養所</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->

   <div class="col1">
    <a href="interview.php">
     <h2>先輩社員へインタビュー</h2>
     <div class="footerBox">
      <ul>
       <li>志望動機</li>
       <li>入社後</li>
       <li>入社1年たって</li>
       <li>これから</li>
       <li>新入社員にむけて</li>
       <li>後日談</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->

   <div class="col1">
    <a href="saiyojisseki.php">
     <h2>採用実績と在籍者数</h2>
     <div class="footerBox">
      <ul>
       <li>採用実績</li>
       <li>採用者数と在籍者数</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->

   <div class="col1">
    <a href="schedule.php">
     <h2>応募条件とスケジュール</h2>
     <div class="footerBox">
      <ul>
       <li>応募条件</li>
       <li>スケジュール</li>
      </ul>
     </div>
    </a>
   </div><!--div class="col1"-->


   <div class="clr"></div>
<?php
htmlSNSButton();
?>
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




