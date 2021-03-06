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
// JANSALEのadnumを返す
//----------------------------------------------------//
function dsetGetAdnum($where=null,$order=null,$having=null){
 $mname="dsetGetAdnum(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select="min(saleday) as saleday,adnum,strcode,saletype";
  $db->from  =TABLE_PREFIX.JANSALE;
  if ($where)  $db->where=$where;
  $db->group="strcode,adnum,saletype";
  if ($order)  $db->order=$order;
  else{
   //$db->order="strcode,min(saleday) desc,adnum";
   $db->order="strcode,min(saleday),adnum";
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
  $db->select="t.strcode,t.saletype,t.saleday,count(t.jcode) as itemcnt";
  $db->from  =TABLE_PREFIX.JANSALE." as t";
  $db->from.=" left outer join ".TABLE_PREFIX.CLSMAS." as t1 on";
  $db->from.=" t.strcode=t1.strcode and t.clscode=t1.clscode ";
  $db->from.=" left outer join ".TABLE_PREFIX.LINMAS." as t2 on";
  $db->from.=" t1.strcode=t2.strcode and t1.lincode=t2.lincode ";
  $db->from.=" left outer join ".TABLE_PREFIX.DPSMAS." as t3 on";
  $db->from.=" t2.strcode=t3.strcode and t2.dpscode=t3.dpscode ";
  $db->from.=" left outer join ".TABLE_PREFIX.STRMAS." as t4 on";
  $db->from.=" t3.strcode=t4.strcode";
  if ($where)  $db->where=$where;
  $db->group ="t.strcode,t.saleday,t.saletype";
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
// JANSALEの年月日一覧を返す(チラシ用）
//----------------------------------------------------//
function dsetGetFlyersDayList($where=null,$order=null,$having=null){
 $mname="dsetGetFlyersDayList(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select=<<<EOF
 t.strcode
,t.saletype
,t.adnum
,t1.saleday
,count(t.jcode) as itemcnt
EOF;
  $db->from=<<<EOF
(
select
 strcode
,saletype
,adnum
,jcode
from ultra_jansale
group by
 strcode
,saletype
,adnum
,jcode
) as t
inner join (
 select
 strcode
,saletype
,adnum
,min(saleday) as saleday
 from ultra_jansale
 group by
 strcode
,saletype
,adnum
) as t1 on
    t.strcode=t1.strcode
and t.saletype=t1.saletype
and t.adnum=t1.adnum
EOF;
  if ($where)  $db->where=$where;
  $db->group="t.strcode,t.saletype,t.adnum,t1.saleday";
  if ($having) $db->having=$having;
  if ($order)  $db->order=$order;
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

//----------------------------------------------------//
// MAKERMASを返す
//----------------------------------------------------//
function dsetGetMakerMas($where=null,$group=null,$order=null,$having=null){
 $mname="dsetGetMakerMas(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" jcode";
  $db->select.=",cname";
  $db->select.=",maker";
  $db->from =TABLE_PREFIX.MAKERMAS;
  if ($where)  $db->where=$where;
  if ($group)  $db->group=$group;
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
  $db->select.=",t.saletype";
  $db->select.=",to_char(t.saleday,'yyyy') as nen";
  $db->select.=",to_char(t.saleday,'MM')   as tuki";
  $db->select.=",min(date_part('day',t.saleday)) as hi";
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
  $db->group.=",t.saletype";
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
// JANSALEのデータを返す(ニュース用）
//----------------------------------------------------//
function dsetGetNews($where=null,$order=null){
 $mname="dsetGetNews(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select="t.*";
  $db->from=TABLE_PREFIX.JANSALE." as t";
  if ($where)  $db->where=$where;
  if ($order)  $db->order=$order;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEの年月一覧を返す(ニュース用）
//----------------------------------------------------//
function dsetGetNewsMonthList($where=null,$order=null,$having=null){
 $mname="dsetGetNewsMonthList(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select =" t.strcode";
  $db->select.=",t.saletype";
  $db->select.=",to_char(t.saleday,'yyyy') as nen";
  $db->select.=",to_char(t.saleday,'MM')   as tuki";
  $db->select.=",min(date_part('day',t.saleday)) as hi";
  $db->select.=",count(jcode) as itemcnt";
  $db->from =TABLE_PREFIX.JANSALE." as t";
  if ($where)  $db->where=$where;
  $db->group =" t.strcode";
  $db->group.=",t.saletype";
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
// JANSALEの日別売上を返す
//----------------------------------------------------//
function dsetGetSaleItemResult($where=null,$order=null,$having=null){
 $mname="dsetGetSaleItemResult(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select=<<<EOF
    t.saleday
   ,t.clscode
   ,t.jcode
   ,t.sname
   ,t.tani
   ,t.price
   ,coalesce(t1.saleitem,0) as saleitem
   ,coalesce(t1.saleamt,0)  as saleamt
   ,coalesce(t1.disitem,0)  as disitem
   ,coalesce(t1.disamt,0)   as disamt
   ,coalesce(t1.dispitem,0) as dispitem
   ,coalesce(t1.dispamt,0)  as dispamt
EOF;
  $db->from =" ultra_jansale as t";
  $db->from.=" left outer join ultra_jandaysale as t1 on";
  $db->from.=" t.strcode=t1.strcode";
  $db->from.=" and t.saleday=t1.saleday";
  $db->from.=" and t.jcode=t1.jcode";
  if ($where) $db->where=$where;
  if ($order)  $db->order=$order;
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANSALEの月別売上を返す
//----------------------------------------------------//
function dsetGetSaleItemMonthResult($where=null,$order=null,$having=null){
 $mname="dsetGetSaleItemMonthResult(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select=<<<EOF
    to_char(t.saleday,'yyyy') as nen
   ,to_char(t.saleday,'MM')   as tuki
   ,t.clscode
   ,t.jcode
   ,t.sname
   ,sum(t1.saleitem) as saleitem
   ,sum(t1.saleamt)  as saleamt
   ,sum(t1.disitem)  as disitem
   ,sum(t1.disamt)   as disamt
   ,sum(t1.dispitem) as dispitem
   ,sum(t1.dispamt)  as dispamt
EOF;
  $db->from =" ultra_jansale as t";
  $db->from.=" left outer join ultra_jandaysale as t1 on";
  $db->from.=" t.strcode=t1.strcode";
  $db->from.=" and t.saleday=t1.saleday";
  $db->from.=" and t.jcode=t1.jcode";

  if ($where) $db->where=$where;

  $db->group=<<<EOF
    to_char(t.saleday,'yyyy') 
   ,to_char(t.saleday,'MM')
   ,t.clscode
   ,t.jcode
   ,t.sname
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
// JANMASの日別売上を返す
//----------------------------------------------------//
function dsetGetItemResult($where=null,$order=null,$having=null){
 $mname="dsetGetItemResult(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select=<<<EOF
    t1.saleday
   ,t.clscode
   ,t.jcode
   ,t.sname
   ,t.tani
   ,t.price
   ,coalesce(t1.saleitem,0) as saleitem
   ,coalesce(t1.saleamt,0)  as saleamt
   ,coalesce(t1.disitem,0)  as disitem
   ,coalesce(t1.disamt,0)   as disamt
   ,coalesce(t1.dispitem,0) as dispitem
   ,coalesce(t1.dispamt,0)  as dispamt
EOF;
  $db->from =" ultra_janmas as t";
  $db->from.=" left outer join ultra_jandaysale as t1 on";
  $db->from.=" t.strcode=t1.strcode";
  $db->from.=" and t.jcode=t1.jcode";
  if ($where) $db->where=$where;
  if ($order)  $db->order=$order;
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

//----------------------------------------------------//
// JANMASの月別売上を返す
//----------------------------------------------------//
function dsetGetItemMonthResult($where=null,$order=null,$having=null){
 $mname="dsetGetItemMonthResult(dset.function.php) ";
 try{
  wLog("start:".$mname);
  $db=new DB();
  $db->select=<<<EOF
    to_char(t1.saleday,'yyyy') as nen
   ,to_char(t1.saleday,'MM')   as tuki
   ,t.clscode
   ,t.jcode
   ,t.sname
   ,sum(t1.saleitem) as saleitem
   ,sum(t1.saleamt)  as saleamt
   ,sum(t1.disitem)  as disitem
   ,sum(t1.disamt)   as disamt
   ,sum(t1.dispitem) as dispitem
   ,sum(t1.dispamt)  as dispamt
EOF;
  $db->from =" ultra_janmas as t";
  $db->from.=" left outer join ultra_jandaysale as t1 on";
  $db->from.=" t.strcode=t1.strcode";
  $db->from.=" and t.jcode=t1.jcode";
  if ($where) $db->where=$where;
  $db->group =<<<EOF
    to_char(t1.saleday,'yyyy')
   ,to_char(t1.saleday,'MM')  
   ,t.clscode
   ,t.jcode
   ,t.sname
EOF;
  if ($order)  $db->order=$order;
  if ($having) $db->having=$having;
  return $db->getArray();
 }
 catch(Exception $e){
  throw $e;
 }
}

?>
