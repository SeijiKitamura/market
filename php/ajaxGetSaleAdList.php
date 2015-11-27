<?php
//月のチラシリスト
require_once("view.function.php");
require_once("html.function.php");

try{
 //引数チェック
 if(preg_match("/^[0-9]+$/",$_GET["strcode"])){
  $strcode=$_GET["strcode"];
 }
 else{
  throw new exception ("店舗番号を確認してください".$_GET["strcode"]);
 }
 
 if(chkDate($_GET["saleday"])){
  $saleday=date("Y-m-d",strtotime($_GET["saleday"]));
 }
 else{
  throw new exception("日付を確認してください");
 }

 $data=viewGetAdnumDayList($strcode,$saleday);

 session_start();
 if( isset($_SESSION["USERID"]) && $_SESSION["USERID"]!==null && $_SESSION["USERID"]===md5(USERID)){
  $loginflg=true;
 }

 $html="";
 $html.=<<<EOF
<table class="Col3Table">
 <colgroup span="4" class="area">
 <thead>
  <tr>
   <th>投函日</th>
   <th>A面</th>
   <th>B面</th>
   <th>備考</th>
  </tr>
 </thead>
 <tbody>
EOF;
 foreach($data as $key=>$val){
  $html.="<tr>";
  //リンクセット
  $link="tirasilist.php?strcode={$strcode}&saleday={$val["saleday"]}";
  //ファイル名設定
  $fpath=date("Ymd",strtotime($val["saleday"]));

  //ファイルパス確定
  $imgpath=realpath("../").IMG."/";

  $html.="<td>";
  $html.="<a href='{$link}' target='_blunk'>";
  $html.=date("m月d日投函",strtotime($val["saleday"]));
  $html.="<br>(チラシ番号:".$val["adnum"].")";
  $html.="</a>";
  $html.="</td>";
  
  $html.="<td>";
  $html.="<a href='{$link}' target='_blunk'>";
  //画像ファイル存在チェック
  if(file_exists($imgpath.$fpath."a.jpg")){
   $html.="<img src='.".IMG."/".$fpath."a.jpg'>";
  }
  $html.="</a>";
  $html.="</td>";

  $html.="<td>";
  $html.="<a href='{$link}' target='_blunk'>";
  if(file_exists($imgpath.$fpath."b.jpg")){
   $html.="<img src='.".IMG."/".$fpath."b.jpg'>";
  }
  $html.="</a>";
  $html.="</td>";
  
  $html.="<td>";
  if($loginflg){
   $html.="<button data-adnum='{$val["adnum"]}'>全削除</button>";
  }
  $html.="</td>";
  $html.="</tr>";
 }
 echo $html;
}
catch(Exception $e){
 echo "error:".$e->getMessage();
}
?>
