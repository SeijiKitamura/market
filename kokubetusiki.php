<?php
//通夜・告別式
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
$title="通夜・告別式について";

//ページ説明文
$description=<<<EOF
平成29年3月24日　午前4時7分に弊社代表取締役　北村　安祥が永眠いたしました。
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
     <h1>通夜・告別式のお知らせ</h1>
     <p> 
        弊社　代表取締役　北村　安祥は去る2017年3月24日（金）に78歳にて逝去いたしました。<br>
        ここに生前のご厚誼を深謝し謹んでご通知申し上げます。
     </p>

     <h2>日時について</h2>
     <p> 
         通夜・告別式は下記日程にて執り行います。<br>
<!--
         通夜 2017年3月30日(木) 午後6時 <br>
         告別式 2017年3月31日(金) 午前10時 出棺 午前11時 <br>
         会場 桐ケ谷斎場 (品川区西五反田5-32-20)<br>
         喪主 株式会社 スーパーキタムラ 取締役 北村 成吏
-->
     </p>

     <ul class="normal">
       <li>
         <span class="width1">通夜</span>
         <span class="width2">2017年3月30日(木) 午後6時</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">告別式</span>
         <span class="width2">2017年3月31日(金) 午前10時</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">出棺</span>
         <span class="width2">2017年3月31日(金) 午前11時</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">会場</span>
         <span class="width2">桐ケ谷斎場 (品川区西五反田5-32-20)</span>
         <div class="clr"></div>
       </li>
       <li>
         <span class="width1">喪主</span>
         <span class="width2">
            株式会社 スーパーキタムラ<br>
            取締役 北村 成吏
         </span>
         <div class="clr"></div>
       </li>
     </ul>

     <h2>お問い合わせ</h2>
     <p>大変恐れ入りますが、通夜・告別式についてのお問い合わせおよび供養注文先は下記にて承っております。</p>

     <p>
       株式会社 JA東京中央セレモニーセンター<br>
       TEL: 03-5315-1717<br>
       FAX: 03-5315-2010<br>
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



