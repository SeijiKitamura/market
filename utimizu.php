<?php
//打ち水大作戦
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
$title="キタムラ打ち水大作戦";

//ページ説明文
$description=<<<EOF
平成29年7月30日　15：30からお客様駐車場にて「打ち水」イベントを行います。
先着40名様に参加賞もプレゼント。
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
     <h1>キタムラ打ち水大作戦について</h1>

     <div class="col2">
       <img src="img/utimizu20170730_1.jpg">
     </div>
     <div class="col2">
       <img src="img/utimizu20170730_3.jpg">
     </div>
     <div class="clr"></div>
     <p>
       たくさんのご参加まことにありがとうございました。おかげさまで大成功となりました。また次の機会をお楽しみに！
     </p>

     <h2>キタムラ打ち水大作戦とは？</h2>
     <p><a href="http://uchimizu.jp/" style="text-decoration:underline;">打ち水大作戦本部</a>様が主催されている「打ち水大作戦」に<a href="http://uchimizu.jp/events/detail/82
" style="text-decoration:underline;">スーパーキタムラ</a>も参加させていただくことになりました。</p>

     <div class="clr"></div>

     <h2>日時について</h2>
     <ul class="normal">
       <li>
         <span class="width1">日時</span>
         <span class="width2">2017年7月30日(日) 15時30分から(開場15時00分）</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">会場</span>
         <span class="width2">スーパーキタムラ　お客様駐車場</span>
         <div class="clr"></div>
       </li>
     </ul>
     <p>打ち水大作戦終了後に「縁日」がスタートします。</p>

     <h2>参加賞について</h2>
     <p>
       「キタムラ打ち水大作戦」に参加されたお客様(先着40名様）が対象になります。
     </p>
     <ul class="normal">
       <li>
         <span class="width1">参加賞 1 </span>
         <span class="width2">「打ち水大作戦」にご参加されたお客様 -> 縁日枚1枚をプレゼント！</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">参加賞 2 </span>
         <span class="width2">&nbsp 浴衣、ハッピなど夏祭りに関連する衣装を着て来る -> 縁日券2枚をプレゼント！</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">参加賞 3 </span>
         <span class="width2">&nbsp 打ち水の様子をInstagramに投稿(#キタムラ打ち水大作戦）-> 縁日券2枚プレゼント</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">ボーナス </span>
         <span class="width2">&nbsp 上記3つをすべて達成した場合-> 縁日券1枚プレゼント</span>
         <div class="clr"></div>
       </li>
     </ul>
     <p>
       参加されたお客様に上記内容が記載されたスタンプカードをお配りいたします。該当する条件を満たしていればスタンプを捺印させていただきます。捺印されたスタンプカードはサービスカウンターにて縁日券と交換いたします。（当日18時まで）
     </p>

     <h2>ご注意点</h2>
     <p>
       お客様駐車場を閉鎖して打ち水を行いますのでお車でご来店されても駐車できない場合がございます。</br>
       雨天の場合やそのほかイベントを実行できないと判断した場合、予告なく中止となる場合がございます。</br>
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



