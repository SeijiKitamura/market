//-----------------------------------------//
// グローバル関数
//-----------------------------------------//
var SALETYPE=[0,1,2,3,5,6,7,8,9];

//-----------------------------------------//
// 画像スライド
//-----------------------------------------//
function slideImg(){
 $("div#slideFl").sliderPro({
  width:360,
  thumbnailWidth:90,
  thumbnailHeight:120,
  aspectRatio:1,
  thumbnailArrows:true,
  autoHeight:true,
  slideDistance:0,
  arrows:true,
  autoplay:false,
  buttons:false
 });
}


//-----------------------------------------//
// スライドメニュー
//-----------------------------------------//
function slideMenu(){
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
}

//-----------------------------------------//
// データベース初期化イベント
//-----------------------------------------//
function dbinit(){
 var fname="dbinit";wlog("start:"+fname);

 $("table tr#dbinit").on("click",function(){
  var e="dbinit click ";
  wlog("start:"+e);

  if(!confirm("注意! 初期化しますか?OKするとすべてのデータを初期化します！")){
   wlog("exit:"+e);return false;
  }

  window.location.href="install.php";
  wlog("end:"+e);
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 店舗マスタ用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inpstrmas(){
 var fname="inpstrmas";wlog("start:"+fname);

 $("table tr#strmas").on("click",function(){
  var e="strmas click ";wlog("start:"+e);
  
  //既存Inputボタン削除
  $(this).find("input").remove();

  //Inputボタン生成(ここをDBのテーブル名とあわせる)
  var inp=mkInpTag("strmas");

  //tdにボタン追加
  $(this).find("td").last().append(inp);

  //イベント開始
  inp.click();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// メジャーマスタ用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inpdpsmas(){
 var fname="inpdpsmas";wlog("start:"+fname);

 $("table tr#dpsmas").on("click",function(){
  var e="dpsmas click ";wlog("start:"+e);
  
  //既存Inputボタン削除
  $(this).find("input").remove();

  //Inputボタン生成(ここをDBのテーブル名とあわせる)
  var inp=mkInpTag("dpsmas");

  //tdにボタン追加
  $(this).find("td").last().append(inp);

  //イベント開始
  inp.click();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 部門マスタ用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inplinmas(){
 var fname="inplinmas";wlog("start:"+fname);

 $("table tr#linmas").on("click",function(){
  var e="linmas click ";wlog("start:"+e);
  
  //既存Inputボタン削除
  $(this).find("input").remove();

  //Inputボタン生成(ここをDBのテーブル名とあわせる)
  var inp=mkInpTag("linmas");

  //tdにボタン追加
  $(this).find("td").last().append(inp);

  //イベント開始
  inp.click();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 部門マスタ用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inpclsmas(){
 var fname="inpclsmas";wlog("start:"+fname);

 $("table tr#clsmas").on("click",function(){
  var e="clsmas click ";wlog("start:"+e);
  
  //既存Inputボタン削除
  $(this).find("input").remove();

  //Inputボタン生成(ここをDBのテーブル名とあわせる)
  var inp=mkInpTag("clsmas");

  //tdにボタン追加
  $(this).find("td").last().append(inp);

  //イベント開始
  inp.click();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 特売情報Inputボタンセット
//-----------------------------------------//
function inptirasi(){
 var fname="inptirasi";wlog("start:"+fname);

 $("table tr#tirasi").on("click",function(){
  var e="tirasi click ";wlog("start:"+e);
  
  //既存Inputボタン削除
  $(this).find("input").remove();

  //Inputボタン生成(ここをDBのテーブル名とあわせる)
  var inp=mkInpTag("jansale");

  //tdにボタン追加
  $(this).find("td").last().append(inp);

  //イベント開始
  inp.click();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// Inputタグ生成
//-----------------------------------------//
function mkInpTag(inpname){
 var fname="mkInpTag";wlog("start:"+fname);
 var inp=$("<input>").attr({"type":"file",
                            "name":inpname
                           })
                     .click(function(evt){
                      wlog("input[name="+inpname+"] click");
                      evt.stopPropagation();
                     })
                    .change(function(){
                      wlog("input[name="+inpname+"] change");

                      var fd=new FormData();
                      fd.append("tablename",inpname);
                      fd.append("file",$(this).prop("files")[0]);
                      wlog("input[name="+inpname+"] ajax start");
                      $.ajax({
                       url        :"php/csvupload.php",
                       type       :"POST",
                       dataType   :"text",
                       data       :fd,
                       processData:false,
                       contentType:false,
                       context    :this,
                       beforeSend :function(){
                                    wlog("input[name="+inpname+"] ajax beforeSend");
                                    $("div.msgarea").empty() 
                                                    .append("データ送信中");
                                   },
                       success    :function(html){
                                    wlog("input[name="+inpname+"] ajax success");
                                    $("div.msgarea").empty() 
                                                    .append(html);
                                   },
                       complete   :function(){
                                    $(this).remove();
                                   }
                      });
                    });
 wlog("end:"+fname);
 return inp;
}

//-----------------------------------------//
// テーブル列の色を変える
//-----------------------------------------//
function tableHover(){
 var fname="tableHover";wlog("start:"+fname);

 $("table tr").hover(function(){
  wlog("mouse in:"+fname);
  $(this).addClass("tHover");
 },function(){
  wlog("mouse out:"+fname);
  $(this).removeClass("tHover");
 });
 wlog("end:"+fname);
}


//-----------------------------------------//
// リスト一覧
//-----------------------------------------//
function getlist(){
 var divname="DataDiv";
 $("div."+divname).remove();
 for(var i=0;i<SALETYPE.length;i++){
  salelist(i);
 }
 delevent();
// tableHover();
}

//-----------------------------------------//
// セールリスト表示
//-----------------------------------------//
function salelist(saletype){
 var fname="salelist";wlog("start:"+fname);
 var divname="DataDiv";
 var q={};
 q.strcode=1;
 q.saletype=saletype;
 //データゲット
 $.ajax({
  url:"php/ajaxGetSaleList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("<div></div>",{"class":divname}).append(html).appendTo("div#wrapper");
   
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 削除イベント
//-----------------------------------------//
function delevent(){
 var fname="delevent";wlog("start:"+fname);
 $("div.tablearea td span").on("click",function(){
  var q={};
  q.strcode=$(this).attr("data-strcode");
  q.saletype=$(this).attr("data-saletype");
  q.nen =$(this).attr("data-nen");
  q.tuki=$(this).attr("data-tuki");
  q.saleday=$(this).attr("data-saleday");

  if(! confirm("削除しますか?")) return false;
  
  //データ削除
  $.ajax({
   url:"php/ajaxDelData.php",
   type:"GET",
   data:q,
   dataType:"html",
   async:false,
   complete:function(){},
   success:function(html){
    wlog(fname+": ajaX success");
    console.log(html);
    if(html.match(/^error/)){
     alert(html);
     return false;
    }
    else{
     alert("削除しました");
     getlist();
    }
   },
   error:function(XMLHttpRequest,textStatus,errorThrown){
    console.log(XMLHttpRequest.responseText);
   }
  });
  wlog("end:"+fname);

 });
}

//-----------------------------------------//
// 単品画像削除
//-----------------------------------------//
function delimg(){
 var fname="delevent";wlog("start:"+fname);
 $("button#delimg").on("click",function(){
  $("div.Tanpin img").each(function(){
   //console.log($(this).attr("src"));
   var q={};
   q.imgpath=$(this).attr("src");
   $.ajax({
    url:"php/ajaxDelImg.php",
    type:"GET",
    data:q,
    dataType:"html",
    async:false,
    complete:function(){},
    success:function(html){
     wlog(fname+": ajaX success");
     console.log(html);
     if(html.match(/^error/)){
      alert(html);
      return false;
     }
     else{
     }
    },
    error:function(XMLHttpRequest,textStatus,errorThrown){
     console.log(XMLHttpRequest.responseText);
    }
   });
  });
  alert("削除しました");
 });
}

//-----------------------------------------//
// 日付チェック
//-----------------------------------------//
function chkdate(hiduke){
 var h=hiduke.match(/^(20[0-9]{2})[\/-]?([0-1]?[0-9]{1})[\/-]?([0-3]?[0-9]{1})$/);
 if(!h){
  console.log("日付不正");
  return false;
 }
 else{
  var newdate=new Date(h[1],h[2]-1,h[3]);
  if(newdate.getFullYear()!=h[1]||newdate.getMonth()+1!=h[2]||newdate.getDate()!=h[3]){
  console.log("日付不正");
  return false;
  }
 }
 return true;
}


//-----------------------------------------//
// ログ出力
//-----------------------------------------//
function wlog(msg){
 var d=new Date();
 var n=d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+" ";
 console.log(n+" "+msg);
}

