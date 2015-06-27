<?php
//----------------------------------------------------//
//  dset.function.php
//----------------------------------------------------//
//  db.class.phpを使用したSQL生成関数
//  戻り値　成功->配列　失敗->false
//----------------------------------------------------//


//ここではwhere句は書かない

require_once("db.class.php");

//----------------------------------------------------//
// JANSALEのセールアイテムを返す
//----------------------------------------------------//
function dsetGetSaleItem($where=null,$order=null){
 $mname="dsetGetSaleItem(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select="*";
  $db->from=TABLE_PREFIX.JANSALE;
  if ($where) $db->where=$where;
  if ($order) $db->order=$order;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEのセールアイテムを返す(期間集計)
//----------------------------------------------------//
function dsetGetSaleItemSum($where=null,$order=null,$having=null){
 $mname="dsetGetSaleItemSum(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select=<<<EOF
    min(saleday) as startday
   ,max(saleday) as endday
   ,clscode
   ,jcode
   ,sname
   ,maker
   ,tani
   ,stdprice
   ,price
   ,yen
   ,comment
   ,grpnum
   ,grpname
   ,specialflg
   ,adnum
EOF;

  $db->from=TABLE_PREFIX.JANSALE;

  if ($where) $db->where=$where;

  $db->group=<<<EOF
    clscode
   ,jcode
   ,sname
   ,maker
   ,tani
   ,stdprice
   ,price
   ,yen
   ,comment
   ,grpnum
   ,grpname
   ,specialflg
   ,adnum
EOF;
  if ($order)  $db->order=$order;
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEのadnumを返す
//----------------------------------------------------//
function dsetGetAdnum($where=null,$order=null,$having=null){
 $mname="dsetGetAdnum(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select="min(saleday) as saleday,adnum";
  $db->from  =TABLE_PREFIX.JANSALE;
  if ($where)  $db->where=$where;
  $db->group="adnum";
  if ($order)  $db->order=$order;
  else{
   $db->order="min(saleday),adnum";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEのsaleday一覧を返す
//----------------------------------------------------//
function dsetGetFlyersDay($where=null,$order=null,$having=null){
 $mname="dsetGetFlyersDay(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select="saleday";
  $db->from  =TABLE_PREFIX.JANSALE;
  if ($where)  $db->where=$where;
  $db->group ="saleday";
  if ($order)  $db->order=$order;
  else{
   $db->order="saleday";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEのlincode一覧を返す
//----------------------------------------------------//
function dsetGetSaleLin($where=null,$order=null,$having=null){
 $mname="dsetGetSaleLin(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select ="trunc(clscode/100) as lincode,count(clscode) as items";
  $db->from =TABLE_PREFIX.JANSALE;
  if ($where)  $db->where=$where;
  $db->group ="trunc(clscode/100)";
  if ($order)  $db->order=$order;
  else{
   $db->order="trunc(clscode/100)";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

?>

