#!/bin/sh

cd $(dirname $0)


#今日を求める
nen=`date '+%Y'`
tuki=`date '+%m'`
hi=`date '+%d'`

#ヘッダー(sitemap.xml)
HEADER=`cat << EOF
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
EOF
`

#フッター(sitemap.xml)
FOOTER=`cat << EOF
</urlset>
EOF
`
#SITEURL
URL="http://market.kita-grp.co.jp"

rm ../sitemap*.xml

#セール商品のsitemap作成
VAL=`psql -t -A -F,<<EOF
select 
 case saletype
  when 0 then '${URL}/tirasiitem.php?strcode='||strcode||'&amp;adnum='||adnum||'&amp;jcode='||jcode
  when 1 then '${URL}/mailitem.php?strcode='||strcode||'&amp;saleday='||saleday||'&amp;jcode='||jcode
  when 3 then '${URL}/calendaritem.php?strcode='||strcode||'&amp;saleday='||saleday
  when 5 then '${URL}/goyoyakuitem.php?strcode='||strcode||'&amp;saleday='||saleday||'&amp;jcode='||jcode
  when 6 then '${URL}/monthitem.php?strcode='||strcode||'&amp;saleday='||saleday||'&amp;jcode='||jcode
  when 7 then '${URL}/newsitem.php?strcode='||strcode||'&amp;saleday='||saleday||'&amp;newsid='||id
  when 8 then '${URL}/giftitem.php?strcode='||strcode||'&amp;saleday='||saleday||'&amp;jcode='||jcode
  when 9 then '${URL}/soukiitem.php?strcode='||strcode||'&amp;saleday='||saleday||'&amp;jcode='||jcode
 end
from ultra_jansale 
where 
saleday<='${nen}-${tuki}-${hi}'
order by 
strcode,saleday desc,saletype,jcode
EOF`
ARY=($VAL)

#40000行ごとに区切る
fileno=1
i=0
for TARGET in ${ARY[*]}
do
 if [ $i -eq 0 ] ; then
  echo "${HEADER}" > ../sitemap${fileno}.xml
  ((i++))
  ((i++))
 fi
 echo "<url><loc>"${TARGET}"</loc></url>" >> ../sitemap${fileno}.xml
 ((i++))
 if [ $i -ge 40000 ] ; then
  i=0
  echo "${FOOTER}" >> ../sitemap${fileno}.xml
  ((fileno++))
 fi
done
echo ${FOOTER} >> ../sitemap${fileno}.xml

#単品マスタのsitemap作成
VAL=`psql -t -A -F,<<EOF
select 
 '${URL}/item.php?strcode='||strcode||'&amp;jcode='||jcode
from ultra_janmas 
order by 
strcode,lastsale desc,jcode
EOF`

#40000行ごとに区切る
i=0
((fileno++))
ARY=($VAL)
for TARGET in ${ARY[*]}
do
 if [ $i -eq 0 ] ; then
  echo "${HEADER}" > ../sitemap${fileno}.xml
  ((i++))
  ((i++))
 fi
 echo "<url><loc>"${TARGET}"</loc></url>" >> ../sitemap${fileno}.xml
 ((i++))
 if [ $i -ge 40000 ] ; then
  i=0
  echo ${FOOTER} >> ../sitemap${fileno}.xml
  ((fileno++))
 fi
done
echo ${FOOTER} >> ../sitemap${fileno}.xml

#固定ページ作成
((fileno++))
cat << EOF >> ../sitemap${fileno}.xml
 <?xml version="1.0" encoding="UTF-8"?>
 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
 <url>
  <loc>http://market.kita-grp.co.jp/searchlist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/giftitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/communication.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/haitatu.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/siteabout.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/newsitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/goyoyakuitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/soukiitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/calendarlist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/soukilist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/tirasiitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/gaiyo.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/monthitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/interview.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/privacy.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/saiyoujikou.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/mailitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/saleitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/schedule.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/kyujinriyu.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/newitemlist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/sinsotu.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/stepup.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/contactus.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/bosyu.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/map.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/tirasilist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/sagyonaiyo.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/saiyojisseki.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/aboutitem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/calendaritem.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/tirasiimg.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/maillist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/giftlist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/newslist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/index.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/saiyohousin.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/monthlist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/kodawari.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/goyoyakulist.php</loc>
 </url> 
 <url>
  <loc>http://market.kita-grp.co.jp/salearchive.php</loc>
 </url> 
</urlset>
EOF

#sitemapリスト作成
i=0
f=1

echo '<?xml version="1.0" encoding="UTF-8"?>' >>../sitemap.xml
echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' >> ../sitemap.xml

#サイトマップリスト生成
while :
do
 echo "<sitemap>" >> ../sitemap.xml
 echo "<loc>${URL}/sitemap${f}.xml</loc>" >> ../sitemap.xml
 echo "</sitemap>" >> ../sitemap.xml
 ((f++))
 if [ $f -gt $fileno ] ; then
  break
 fi
done

echo "</sitemapindex>" >> ../sitemap.xml

