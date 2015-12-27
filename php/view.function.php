<?php
//----------------------------------------------------//
//  view.function.php
//----------------------------------------------------//
//  dset.function.phpを使用したデータ表示用関数
//  主にwhere句とorder句を記入
//  戻り値　成功->配列　失敗->false
//----------------------------------------------------//

require_once("dset.function.php");

//----------------------------------------------------//
// saledayから該当するチラシ番号を配列で返す
// この関数を使用するときはチラシがダブって投函される可
// 能性を考えて使用する
//----------------------------------------------------//
function viewGetAdnum($strcode,$saleday=null){
 $mname="viewGetAdnum(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  $where=<<<EOF
       strcode ={$strcode}
   and saletype={$saletype}
EOF;

  if($saleday){
   $where.=" and saleday='{$saleday}'";
  }

  $adnum=array();
  $adnum=dsetGetAdnum($where);

  if(! isset($adnum)|| ! is_array($adnum)|| ! count($adnum)){
   $adnum=null;
   throw new exception(" 該当日にチラシなし");
  }

  return $adnum;
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// カレンダーを返す
//----------------------------------------------------//
function viewGetCalendar($strcode,$startday,$endday,$w=null){
 $mname="viewGetCalendar(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=3;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  if(strtotime($startday)==strtotime($endday)){
   $where=<<<EOF
        t.strcode={$strcode}
    and t.saletype={$saletype}
    and t.saleday ='{$startday}'
EOF;
  }
  else{
   $where=<<<EOF
        t.strcode={$strcode}
    and t.saletype={$saletype}
    and t.saleday between '{$startday}' and '{$endday}'
EOF;
  }

  if($w){
   $where.=" ".$w;
  }

  $order=<<<EOF
    t.strcode
   ,t.saleday
   ,t.saletype
   ,t.tani
   ,t.price
   ,t.yen
   ,t.comment
EOF;

  return dsetGetSaleDpsItem($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ日付を配列で返す
// $clscodeが指定された場合、clscodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersDayCls($strcode,$adnum,$clscode=null){
 $mname="viewGetFlyersDayCls(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! preg_match("/^[0-9]+$/",$adnum)){
   throw new exception("adnumが数字ではありません(".$adnum.")");
  }

  if($clscode && ! preg_match("/^[0-9]+$/",$clscode)){
   throw new exception("clscodeが数字ではありません(".$clscode.")");
  }

  $where=<<<EOF
       t.strcode ={$strcode}
   and t.saletype={$saletype}
   and t.adnum   ={$adnum}
EOF;
  if($clscode){
   $where.=" and t.clscode={$clscode}";
  }

  return dsetGetFlyersDay($where);
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ日付を配列で返す
// $lincodeが指定された場合、lincodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersDayLin($strcode,$adnum,$lincode=null){
 $mname="viewGetFlyersDayLin(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! preg_match("/^[0-9]+$/",$adnum)){
   throw new exception("adnumが数字ではありません(".$adnum.")");
  }

  if($lincode && ! preg_match("/^[0-9]+$/",$lincode)){
   throw new exception("lincodeが数字ではありません(".$lincode.")");
  }

  $where=<<<EOF
       t.strcode ={$strcode}
   and t.saletype={$saletype}
   and t.adnum   ={$adnum}
EOF;
  if($lincode){
   $where.=" and t1.lincode={$lincode}";
  }

  return dsetGetFlyersDay($where);
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ掲載号別セールアイテム数を返す
//----------------------------------------------------//
function viewGetFlyersDayList($strcode,$w=null){
 $mname="viewGetFlyersDayList(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  $where=<<<EOF
   t.strcode={$strcode}
   and t.saletype={$saletype}
EOF;
  if($w){
   $where.=" and ".$w;
  }

  $order=<<<EOF
   t.strcode
  ,t.saletype
  ,t1.saleday
EOF;
  return dsetGetFlyersDayList($where,$order,null);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}


//----------------------------------------------------//
// 指定月のチラシ掲載号別セールアイテム数を返す
//----------------------------------------------------//
function viewGetFlyersDayList2($strcode,$saleday,$w=null){
 $mname="viewGetFlyersDayList2(view.function.php)";
 try{
  wLog("start:".$mname);
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
 
  if(! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  //開始日と終了日をセット
  $startday=date("Y-m-01",strtotime($saleday));
  $endday  =date("Y-m-t" ,strtotime($saleday));

  $where=" t1.saleday between '{$startday}' and '{$endday}'";
  if($w){
   $where.=" and ".$w;
  }
  return viewGetFlyersDayList($strcode,$where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ商品を返す
// $saledayが指定された場合、saleday以降
// $clscodeが指定された場合、clscodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersItemCls($strcode,$adnum,$saleday=null,$clscode=null){
 $mname="viewGetFlyersItemCls(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! preg_match("/^[0-9]+$/",$adnum)){
   throw new exception("adnumが数字ではありません(".$adnum.")");
  }
 
  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  if($clscode && ! preg_match("/^[0-9]+$/",$clscode)){
   throw new exception("clscodeが数字ではありません(".$clscode.")");
  }

  $where="t.adnum={$adnum} and t.strcode={$strcode}";
  if($saleday) $where.=" and t.saleday>='{$saleday}'";
  if($clscode) $where.=" and t.clscode={$clscode}";

  $order=<<<EOF
    min(t.saleday)
   ,max(t.saleday)
   ,t.specialflg desc
   ,t.grpnum
   ,t.clscode
   ,t.maker
   ,t.sname
   ,t.jcode
   ,t.tani
   ,t.price
EOF;

  if($saleday){
   $having="min(saleday)='{$saleday}'";
  }

  return dsetGetSaleItemSum($where,$order,$having);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ商品を返す
// $saledayが指定された場合、saleday以降
// $lincodeが指定された場合、lincodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersItemLin($strcode,$adnum,$saleday=null,$lincode=null){
 $mname="viewGetFlyersItemLin(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! preg_match("/^[0-9]+$/",$adnum)){
   throw new exception("adnumが数字ではありません(".$adnum.")");
  }
 
  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  if($lincode && ! preg_match("/^[0-9]+$/",$lincode)){
   throw new exception("lincodeが数字ではありません(".$lincode.")");
  }

  $where="t.adnum={$adnum} and t.strcode={$strcode}";
  if($saleday) $where.=" and t.saleday>='{$saleday}'";
  if($lincode) $where.=" and t1.lincode={$lincode}";

  $order=<<<EOF
    max(t.saleday)
   ,min(t.saleday)
   ,t.grpnum
   ,t.grpname desc
   ,t.specialflg desc
   ,t.clscode
   ,t.maker
   ,t.sname
   ,t.jcode
   ,t.tani
   ,t.price
EOF;

  if($saleday){
   $having="min(saleday)='{$saleday}'";
  }

  return dsetGetSaleItemSum($where,$order,$having);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ商品を返す
// $saledayが指定された場合、saleday以降
// $dpscodeが指定された場合、dpscodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersItemDps($strcode,$adnum,$saleday=null,$dpscode=null){
 $mname="viewGetFlyersItemDps(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! preg_match("/^[0-9]+$/",$adnum)){
   throw new exception("adnumが数字ではありません(".$adnum.")");
  }
 
  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  if($dpscode && ! preg_match("/^[0-9]+$/",$dpscode)){
   throw new exception("dpscodeが数字ではありません(".$dpscode.")");
  }

  $where="t.adnum={$adnum} and t.strcode={$strcode}";
  if($saleday) $where.=" and t.saleday>='{$saleday}'";
  if($dpscode) $where.=" and t2.dpscode={$dpscode}";

  $order=<<<EOF
    min(t.saleday)
   ,max(t.saleday)
   ,t.specialflg desc
   ,t.grpnum
   ,t.clscode
   ,t.maker
   ,t.sname
   ,t.jcode
   ,t.tani
   ,t.price
EOF;

  if($saleday){
   $having="min(saleday)='{$saleday}'";
  }

  return dsetGetSaleItemSum($where,$order,$having);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 指定年の月別チラシ掲載数を返す
//----------------------------------------------------//
function viewGetFlyersMonthList($strcode,$saleday,$w=null){
 $mname="viewGetFlyersMonthList(view.function.php) ";
 try{
  wLog("start:".$mname);
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
 
  if(! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  //指定年をセット
  $startday=date("Y-01-01",strtotime($saleday));
  $endday  =date("Y-12-31",strtotime($saleday));
  $where=" t1.saleday between '{$startday}' and '{$endday}'";
  if($w){
   $where.=" and ".$w;
  }
  $datalist=viewGetFlyersDayList($strcode,$where);

  //月ごとにサマリー
  $data=array();
  foreach($datalist as $key=>$val){
   $flg=0;
   foreach($data as $key1=>$val1){
    if($val1["month"]==date("m",strtotime($val["saleday"]))){
     $flg=1;
     $data[$key1]["cnt"]++;
     break;
    }
   }
   if(! $flg){
    $data[]=array("month"=>date("m",strtotime($val["saleday"]))
                  ,"cnt"=>1);
   }
  }
  return $data;
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 年別チラシ掲載数を返す
//----------------------------------------------------//
function viewGetFlyersYearList($strcode,$w=null){
 $mname="viewGetFlyersYearList(view.function.php) ";
 try{
  wLog("start:".$mname);
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
 
  //データをセット
  $datalist=viewGetFlyersDayList($strcode,$w);

  //年ごとにサマリー
  $data=array();
  foreach($datalist as $key=>$val){
   $flg=0;
   foreach($data as $key1=>$val1){
    if($val1["year"]==date("Y",strtotime($val["saleday"]))){
     $flg=1;
     $data[$key1]["cnt"]++;
     break;
    }
   }
   if(! $flg){
    $data[]=array("year"=>date("Y",strtotime($val["saleday"]))
                  ,"cnt"=>1);
   }
  }
  return $data;
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 商品マスタを返す
//----------------------------------------------------//
function viewGetItem($strcode,$jcode){
 $mname="viewGetItem(view.function.php) ";
 try{
  wLog("start:".$mname);
  $where =" t.strcode={$strcode}";
  $where.=" and t.jcode='{$jcode}'";

  return dsetGetJanMas($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}


//----------------------------------------------------//
// 指定されたクラスの商品マスタを返す
//----------------------------------------------------//
function viewGetItemCls($strcode,$clscode){
 $mname="viewGetItemCls(view.function.php) ";
 try{
  wLog("start:".$mname);
  $lastsale=date("Y-m-d",strtotime("-30days"));
  $where =" t.strcode={$strcode}";
  $where.=" and t.clscode='{$clscode}'";
  $where.=" and t.lastsale>'{$lastsale}'";
  return dsetGetJanMas($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// メーカー空欄の商品マスタを返す
// (JANコード8桁もしくは13桁のみ）
//----------------------------------------------------//
function viewGetMakerNull($strcode,$saleday){
 $mname="viewGetMakerNull(view.function.php) ";
 try{
  wLog("start:".$mname);
  $where =" t.strcode={$strcode}";
  $where.=" and t.lastsale='{$saleday}'";
  $where.=" and t.jcode like '4%'";
  $where.=" and length(t.jcode)=8";
  $where.=" and t.maker=''";
  $where.=" or";
  $where.=" t.strcode={$strcode}";
  $where.=" and t.lastsale='{$saleday}'";
  $where.=" and t.jcode like '4%'";
  $where.=" and length(t.jcode)=13";
  $where.=" and t.maker=''";

  $order=" t.strcode,t.lastsale desc,t.clscode,t.jcode";

  return dsetGetJanMas($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// メーカーマスタを返す
//----------------------------------------------------//
function viewGetMakerMas($jcode){
 $mname="viewGetMakerMas(view.function.php) ";
 try{
  wLog("start:".$mname);
  $where ="jcode='{$jcode}'";
  return dsetGetMakerMas($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// メーカーマスタを返す
//----------------------------------------------------//
function viewGetMakerList($cname){
 $mname="viewGetMakerList(view.function.php) ";
 try{
  wLog("start:".$mname);
  if($cname) $where ="cname like '%{$cname}%'";
  $order ="cname,jcode";
  return dsetGetMakerMas($where,null,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}


//----------------------------------------------------//
// メールを返す
//----------------------------------------------------//
function viewGetMailList($strcode,$saleday){
 $mname="viewGetMailList(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=1;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  //月末をセット
  $endday=date("Y-m-t",strtotime($saleday));
  $where=<<<EOF
       t.strcode  ={$strcode}
   and t.saletype ={$saletype}
EOF;
  if($saleday==$endday){
   $where.=" and t.saleday='{$saleday}'";
  }
  else{
   $where.=" and t.saleday between '{$saleday}' and '{$endday}'";
  }

  $order=<<<EOF
    t.saleday
   ,t.clscode
   ,t.jcode
EOF;

  return dsetGetSaleItem($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 年月とアイテム数を返す
//----------------------------------------------------//
function viewGetMonthList($strcode,$saletype,$w=null){
 $mname="viewGetMonthList(view.function.php) ";
 try{
  wLog("start:".$mname);

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
  
  if(! preg_match("/^[0-9]+$/",$saletype)){
   throw new exception("saletypeが数字ではありません(".$saletype.")");
  }

  $where=<<<EOF
       t.strcode={$strcode}
   and t.saletype={$saletype}
EOF;
  if($w){
   $where.=" ".$w;
  }

  $order=<<<EOF
       to_char(t.saleday,'yyyy') 
      ,to_char(t.saleday,'MM')
EOF;

  if($saletype==7){
   return dsetGetNewsMonthList($where,$order);
  }
  return dsetGetMonthList($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 新商品を返す
//----------------------------------------------------//
function viewGetNewItem($strcode,$saleday){
 $mname="viewGetNewItem(view.function.php) ";
 try{
  wLog("start:".$mname);
  $firstsale=date("Y-m-d",strtotime("-14days",strtotime($saleday)));
  $where =" t.strcode={$strcode}";
  $where.=" and t.firstsale>='{$firstsale}'";
  //$where.=" and t.lastsale>'1970/1/1'";
  return dsetGetJanMas($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 最新ニュースを返す
//----------------------------------------------------//
function viewGetNews($strcode,$saleday){
 $mname="viewGetNews(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=7;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  $where=<<<EOF
       t.strcode ={$strcode}
   and t.saleday <='{$saleday}'
   and t.saletype={$saletype}
EOF;

  $order=<<<EOF
    t.saleday desc
   ,t.idate desc
EOF;

  return dsetGetNews($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ商品のメジャー一覧を返す
// $saledayが指定された場合、saleday以降
//----------------------------------------------------//
function viewGetSaleDpsList($strcode,$adnum,$saleday=null){
 $mname="viewGetSaleDpsList(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! preg_match("/^[0-9]+$/",$adnum)){
   throw new exception("adnumが数字ではありません(".$adnum.")");
  }
 
  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  $where="t.strcode={$strcode} and t.adnum={$adnum}";
  if($saleday) $where.=" and t.saleday>='{$saleday}'";

  return dsetGetSaleDps($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 該当日付のセールアイテムを返す
//----------------------------------------------------//
function viewGetSaleItem($strcode,$saletype=null,$saleday=null){
 $mname="viewGetSaleItem(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  if($saletype===null) $saletype=0;
  if($saleday ===null) $saleday =date("Y-m-d");

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
 
  if(! preg_match("/^[0-9]+$/",$saletype)){
   throw new exception("saletypeが数字ではありません(".$saletype.")");
  }
 
  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }
  
  //where句セット
  $where=<<<EOF
       t.strcode = {$strcode}
   and t.saleday ='{$saleday}'
   and t.saletype= {$saletype}
EOF;

  //order句セット
  $order=<<<EOF
    t.adnum
   ,t.saleday
   ,t.grpnum
   ,t.specialflg
   ,t.clscode
   ,t.maker
   ,t.sname
   ,t.jcode
   ,t.tani
   ,t.price
EOF;

  return dsetGetSaleItem($where,$order);
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// セールアイテム単品販売履歴を返す(日別)
//----------------------------------------------------//
function viewGetSaleItemDayResult($strcode,$saletype,$saleday,$jcode){
 $mname="viewGetSaleItemDayResult(view.function.php) ";
 try{
  wLog("start:".$mname);
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
 
  if(! preg_match("/^[0-9]+$/",$saletype)){
   throw new exception("saletypeが数字ではありません(".$saletype.")");
  }
 
  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  if(! preg_match("/^[0-9]+$/",$jcode)){
   throw new exception("jcodeが数字ではありません(".$jcode.")");
  }
  
  //where句セット
  $where=<<<EOF
       t.strcode  = {$strcode}
   and t.saleday <='{$saleday}'
   and t.saletype = {$saletype}
   and t.jcode    = '{$jcode}'
EOF;
  
  //order句セット
  $order=<<<EOF
    t.saleday desc
EOF;

  return dsetGetSaleItem($where,$order);
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// セールアイテム単品販売履歴を返す(集計サマリー)
//----------------------------------------------------//
function viewGetSaleItemResult($strcode,$saletype,$saleday,$jcode){
 $mname="viewGetSaleItemResult(view.function.php) ";
 try{
  wLog("start:".$mname);
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
 
  if(! preg_match("/^[0-9]+$/",$saletype)){
   throw new exception("saletypeが数字ではありません(".$saletype.")");
  }
 
  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  if(! preg_match("/^[0-9]+$/",$jcode)){
   throw new exception("jcodeが数字ではありません(".$jcode.")");
  }
  
  //where句セット
  $where=<<<EOF
       t.strcode  = {$strcode}
   and t.saleday <='{$saleday}'
   and t.saletype = {$saletype}
   and t.jcode    = '{$jcode}'
EOF;
  
  //order句セット
  $order=<<<EOF
    max(t.saleday) desc
   ,min(t.saleday) desc
EOF;

  return dsetGetSaleItemSum($where,$order);
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 日付とアイテム数を返す
//----------------------------------------------------//
function viewGetSaleList($strcode,$saletype,$w=null){
 $mname="viewGetSaleList(view.function.php) ";
 try{
  wLog("start:".$mname);

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
  
  if(! preg_match("/^[0-9]+$/",$saletype)){
   throw new exception("saletypeが数字ではありません(".$saletype.")");
  }

  $where=<<<EOF
       t.strcode={$strcode}
   and t.saletype={$saletype}
EOF;

  if($w){
   $where.=" ".$w;
  }

  $order=<<<EOF
   t.saleday
EOF;

  return dsetGetFlyersDay($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// セール商品期間集計を返す
//----------------------------------------------------//
function viewGetSaleSummry($strcode,$saletype,$w=null){
 $mname="viewGetSaleSummry(view.function.php) ";
 try{
  wLog("start:".$mname);
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! preg_match("/^[0-9]+$/",$saletype)){
   throw new exception("saletypeが数字ではありません(".$saletype.")");
  }

  $where=<<<EOF
       t.strcode ={$strcode}
   and t.saletype={$saletype}
EOF;
  
  if($w){
   $where.=" ".$w;
  }
  $order=<<<EOF
    min(t.saleday)
   ,max(t.saleday)
   ,t.saletype
   ,t.strcode
   ,t.clscode
   ,t.jcode
EOF;
  if($saletype==7){
   $order="t.saletype,t.strcode,t.saleday,t.clscode";
   return dsetGetNews($where,$order);
  }
  return dsetGetSaleItemSum($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 検索結果を返す(商品マスタ)
//----------------------------------------------------//
function viewGetSearchItem($strcode,$jcode=null,$keyword=null){
 $mname="viewGetSearchItem(view.function.php) ";
 try{
  wLog("start:".$mname);
  $where =" t.strcode={$strcode}";

  if($jcode){
   $where.=" and t.jcode like '{$jcode}%'";
  }

  if($keyword){
   $where.=" and t.sname like '%{$keyword}%'";
  }

  //$order="t.sname";

  return dsetGetJanMas($where,null,$order,null);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// 検索結果を返す セール商品(チラシ以外)
//----------------------------------------------------//
function viewGetSearchSaleItem($strcode,$jcode=null,$keyword=null){
 $mname="viewGetSearchSaleItem(view.function.php) ";
 try{
  wLog("start:".$mname);
  $where =" t.strcode={$strcode} ";
  $where.=" and t.saleday='".date("Y-m-d")."'";
  $where.=" and t.saletype>0 ";
  if($jcode){
   $where.=" and t.jcode like '{$jcode}%'";
  }

  if($keyword){
   $where.=" and t.sname like '%{$keyword}%'";
  }

  //$order="t.sname";

  return dsetGetSaleItem($where,null,$order,null);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

?>
