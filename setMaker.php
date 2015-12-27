<?php
//メーカー登録
require_once("php/view.function.php");
require_once("php/html.function.php");


//ログインチェック
session_start();
if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
 header("Location:login.php");
}

htmlHeader("メーカー登録画面");
?>

  <div id="wrapper">
   <div id="itemListDiv">
    <h2>メーカー未登録商品一覧</h2>
    最終販売日：<input name="saleday" type="text" value="">
    <div class="tablearea">
     <table id="ItemList" class="ItemData">
      <thead>
       <tr>
        <th>部門</th>
        <th>クラス</th>
        <th>JANコード</th>
        <th>商品名</th>
        <th>規格</th>
        <th>売価</th>
        <th>登録日</th>
        <th>販売日</th>
       </tr>
      </thead>
      <tbody>
      </tbody>
     </table>
    </div><!--div class="tablearea"-->
   </div><!--div id="itemListDiv"-->

   <div id="setMakerDiv">
    <h2>メーカー登録</h2>
    <a href="http://gepir.dsri.jp/modules/gepir/" target="_blank">GEPIRを開く</a>
    <div class="tablearea">
     <table class="ItemData">
      <thead>
       <tr>
        <th>正式名称</th>
        <th>略称</th>
        <th>企業コード</th>
        <th> </th>
       </tr>
      </thead>
      <tbody>
       <tr>
        <td><input name="cname" type="text" value=""></td>
        <td><input name="maker" type="text" value=""></td>
        <td><input name="jcode" type="text" value=""></td>
        <td><input type="submit" value="登録"></td>
       </tr>
      </tbody>
     </table><!--table class="ItemData"-->
    </div><!--div class="tablearea"-->
   </div><!--div id="setMakerDiv"-->

   <div id="MakerListDiv">
    <h2>登録済みメーカー一覧</h2>
    <div>
     正式名称:<input name="searchcname" type="text">
    </div>
    <div class="tablearea">
     <table id="MakerList" class="ItemData">
      <thead>
       <tr>
        <th> </th>
        <th>正式名称</th>
        <th>略称</th>
        <th>企業コード</th>
       </tr>
      </thead>
      <tbody>
      </tbody>
     </table><!--table class="ItemData"-->
    </div><!--div class="tablearea"-->
   </div><!--div id="MakerListDiv"-->

  </div><!--div id="wrapper"-->
 </body>

 <script>
$(function(){
 //今日の日付をゲット
 var d=new Date();
 d.setDate(d.getDate()-1);

 var hiduke=d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
 
 //最終販売日
 $("input[name=saleday]").val(hiduke);

 //メーカー未登録アイテム表示
 getItemList();

 //メーカー一覧表示
 getMakerList();

 //登録ボタン
 $("input[type=submit]").on("click",function(){
  setMaker();
 });

 //メーカー検索
 $("input[name=searchcname]").on("change",function(){
  getMakerList($(this).val());
 });

 //最終販売日更新
 $("input[name=saleday]").on("change",function(){
  getItemList($(this).val());
 });


});

 </script>
</html>
