<?php
//新商品リスト

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="newitemlist.php";
aLog($_SERVER["REQUEST_URI"]);

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

//新商品リストゲット
$itemlist=viewGetNewItem($strcode,$saleday);

//タイトル決定
if(count($itemlist)){
 $title=date("Y年m月d日")."現在の新商品リスト";
 $description=<<<EOF
各メーカーから販売された新発売商品や当店で新しく取り扱いを始めた新商品のご案内です。
新しい商品は生活や気分を豊かにしてくれますね。
マンネリになりがちな食卓に新しい商品を加えてみてはいかがでしょうか。
EOF;
}
else{
 $title="申し訳ございません。ただいまご案内できる新商品がございません";
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
    <h2>新商品のご案内</h2>
    <p>
<?php
if(count($itemlist)){
 echo "当店で新しく取り扱いを始めた商品のご案内です。";
}
else{
 echo $title;
}
?>
    </p>
   </div><!--div class="col1"-->
<?php
if(count($itemlist)){
 $linname="";
 $imgdir=realpath(__DIR__."/".IMG);

 foreach($itemlist as $key=>$val){
  $imgpath=$imgdir."/".$val["jcode"].".jpg";
  //画像判定
  if(file_exists($imgpath)){
   //部門判定
   if($linname!=$val["linname"]){
    echo "<div class='clr'></div>";
    echo "<h2>{$val["linname"]}</h2>";
    $linname=$val["linname"];
   }
   //商品表示
   echo "<div class='col3'>";
   $ary=array();
   $ary[]=$itemlist[$key];
   htmlItemList($ary);
   echo "</div>";
  }
 }
}

htmlSNSButton();
?>

   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->


