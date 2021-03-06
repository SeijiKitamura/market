<?php
//求人募集
//引数
// strcode 店舗番号 [推奨] ない場合は1になる
// 最小引数 ?strcode=1

require_once("php/view.function.php");
require_once("php/html.function.php");

//ファイル名
$me="bosyu.php";

//店舗番号確定
if($_GET["strcode"] && preg_match("/^[0-9]+$/",$_GET["strcode"])){
 $strcode=$_GET["strcode"];
}
else{
 $strcode=1;
}


//タイトル
$title="求人について";

//ページ説明文
$description=<<<EOF
スーパーキタムラでお仕事しませんか？このページでは現在の求人情報について
ご案内しております。小売業に興味のある方を歓迎しております。特にアルバイト、
パートご希望の方はぜひこのページをご覧ください。
EOF;
htmlHeader($title,$description);
?>

  <div id="wrapper">
   <div class="col1">
<?php
echo htmlNaviBar();
?>
   </div><!--div class="col1"-->

   <div class="col1">
    <h1>求人募集</h1>
    <img class="backimage" src="img/bosyu_1.jpg" alt="アルバイト募集|スーパーキタムラ">
    <p>
     現在、以下の求人募集を行っております。キタムラで一緒にお仕事できる方、ぜひご連絡ください。
    </p>

    <h2>惣菜コーナー</h2>
    <br>

    <table class="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <tbody>
      <tr>
       <td style="text-align:center;">部門</td>
       <td>惣菜(フルタイム)</td>
      </tr>
      <tr>
       <td style="text-align:center;">時給</td>
       <td>920円</td>
      </tr>
      <tr>
       <td style="text-align:center;">時間</td>
       <td>8:00-17:45(実働８時間)</td>
      </tr>
      <tr>
       <td style="text-align:center;">休日</td>
       <td>週休２日制</td>
      </tr>
      <tr>
       <td style="text-align:center;">詳細</td>
       <td>試用期間(2週間)有り。制服一部貸与。電話連絡の上、履歴書（写真添付）をご持参ください。</td>
      </tr>
     </tbody>
    </table>

    <br>

    <table class="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <tbody>
      <tr>
       <td style="text-align:center;">部門</td>
       <td>惣菜(パートタイム)</td>
      </tr>
      <tr>
       <td style="text-align:center;">時給</td>
       <td>1000円</td>
      </tr>
      <tr>
       <td style="text-align:center;">時間</td>
       <td>8:00-13:00</td>
      </tr>
      <tr>
       <td style="text-align:center;">曜日</td>
       <td>週3-5日勤務できる方</td>
      </tr>
      <tr>
       <td style="text-align:center;">詳細</td>
       <td>試用期間(2週間)有り。制服一部貸与。電話連絡の上、履歴書（写真添付）をご持参ください。</td>
      </tr>
     </tbody>
    </table>

    <br>

    <h2>レジコーナー</h2>
    <br>

    <table class="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <tbody>
      <tr>
       <td style="text-align:center;">部門</td>
       <td>レジおよび品出し(フルタイム)</td>
      </tr>
      <tr>
       <td style="text-align:center;">時給</td>
       <td>920円</td>
      </tr>
      <tr>
       <td style="text-align:center;">時間</td>
       <td>8:00-17:45(実働８時間)</td>
      </tr>
      <tr>
       <td style="text-align:center;">休日</td>
       <td>週休２日制</td>
      </tr>
      <tr>
       <td style="text-align:center;">詳細</td>
       <td>試用期間(2週間)有り。制服一部貸与。電話連絡の上、履歴書（写真添付）をご持参ください。</td>
      </tr>
     </tbody>
    </table>

    <br>

    <table class="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <tbody>
      <tr>
       <td style="text-align:center;">部門</td>
       <td>レジ(パートタイム)</td>
      </tr>
      <tr>
       <td style="text-align:center;">時給</td>
       <td>1000円（高校生950円）</td>
      </tr>
      <tr>
       <td style="text-align:center;">時間</td>
       <td>10:00-14:00/14:00-18:00/18:00-22:00 のいずれかの時間帯</td>
      </tr>
      <tr>
       <td style="text-align:center;">曜日</td>
       <td>週3-5日勤務できる方(土日いずれか勤務)</td>
      </tr>
      <tr>
       <td style="text-align:center;">詳細</td>
       <td>試用期間(2週間)有り。制服一部貸与。電話連絡の上、履歴書（写真添付）をご持参ください。</td>
      </tr>
     </tbody>
    </table>

    <br>

    <h2>その他</h2>
    <br>

    <table class="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <tbody>
      <tr>
       <td style="text-align:center;">部門</td>
       <td>品出し(パートタイム)</td>
      </tr>
      <tr>
       <td style="text-align:center;">時給</td>
       <td>1000円</td>
      </tr>
      <tr>
       <td style="text-align:center;">時間</td>
       <td>8:30-12:30</td>
      </tr>
      <tr>
       <td style="text-align:center;">曜日</td>
       <td>週3-5日勤務できる方(土日いずれか勤務)</td>
      </tr>
      <tr>
       <td style="text-align:center;">詳細</td>
       <td>試用期間(2週間)有り。制服一部貸与。電話連絡の上、履歴書（写真添付）をご持参ください。</td>
      </tr>
     </tbody>
    </table>

    <br>

    <table class="ItemData">
     <colgroup>
      <col class="nen">
     </colgroup>
     <colgroup>
      <col class="naiyo">
     </colgroup>
     <tbody>
      <tr>
       <td style="text-align:center;">部門</td>
       <td>清掃(店内および外回り)</td>
      </tr>
      <tr>
       <td style="text-align:center;">時給</td>
       <td>910円</td>
      </tr>
      <tr>
       <td style="text-align:center;">時間</td>
       <td>7:00-12:00</td>
      </tr>
      <tr>
       <td style="text-align:center;">曜日</td>
       <td>週3-4日勤務できる方</td>
      </tr>
      <tr>
       <td style="text-align:center;">詳細</td>
       <td>試用期間(2週間)有り。制服一部貸与。電話連絡の上、履歴書（写真添付）をご持参ください。</td>
      </tr>
     </tbody>
    </table>

    <p>
メールでも連絡を承っております。<a href="contactus.php" style="color:blue">こちらのページ</a>をご確認の上、メールをご送信ください。
    </p>
   </div><!--div class="col1"-->

<?php
htmlSNSButton();
?>
   <div class="clr"></div>

   <div id="footer">
<?php
htmlFooter();
?>
   </div><!--div id="footer"-->

  </div><!--div id="wrapper"-->
 </body>
<script>
$(function(){
});
</script>
</html>



