<?php
//チラシ画像

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="tirasiimg.php";
wLog("pagecount ".$me);

//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// saleday 日付 [推奨] ない場合は当日になる
// 最小引数 ?strcode=1&saleday=yyyy-mm-dd

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}

//日付確定
if($_GET["saleday"] &&chkDate($_GET["saleday"])){
 $saleday=$_GET["saleday"];
} 
else{
 $saleday=date("Y-m-d");
}

//リスト用リンク作成
$link="tirasilist.php?strcode={$strcode}&saleday={$saleday}";

//チラシ番号をゲット(追い打ちチラシは非表示)
$adnumary=viewGetAdnum($strcode,$saleday);
if(count($adnumary)){
 $adnum=$adnumary[0]["adnum"];
}

if($adnum){
 //店舗全体の日付リスト、商品リストをゲット
 $daylist=viewGetFlyersDayLin ($strcode,$adnum);
 
 //投函日ゲット
 $adday=$daylist[0]["saleday"];
}

//タイトル決定
if($daylist){
 $title=date("Y年m月d日",strtotime($adday))."投函のチラシ";
 $description=<<<EOF
新聞折込チラシの画像をそのままご覧いただけます。広告は表面フルカラー、裏面2色ですがインターネット上では
両面フルカラーとなっています。ぜひこちらもご活用ください。
EOF;
}
else{
 $title="申し訳ございません。本日はチラシが入っていません";
}

htmlHeader($title,$description);
?>
  <div id="wrapper">

   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <ul>
    <li><a href="<?php echo $link; ?>">チラシ一覧へ戻る</a></li>
    </ul>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
if($daylist){
 echo "<h1>".$title."</h1>";
}
else{
 echo "<p>申し訳ございません。本日はご案内するチラシ商品がございません</p>";
}
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
//A面
$imgdir=realpath("./").IMG."/".date("Ymd",strtotime($adday));
$imgpath=$imgdir."a.jpg";
if(file_exists($imgpath)){
 echo "<img src='./".IMG."/".date("Ymd",strtotime($adday))."a.jpg' alt='".date("Y年m月d日",strtotime($adday))."のチラシA面 | ".CORPNAME."'>";
}
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
//B面
$imgpath=$imgdir."b.jpg";
if(file_exists($imgpath)){
 echo "<img src='./".IMG."/".date("Ymd",strtotime($adday))."b.jpg' alt='".date("Y年m月d日",strtotime($adday))."のチラシB面 | ".CORPNAME."'>";
}
?>
   </div><!--div class="col1"-->

<?php
htmlSNSButton();
?>

   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->


