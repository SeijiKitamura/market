#!/bin/bash

cd $(dirname $0)

#前日のログを解析する

#前日を求める
nen=`date '+%Y' -d '1 days ago'`
tuki=`date '+%m' -d '1 days ago'`
hi=`date '+%d' -d '1 days ago'`

#月別
echo "<h2>${nen}年${tuki}月 アクセス集計</h2>" >../log/access${nen}${tuki}.html     &
find ../log -type f -name "access${nen}${tuki}*.log" -exec cat {} \; |\
awk -F'\"|| ' 'sub(/\?.*/,"",$3) sub(/\|.*/,"",$5) {print $3,$5}'   |\
sort                                                                |\
uniq -c                                                             |\
sort -k 1,1nr -k3,3                                                 |\
awk 'BEGIN {print "<h2>月合計アクセス数</h2>"}
     BEGIN {print "<table>"}
     BEGIN {print "<thead><tr>"}
     BEGIN {print "<th>ページ名</th>"}
     BEGIN {print "<th>アクセス数</th"}
     BEGIN {print "</tr></thead><tbody>"}
     {print "<tr>"}
     {print "<td><a href=\""$2"\">"}
     {print $3}
     {print "</a></td>"}
     {print "<td>"$1"</td>"}
     {print "</tr>"}
     {sum+=$1}
     END   {print "<tr><td>合計</td><td>"sum"</td>"}
     END   {print "</tbody></table>"}
    '>>../log/access${nen}${tuki}.html

#日別
find ../log -type f -name "access${nen}${tuki}*.log" -exec cat {} \; |\
awk -F'\"|| ' 'sub(/\?.*/,"",$3) sub(/\|.*/,"",$5) {print $1,$3,$5}'|\
sort                                                                |\
uniq -c                                                             |\
sort -k 2,2 -k 1,1nr -k4,4                                          |\
awk 'BEGIN {print "<h2>日別合計アクセス数</h2>"}
     BEGIN {print "<table>"}
     BEGIN {print "<thead><tr>"}
     BEGIN {print "<th>日付</th>"}
     BEGIN {print "<th>ページ名</th>"}
     BEGIN {print "<th>アクセス数</th"}
     BEGIN {print "</tr></thead><tbody>"}
     {print "<tr>"}
     {print "<td>"$2"</td>"}
     {print "<td><a href=\""$3"\">"}
     {print $4}
     {print "</a></td>"}
     {print "<td>"$1"</td>"}
     {print "</tr>"}
     {sum+=$1}
     END   {print "<tr><td></td><td>合計</td><td>"sum"</td>"}
     END   {print "</tbody></table>"}
    '>>../log/access${nen}${tuki}.html

#日別詳細
find ../log -type f -name "access${nen}${tuki}*.log" -exec cat {} \; |\
awk -F'\"|| ' '{print $1,$3,$5}'                  |\
sort                                                                |\
uniq -c                                                             |\
sort -k 2,2 -k 1,1nr -k4,4                                          |\
awk 'BEGIN {print "<h2>日別合計アクセス数</h2>"}
     BEGIN {print "<table>"}
     BEGIN {print "<thead><tr>"}
     BEGIN {print "<th>日付</th>"}
     BEGIN {print "<th>ページ名</th>"}
     BEGIN {print "<th>アクセス数</th"}
     BEGIN {print "</tr></thead><tbody>"}
     {print "<tr>"}
     {print "<td>"$2"</td>"}
     {print "<td><a href=\""$3"\">"}
     {print $4}
     {print "</a></td>"}
     {print "<td>"$1"</td>"}
     {print "</tr>"}
     {sum+=$1}
     END   {print "<tr><td></td><td>合計</td><td>"sum"</td>"}
     END   {print "</tbody></table>"}
    '>>../log/access${nen}${tuki}.html
