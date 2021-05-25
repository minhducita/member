<!DOCTYPE html>
<head><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>キャンペーンエントリー | 日本ワーキング・ホリデー協会</title>
<meta name="keywords" content="オーストラリア,ニュージーランド,カナダ,カナダ,韓国,フランス,ドイツ,イギリス,アイルランド,デンマーク,台湾,香港,ビザ,取得,方法,申請,手続き,渡航,外務省,厚生労働省,最新,ニュース,大使館" />
<meta name="description" content="オーストラリア・ニュージーランド・カナダを初めとしたワーキングホリデー（ワーホリ）協定国の最新のビザ取得方法や渡航情報などを発信しています。" />
<meta name="author" content="Japan Association for Working Holiday Makers" />
<meta name="dcterms.rightsHolder" content="Japan Association for Working Holiday Makers" />
<link href="mailto:info@jawhm.or.jp" rel="help" title="Information contact"  />
<link rel="Author" href="mailto:info@jawhm.or.jp" title="E-mail address" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="index" href="https://www.jawhm.or.jp/index.html"  type="text/html" title="日本ワーキングホリデー協会" />
<link href="https://www.jawhm.or.jp/css/menu_mobile.css" rel="stylesheet" type="text/css" />
<link href="https://www.jawhm.or.jp/css/base_mobile.css" rel="stylesheet" type="text/css" />
<link href="https://www.jawhm.or.jp/css/system_mobile.css" rel="stylesheet" type="text/css" />
<script src="https://www.jawhm.or.jp/js/jquery.js" type="text/javascript"></script>
<script src="https://www.jawhm.or.jp/js/iscroll.js?v=20190718" type="text/javascript"></script>
<script src="https://www.jawhm.or.jp/js/jquery_ready.js" type="text/javascript"></script>
<link href="https://www.jawhm.or.jp/css/base_mobile_extra.css" rel="stylesheet" type="text/css" />
<script src="https://www.jawhm.or.jp/js/mobile-script.js?version=20180719" type="text/javascript"></script><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KKVVF9Q');</script> 
<link rel="stylesheet" href="https://www.jawhm.or.jp/calendar_module/css/cal_module.css" />
<!--[if lte IE 8 ]>
    <link rel="stylesheet" href="https://www.jawhm.or.jp/calendar_module/css/cal_module_ie.css" />
<![endif]-->
<link rel="stylesheet" href="https://www.jawhm.or.jp/calendar_module/css/cal_module_mobile.css" />
</head>
<script>
function fnccho(obj)	{
	document.entry.choosen_index.value = (obj.selectedIndex);
	document.entry.choosen_text.value = document.entry.choosen[obj.selectedIndex].text;
}
function fncsubmit()	{
	if (document.entry.choosen.selectedIndex == 0)	{
		alert('選択してください');
	}else{
		document.entry.submit();
	}
}
</script>
<body>

<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-KKVVF9Q' height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>

<div id="contentsbox-new">
<div id="wrap-box-new">
<div id="contents-new">
<div id="switch-btn-new"></div>
<div id="header-box-new">
<h1 id="header" class="header-new">
<a href="https://www.jawhm.or.jp/"><img src="https://www.jawhm.or.jp/images/mobile/mobile-new-header.gif" class="responsive-img"></a>
</h1>
</div>
<?php

ini_set( 'display_errors', 1 );
date_default_timezone_set('Asia/Tokyo');
include "../../lineapi/inc_dbopen_jawhm.php";


	$arr = explode("/", @$_SERVER['REQUEST_URI']);

	$dat_act	= @$_POST['act'];
	$dat_entry_cd	= @$_POST['entry_cd'];
	if ($dat_entry_cd == '')	{
		$dat_entry_cd	= $arr[3];
	}

	$dat_choosen		= @$_POST['choosen'];
	$dat_choosen_index	= @$_POST['choosen_index'];
	$dat_choosen_text	= @$_POST['choosen_text'];

	$sql_entry_cd	 	= mysqli_real_escape_string($link, $dat_entry_cd);
	$sql_choosen 		= mysqli_real_escape_string($link, $dat_choosen);
	$sql_choosen_index 	= mysqli_real_escape_string($link, $dat_choosen_index);
	$sql_choosen_text 	= mysqli_real_escape_string($link, $dat_choosen_text);

	$sql_choosen		= mb_ereg_replace('“', '', $sql_choosen);
	$sql_choosen		= mb_ereg_replace('”', '', $sql_choosen);

	$status 	= '';
	$campaign_id 	= '';
	$campaign_name 	= '';
	$expire_date 	= '';
	$line_user 	= '';

	// キャンペーンデータ読込
	$query  = "";
	$query .= "SELECT ";
	$query .= "  t_entry_campaign.*";
	$query .= " ,m_campaign.choose";
	$query .= " FROM t_entry_campaign, m_campaign";
	$query .= " WHERE ";
	$query .= "  entry_cd = '".$sql_entry_cd."'";
	$query .= " AND t_entry_campaign.campaign_id = m_campaign.id";
	$query .= "";
	if ($result = mysqli_query($link, $query)) {
		foreach ($result as $row) {
			$status = $row['status'];
			$campaign_id = $row['campaign_id'];
			$campaign_name = $row['campaign_name'];
			$expire_date = $row['expire_date'];
			$line_user = $row['line_user'];
			$choose = $row['choose'];
		}
	}


	$html = '';

	if ($dat_act == '' && $expire_date < date("Y-m-d H:i:s"))	{
$html = '
<div class="text06">
	<span>正しい情報が確認できません</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<span>発行されたURLは３０分を過ぎると無効となります。</span>
</div>
';
	}
	if ($dat_act == '' && $campaign_id == '')	{
$html = '
<div class="text06">
	<span>正しい情報が確認できません</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<span>URLをコピペした場合は、途中でURLが切れていないかご確認ください。</span>
</div>
';
	}
	if ($dat_act == '' && $status <> 0)	{
$html = '
<div class="text06">
	<span>既にエントリー済みのキャンペーンです。</span>
</div>
';
	}


	if ($html == '')	{

		if ($dat_act == 'upd'	)	{

			// t_entry_campaign更新
			$upd_t_entry_campaign  = "UPDATE t_entry_campaign SET ";
			$upd_t_entry_campaign .= "  status = 1";
			$upd_t_entry_campaign .= " ,choosen_campaign = '$sql_choosen'";
			$upd_t_entry_campaign .= " ,choosen_no = '$sql_choosen_index'";
			$upd_t_entry_campaign .= " ,choosen_text = '$sql_choosen_text'";
			$upd_t_entry_campaign .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
			$upd_t_entry_campaign .= " WHERE entry_cd = '$sql_entry_cd'";
			if (!mysqli_query($link, $upd_t_entry_campaign)) {
			    error_log('Sql error : ' . $upd_t_entry_campaign);
			}

			// t_msg追加
			$msg  = "";
			$msg .= "「".$campaign_name."」に「".$dat_choosen_text."」でエントリーしました。".chr(13);
			$msg .= "結果を楽しみにお待ちください。ありがとうございました。";

			$ins_t_msg  = "INSERT t_msg ( mtype, mstatus, msg, msg_type, line_type, reply_token, line_user, ins_date, upd_date )";
			$ins_t_msg .= " values ( ";
			$ins_t_msg .= " 'auto'";
			$ins_t_msg .= " ,1";
			$ins_t_msg .= " ,'$msg'";
			$ins_t_msg .= " ,'text'";
			$ins_t_msg .= " ,'message'";
			$ins_t_msg .= " ,''";
			$ins_t_msg .= " ,'$line_user'";
			$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
			$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
			$ins_t_msg .= " ) ";
			if (!mysqli_query($link, $ins_t_msg)) {
			        error_log('Sql error : ' . $ins_t_msg);
			}

$html = '
<div class="text06">
	<span>「'.$campaign_name.'」に<br/>「'.$dat_choosen_text.'」で<br/>エントリーしました。</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<span>ありがとうございました。</span>
</div>
';

		}else{

$html = '
<form method="post" action="./" name="entry">
<div class="text06">
	<span>'.$campaign_name.'<br/>&nbsp;<br/>以下からご選択の上、エントリーをお願いします。</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<center>
		<table>
<select id="choosen" name="choosen" onchange="fnccho(this);">
<option value=“選択してください”>(*) 選択してください</option>
'.$choose.'
</select>
		</table>
	</center>
</div>
&nbsp;<br/>
<div class="btn-backhome" onclick="fncsubmit();"><a href="#" onclick="fncsubmit();">エントリー</a></div>
<input type="hidden" name="choosen_index" value="upd" />
<input type="hidden" name="choosen_text" value="upd" />
<input type="hidden" name="act" value="upd" />
<input type="hidden" name="entry_cd" value="'.$dat_entry_cd.'" />
</form>
';

		}
	}

?>

<style>
input,select {
	font-size: 120%;
}
</style>

	<div id="maincontent">
		<div class="content404">
			<div class="text06">
				&nbsp;<br/>
				<span>キャンペーンエントリー</span>
			</div>
			<img src="https://www.jawhm.or.jp/images/mobile/bamukun_jawhm.png" width="12%" alt="icon">
			<?php echo $html; ?>
		</div>
	</div><!--maincontentEND-->
	&nbsp;<br/>
	&nbsp;<br/>

</div><!--contentsEND-->
</div><!--contentsboxEND-->
</div>

<div id="footer-mobile-new">

<dl id="footer-mobile-new-menu">
<dt><span>個人情報の取り扱い等</span></dt>
<dd>
<ul>
<li><a target="_blank" href="https://www.jawhm.or.jp/privacy.html">個人情報の取り扱い</a></li>
<li><a target="_blank" href="https://www.jawhm.or.jp/about.html#deal">特定商取引に関する表記</a></li>
</ul>
</dd>

<dt><span>国内オフィスのご案内</span></dt>
<dd>
<ul>
<li><a target="_blank" href="https://www.jawhm.or.jp/office/tokyo/">東京オフィス</a></li>
<li><a target="_blank" href="https://www.jawhm.or.jp/office/osaka/">大阪オフィス</a></li>
<li><a target="_blank" href="https://www.jawhm.or.jp/office/nagoya/">名古屋オフィス</a></li>
<li><a target="_blank" href="https://www.jawhm.or.jp/office/fukuoka/">福岡オフィス / カフェバーマンリー</a></li>
<li><a target="_blank" href="https://www.jawhm.or.jp/office/okinawa/">沖縄オフィス</a></li>
<li><a target="_blank" href="https://www.jawhm.or.jp/office/kumamoto/">熊本オフィス</a></li>
</ul>
</dd>
</dl>

<div id="footer-copyright-new" style="text-align: center;">
<div class="social-box">

</div>
<div style="margin-top:0px; margin-bottom:8px; color:white; font-size:10pt;">
<a href="https://www.jawhm.or.jp">日本ワーキングホリデー協会は、みなさまのワーキングホリデー（ワーホリ）と留学を全力で応援します</a>
</div>
Copyright© JAPAN Association for Working Holiday Makers All right reserved.
</div>
</div>

<script>
fnccho(document.entry.choosen);
</script>

</body>
</html>
<?php

include "../../lineapi/message-center/inc_dbclose.php";


?>