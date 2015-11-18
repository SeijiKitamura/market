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


//商品リストをゲット
if($jcode || $keyword){
 $itemlist=viewGetSearchItem($strcode,$jcode,$keyword);
}

//タイトル決定
$title="商品検索|";

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
if(count($itemlist)){
 foreach($itemlist as $key=>$val){
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
else{
 if($_GET["keyword"]){
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


