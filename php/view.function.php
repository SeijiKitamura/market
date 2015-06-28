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
   ,t.specialflg desc
   ,t.grpnum
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
 $mname="viewGetTirasiItem(view.function.php) ";
 try{
  wLog("start:".$mname);
  //デフォルト値
  $saletype=0;
  if($saleday===null) $saleday=date("Y-m-d");

  //引数チェック
  if(! preg_match("/^[0-9]+$/",$strcode)){
   throw new exception("strcodeが数字ではありません(".$strcode.")");
  }

  if(! chkDate($saleday)){
   throw new exception("saledayが日付ではありません(".$saleday.")");
  }

  $where=<<<EOF
       strcode ={$strcode}
   and saletype={$saletype}
   and saleday='{$saleday}'
EOF;
  $adnum=array();
  $adnum=dsetGetAdnum($where);

  if(! isset($adnum)|| ! is_array($adnum)|| ! count($adnum)) throw new exception(" 該当日にチラシなし");

  return $adnum;
 }
 catch(Exception $e){
  wLog("error:".$mname." ".$e->getMessage());
  return false;
 }
}

//----------------------------------------------------//
// チラシ日付を配列で返す
//----------------------------------------------------//
function viewGetFlyersDay($strcode,$adnum){
 $mname="viewGetTirasiItem(view.function.php) ";
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

  $where=<<<EOF
       strcode ={$strcode}
   and saletype={$saletype}
   and adnum   ={$adnum}
EOF;
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

  $where="t.adnum={$adnum}";
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

  $where="t.adnum={$adnum}";
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

  $where="t.adnum={$adnum}";
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


?>
