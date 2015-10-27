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
// チラシ用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
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
// メール用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inpmail(){
 var fname="inpmail";wlog("start:"+fname);

 $("table tr#mail").on("click",function(){
  var e="mail click ";wlog("start:"+e);
  
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
// メール用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inposusume(){
 var fname="inposusume";wlog("start:"+fname);

 $("table tr#osusume").on("click",function(){
  var e="osusume click ";wlog("start:"+e);
  
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
// カレンダー用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inpcalendar(){
 var fname="inpcalendar";wlog("start:"+fname);

 $("table tr#calendar").on("click",function(){
  var e="calendar click ";wlog("start:"+e);
  
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
// ご注文用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inpgotyumon(){
 var fname="inpgotyumon";wlog("start:"+fname);

 $("table tr#gotyumon").on("click",function(){
  var e="calendar click ";wlog("start:"+e);
  
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
// 月間お買得品Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inpgekkan(){
 var fname="inpgotyumon";wlog("start:"+fname);

 $("table tr#gekkan").on("click",function(){
  var e="gekkan click ";wlog("start:"+e);
  
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
// 日付リストイベント
//-----------------------------------------//
function DayEvent(){
 var fname="DayEvent";wlog("start:"+fname);
 $("div.daylist ul li").click(function(){
  $(this).siblings().removeClass("hoverColor");
  $(this).addClass("hoverColor");
  getTirasi();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 部門リストイベント
//-----------------------------------------//
function LinEvent(){
 var fname="LinEvent";wlog("start:"+fname);
 $("div.grplist ul li").click(function(){
  $(this).siblings().removeClass("hoverColor");
  $(this).addClass("hoverColor");
  getTirasi();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// チラシ商品抽出
//-----------------------------------------//
function getTirasi(){
 var fname="getTirasi";wlog("start:"+fname);
 var url;
 var q={};

 //チラシ番号,部門番号をゲット
 if($("div.grplist ul li").hasClass("hoverColor")){
  var strcode=$("div.grplist ul li.hoverColor").attr("data-strcode");
  var adnum=$("div.grplist ul li.hoverColor").attr("data-adnum");
  var dpscode=$("div.grplist ul li.hoverColor").attr("data-dpscode");
 }

 //チラシ番号,日付をゲット
 if($("div.daylist ul li").hasClass("hoverColor")){
  var strcode=$("div.daylist ul li.hoverColor").attr("data-strcode");
  var adnum=$("div.daylist ul li.hoverColor").attr("data-adnum");
  var saleday=$("div.daylist ul li.hoverColor").attr("data-saleday");
 }

 //引数チェック
 if(! strcode.match(/^[0-9]+$/)){
  alert("店舗番号が不正です");
  wlog(fname+":店舗番号が不正"+strcode);
  return false;
 }

 if(! adnum.match(/^[0-9]+$/)){
  alert("チラシ番号が不正です");
  wlog(fname+":チラシ番号が不正"+adnum);
  return false;
 }

 if(dpscode && ! dpscode.match(/^[0-9]+$/)){
  alert("メジャーが不正です");
  wlog(fname+":メジャーが不正"+dpscode);
  return false;
 }

 if(saleday && ! chkdate(saleday)){
  alert("日付が不正です");
  wlog(fname+":日付が不正"+saleday);
  return false;
 }
 
 //queryセット
 if(strcode) q.strcode=strcode;
 if(adnum) q.adnum=adnum;
 if(saleday) q.saleday=saleday;
 if(dpscode) q.dpscode=dpscode;
 console.log(q);

 //データゲット
 $.ajax({
  url:"php/ajaxGetTirasi.php",
  type:"GET",
  dataType:"html",
  data:q,
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.items").empty()
                 .append(html);
   console.log(html);
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 日付リストイベント(ご注文用)
//-----------------------------------------//
function G_DayEvent(){
 var fname="G_DayEvent";wlog("start:"+fname);
 $("div.daylist ul li").click(function(){
  $(this).siblings().removeClass("hoverColor");
  $(this).addClass("hoverColor");

  //部門リストを抽出
  var q={};
  q.strcode=$(this).attr("data-strcode");
  q.year =$(this).attr("data-year");
  q.month=$(this).attr("data-month");

  //データゲット
  $.ajax({
   url:"php/ajaxGetGotyumonGrpList.php",
   type:"GET",
   dataType:"html",
   data:q,
   async:false,
   complete:function(){},
   success:function(html){
    wlog(fname+": ajax success");
    console.log(html);
    $("div.grplist ul").empty()
                       .append(html);
    //ここから
    G_LinEvent();
    getGotyumon();
   },
   error:function(XMLHttpRequest,textStatus,errorThrown){
    console.log(XMLHttpRequest.responseText);
   }
  });

 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 部門リストイベント(ご注文用)
//-----------------------------------------//
function G_LinEvent(){
 var fname="G_LinEvent";wlog("start:"+fname);
 $("div.grplist ul li").click(function(){
  $(this).siblings().removeClass("hoverColor");
  $(this).addClass("hoverColor");
  getGotyumon();
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// ご注文商品抽出
//-----------------------------------------//
function getGotyumon(){
 var fname="getGotyumon";wlog("start:"+fname);
 var url;
 var q={};

 //年月、店舗番号をゲット
 if($("div.daylist ul li").hasClass("hoverColor")){
  var strcode=$("div.daylist ul li.hoverColor").attr("data-strcode");
  var nen= $("div.daylist ul li.hoverColor").attr("data-year");
  var tuki=$("div.daylist ul li.hoverColor").attr("data-month");
 }
 
 //チラシ番号,部門番号をゲット
 if($("div.grplist ul li").hasClass("hoverColor")){
  var strcode=$("div.grplist ul li.hoverColor").attr("data-strcode");
  var saleday=$("div.grplist ul li.hoverColor").attr("data-saleday");
  var grpnum =$("div.grplist ul li.hoverColor").attr("data-grpnum");
 }

 //引数チェック
 if(! strcode.match(/^[0-9]+$/)){
  alert("店舗番号が不正です");
  wlog(fname+":店舗番号が不正"+strcode);
  return false;
 }

 if(nen && ! nen.match(/^[0-9]+$/)){
  alert("年数が不正です");
  wlog(fname+":年数が不正"+nen);
  return false;
 }

 if(tuki && ! tuki.match(/^[0-9]+$/)){
  alert("月が不正です");
  wlog(fname+":月が不正"+tuki);
  return false;
 }

 if(saleday && ! chkdate(saleday)){
  alert("日付が不正です");
  wlog(fname+":日付が不正"+saleday);
  return false;
 }

 if(grpnum && ! grpnum.match(/^[0-9]+$/)){
  alert("グループ番号が不正です");
  wlog(fname+":グループ番号が不正"+grpnum);
  return false;
 }
 
 //queryセット
 if(strcode) q.strcode=strcode;
 if(nen) q.year=nen;
 if(tuki) q.month=tuki;
 if(saleday) q.saleday=saleday;
 if(grpnum) q.grpnum=grpnum;
 console.log(q);

 //データゲット
 $.ajax({
  url:"php/ajaxGetGotyumon.php",
  type:"GET",
  dataType:"html",
  data:q,
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.items").empty()
                 .append(html);
   //console.log(html);
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

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
// リスト一覧
//-----------------------------------------//
function getlist(){
 tirasilist();
 maillist();
 osusumelist();
 calendarlist();
 gotyumonlist();
 delevent();
 tableHover();
}


//-----------------------------------------//
// チラシリスト
//-----------------------------------------//
function tirasilist(){
 var fname="tirailist";wlog("start:"+fname);
 var q={};
 q.strcode=1;

 //データゲット
 $.ajax({
  url:"php/ajaxGetTirasiList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.tirasilist").empty()
                      .append(html);
   
   //削除イベント
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// メールリスト
//-----------------------------------------//
function maillist(){
 var fname="maillist";wlog("start:"+fname);
 var q={};
 q.strcode=1;

 //データゲット
 $.ajax({
  url:"php/ajaxGetMailList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.maillist").empty()
                    .append(html);
   
   //削除イベント
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// カレンダーリスト
//-----------------------------------------//
function calendarlist(){
 var fname="calendarlist";wlog("start:"+fname);
 var q={};
 q.strcode=1;

 //データゲット
 $.ajax({
  url:"php/ajaxGetCalendarList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.calendarlist").empty()
                        .append(html);
   
   //削除イベント
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// おすすめリスト
//-----------------------------------------//
function osusumelist(){
 var fname="osusumelist";wlog("start:"+fname);
 var q={};
 q.strcode=1;

 //データゲット
 $.ajax({
  url:"php/ajaxGetOsusumeList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.osusumelist").empty()
                       .append(html);
   
   //削除イベント
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// ご注文リスト
//-----------------------------------------//
function gotyumonlist(){
 var fname="gotyumonlist";wlog("start:"+fname);
 var q={};
 q.strcode=1;

 //データゲット
 $.ajax({
  url:"php/ajaxGetGotyumonList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.gotyumonlist").empty()
                       .append(html);
   
   //削除イベント
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
  
  if(q.saletype==3 || q.saletype==5){
   q.nen =$(this).attr("data-year");
   q.tuki=$(this).attr("data-month");
  }
  else{
   q.saleday=$(this).attr("data-saleday");
  }

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

