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
// チラシ番号を配列で返す
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
// チラシ日付を配列で返す
// $dpscodeが指定された場合、dpscodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersDayDps($strcode,$adnum,$dpscode=null){
 $mname="viewGetFlyersDayDps(view.function.php) ";
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

  if($dpscode && ! preg_match("/^[0-9]+$/",$dpscode)){
   throw new exception("dpscodeが数字ではありません(".$dpscode.")");
  }

  $where=<<<EOF
       t.strcode ={$strcode}
   and t.saletype={$saletype}
   and t.adnum   ={$adnum}
EOF;
  if($dpscode){
   $where.=" and t2.dpscode={$dpscode}";
  }

  return dsetGetFlyersDay($where);
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ商品を返す
// $saledayが指定された場合、saleday以降
// $clscodeが指定された場合、clscodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersItemCls($strcode,$adnum,$saleday=null,$clscode=null){
 $mname="viewGetTirasiItemCls(view.function.php) ";
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
 $mname="viewGetTirasiItemLin(view.function.php) ";
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
// $dpscodeが指定された場合、dpscodeに属するアイテム
//----------------------------------------------------//
function viewGetFlyersItemDps($strcode,$adnum,$saleday=null,$dpscode=null){
 $mname="viewGetTirasiItemDps(view.function.php) ";
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
// チラシ商品のクラス一覧を返す
// $saledayが指定された場合、saleday以降のアイテム
// $lincodeが指定された場合、lincodeに属するクラス
//----------------------------------------------------//
function viewGetSaleClsList($strcode,$adnum,$saleday=null,$lincode=null){
 $mname="viewGetSaleClsList(view.function.php) ";
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

  $where="t.strcode={$strcode} and t.adnum={$adnum}";
  if($saleday) $where.=" and t.saleday>='{$saleday}'";
  if($lincode) $where.=" and t1.lincode={$lincode}";

  return dsetGetSaleCls($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ商品の部門一覧を返す
// $saledayが指定された場合、saleday以降
// $dpscodeが指定された場合、dpscodeに属するクラス
//----------------------------------------------------//
function viewGetSaleLinList($strcode,$adnum,$saleday=null,$dpscode=null){
 $mname="viewGetSaleLinList(view.function.php) ";
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

  $where="t.strcode={$strcode} and t.adnum={$adnum}";
  if($saleday) $where.=" and t.saleday>='{$saleday}'";
  if($dpscode) $where.=" and t2.dpscode={$dpscode}";

  return dsetGetSaleLin($where);
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
// チラシのgrpnum一覧を返す
// $saledayが指定された場合、saleday以降
//----------------------------------------------------//
function viewGetSaleGrpList($strcode,$adnum,$saleday=null){
 $mname="viewGetSaleGrpList(view.function.php) ";
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

  $where="strcode={$strcode} and adnum={$adnum}";
  if($saleday) $where.=" and saleday>='{$saleday}'";

  return dsetGetSaleGrpList($where);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシのgrpnumから商品一覧を返す
// $saledayが指定された場合、saleday以降
//----------------------------------------------------//
function viewGetSaleGrpItem($strcode,$adnum,$saleday=null,$grpnum){
 $mname="viewGetSaleGrpList(view.function.php) ";
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

  if(! preg_match("/^[0-9]+$/",$grpnum)){
   throw new exception("grpnumが数字ではありません(".$grpnum.")");
  }

  $where=<<<EOF
       t.strcode={$strcode}
   and t.adnum  ={$adnum}
   and t.grpnum ={$grpnum}
EOF;

  if($saleday) $where.=" and saleday>='{$saleday}'";

  $order=<<<EOF
    t.specialflg desc
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
// カレンダーを返す
//----------------------------------------------------//
function viewGetCalendar($strcode,$startday,$endday){
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
// 日付とアイテム数を返す
//----------------------------------------------------//
function viewGetSaleList($strcode,$saletype){
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

  $order=<<<EOF
   t.saleday desc
EOF;

  return dsetGetFlyersDay($where,$order);
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
   $where.=" and ".$w;
  }

  $order=<<<EOF
       to_char(t.saleday,'yyyy') 
      ,to_char(t.saleday,'MM')
EOF;

  return dsetGetMonthList($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// ご注文商品のグループを返す
//----------------------------------------------------//
function viewGetGroupList($strcode,$saletype,$saleday){
 $mname="viewGetGroupList(view.function.php) ";
 try{
  wLog("start:".$mname);
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }
  
  if(! preg_match("/^[0-9]+$/",$saletype)){
   throw new exception("saletypeが数字ではありません(".$saletype.")");
  }
  
  if(! chkDate($saleday)){
   throw new exception("saledayが正しくありません({$saleday})");
  }

  $startday=date("Y-m-1",strtotime($saleday));
  $endday=date("Y-m-t",strtotime($saleday));

  $where=<<<EOF
       strcode={$strcode} 
   and saletype={$saletype}
   and saleday between '{$startday}' and '{$endday}'
EOF;
  return dsetGetSaleGrpList($where,$order);
 }
 catch(Exception $e){
  wLog($e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// ご注文商品を返す
//----------------------------------------------------//
function viewGetGotyumonGrpItem($strcode,$saleday,$grpnum){
 $mname="viewGetGotyumonGrpItem(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=5;
  
  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if($saleday && ! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  if(! preg_match("/^[0-9]+$/",$grpnum)){
   throw new exception("grpnumが数字ではありません(".$grpnum.")");
  }

  $where=<<<EOF
       t.strcode ={$strcode}
   and t.saleday ='{$saleday}'
   and t.saletype={$saletype}
EOF;
  if($grpnum){
   $where.=" and t.grpnum={$grpnum}";
  }

  $order=<<<EOF
    t.grpnum
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
// 検索結果を返す
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

?>
