<?php
require_once("php/html.function.php");
session_start();
if(! isset($_SESSION["USERID"]) || $_SESSION["USERID"]==null || $_SESSION["USERID"]!==md5(USERID)){
 header("Location:login.php");
}
htmlHeader("データ表示|");
?>

  <div id="wrapper">
   <div class="col1">
    <h2>データメニュー</h2>
    <div class="footerBox">
     <ul>
      <li>アクセスログ</li>
     </ul>
    </div><!--div class="footerBox"-->
   </div><!--div class="col1"-->

<!-- ここから 月を選択できるようにする-->
   <div class="col1">
    <h2>年月</h2>
    <div class="nentuki">
     <ul class="naviul">
      <li></li>
      <li></li>
     </ul>
    </div><!--div class="nentuki"-->
   </div><!--div class="col1"-->

   <div class="msgarea">
   </div><!--div class="msgarea"-->
   <div class="clr"></div>
  </div><!--div id="wrapper"-->

<?php
//htmlFooter()
?>
 </body>

 <script>
$(function(){
 //年
 var sct=makeNenBox(2015,null);
 $("div.nentuki ul.naviul li").eq(0).append(sct);
 
 //月
 var sct=makeTukiBox();
 $("div.nentuki ul.naviul li").eq(1).append(sct);

 //イベント
 $("select#nen,select#tuki").on("change",function(){
  var nen =$("select#nen").val();
  var tuki=$("select#tuki").val();
  var url="log/access"+nen+tuki+".html";

  $("div.datazone").remove(); 
  //データゲット
  $.ajax({
   url:url,
   type:"GET",
   dataType:"html",
   async:false,
   cache:false,
   complete:function(){},
   success:function(html){
    wlog(": ajax success");
    $("<div></div>",{"class":"datazone"}).append(html).appendTo("div#wrapper");
    $("div.datazone table").addClass("ItemData");
   },
   error:function(XMLHttpRequest,textStatus,errorThrown){
    console.log(XMLHttpRequest.responseText);
   }
  });

 });
});

 </script>
</html>
