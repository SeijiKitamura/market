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
  var inp=mktirasi("strmas");

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
  var inp=mktirasi("dpsmas");

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
  var inp=mktirasi("linmas");

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
  var inp=mktirasi("clsmas");

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
  var inp=mktirasi("jansale");

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
function mktirasi(inpname){
 var fname="mktirasi";wlog("start:"+fname);
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

 //データゲット(ここから)
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

