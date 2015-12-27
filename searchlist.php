<?php
//検索リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1&saleday=yyyy-mm-dd

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}

//キーワード(空欄区切り対応)
//if($_GET["keyword"]){
// $keyword = mb_convert_kana($_GET["keyword"], 's');
// $ary_keyword = preg_split('/[\s]+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
// print_r($ary_keyword);
// foreach($ary_keyword as $key=>$val){
//  if(preg_match("/^[0-9]+$/",$val)){
//   $jcode=$val;
//  }
//  else{
//   $keyword=$val;
//  }
// }
//}

//キーワード(空欄区切り未対応)
if($_GET["keyword"]){
 if(preg_match("/^[0-9]+$/",$_GET["keyword"])){
  $jcode=$_GET["keyword"];
 }
 else{
  $keyword=$_GET["keyword"];
 }
}


if($jcode || $keyword){
 //チラシ番号をゲット(追い打ちチラシは非表示)
 $adnumary=viewGetAdnum($strcode,date("Y-m-d"));
 if(count($adnumary)){
  $adnum=$adnumary[0]["adnum"];
  $tirasi=viewGetFlyersItemLin($strcode,$adnum,$saleday);
  foreach($tirasi as $key=>$val){
   if($jcode){
    if(preg_match("/".$jcode."/",$val["jcode"])){
     $tirasilist[]=$tirasi[$key];
    }
   }
   if($keyword){
    if(preg_match("/".$keyword."/",$val["sname"])){
     $tirasilist[]=$tirasi[$key];
    }
   }
  }
 }
 
 //セール商品
 $salelist=viewGetSearchSaleItem($strcode,$jcode,$keyword);
 
 //商品マスタをゲット
 $itemlist=viewGetSearchItem($strcode,$jcode,$keyword);
}

//タイトル決定
$title="商品検索";

$description=<<<EOF
当店で取り扱っている商品の検索はこちらでできます。JANコード検索もしくは商品名にて検索可能です。
表示される商品によってはすでに取り扱いを終了している商品もございます。
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
    <h1>商品検索</h1>
    <p>商品名、バーコードを入力して「検索ボタン」を押してください</p>
    <form action="searchlist.php" method="get">
    <input type="text" name="keyword" value="<?php echo $_GET["keyword"]; ?>">
     <input type="submit" value="検索">
    </form>
   </div><!--div class="col1"-->

   <div class="col1">
    <div class="SearchList">
<?php
if(count($tirasilist)){
 echo "<h2>広告の品</h2>";
 foreach($tirasilist as $key=>$val){
  echo "<div class='col3'>";
  $ary=array();
  $ary[]=$tirasilist[$key];
  htmlItemList($ary);
  echo "</div>";
 }
 
}

if(count($salelist)){
 $stype=null;
 foreach($salelist as $key=>$val){
  if($stype!==$val["saletype"]){
   $stype=$val["saletype"];
   echo "<div class='clr'></div>";
   echo "<h2>".$SALETYPE[$val["saletype"]]."</h2>";
  }
  echo "<div class='col3'>";
  $ary=array();
  $ary[]=$salelist[$key];
  htmlItemList($ary);
  echo "</div>";
 }
}

if(count($itemlist)){
 echo "<div class='clr'></div>";
 echo "<h2>商品リスト</h2>";
 foreach($itemlist as $key=>$val){
   echo "<div class='col3'>";
  $ary=array();
  $ary[]=$itemlist[$key];
  htmlItemList($ary);
  echo "</div><!--div class='col3'-->";
 }
}

if($_GET["keyword"]){
 if(! $tirasilist && ! $salelist && ! $itemlist){
  echo "申し訳ございません。商品が見当たりませんでした。";
 }
}
?>
    </div><!--div class="SearchList"-->
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


