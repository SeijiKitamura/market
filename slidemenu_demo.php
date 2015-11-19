<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title><!--title--></title>
  <meta name="google-site-verification" content="<!--GOOGLEWEBMASTER-->" />
  <meta name="description" content="<!--description-->">
  <meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1">
  <link rel="shortcut icon" href="img/kitamura.ico">
  <link rel="stylesheet" type="text/css" href="./css/test.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 </head>
 <body>
  <div id="wrapper">
   <nav id="slide_menu">
    <ul>
     <li><a href="#">menu1</a></li>
     <li><a href="#">menu2</a></li>
     <li><a href="#">menu3</a></li>
     <li><a href="#">menu4</a></li>
     <li><a href="#">menu5</a></li>
    </ul>
   </nav><!--nav id="slide_menu"-->
   <button id="btn">Menu</button>

   <div class="layer"></div>
    <div class="col1">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    </div><!--div class="col1"-->
    <div class="col2">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    </div><!--div class="col2"-->
    <div class="col2">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    </div><!--div class="col2"-->
    <div class="col4">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    </div><!--div class="col4"-->
    <div class="col4">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    </div><!--div class="col4"-->
    <div class="col4">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    </div><!--div class="col4"-->
    <div class="col4">
     <img src="img/topimage.jpg" alt="南馬込桜並木の様子|スーパーキタムラ">
    </div><!--div class="col4"-->
   wrapper
  </div>

  <script>
$(function(){
 var menu=$("#slide_menu");
 var menuBtn=$("#btn");
 var body=$(document.body);
 var menuWidth=menu.outerWidth();
 var layer=$(".layer");

 menuBtn.on("click",function(){
  var w=$(window).width();
  console.log(w);

  body.toggleClass("open");
  if(body.hasClass("open")){
   layer.show();
   body.animate({"left":menuWidth},300);
   menu.animate({"left":0        },300);
  }
  else{
   layer.hide();
   menu.animate({"left":-menuWidth},300);
   body.animate({"left":0         },300);
  }
 });

 layer.on("click",function(){
   menu.animate({"left":-menuWidth},300);
   body.animate({"left":0         },300).removeClass("open");
   layer.hide();
 });
});
  </script>
 </body>
</html>

<?php
?>
