#!/bin/sh

#画像ディレクトリセット
IMGDIR="../img"

#現在位置へ移動
my_path=`readlink  -f $0`
my_dir=`dirname $my_path`
cd $my_dir 

#DBから出力
psql -A -t -c "select jcode from ultra_jansale group by jcode order by jcode" -d kennpin1>janlist.txt
#psql -A -t -c "select jcode from ultra_janmas  group by jcode order by jcode">>janlist.txt

#画像リスト出力
cd ${IMGDIR}
ls  *.jpg | sort >${my_dir}/imglist.txt

