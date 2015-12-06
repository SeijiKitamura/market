#!/bin/sh

#変数セット
DATADIR=data
FNAME=janmas.csv

cd $(dirname $0)
cd ../${DATADIR}
#echo `pwd`

#ファイル存在チェック
if [ ! -e ${FNAME} ]; then
 echo "${FNAME}がありません"
 exit 1
fi


if [ -e sql.txt ]; then
 rm -f sql.txt
fi

#ファイル読み込み
while read LINE; do
 echo $LINE|awk -F',' '{printf("DELETE FROM ultra_janmas where strcode=%d and jcode=\047%d\047;"),$1,$3;print "";
                        printf("INSERT INTO ultra_janmas(strcode,clscode,jcode,sname,maker,tani,stdprice,price,comment,firstsale,lastsale) VALUES(%s,%s,\x27%s\x27,\x27%s\x27,\x27%s\x27,\x27%s\x27,%s,%s,\x27%s\x27,\x27%s\x27,\x27%s\x27);",$1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11);print ""}'>>sql.txt 
done < ${FNAME}

echo "update ultra_janmas set firstsale='1970/1/1' where firstsale='1900/1/1';">>sql.txt
echo "update ultra_janmas set lastsale ='1970/1/1' where lastsale='1900/1/1'; ">>sql.txt

psql -f sql.txt >/dev/null

