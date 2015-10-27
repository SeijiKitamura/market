<?php
/*-----------------------------------------------------
 ファイル名:import.function.php
 接頭語    :imp
 主な動作  :各種データをDBにセットする
 返り値    :
 エラー    :メッセージを表示
----------------------------------------------------- */
require_once("db.class.php");

//------------------------------------------//
//POSTされたファイルを指定されたテーブルに
//登録する(下記1-4のラッパー)
//------------------------------------------//
function impPost2DB($tablename){
 $mname="impPost2DB(import.function.php) ";
 try{
  wLog("start:".$mname);
  if($filename=impPostFileName($_FILES)){
   if(impFile2DB($tablename,$filename)){
    echo "インポートしました";
    return true;
   }
  }
  return false;
 }
 catch(Exception $e){
  wLog("error:".$mname.$e->getMessage());
  echo "err:".$e->getMessage();
 }
}

//------------------------------------------//
//ファイルを指定されたテーブルに
//登録する(下記2-4のラッパー)
//------------------------------------------//
function impFile2DB($tablename,$filename){
 $mname="impFile2DB(import.function.php) ";
 try{
  if(impConvertUTF($filename)){
   if($csv=impCsv2Ary($filename)){
    if($sql=impCsv2SQL($tablename,$csv)){
     //DB登録
     $db=new DB();
     
     //テーブル別に既存データ処理を選別
     if($tablename==STRMAS || $tablename==DPSMAS || $tablename==LINMAS || $tablename==CLSMAS){
      $db->from=TABLE_PREFIX.$tablename;
      $db->where =" id>0";
      $db->delete();
      echo "既存データ削除完了<br>";
     }
     if($tablename==JANSALE){
      //チラシ既存データは一括削除
      if($sql[0]["col"]["saletype"]==0){
       $db->from=TABLE_PREFIX.JANSALE;
       $db->where =" adnum   =".$sql[0]["col"]["adnum"];
       $db->where.=" and saletype=0";
       $db->delete();
       echo "既存データ削除完了<br>";
      }

      //メール商品既存データは1行目の日付以降を一括削除
      if($sql[0]["col"]["saletype"]==1){
       $db->from=TABLE_PREFIX.JANSALE;
       $db->where =" saleday >='".$sql[0]["col"]["saleday"]."'";
       $db->where.=" and saletype=1";
       $db->delete();
       echo "既存データ削除完了<br>";
      }
      
      //おすすめ商品既存データは1行目の日付以降を一括削除
      if($sql[0]["col"]["saletype"]==2){
       $db->from=TABLE_PREFIX.JANSALE;
       $db->where =" saleday >='".$sql[0]["col"]["saleday"]."'";
       $db->where.=" and saletype=2";
       $db->delete();
       echo "既存データ削除完了<br>";
      }
      
      //カレンダー既存データは1行目の日付以降を一括削除
      if($sql[0]["col"]["saletype"]==3){
       $db->from=TABLE_PREFIX.JANSALE;
       $db->where =" saleday >='".$sql[0]["col"]["saleday"]."'";
       $db->where.=" and saletype=3";
       $db->delete();
       echo "既存データ削除完了<br>";
      }
      
      //ご注文既存データは1行目の日付以降を一括削除
      if($sql[0]["col"]["saletype"]==5){
       $db->from=TABLE_PREFIX.JANSALE;
       $db->where =" saleday >='".$sql[0]["col"]["saleday"]."'";
       $db->where.=" and saletype=5";
       $db->delete();
       echo "既存データ削除完了<br>";
      }
      
      //月間お買得品は1行目の日付以降を一括削除
      if($sql[0]["col"]["saletype"]==6){
       $db->from=TABLE_PREFIX.JANSALE;
       $db->where =" saleday >='".$sql[0]["col"]["saleday"]."'";
       $db->where.=" and saletype=6";
       $db->delete();
       echo "既存データ削除完了<br>";
      }
     }
     
     //単品マスタは何もしない

     $db->updatearray($sql);
     $c="end ".$mname;wLog($c);
     echo "DB登録完了<br>";
     return true;
    }
   }
  }
 }
 catch(Exception $e){
  wLog("error:".$mname.$e->getMessage());
  echo "err:".$e->getMessage();
 }
}

//------------------------------------------//
//1.POSTされたファイル名を返す
//------------------------------------------//
function impPostFileName($postfile){
 $mname="impPostFileName(import.function.php) ";
 try{
  $c="start ".$mname;wLog($c);
  //アップロードチェック
  switch ($postfile["file"]["error"]){
   case UPLOAD_ERR_OK:
     echo "アップロード完了<br>";
     break;
   case UPLOAD_ERR_NO_FILE:
    throw new Exception("ファイルが選択されていません");
   case UPLOAD_ERRINI_SIZE:
   case UPLOAD_ERR_FORM_SIZE:
    throw new Exception("ファイルサイズが大きすぎます");
   default:
    throw new Exception("想定外のエラーです");
  }
  return $postfile["file"]["tmp_name"];
 }
 catch(Exception $e){
  wLog("error:".$mname.$e->getMessage());
  echo "err:".$e->getMessage();
 }
}


//------------------------------------------//
//2.ファイルの文字コードをUTF-8へ変換
//------------------------------------------//
function impConvertUTF($filename){
 $mname="impConvertUTF(import.function.php) ";
 try{
  setlocale(LC_ALL,"ja_JP.UTF-8");
  $detect_order="ASCII,JIS,UTF-8,CP51932,SJIS-win";

  $c=$mname."ファイル名読み込み。".$tmp_name;wLog($c);
  $buffer=file_get_contents($filename);
  if(! $encoding=mb_detect_encoding($buffer,$detect_order,true)){
   unset($buffer);
   throw new Exception("文字コード変換失敗。");
  }

  $c=$mname."ファイルの文字コードをUTF-8に変更。".$filename;wLog($c);
  file_put_contents($filename,mb_convert_encoding($buffer,"UTF-8",$encoding));
  unset($buffer);
  return true;
 }
 catch(Exception $e){
  wLog("error:".$mname.$e->getMessage());
  echo "err:".$e->getMessage();
 }
}

//------------------------------------------//
//3.CSVファイルを配列にして返す
//------------------------------------------//
function impCsv2Ary($filename){
 $mname="impCsv2Ary(import.function.php) ";
 try{
  $c="start ".$mname;wLog($c);
  $fp=fopen($filename,"rb");
  $c=$mname."行ごとに配列へ格納";wLog($c);
  $csv=array();
  while($row=fgetcsv($fp)){
   //空行はスキップｗ!
   if($row===array(null)){
    $c=$mname."空行のため、処理をスキップ";wLog($c);
    continue;
   }
   $csv[]=$row;
  }

  //読み込み終了後エンドポイントになっていなければエラー
  if(!feof($fp)){
   $c=$mname."読み込み終了後エンドポイントになっていない";wLog($c);
   throw new Exception("CSV変換エラー");
  }
  fclose($fp);
  $c="end ".$mname;wLog($c);
  echo "CSV変更完了<br>";
  return $csv;
 }
 catch(Exception $e){
  wLog("error:".$mname.$e->getMessage());
  echo "err:".$e->getMessage();
 }
}

//-------------------------------------------------//
// 4.CSV配列をSQL配列へ変換して返す
//-------------------------------------------------//
function impCsv2SQL($tablename,$csv){
 global $TABLES;
 global $CSVCOL;
 $mname="impCsv2SQL(import.function.php) ";
 try{
  $c="start ".$mname;wLog($c);
//テーブル存在確認
  if(!isset($TABLES[$tablename])){
   throw new exception("テーブル定義が登録されていません".$tablename);
  }
  
//CSVデータ確認
  if(! isset($csv)){
   throw new exception("CSVデータがありません");
  }
  
//CSV列をコンバート
  $colnum=impCvrtTable($tablename);

//where句対象列を配列にセット
  foreach($colnum as $key=>$val){
   if($TABLES[$tablename][$val]["index"]){
    $c=$mname."where句に".$val."をセット";
    $wherecol[$key]=$val;
   }
  }
  
//CSV読み込み
  $sql=array();
  foreach($csv as $rows=>$row){
   $col=array();
//データを列名=>値にセット
   foreach($row as $n=>$val){
    if(! $colnum[$n]) continue;
    $c=$mname."データ更新列".$colnum[$n]."に".$val."をセット";wLog($c);
    $col[$colnum[$n]]=$val;
   }//foreach

//where句を列名=>値にセット
   foreach($wherecol as $n=>$colname){
    $c=$mname."where句に".$colname."=".$row[$n]."をセット";wLog($c);
    $where[$colname]=$row[$n];
   }
//配列に格納
   $sql[]=array( "col"=>$col
                ,"from"=>TABLE_PREFIX.$tablename
                ,"where"=>$where
               );
  }//foreach
  $c="end ".$mname;wLog($c);
  echo "SQL変換完了<br>";
  return $sql;
 }
 catch(exception $e){
  $c="error:".$mname.$e->getMessage();wLog($c);
  echo $c;
 }
}

//-------------------------------------------------//
// 4-1.CSVをテーブル用にコンバート
// (テーブル名がわかっている場合に使用)
//-------------------------------------------------//
function impCvrtTable($tablename){
 global $TABLES;
 $mname="impCvrtTable2(import.function.php)";
 try{
  $c="start ".$mname;wLog($c);
  foreach($TABLES[$tablename] as $colname=>$val){
   $ary[]=$colname;
  }
  $c="end ".$mname;wLog($c);
  return $ary;
 }
 catch(Exception $e){
  $c="error:".$mname.$e->getMessage();wLog($c);
  echo $c;
 }
}

?>
