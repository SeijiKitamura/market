<?php
//チラシリスト

require_once("php/view.function.php");
require_once("php/html.function.php");

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

//チラシ番号をゲット(追い打ちチラシは非表示)
$adnumary=viewGetAdnum($strcode,$saleday);
if(count($adnumary)){
 $adnum=$adnumary[0]["adnum"];
}

if($adnum){
 //店舗全体の日付リスト、商品リストをゲット
 $daylist=viewGetFlyersDayLin ($strcode,$adnum);
 $dpslist=viewGetSaleDpsList  ($strcode,$adnum,$saleday);
 $itemlist=viewGetFlyersItemLin($strcode,$adnum,$saleday);
}

//タイトル決定
if(count($itemlist)){
 $title="チラシ商品一覧|".date("Y年m月d日",strtotime($itemlist[0]["startday"]));
 $description=<<<EOF
新聞折込チラシで配布した商品をご紹介しております。また、広告には載せきれなかった商品を
Web限定商品としてご案内中です。だから実際のチラシよりも内容が充実。
スーパーキタムラのインターネットチラシ。こちらの広告をぜひご利用くださいませ。
EOF;
}
else{
 $title="チラシ商品一覧|申し訳ございません。本日はチラシが入っていません";
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
<?php
if($itemlist){
}

if($daylist){
 echo "<h1>".date("Y年m月d日",strtotime($daylist[0]["saleday"]))."投函のチラシ</h1>";
 $imgpath=date("Ymd",strtotime($daylist[0]["saleday"]));
 echo "<div class='col2'>";
 $path=realpath("./").IMG."/".$imgpath."a.jpg";
 if(file_exists($path)){
  echo "<a href='tirasiimg.php?strcode={$strcode}&saleday={$saleday}'>";
  echo "<img src='.".IMG."/".$imgpath."a.jpg'>";
  echo "</a>";
 }
 echo "</div>";
 echo "<div class='col2'>";
 $path=realpath("./").IMG."/".$imgpath."b.jpg";
 if(file_exists($path)){
  echo "<a href='tirasiimg.php?strcode={$strcode}&saleday={$saleday}'>";
  echo "<img src='.".IMG."/".$imgpath."b.jpg'>";
  echo "</a>";
 }
 echo "</div>";
 echo "<div class='clr'></div>";
}
else{
 echo "<p>申し訳ございません。本日はご案内するチラシ商品がございません</p>";
}
?>
   </div><!--div class="col1"-->

   <div class="col1">
<?php
//日付リスト表示
if($daylist){
 echo "<ul class='daylist'>";
 foreach($daylist as $key=>$val){
  //$d=date("n月j日",strtotime($val["saleday"]));
  $d=date("j日",strtotime($val["saleday"]));
  $d.="({$YOUBI[date("w",strtotime($val["saleday"]))]})";
  echo "<li><a href='tirasilist.php?strcode={$strcode}&saleday={$val["saleday"]}'>";
  echo $d;
  echo "</a></li>";
 }
 echo "</ul>";
}
?>
    <div class="clr"></div>
   </div><!--div class="col1"-->
  
<?php
if($itemlist){
 $grpname="";
 foreach($itemlist as $key=>$val){
  //終了日セット
  $lday=date("m月d日",strtotime($val["endday"]));
  if(strtotime($val["startday"])===strtotime($val["endday"])){
   $lday.="限り";
  }
  else{
   $lday.="まで";
  }

  if(! $val["grpname"]){
   //グループ名空欄
   if($grpname!==$lday){
    echo "<div class='clr'></div>";
    echo "<h2>".$lday."</h2>";
    $grpname=$lday;
   }
  } 
  else{
   //グループ名有り
   if($grpname!=$val["grpname"]){
    echo "<div class='clr'></div>";
    echo "<h2>".$val["grpname"]." ".$lday."</h2>";
    $grpname=$val["grpname"];
   }
  }
?>
   <div class="col3">
<?php 
  $ary=array();
  $ary[]=$itemlist[$key];
  htmlItemList($ary);
?>
   </div><!--div class="col3"-->
<?php
 }
}
?>

<?php
htmlSNSButton();
?>
   <div id="footer">
    <div class="footerBox">
     <h3>過去のチラシ</h3>
     <ul>
      <li><a href="tirasiarchive.php">以前配布されたチラシについてはこちらをごらんください</a></li>
     </ul>
    </div><!--div class="footerbox"-->
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->
 </body>
</html>

