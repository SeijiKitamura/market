//-----------------------------------------//
// グローバル関数
//-----------------------------------------//
var SALETYPE=[0,1,2,3,5,6,7,8,9];

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
// 単品画像削除
//-----------------------------------------//
function delimg(){
 var fname="delevent";wlog("start:"+fname);
 var flg=1;
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
      flg=0;
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
  if(flg){
   alert("削除しました");
   location.reload();
  }
 });
}

//-----------------------------------------//
// セールタイプリスト表示
//-----------------------------------------//
function salelist(saletype){
 var fname="salelist";wlog("start:"+fname);
 var q={};
 //データゲット
 $.ajax({
  url:"php/ajaxGetSaleTypeList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("#saletype").remove();
   $("div.resultbox").empty();
   //エラー判定
   if(html.match(/error/)){
    $("div.resultbox").empty()
                      .append(html);
    console.log(html);
    return false;
   }
   $("div.listbox").append(html);
   $("#saletype").on("change",function(){
    $("div.resultbox").empty();
    if($(this).val()==99){
     $("select#year").remove();
     $("select#month").remove();
     $("select#day").remove();
     return false;
    }
    yearlist($(this).val());
   });
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// セール商品年リスト表示
//-----------------------------------------//
function yearlist(saletype){
 var fname="yearlist";wlog("start:"+fname);
 var q={};
 q.strcode=1;
 q.saletype=saletype;
 //データゲット
 $.ajax({
  url:"php/ajaxGetSaleYearList.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div.resultbox").empty();
   //エラー判定
   if(html.match(/error/)){
    $("div.resultbox").append(html);
    console.log(html);
    return false;
   }
   $("select#year").remove();
   $("select#month").remove();
   $("select#day").remove();
   $("div.listbox").append(html);
   $("select#year").on("change",function(){
    if($(this).val()==99){
     $("select#month").remove();
     $("select#day").remove();
     return false;
    }
    //月別チラシ掲載数を表示
    monthlist($(this).val(),"resultbox");
    //月別サマリーを表示
    monthsummry($(this).val(),"resultbox");
    //イベントセット
    checkall();
    checkoff();
    checkdel();
   });
   
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// セール商品月リスト表示
//-----------------------------------------//
function monthlist(saleday,parentdiv){
 var fname="monthlist";wlog("start:"+fname);
 var url;
 var q={};
 q.strcode=1;
 q.saleday=saleday;
 q.saletype=$("select#saletype").val();
 url="php/ajaxGetSaleMonthList.php";
 
 //データゲット
 $.ajax({
  url:url,
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("select#month").remove();
   $("select#day").remove();
   $("div.listbox").append(html);
   $("select#month").on("change",function(){
    if($(this).val()==99){
     monthsummry($("select#year").val(),"resultbox");
     $("select#day").remove();
     return false;
    }
    //日別チラシ掲載数を表示
    daylist($(this).val(),"resultbox");
    //該当月の日別サマリーを表示
    daysummry($(this).val(),"resultbox");
    //イベントセット
    checkall();
    checkoff();
    checkdel();
   });
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}
//-----------------------------------------//
// セール商品月サマリー
//-----------------------------------------//
function monthsummry(saleday,parentdiv){
 var fname="monthsummry";wlog("start:"+fname);
 var url="php/ajaxGetSaleMonthSummry.php";
 var q={};
 q.strcode=1;
 q.saletype=$("select#saletype").val();
 q.saleday=saleday;
 $.ajax({
  url:url,
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div."+parentdiv).empty();
   $("div."+parentdiv).append(html);
   if(html.match(/^error/)){
    return false;
   }
   //イベントセット
   checkall();
   checkoff();
   checkdel();

  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });

 wlog("end:"+fname);
}

//-----------------------------------------//
// セール商品日リスト表示
//-----------------------------------------//
function daylist(saleday,parentdiv){
 var fname="daylist";wlog("start:"+fname);
 var url;
 var q={};
 q.strcode=1;
 q.saleday=saleday;
 q.saletype=$("select#saletype").val();
 url="php/ajaxGetSaleDayList.php";
 //データゲット
 $.ajax({
  url:url,
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("select#day").remove();
   $("div.listbox").append(html);
   $("select#day").on("change",function(){
    if($(this).val()==99){
     daysummry($("select#month").val(),"resultbox");
     return false;
    }
    //該当掲載号のチラシ商品を表示
    saleitem($(this).val(),"resultbox");
    
    //イベントセット
    checkall();
    checkoff();
    checkdel();

   });
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// セール商品日サマリー
//-----------------------------------------//
function daysummry(saleday,parentdiv){
 var fname="daysummry";wlog("start:"+fname);
 var url="php/ajaxGetSaleSummry.php";
 var q={};
 q.strcode=1;
 q.saletype=$("select#saletype").val();
 q.saleday=saleday;
 $.ajax({
  url:url,
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div."+parentdiv).empty();
   $("div."+parentdiv).append(html);
   if(html.match(/^error/)){
    return false;
   }

  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });

 wlog("end:"+fname);
}

function saleitem(saleday,parentdiv){
 var fname="saleitem";wlog("start:"+fname);
 var url="php/ajaxGetSaleItem.php";
 var q={};
 q.strcode=1;
 q.saletype=$("select#saletype").val();
 q.saleday=saleday;
 $.ajax({
  url:url,
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   $("div."+parentdiv).empty();
   $("div."+parentdiv).append(html);
   if(html.match(/^error/)){
    return false;
   }

  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });

 wlog("end:"+fname);
}

//-----------------------------------------//
// 全選択
//-----------------------------------------//
function checkall(){
 var fname="checkall";wlog("start:"+fname);
 $("button.checkall").on("click",function(){
  $("table.ItemData tr td input[type=checkbox]").prop("checked",true);
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// 全解除
//-----------------------------------------//
function checkoff(){
 var fname="checkoff";wlog("start:"+fname);
 $("button.checkoff").on("click",function(){
  $("table.ItemData tr td input[type=checkbox]").prop("checked",false);
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// チェックを削除
//-----------------------------------------//
function checkdel(adnum){
 var fname="checkdel";wlog("start:"+fname);
 $("button.checkdel").on("click",function(){
  if(! confirm("削除しますか")) return false;
  $("table.ItemData tr td input[type=checkbox]").each(function(){
   if($(this).prop("checked")){
    console.log($(this));
    deldata($(this));
   }
  });
 });
 wlog("end:"+fname);
}

//-----------------------------------------//
// データ削除
//-----------------------------------------//
function deldata(elem){
 var fname="deldata";wlog("start:"+fname);
 var q={};
 q.strcode =elem.attr("data-strcode");
 q.adnum   =elem.attr("data-adnum");
 q.saletype=elem.attr("data-saletype");
 q.saleday =elem.attr("data-saleday");
 q.jcode   =elem.attr("data-jcode");
 q.startday=elem.attr("data-startday");
 q.endday  =elem.attr("data-endday");
 q.newsid  =elem.attr("data-newsid");
 q.summry  =elem.attr("data-summry");
 console.log(q);

 //データ削除
 $.ajax({
  context:this,
  url:"php/ajaxDelData.php",
  type:"GET",
  data:q,
  dataType:"html",
  async:false,
  complete:function(){},
  success:function(html){
   wlog(fname+": ajax success");
   console.log(html);
   if(html.match(/^err/)){
    alert(html);
    return false;
   }
   elem.parent().parent().hide();
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
 wlog("end:"+fname);
}

//----------------------------------------//
// 年のSelectBox作成(ログファイル用)
//----------------------------------------//
function makeNenBox(){
 var fname="makeNenBox";wlog("start:"+fname);
 $("select.year").remove();
 var url="php/ajaxGetLogYearMonth.php";
 var q={};
 q.strcode=1;
 $.ajax({
  url:url,
  data:q,
  type:"GET",
  dataType:"json",
  async:false,
  cache:false,
  complete:function(){},
  success:function(json){
   wlog(": ajax success");
   //年ボックス作成
   var year=0;
   var sct=$("<select>").addClass("year");
   var opt=$("<option>").val(99).text("選択").appendTo(sct);
   $.each(json,function(i,item){
    if(year!=json[i].year){
     year=json[i].year;
     var opt=$("<option>").val(year).text(year+"年");
     sct.append(opt);
    }
   });
   
   //イベントセット
   sct.appendTo("div#wrapper")
      .on("change",function(){
        makeTukiBox($(this).val());
       });
   
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
}

//----------------------------------------//
// 月のSelectBox作成(ログファイル用)
//----------------------------------------//
function makeTukiBox(year){
 var fname="makeTukiBox";wlog("start:"+fname);
 $("select.month").remove();
 if(year==99){ return false; }
 var url="php/ajaxGetLogYearMonth.php";
 var q={};
 q.strcode=1;
 q.year=year;
 $.ajax({
  url:url,
  data:q,
  type:"GET",
  dataType:"json",
  async:false,
  cache:false,
  complete:function(){},
  success:function(json){
   wlog(": ajax success");
   //月ボックス作成
   var month=0;
   var sct=$("<select>").addClass("month");
   var opt=$("<option>").val(99).text("選択").appendTo(sct);
   $.each(json,function(i,item){
    if(month!=json[i].month){
     month=json[i].month;
     var opt=$("<option>").val(month).text(month+"月");
     sct.append(opt);
    }
   });
   
   //イベントセット
   sct.appendTo("div#wrapper")
      .on("change",function(){
        getaccesslog();
       });
   
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });

}

//-----------------------------------------//
// アクセスログ表示
//-----------------------------------------//
function getaccesslog(){
 var fname="getaccesslog";wlog("start:"+fname);
 var nen =$("select.year").val();
 var tuki=$("select.month").val();
 var url="log/access"+nen+tuki+".html";
 
 $("div.datazone").remove(); 
 if(nen==99 || tuki==99){return false; }
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
}

//-----------------------------------------//
// 売切れボタン
//-----------------------------------------//
function saleout(){
 var fname="saleout";wlog("start:"+fname);
 var url="php/ajaxSaleOutIn.php";

 $("button#saleout").on("click",function(){
  var q={};
  q.strcode =$(this).attr("data-strcode");
  q.saletype=$(this).attr("data-saletype");
  q.adnum   =$(this).attr("data-adnum");
  q.saleday =$(this).attr("data-saleday");
  q.jcode   =$(this).attr("data-jcode");
  q.flg="out";
  console.log(q); 
  //データゲット
  $.ajax({
   url:url,
   type:"GET",
   data:q,
   dataType:"html",
   async:false,
   cache:false,
   complete:function(){},
   success:function(html){
    wlog(": ajax success");
    console.log(html);
    if(html.match(/^error/)){
     alert(html);
     return false;
    }
    else{
     location.reload();
    }
   },
   error:function(XMLHttpRequest,textStatus,errorThrown){
    console.log(XMLHttpRequest.responseText);
   }
  });
 });
}

//-----------------------------------------//
// 売切解除ボタン
//-----------------------------------------//
function salein(){
 var fname="salein";wlog("start:"+fname);
 var url="php/ajaxSaleOutIn.php";

 $("button#salein").on("click",function(){
  var q={};
  q.strcode =$(this).attr("data-strcode");
  q.saletype=$(this).attr("data-saletype");
  q.adnum   =$(this).attr("data-adnum");
  q.saleday =$(this).attr("data-saleday");
  q.jcode   =$(this).attr("data-jcode");
  //q.flg="out";
  console.log(q); 
  //データゲット
  $.ajax({
   url:url,
   type:"GET",
   data:q,
   dataType:"html",
   cache:false,
   complete:function(){},
   success:function(html){
    wlog(": ajax success");
    console.log(html);
    if(html.match(/^error/)){
     alert(html);
     return false;
    }
    else{
     location.reload();
    }
   },
   error:function(XMLHttpRequest,textStatus,errorThrown){
    console.log(XMLHttpRequest.responseText);
   }
  });
 });
}

//-----------------------------------------//
// メーカー未登録商品一覧
//-----------------------------------------//
function getItemList(){
 var fname="getItemList";wlog("start:"+fname);
 var url="php/ajaxGetMakerItem.php";
 var q={};
 q.saleday=$("input[name=saleday]").val()
  
 //引数チェック
 if(! q.saleday){
  alert("最終販売日を入力してください");
  return false;
 }
 
 //日付正当性
 if(! chkdate(q.saleday)){
  alert("正しい日付を入力してください");
  return false;
 }

 $.ajax({
  url:url,
  type:"GET",
  data:q,
  dataType:"html",
  cache:false,
  complete:function(){},
  success:function(html){
   wlog(": ajax success");
   if(html.match(/^error/)){
    alert(html);
    return false;
   }
   $("table#ItemList tbody").empty() 
                            .append(html);
  },
  error:function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
}

//-----------------------------------------//
// メーカーコード登録
//-----------------------------------------//
function setMaker(){
 var fname="setMaker";wlog("start:"+fname);
 var cname=$("input[name=cname]").val();
 var maker=$("input[name=maker]").val();
 var jcode=$("input[name=jcode]").val();
 var url="php/ajaxSetMaker.php";

 //引数チェック
 if(! cname || ! maker || ! jcode){
  wlog("値が空欄のため処理終了");
  return false;
 }

 if(! jcode.match(/^[0-9 ]+$/)){
  alert("企業コードが数字ではありません");
  $("input[name=jcode]").focus();
  return false;
 }
 
 if(! confirm("登録しますか?")){
  return false;
 }

 //JANコード分割
 var s=jcode.split(" ");
 $.each(s,function(i){
  var q={};
  q.cname=cname;
  q.maker=maker;
  q.jcode=s[i];
  $.ajax({
   url:url,
   type     :"GET",
   data     :q,
   dataType :"html",
   cache    :false,
   complete :function(){},
   success  :function(html){
    wlog(": ajax success");
    if(html.match(/^error/)){
     alert(html);
     return false;
    }
   },
   error    :function(XMLHttpRequest,textStatus,errorThrown){
    console.log(XMLHttpRequest.responseText);
   }
  });
 });

 alert("登録しました");
 getItemList();
 getMakerList(cname);
}

//-----------------------------------------//
// メーカーリスト一覧
//-----------------------------------------//
function getMakerList(cname){
 var fname="getMakerList";wlog("start:"+fname);
 var url="php/ajaxGetMakerList.php";
 var q={};
 
 if(cname) q.cname=cname;

 $.ajax({
  url      :url,
  type     :"GET",
  data     :q,
  dataType :"html",
  cache    :false,
  complete :function(){},
  success  :function(html){
   wlog(": ajax success");
   if(html.match(/^error/)){
    alert(html);
    return false;
   }
   $("table#MakerList tbody").empty()
                             .append(html);
   //あとでイベント追加
   $("button").on("click",function(){
    delMaker($(this).attr("data-jcode"));
   });
  },
  error    :function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
 });
}

//-----------------------------------------//
// メーカーリスト削除
//-----------------------------------------//
function delMaker(jcode){
 var fname="delMaker";wlog("start:"+fname);
 var url="php/ajaxDelMaker.php";
 var q={};
 q.jcode=jcode;

 if(! q.jcode){
  alert("企業コードが登録されていません");
  return false;
 }

 if(! q.jcode.match(/^[0-9]+$/)){
  alert("企業コードが数字ではありません");
  return false;
 }

 if(! confirm("削除しますか?")) return false;

 $.ajax({
  url      :url,
  type     :"GET",
  data     :q,
  dataType :"html",
  cache    :false,
  complete :function(){},
  success  :function(html){
   wlog(": ajax success");
   if(html.match(/^error/)){
    alert(html);
    return false;
   }
   $("button").each(function(){
    if($(this).attr("data-jcode")==q.jcode){
     $(this).parent().parent().hide();
     alert("削除しました");
     return false;
    }
   });
  },
  error    :function(XMLHttpRequest,textStatus,errorThrown){
   console.log(XMLHttpRequest.responseText);
  }
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

