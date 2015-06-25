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
// チラシ用Inputボタンセット
//(これをひな形として他のデータをセットしていく)
//-----------------------------------------//
function inptirasi(){
 var fname="inptirasi";wlog("start:"+fname);

 $("table tr#tirasi").on("click",function(){
  var e="tirasi click ";wlog("start:"+e);
  
  //既存Inputボタン削除
  $(this).find("input").remove();

  //Inputボタン生成
  var inp=mktirasi("tirasi");

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
                       success:function(html){
                        wlog("input[name="+inpname+"] ajax success");
                        wlog(html);
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
  $(this).removeClass("tHover")
         .find("input").remove();
 });
 wlog("end:"+fname);
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

