<?php
//過去のセール商品リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}

//タイトル決定
$title="過去のセール商品一覧|";
$description=<<<EOF
過去のセール商品一覧です。ご希望の年月を選んで知りたい情報をクリックしてください。
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
    <h2>過去のチラシ一覧</h2>
    <div class="listbox">
    </div><!--div class="listbox"-->
    <div class="resultbox">
    </div><!--div class="listbox"-->
   </div><!--div class="col1"-->

   <div class="col1">
   </div><!--div class="col1"-->
  
   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->
 </body>
<script>
$(function(){
 salelist();
});

</script>
</html>

