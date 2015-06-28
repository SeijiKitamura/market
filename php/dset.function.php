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
  $db->select =<<<EOF
    t.*
   ,t1.clsname
   ,t2.lincode
   ,t2.linname
   ,t3.dpscode
   ,t3.dpsname
   ,t4.strname
EOF;
  $db->from=TABLE_PREFIX.JANSALE." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode ";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode ";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode ";
  $db->from.=" inner join ".TABLE_PREFIX.STRMAS." as t4 on";
  $db->from.=" t3.strcode=t4.strcode";
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
    min(t.saleday) as startday
   ,max(t.saleday) as endday
   ,t.clscode
   ,t.jcode
   ,t.sname
   ,t.maker
   ,t.tani
   ,t.stdprice
   ,t.price
   ,t.yen
   ,t.comment
   ,t.grpnum
   ,t.grpname
   ,t.specialflg
   ,t.adnum
   ,t1.clsname
   ,t2.lincode
   ,t2.linname
   ,t3.dpscode
   ,t3.dpsname
   ,t4.strname
EOF;

  $db->from=TABLE_PREFIX.JANSALE." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode ";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode ";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode ";
  $db->from.=" inner join ".TABLE_PREFIX.STRMAS." as t4 on";
  $db->from.=" t3.strcode=t4.strcode";

  if ($where) $db->where=$where;

  $db->group=<<<EOF
    t.clscode
   ,t.jcode
   ,t.sname
   ,t.maker
   ,t.tani
   ,t.stdprice
   ,t.price
   ,t.yen
   ,t.comment
   ,t.grpnum
   ,t.grpname
   ,t.specialflg
   ,t.adnum
   ,t1.clsname
   ,t2.lincode
   ,t2.linname
   ,t3.dpscode
   ,t3.dpsname
   ,t4.strname
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
// JANSALEのclscode一覧を返す
//----------------------------------------------------//
function dsetGetSaleCls($where=null,$order=null,$having=null){
 $mname="dsetGetSaleCls(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t.clscode,t1.clsname,count(t.jcode) as itemcnt";
  $db->from =TABLE_PREFIX.JANSALE." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  if ($where)  $db->where=$where;
  $db->group ="t.clscode,t1.clsname";
  if ($order)  $db->order=$order;
  else{
   $db->order="t.clscode";
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
  $db->select =" t1.lincode,t2.linname,count(t.jcode) as itemcnt";
  $db->from =TABLE_PREFIX.JANSALE." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode";
  if ($where)  $db->where=$where;
  $db->group ="t1.lincode,t2.linname";
  if ($order)  $db->order=$order;
  else{
   $db->order="t1.lincode";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEのdpscode一覧を返す
//----------------------------------------------------//
function dsetGetSaleDps($where=null,$order=null,$having=null){
 $mname="dsetGetSaleDps(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t2.dpscode,t3.dpsname,count(t.jcode) as itemcnt";
  $db->from =TABLE_PREFIX.JANSALE." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode";
  if ($where)  $db->where=$where;
  $db->group ="t2.dpscode,t3.dpsname";
  if ($order)  $db->order=$order;
  else{
   $db->order="t2.dpscode";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEのgrpnum一覧を返す
//----------------------------------------------------//
function dsetGetSaleGrpList($where=null,$order=null,$having=null){
 $mname="dsetGetSaleDps(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select="grpnum,grpname";
  $db->from =TABLE_PREFIX.JANSALE." as t ";
  if ($where)  $db->where=$where;
  $db->group =$db->select;
  if ($order)  $db->order=$order;
  else{
   $db->order="grpnum";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

?>
