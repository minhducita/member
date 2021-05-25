<!DOCTYPE html>
<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

ini_set( 'display_errors', 1 );
date_default_timezone_set('Asia/Tokyo');
include "../../lineapi/inc_dbopen_jawhm.php";

require "/home/ec2-user/vendor/autoload.php";
use Aws\Sns\SnsClient; 
use Aws\Exception\AwsException;

?>
<head><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ガイドブック | 日本ワーキング・ホリデー協会</title>
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
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
function fncsubmit()	{
	if (document.entry.key_name.value == "")	{
		alert('お名前を入力してください。');
		return false;
	}
	if (document.entry.key_tel.value == "") 	{
		alert('携帯番号を入力してください。');
		return false;
	}
	if (document.entry.key_tel.value != '')	{
		var tel = document.entry.key_tel.value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi,"");
		if (!tel.match(/^0[6789]0[0-9]{8}$/)) {
			alert('携帯電話の番号を入力してください');
			return false;
		}
	}
	document.entry.submit();
}
function fncsubmit2()	{
	document.send.submit();
}
function fncsubmit3()	{
	if (document.check.key_code.value == "")	{
		alert('確認コードを入力してください。');
		return false;
	}
	document.check.submit();
}
function fncsubmit4()	{
	if (document.address.key_postcd.value == "")	{
		alert('郵便番号を入力してください。');
		return false;
	}
	if (document.address.key_add1.value == "")	{
		alert('住所を入力してください。');
		return false;
	}
	document.address.submit();
}
function fncsubmit5()	{
	document.finalcheck.submit();
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

function getOneTimePWD($nLengthRequired = 6) {
    $sCharList = "0123456789";
    mt_srand();
    $sRes = "";
    for ($i = 0; $i < $nLengthRequired; $i++)
        $sRes .= $sCharList{mt_rand(0, strlen($sCharList) - 1)};
    return $sRes;
}
function wbsRequest($url, $params) {
	$data = http_build_query($params);
	$arrContextOptions = array(
		"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
		),
	);
	$content = file_get_contents($url . '?' . $data, false, stream_context_create($arrContextOptions));
	return $content;
}


	$arr = explode("/", @$_SERVER['REQUEST_URI']);

	$dat_act	= @$_POST['act'];
	$dat_entry_cd	= @$_POST['entry_cd'];
	if ($dat_entry_cd == '')	{
		$dat_entry_cd	= $arr[3];
	}

	$dat_key_name	= @$_POST['key_name'];
	$dat_key_tel	= @$_POST['key_tel'];
	$dat_key_postcd	= @$_POST['key_postcd'];
	$dat_key_add1	= @$_POST['key_add1'];
	$dat_key_add2	= @$_POST['key_add2'];
	$dat_key_add3	= @$_POST['key_add3'];
	$dat_key_code	= @$_POST['key_code'];

	$sql_entry_cd 	= mysqli_real_escape_string($link, $dat_entry_cd);
	$sql_key_name 	= mysqli_real_escape_string($link, $dat_key_name);
	$sql_key_tel 	= mysqli_real_escape_string($link, $dat_key_tel);
	$sql_key_postcd	= mysqli_real_escape_string($link, $dat_key_postcd);
	$sql_key_add1 	= mysqli_real_escape_string($link, $dat_key_add1);
	$sql_key_add2 	= mysqli_real_escape_string($link, $dat_key_add2);
	$sql_key_add3 	= mysqli_real_escape_string($link, $dat_key_add3);

	$status 	= '';
	$expire_date 	= '';
	$line_user 	= '';
	$key_name	= '';
	$key_tel	= '';
	$key_postcd	= '';
	$key_add1	= '';
	$key_add2	= '';
	$key_add3	= '';
	$key_status 	= '';
	$chk_code	= '';
	$showmsg	= '';

	// キャンペーンデータ読込
	$query  = "";
	$query .= "SELECT ";
	$query .= "  t_entry_guidebook.*";
	$query .= " ,m_user.line_user ";
	$query .= " FROM t_entry_guidebook, m_user";
	$query .= " WHERE ";
	$query .= "  entry_cd = '".$sql_entry_cd."'";
	$query .= " AND t_entry_guidebook.line_user = m_user.line_user";
	$query .= "";
	if ($result = mysqli_query($link, $query)) {
		foreach ($result as $row) {
			$status = $row['status'];
			$expire_date = $row['expire_date'];
			$line_user = $row['line_user'];
			$key_name = $row['key_name'];
			$key_tel = $row['key_tel'];
			$key_postcd = $row['key_postcd'];
			$key_add1 = $row['key_add1'];
			$key_add2 = $row['key_add2'];
			$key_add3 = $row['key_add3'];
			$key_status = $row['key_status'];
			$chk_code = $row['chk_code'];
			$k_no = $row['k_no'];
		}
		if ($dat_key_name == '')	{
			$dat_key_name	= $key_name;
			$dat_key_tel	= $key_tel;
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
	if ($dat_act == '' && $status == '')	{
$html = '
<div class="text06">
	<span>正しい情報が確認できません</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<span>URLをコピペした場合は、途中でURLが切れていないかご確認ください。</span>
</div>
';
	}
	if ($dat_act == '' && $status <> '0')	{
$html = '
<div class="text06">
	<span>既にご登録いただいております。</span>
</div>
';
	}


	if ($html == '')	{

		if ($dat_act == 'upd'	)	{

			// t_entry_guidebook更新
			$upd_t_entry_guidebook  = "UPDATE t_entry_guidebook SET ";
			$upd_t_entry_guidebook .= "  key_status = 1";
			$upd_t_entry_guidebook .= " ,key_name = '$sql_key_name'";
			$upd_t_entry_guidebook .= " ,key_tel = '$sql_key_tel'";
			$upd_t_entry_guidebook .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
			$upd_t_entry_guidebook .= " WHERE entry_cd = '$sql_entry_cd'";
			if (!mysqli_query($link, $upd_t_entry_guidebook)) {
			    error_log('Sql error : ' . $upd_t_entry_guidebook);
			}

			// CRMを確認
		        $data = array(
		            'pwd' => '303pittST'
		            , 'act' => 'linelink'
		            , 'edit_namae' => $dat_key_name
		            , 'edit_tel' => $dat_key_tel
		            , 'edit_email' => ''
		        );

		        $url = 'https://toratoracrm.com/crm/';
		        $val = wbsRequest($url, $data);
		        $ret = json_decode($val, true);

		        $customid = '';

		        if ($ret['msg'] == 'hit')	{
		        	// 該当あり
		        	$customid = $ret['customid'];
			}

			// t_entry_guidebook更新
			$upd_t_entry_guidebook  = "UPDATE t_entry_guidebook SET ";
			$upd_t_entry_guidebook .= "  key_status = 2";
			$upd_t_entry_guidebook .= " ,k_no = '$customid'";
			$upd_t_entry_guidebook .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
			$upd_t_entry_guidebook .= " WHERE entry_cd = '$sql_entry_cd'";
			if (!mysqli_query($link, $upd_t_entry_guidebook)) {
			    error_log('Sql error : ' . $upd_t_entry_guidebook);
			}



		$customid = '';




			if ($customid == '')	{
				// NO-HITの場合は、住所登録へスキップ
				$dat_act = 'check';
				$chk_code = '123456';
				$dat_key_code = $chk_code;
			}else{

				$showmsg = '携帯番号<br/>['.$dat_key_tel.']';

$html = '
<form method="post" action="./" name="send">
<div class="text06">
	<span>ご本人様確認の為、<br/>ご入力頂きました'.$showmsg.'に、<br/>確認コードをお送りします。<br/></span>
	&nbsp;<br/>
</div>
&nbsp;<br/>
<div class="btn-backhome" onclick="fncsubmit2();"><a href="#" onclick="fncsubmit2();">確認コード送信</a></div>
<input type="hidden" name="act" value="send" />
<input type="hidden" name="entry_cd" value="'.$dat_entry_cd.'" />
</form>
';
			}

		}

		if ($dat_act == 'send')	{

			$send_code = getOneTimePWD(6);

			// t_entry_guidebook更新
			$upd_t_entry_guidebook  = "UPDATE t_entry_guidebook SET ";
			$upd_t_entry_guidebook .= "  key_status = 3";
			$upd_t_entry_guidebook .= " ,chk_code = '$send_code'";
			$upd_t_entry_guidebook .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
			$upd_t_entry_guidebook .= " WHERE entry_cd = '$sql_entry_cd'";
			if (!mysqli_query($link, $upd_t_entry_guidebook)) {
			    error_log('Sql error : ' . $upd_t_entry_guidebook);
			}

			$SnSclient = new SnsClient([
			    'credentials' => [
			        'key'    => 'AKIA45VRJ2LQYT7EOFEK',
			        'secret' => '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',
			    ],
			    'region' => 'us-east-1',
			    'version' => '2010-03-31'
			]);

			$message = '[JAWHM]確認コード：'.$send_code.chr(13).'※確認コードは３０分間有効です';
			$phone = '+81'.substr($key_tel,1);

			try {
			    $result = $SnSclient->publish([
			        'Message' => $message,
			        'PhoneNumber' => $phone,
			    ]);
var_dump($result);
			} catch (AwsException $e) {
			    error_log($e->getMessage());
			    var_dump($e->getMessage());
			}

$html = '
<form method="post" action="./" name="check">
<div class="text06">
	<span>確認コード(数字６桁)を入力してください。<br/></span>
	&nbsp;<br/>
	確認コード(*)&nbsp;<input type="tel" name="key_code" value="" / >
</div>
&nbsp;<br/>
<div class="btn-backhome" onclick="fncsubmit3();"><a href="#" onclick="fncsubmit3();">次へ</a></div>
<input type="hidden" name="act" value="check" />
<input type="hidden" name="entry_cd" value="'.$dat_entry_cd.'" />
</form>
';

		}

		if ($dat_act == 'check')	{
			if ($chk_code == $dat_key_code)	{

				// t_entry_guidebook更新
				$upd_t_entry_guidebook  = "UPDATE t_entry_guidebook SET ";
				$upd_t_entry_guidebook .= "  key_status = 4";
				$upd_t_entry_guidebook .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
				$upd_t_entry_guidebook .= " WHERE entry_cd = '$sql_entry_cd'";
				if (!mysqli_query($link, $upd_t_entry_guidebook)) {
				    error_log('Sql error : ' . $upd_t_entry_guidebook);
				}

$html = '
<form method="post" action="./" name="address">
<div class="text06">
	<span>ご送付先を入力してください</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<center>
		<table>
		<tr><td>郵便番号</td><td>
			<input type="tel" maxlength="8" id="key_postcd" name="key_postcd" value="'.$dat_key_postcd.'"
			 onKeyUp="AjaxZip3.zip2addr(this,\'\',\'key_add1\',\'key_add2\');"/ ></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>都道府県</td><td><input type="text" id="key_add1" name="key_add1" value="'.$dat_key_add1.'" / ></td></tr>
		<tr><td>市区町村</td><td><input type="text" id="key_add2" name="key_add2" value="'.$dat_key_add2.'" / ></td></tr>
		<tr><td>番地以降</td><td><input type="text" id="key_add3" name="key_add3" value="'.$dat_key_add3.'" / ></td></tr>
		<tr><td colspan="2">＊マンション名、号室のご入力もお忘れなく</td></tr>
		</table>
	</center>
</div>
&nbsp;<br/>
<div class="btn-backhome" onclick="fncsubmit4();"><a href="#" onclick="fncsubmit4();">次へ</a></div>
<input type="hidden" name="act" value="finalcheck" />
<input type="hidden" name="entry_cd" value="'.$dat_entry_cd.'" />
</form>
';


			}else{
$html = '
<form method="post" action="./" name="check">
<div class="text06">
	<span>確認コードが正しくありません。<br/></span>
	&nbsp;<br/>
	<span>もう一度、確認コード(数字６桁)を入力してください。<br/></span>
	&nbsp;<br/>
	確認コード(*)&nbsp;<input type="tel" name="key_code" value="" / >
</div>
&nbsp;<br/>
<div class="btn-backhome" onclick="fncsubmit3();"><a href="#" onclick="fncsubmit3();">次へ</a></div>
<input type="hidden" name="act" value="check" />
<input type="hidden" name="entry_cd" value="'.$dat_entry_cd.'" />
</form>
';
			}
		}

		if ($dat_act == 'finalcheck')	{

			// t_entry_guidebook更新
			$upd_t_entry_guidebook  = "UPDATE t_entry_guidebook SET ";
			$upd_t_entry_guidebook .= "  key_postcd = '$sql_key_postcd'";
			$upd_t_entry_guidebook .= " ,key_add1 = '$sql_key_add1'";
			$upd_t_entry_guidebook .= " ,key_add2 = '$sql_key_add2'";
			$upd_t_entry_guidebook .= " ,key_add3 = '$sql_key_add3'";
			$upd_t_entry_guidebook .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
			$upd_t_entry_guidebook .= " WHERE entry_cd = '$sql_entry_cd'";
			if (!mysqli_query($link, $upd_t_entry_guidebook)) {
			    error_log('Sql error : ' . $upd_t_entry_guidebook);
			}

$html = '
<form method="post" action="./" name="finalcheck">
<div class="text06">
	<span>ご送付先を確認してください</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<center>
		<table>
		<tr><td>お名前</td><td>'.$dat_key_name.'&nbsp;様</td></tr>
		<tr><td>郵便番号&nbsp;&nbsp;</td><td>'.$dat_key_postcd.'</td></tr>
		<tr><td>ご住所</td><td>'.$dat_key_add1.'</td></tr>
		<tr><td></td><td>'.$dat_key_add2.'</td></tr>
		<tr><td></td><td>'.$dat_key_add3.'</td></tr>
		</table>
	</center>
</div>
&nbsp;<br/>
<div class="btn-backhome" onclick="fncsubmit5();"><a href="#" onclick="fncsubmit5();">登録</a></div>
<input type="hidden" name="act" value="done" />
<input type="hidden" name="entry_cd" value="'.$dat_entry_cd.'" />
</form>
&nbsp;<br/>
&nbsp;<br/>
<a href="/line/guidebook/'.$sql_entry_cd.'">やり直し</a>
';
		}

		if ($dat_act == 'done')	{

			// t_entry_guidebook更新
			$upd_t_entry_guidebook  = "UPDATE t_entry_guidebook SET ";
			$upd_t_entry_guidebook .= "  key_status = 5";
			$upd_t_entry_guidebook .= " ,status = 2";
			$upd_t_entry_guidebook .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
			$upd_t_entry_guidebook .= " WHERE entry_cd = '$sql_entry_cd'";
			if (!mysqli_query($link, $upd_t_entry_guidebook)) {
			    error_log('Sql error : ' . $upd_t_entry_guidebook);
			}

			// t_msg追加
			$msg  = "";
			$msg .= "".$key_name."様".chr(13)."ガイドブック送付依頼を受け付けました。".chr(13);
			$msg .= "万が一、１～２週間経ってもお手元に届かない場合は、お手数ですが、info@jawhm.or.jpまでお問合せください。";

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
	<span>ガイドブック送付依頼を受け付けました</span>
</div>
';
		}


		if ($dat_act == '')	{

$html = '
<form method="post" action="./" name="entry">
<div class="text06">
	<span>お名前と携帯番号を入力してください</span>
	&nbsp;<br/>
	&nbsp;<br/>
	<center>
		<table>
		<tr><td>お名前(*)</td><td><input type="text" name="key_name" value="'.$dat_key_name.'" / ></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>携帯番号(*)</td><td><input type="tel" name="key_tel" value="'.$dat_key_tel.'" / ></td></tr>
		</table>
	'.$showmsg.'
	</center>
</div>
&nbsp;<br/>
<div class="btn-backhome" onclick="fncsubmit();"><a href="#" onclick="fncsubmit();">次へ</a></div>
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
				<span>ガイドブックお送り先の登録</span>
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
</script>


</body>
</html>
<?php

include "../../lineapi/message-center/inc_dbclose.php";


?>