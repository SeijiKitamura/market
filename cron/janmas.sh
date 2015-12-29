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

#ファイル存在チェック
if [ ! -e ${FNAME} ]; then
 echo "${FNAME}がありません">>$LOGFILE
 exit 1
fi


if [ -e sql.txt ]; then
 rm -f sql.txt
fi

#ファイル読み込み
while read LINE; do
 echo $LINE|awk -F',' '{printf("DELETE FROM ultra_janmas where strcode=%s and jcode=\x27%s\x27;"),$1,$3;print "";
                        printf("INSERT INTO ultra_janmas(strcode,clscode,jcode,sname,maker,tani,stdprice,price,comment,firstsale,lastsale) VALUES(%s,%s,\x27%s\x27,\x27%s\x27,\x27%s\x27,\x27%s\x27,%s,%s,\x27%s\x27,\x27%s\x27,\x27%s\x27);",$1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11);print ""}'>>sql.txt 
done < ${FNAME}

echo "update ultra_janmas set firstsale='1970/1/1' where firstsale='1900/1/1';">>sql.txt
echo "update ultra_janmas set lastsale ='1970/1/1' where lastsale='1900/1/1'; ">>sql.txt

echo "update ultra_janmas set maker=ultra_makermas.maker from ultra_makermas where ultra_makermas.jcode=substr(ultra_janmas.jcode,1,6) and ultra_janmas.maker='';">>sql.txt
echo "update ultra_janmas set maker=ultra_makermas.maker from ultra_makermas where ultra_makermas.jcode=substr(ultra_janmas.jcode,1,7) and ultra_janmas.maker='';">>sql.txt
echo "update ultra_janmas set maker=ultra_makermas.maker from ultra_makermas where ultra_makermas.jcode=substr(ultra_janmas.jcode,1,9) and ultra_janmas.maker='';">>sql.txt
psql -f sql.txt >/dev/null

#cp sql.txt ${d}sql.txt

FNAME=jandaysale.csv

#ファイル存在チェック
if [ -e ${FNAME} ]; then

 #既存sqlファイル削除
 if [ -e sql.txt ]; then
  rm -f sql.txt
 fi
 
 #ファイル読み込み(削除)
 HIDUKE=""
 while read LINE; do
  H=`echo ${LINE}|awk -F',' '{print $1}'`
  if [ "$HIDUKE" != "$H" ]; then
   echo $LINE|awk -F',' '{printf("delete from ultra_jandaysale where saleday=\x27%s\x27 and strcode=%s;",$1,$2);print ""}'>>sql.txt
  fi
  HIDUKE=${H}
 
  echo $LINE|awk -F',' '{printf("insert into ultra_jandaysale(saleday,strcode,clscode,jcode,saleitem,saleamt,disitem,disamt,dispitem,dispamt) values(\x27%s\x27,%s,%s,\x27%s\x27,%s,%s,%s,%s,%s,%s);",$1,$2,$3,$4,$5,$6,$7,$8,$9,$10);print "";}'>>sql.txt
 done < ${FNAME}
 
 psql -f sql.txt
 
 #該当ファイル削除
 rm -f ${FNAME}

fi

echo `date +%Y-%m-%d_%H:%M:%S` end>>$LOGFILE
