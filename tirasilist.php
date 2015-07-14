<?php
require_once("php/html.function.php");
require_once("php/view.function.php");

//店舗番号
if(! $_GET["strcode"]) $strcode=1;

//販売日
if(! $_GET["saleday"]) $saleday=date("Y-m-d");
else{
 $saleday=$_GET["saleday"];
}
if($_GET["saleday"] && ! chkDate($_GET["saleday"])){
 wLog("tirasi.php 日付無効のため本日日付をセット({$_GET["saleday"]})");
 $saleday=date("Y-m-d");
}


//部門番号
if(! $_GET["lincode"]){
 $lincode=0;
}
elseif(! preg_match("/^[0-9]+$/",$_GET["lincode"])){
 $lincode=0;
}
else{
 $lincode=$_GET["lincode"];
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
 $item=viewGetFlyersItemLin($strcode,$adnum,$saleday);
}

//タイトル決定
if(count($item)){
 $title=date("Y年m月d日",strtotime($item[0]["startday"]))."の広告商品";
}
else{
 $title="申し訳ございません。本日はチラシが入っていません";
}

htmlHeader($title);
?>
  <div id="wrapper">
   <div class="daylist">
    <ul>
<?php
//日付リスト表示
if($daylist){
 foreach($daylist as $key=>$val){
  $d=date("n月j日",strtotime($val["saleday"]));
  $d.="({$YOUBI[date("w",strtotime($val["saleday"]))]})";
  $d.=" {$val["itemcnt"]}点";
  echo "<li data-strcode={$strcode} data-adnum={$adnum} data-saleday={$val["saleday"]}>{$d}</li>";
 }
}
?>
    </ul>
   </div><!--div class="daylist"-->
   <div class="clr"></div>

   <div class="grplist">
    <ul>
<?php
//グループ表示
if($linlist){
 echo "<li data-strcode={$strcode} data-adnum={$adnum} data-lincode=0>すべて</li>";
 foreach($linlist as $key=>$val){
  $d="{$val["linname"]}({$val["itemcnt"]})";
  echo "<li data-strcode={$strcode} data-adnum={$adnum} data-lincode={$val["lincode"]}>{$d}</li>";
 }
}
elseif($dpslist){
 echo "<li data-strcode={$strcode} data-adnum={$adnum} data-dpscode=0>すべて</li>";
 foreach($dpslist as $key=>$val){
  $d="{$val["dpsname"]}({$val["itemcnt"]})";
  echo "<li data-strcode={$strcode} data-adnum={$adnum} data-dpscode={$val["dpscode"]}>{$d}</li>";
 }
}
?>
    </ul>
   </div><!--div class="grplist"-->

   <div class="items">
<?php
if($item){
 //チラシ画像表示
?>
    <div class="flyers">
     <div class="sidea">
      <a href="img/a.jpg" target="_blank">
       <img src="img/a.jpg" alt="スーパーキタムラ チラシA面">
      </a>
     </div><!--div class="sidea"-->
     <div class="sideb">
      <a href="img/b.jpg" target="_blank">
       <img src="img/b.jpg" alt="スーパーキタムラ チラシB面">
      </a>
     </div><!--div class="sideb"-->
     <div class="clr"></div>
    </div><!--div class="flyers"-->
<?php 
 //チラシアイテム表示
 htmlContents($item);
}
else{
?>
    <h1>申し訳ございません。本日はチラシ商品はございません。</h1>
    <p>次回の広告をご期待くださいませ。</p>
<?php
}
?>
   </div><!--div class="items"-->
  </div><!--div id="wrapper"-->
 </body>
<script>
$(function(){
 DayEvent();
 LinEvent();
});

</script>
</html>
