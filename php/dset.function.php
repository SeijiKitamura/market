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
   ,t.saletype
   ,t.strcode
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
    t.saletype
   ,t.strcode
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
  $db->select="min(saleday) as saleday,adnum,strcode";
  $db->from  =TABLE_PREFIX.JANSALE;
  if ($where)  $db->where=$where;
  $db->group="strcode,adnum";
  if ($order)  $db->order=$order;
  else{
   $db->order="strcode,min(saleday) desc,adnum";
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
  $db->select="t.strcode,t.saleday,count(t.jcode) as itemcnt";
  $db->from  =TABLE_PREFIX.JANSALE." as t";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode ";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode ";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode ";
  $db->from.=" inner join ".TABLE_PREFIX.STRMAS." as t4 on";
  $db->from.=" t3.strcode=t4.strcode";
  if ($where)  $db->where=$where;
  $db->group ="t.strcode,t.saleday";
  if ($order)  $db->order=$order;
  else{
   $db->order="t.saleday";
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
 $mname="dsetGetSaleGrpList(dset.function.php) ";
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

//----------------------------------------------------//
// JANSALE一覧を返す(カレンダー用）
//----------------------------------------------------//
function dsetGetSaleDpsItem($where=null,$order=null,$having=null){
 $mname="dsetGetSaleDpsItem(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select ="t.strcode,t.saleday,t.saletype,";
  $db->select.="t.tani,t.price,t.yen,t.comment,t.grpname,";
  $db->select.="t3.dpsname";
  $db->from =TABLE_PREFIX.JANSALE." as t";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode";
  if ($where)  $db->where=$where;
  $db->group =$db->select;
  if ($order)  $db->order=$order;
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEの年月一覧を返す(カレンダー用）
//----------------------------------------------------//
function dsetGetMonthList($where=null,$order=null,$having=null){
 $mname="dsetGetMonthList(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t.strcode";
  $db->select.=",to_char(t.saleday,'yyyy') as nen";
  $db->select.=",to_char(t.saleday,'MM')   as tuki";
  $db->select.=",count(jcode) as itemcnt";
  $db->from =TABLE_PREFIX.JANSALE." as t";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode";
  if ($where)  $db->where=$where;
  $db->group =" t.strcode";
  $db->group.=",to_char(t.saleday,'yyyy')";
  $db->group.=",to_char(t.saleday,'MM')  ";
  if ($order)  $db->order=$order;
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANMASのDPSグループを返す
//----------------------------------------------------//
function dsetGetDpsList($where=null,$order=null,$having=null){
 $mname="dsetGetDpsList(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t.strcode";
  $db->select.=",t3.dpscode";
  $db->select.=",t3.dpsname";
  $db->select.=",count(*) as itemcnt";
  $db->from =TABLE_PREFIX.JANMAS." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode";
  if ($where)  $db->where=$where;
  $db->group =" t.strcode";
  $db->group.=",t3.dpscode";
  $db->group.=",t3.dpsname";
  if ($order)  $db->order=$order;
  else{
   $db->order="t.strcode,t3.dpscode";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANMASのLINグループを返す
//----------------------------------------------------//
function dsetGetLinList($where=null,$order=null,$having=null){
 $mname="dsetGetLinList(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t.strcode";
  $db->select.=",t2.lincode";
  $db->select.=",t2.linname";
  $db->select.=",count(*) as itemcnt";
  $db->from =TABLE_PREFIX.JANMAS." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode";
  if ($where)  $db->where=$where;
  $db->group =" t.strcode";
  $db->group.=",t2.lincode";
  $db->group.=",t2.linname";
  if ($order)  $db->order=$order;
  else{
   $db->order="t.strcode,t2.lincode";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANMASのCLSグループを返す
//----------------------------------------------------//
function dsetGetClsList($where=null,$order=null,$having=null){
 $mname="dsetGetClsList(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t.strcode";
  $db->select.=",t1.clscode";
  $db->select.=",t1.clsname";
  $db->select.=",count(*) as itemcnt";
  $db->from =TABLE_PREFIX.JANMAS." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  if ($where)  $db->where=$where;
  $db->group =" t.strcode";
  $db->group.=",t1.clscode";
  $db->group.=",t1.clsname";
  if ($order)  $db->order=$order;
  else{
   $db->order="t.strcode,t1.clscode";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANMASを返す
//----------------------------------------------------//
function dsetGetJanMas($where=null,$group=null,$order=null,$having=null){
 $mname="dsetGetJanMas(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t.strcode";
  $db->select.=",t3.dpscode";
  $db->select.=",t3.dpsname";
  $db->select.=",t2.lincode";
  $db->select.=",t2.linname";
  $db->select.=",t1.clscode";
  $db->select.=",t1.clsname";
  $db->select.=",t.jcode";
  $db->select.=",t.sname";
  $db->select.=",t.maker";
  $db->select.=",t.tani";
  $db->select.=",t.stdprice";
  $db->select.=",t.price";
  $db->select.=",t.comment";
  $db->select.=",t.firstsale";
  $db->select.=",t.lastsale";
  $db->from =TABLE_PREFIX.JANMAS." as t ";
  $db->from.=" inner join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode";
  $db->from.=" inner join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode";
  $db->from.=" inner join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode";
  if ($where)  $db->where=$where;
  if ($group)  $db->group=$group;
  if ($order)  $db->order=$order;
  else{
   $db->order="t.strcode,t3.dpscode,t2.lincode,t1.clscode,t.jcode";
  }
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

?>
