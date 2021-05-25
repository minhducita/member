<?php 

if( $_SERVER["SERVER_PORT"] != 443 ) {
    header( "location:" . "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
    exit;
}


require_once ('include/mem_function.php');

mb_language("Japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set("Asia/Tokyo");


require_once '../include/header.php';

$header_obj = new Header();

$header_obj->title_page='メンバー登録';
$header_obj->description_page='メンバー登録：オーストラリア・ニュージーランド・カナダを初めとしたワーキングホリデー（ワーホリ）協定国の最新のビザ取得方法や渡航情報などを発信しています。';
$header_obj->keywords_page='ワーキングホリデー,ワーホリ,オーストラリア,ニュージーランド,カナダ,カナダ,韓国,フランス,ドイツ,イギリス,アイルランド,デンマーク,台湾,香港,ビザ,取得,方法,申請,手続き,渡航,外務省,厚生労働省,最新,ニュース,大使館';

$header_obj->mobileredirect=@$redirection;

$header_obj->temporary_parameter = true;

$header_obj->add_css_files='<link id="calendar_style" href="/mem2/css/simple.css" media="screen" rel="Stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"  href="/mem2/css/conbini_logo.css" />
<link rel="stylesheet" type="text/css"  href="/mem2/css/memberscript.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/mem2/css/screen.css" />
';
$header_obj->add_js_files='<script src="/mem2/js/prototype.js" type="text/javascript"></script>
<script src="/mem2/js/jquery.js" type="text/javascript"></script>
<script src="/mem2/js/ajaxzip2/ajaxzip2.js" charset="UTF-8"></script>
<script src="/mem2/js/effects.js" type="text/javascript"></script>
<script src="/mem2/js/protocalendar.js" type="text/javascript"></script>
<script src="/mem2/js/lang_ja.js" type="text/javascript"></script>
<script src="/mem2/js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
</script>';

$header_obj->add_js_files .='
<script>
jQuery(function(){
     jQuery(".focus").focus(function(){
          if(this.getAttribute("pre") == "1"){
        this.setAttribute("pre","0")
        jQuery(this).val("").css("color","#000000");
          }
     });
     jQuery(".tooltip img").hover(function() {
        jQuery(this).next("div").animate({opacity: "show", top: "0"}, "fast");}, function() {
               jQuery(this).next("div").animate({opacity: "hide", top: "0"}, "fast");
     });
});
function fncClearFields()	{
    var obj = document.getElementsByClassName("focus");
    for (idx=0; idx<obj.length; idx++)	{
        if (obj[idx].getAttribute("pre") == "1")	{
            obj[idx].value = "";
        }
    }
}
</script>
';
$header_obj->fncMenuHead_imghtml = '<img id="top-mainimg" src="../images/mainimg/mem-topbanner.jpg" alt="" width="970" height="170" />';
$header_obj->fncMenuHead_h1text = '日本ワーキングホリデー協会にメンバー登録しよう！！';
$header_obj->fncMenuHead_link = 'nolink';
$header_obj->fncMenubar_function = false;

$header_obj->display_header();


?>

<div width="auto" >


<h1 id="renewal" style="font-size:xx-large;text-align:center">
現在メンバー登録ページはメンテナンス中です。<br>
<img src="./images/ばむ工事ver3.png" height="500px"> 
</h1>

</div
<?php    fncMenuFooter('nolink'); ?>
