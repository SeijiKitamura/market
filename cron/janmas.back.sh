#!/bin/sh

#変数セット
DATADIR=data
FNAME=janmas.csv
LOGFILE=logfile.txt

cd $(dirname $0)
cd ../${DATADIR}
#echo `pwd`

echo `date +%Y-%m-%d_%H:%M:%S` start>>$LOGFILE
d=`date +%Y%m%d%H%M%S`

FNAME=clsdaysale.back.csv

#ファイル存在チェック
if [ -e ${FNAME} ]; then

 #既存sqlファイル削除
 if [ -e sql.back.txt ]; then
  rm -f sql.back.txt
 fi
 
 #ファイル読み込み(削除)
 HIDUKE=""
 while read LINE; do
  H=`echo ${LINE}|awk -F',' '{print $1}'`
  if [ "$HIDUKE" != "$H" ]; then
   echo $LINE|awk -F',' '{printf("delete from ultra_clsdaysale where saleday=\x27%s\x27 and strcode=%s;",$1,$2);print ""}'>>sql.back.txt
  fi
  HIDUKE=${H}
 
  echo $LINE|awk -F',' '{printf("insert into ultra_clsdaysale(saleday,strcode,clscode,saleitem,saleamt,disitem,disamt,dispitem,dispamt) values(\x27%s\x27,%s,%s,%s,%s,%s,%s,%s,%s);",$1,$2,$3,$4,$5,$6,$7,$8,$9);print "";}'>>sql.back.txt
 done < ${FNAME}
 
# psql -f sql.back.txt >/dev/null
 
 #該当ファイル削除
# rm -f ${FNAME}

fi

FNAME=lindaysale.back.csv

#ファイル存在チェック
if [ -e ${FNAME} ]; then

 #ファイル読み込み(削除)
 HIDUKE=""
 while read LINE; do
  H=`echo ${LINE}|awk -F',' '{print $1}'`
  if [ "$HIDUKE" != "$H" ]; then
   echo $LINE|awk -F',' '{printf("delete from ultra_lindaysale where saleday=\x27%s\x27 and strcode=%s;",$1,$2);print ""}'>>sql.back.txt
  fi
  HIDUKE=${H}
 
  echo $LINE|awk -F',' '{printf("insert into ultra_lindaysale(saleday,strcode,lincode,saleitem,saleamt,disitem,disamt,dispitem,dispamt) values(\x27%s\x27,%s,%s,%s,%s,%s,%s,%s,%s);",$1,$2,$3,$4,$5,$6,$7,$8,$9);print "";}'>>sql.back.txt
 done < ${FNAME}
 
# psql -f sql.back.txt >/dev/null
 
 #該当ファイル削除
# rm -f ${FNAME}

fi


echo `date +%Y-%m-%d_%H:%M:%S` end>>$LOGFILE
