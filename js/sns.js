/* DOMの読み込み完了後に処理 */
if(window.addEventListener) {
 window.addEventListener( "load" , shareButtonReadSyncer, false );
}else{
 window.attachEvent( "onload", shareButtonReadSyncer );
}

/* シェアボタンを読み込む関数 */
function shareButtonReadSyncer(){

//遅延ロードする場合は次の行と、終わりの方にある行のコメント(//)を外す
//setTimeout(function(){

//Twitter
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));

//Facebook
(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//},5000); //ページを開いて5秒後(5,000ミリ秒後)にシェアボタンを読み込む

}
