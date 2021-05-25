<?php
    $card_payment_url = 'https://www.paydesign.jp/settle/settle3/bp3.dll';
	$card_ok_url_payment = 'https://member.jawhm.or.jp/mem2/receive_card.php?k='.$k.'&act=s4';
	$card_wrong_url_payment = 'https://member.jawhm.or.jp/mem2/receive_card.php?k='.$k.'&act=s3&email='.urlencode($dat_email).'&userid='.$dat_id.'&mailcheck='.$dat_mailcheck.'&return=true';
    $conv_payment_url = 'https://www.paydesign.jp/settle/settle3/bp3.dll';
	$conv_ok_url_payment = 'https://member.jawhm.or.jp/mem2/receive_conv.php?k='.$k.'&act=s4';
	$conv_wrong_url_payment = 'https://member.jawhm.or.jp/mem2/receive_conv.php?k='.$k.'&act=s3&email='.urlencode($dat_email).'&userid='.$dat_id.'&mailcheck='.$dat_mailcheck.'&return=true';
 ?>


<div style="padding-left:30px;">
		<p class="title_bar">
			メンバー登録料のお支払手続きをお願いします
		</p>

		<?php
            if ($msg <> '')
			{
                echo '<p class="orange_info">'.$msg.'</p>';
            }
        ?>

        &nbsp;<br/>

	<div id="div_cc">
		<p>
			メールアドレスの確認ができました。
		</p>
		<br/>
		<p>
			引き続き、登録料のお支払手続きに入ります。お支払方法を選択してください。<br/>
		</p>
		<div class="navy_frame">
			<p>
				【クレジットカードでお支払の場合】<br />
                当協会ではクレジットカードをご利用の場合、株式会社ペイデザインのシステムを利用しております。<br />
                以下の「クレジットカードでお支払の場合はこちら」のボタンをクリックして、支払手続きをお願いいたします。<br />
                <strong>クレジットカードでのお支払は SSLというシステムを利用しており、カード番号等の情報は暗号化されて送信されます。ご安心下さい。<br />
				また、ご入力頂きますクレジットカード番号、有効期限等の情報は、今回の決済にのみ利用され、当協会のシステムには保存されません。<br /></strong>

			</p>
            <div style="text-align:center;margin:15px 0 0 0;"><img src="images/creditcard_rogo.gif" ></div>

			<p style="color:red; font-weight:bold;">
				<br/>
				【ご注意】<br/>
				クレジットカードでお支払の場合、ＶＩＳＡ（ビザ）又はＭＡＳＴＥＲ（マスター）のマークがあるカードのみご利用頂けます。<br/>
			</p>
			<div>
				<form method="POST" action="<?php echo $card_payment_url?>" accept-charset="Shift_JIS" onsubmit="document.charset='SHIFT-JIS';">
					<input type="hidden" name="IP" value="A363045858" />
					<input type="hidden" name="SID" value="<?php echo $dat_sid; ?>" />
					<input type="hidden" name="N1" value="JAWHM MEMBERSHIP FEE" />
					<input type="hidden" name="K1" value="5000" />
					<input type="hidden" name="FUKA" value="<?php echo $dat_id; ?>" />
					<input type="hidden" name="KAKUTEI" value="1" />
					<input type="hidden" name="STORE" value="51">
					<input type="hidden" name="OKURL" value="<?php echo $card_ok_url_payment;?>" />
					<input type="hidden" name="RT" value="<?php echo $card_wrong_url_payment;?>" />
					<input type="hidden" name="NAME1" value="<?php echo $dat_name1; ?>" />
					<input type="hidden" name="NAME2" value="<?php echo $dat_name2; ?>" />
					<input type="hidden" name="TEL" value="<?php echo $dat_tel; ?>" />
					<input type="hidden" name="ADR1" value="<?php echo $dat_adr1; ?>" />
					<input type="hidden" name="ADR2" value="<?php echo $dat_adr2; ?>" />
					<input type="hidden" name="MAIL" value="<?php echo $dat_email; ?>" />
					<input type="submit" value="クレジットカードでお支払の場合はこちら" class="send_btn" />
				</form>
			</div>
		</div>
		<div class="navy_frame">
			<p>
				【コンビニでお支払の場合】<br />
                当協会ではコンビニ支払をご利用の場合、株式会社ペイデザインのシステムを利用しております。<br />
                以下から、<strong>お支払頂くコンビニを選択の上、「コンビニでお支払の場合はこちら」のボタンをクリックして、支払手続きをお願いいたします。</strong>
			</p>
			<p style="color:red; font-weight:bold;">
				<br/>
				【ご注意】<br/>
				決済手数料（250円）はお客様のご負担となります。（コンビニ店頭で、5,250円をお支払下さい。）<br/>
				また、コンビニ端末で、事業所名に「株式会社ペイデザイン」と表示される場合がありますが、問題ありません。<br/>
				株式会社ペイデザインは、メンバー登録料の収納代行会社の名前です。<br/><br />
			</p>
			<?php
				if (@$msg_store <> '')
				{
					echo '<p class="orange_info">'.$msg_store.'</p>';
				}
			?>

<!--
			 <form method="POST" action="payment.php" accept-charset="Shift_JIS" onsubmit="document.charset='SHIFT-JIS';">
-->
			<form method="POST" action="<?php echo $conv_payment_url?>">
				<div id="choice-conbini">
						<input type="hidden" name="IP" value="D363045858">
						<input type="hidden" name="SID" value="<?php echo $dat_sid; ?>" />
						<input type="hidden" name="NAME1" value="<?php echo $dat_name1.$dat_name2; ?>" />
						<input type="hidden" name="NAME2" value="　" />
						<input type="hidden" name="TEL" value="<?php echo $dat_tel; ?>" />
						<input type="hidden" name="ADR1" value="<?php echo $dat_adr1; ?>" />
						<input type="hidden" name="MAIL" value="<?php echo $dat_email; ?>" />
						<input type="hidden" name="FUKA" value="<?php echo $dat_id; ?>" />
						<input type="hidden" name="N1" value="日本ワーキングホリデー協会登録料" />
						<input type="hidden" name="K1" value="5250" />
						<input type="hidden" name="STORE" value="99" />
						<input type="hidden" name="OKURL" value="<?php echo $conv_ok_url_payment;?>" />
						<input type="hidden" name="RT" value="<?php echo $conv_wrong_url_payment;?>" />

<!-- 						<input class="radio" type="radio" name="STORE" id="lawson" value="1"/>
						<label  class="radio" for="lawson" id="label_lawson"></label>

						<input  class="radio" type="radio" name="STORE" id="threef" value="73" />
						<label for="threef" id="label_threef"></label>

						<input  class="radio" type="radio" name="STORE" id="circleK" value="73" />
						<label for="circleK" id="lable_circleK"></label>

						<input  class="radio" type="radio" name="STORE" id="dailyyamazaki" value="73" />
						<label for="dailyyamazaki" id="label_dailyyamazaki"></label>

						<input  class="radio"  type="radio" name="STORE" id="yamazakidaily" value="73" />
						<label for="yamazakidaily" id="label_yamazakidaily" ></label>

						<input  class="radio" type="radio" name="STORE" id="familymart" value="3" />
						<label for="familymart" id="label_familymart"></label>

						<input  class="radio" type="radio" name="STORE" id="ministop" value="1" />
						<label for="ministop" id="label_ministop"></label>

						<input  class="radio" type="radio" name="STORE" id="seicomart" value="1" />
						<label for="seicomart" id="label_seicomart"></label>

						<input  class="radio" type="radio" name="STORE" id="seven" value="2" />
						<label for="seven" id="label_seven"></label>
						<br />
 -->						<input type="hidden" name="TAX" value="454" />
						<!-- <input type="hidden" name="form" value="conv" /> -->
						<!-- <input type="hidden" name="act" value="4,5" /> -->
				</div>
				<input type="submit" value="コンビニでお支払の場合はこちら"  class="send_btn" />
			</form>


		</div>
		<div class="navy_frame">
			<p>
				【銀行振込でお支払の場合】<br/>
				銀行振込で登録料をお支払の場合、以下の口座をご利用ください。<br/>
				なお、１週間以内にお振込をお願い致します。<br/>
            </p>
            <div style="text-align:center;margin:15px 0 0 0;"><img src="images/hurikomi_rogo.gif" ></div>
            <div style="border: 2px dotted navy; margin:10px 100px 10px 30px; padding:8px 10px 8px 10px; font-size:11pt;">
                <table>
                    <tr>
                        <td>銀行名</td><td>　　：　</td><td>三井住友銀行 (0009)</td>
                    </tr>
                    <tr>
                        <td>支店名</td><td>　　：　</td><td>新宿支店 (221)</td>
                    </tr>
                    <tr>
                        <td>口座番号</td><td>　　：　</td><td>普通　4246817</td>
                    </tr>
                    <tr>
                        <td>名義人</td><td>　　：　</td><td>シャ）ニホンワーキングホリデーキョウカイ</td>
                    </tr>
                </table>
            </div>
			<p style="color:red; font-weight:bold;">
				<br/>ご注意】<br/>
				お振込手数料はお客様のご負担となります。<br/>手数料は振込方法により異なりますので、取引銀行にお問い合わせください。
			</p>
			<div>
				<form class="cmxform" id="signupForm" method="post" action="./welcome.php?k=<?php echo $k; ?>">
					<input type="hidden" name="act" value="<?php echo $act; ?>">
					<input type="hidden" name="userid" value="<?php echo $dat_id; ?>">
					<input type="hidden" name="email" value="<?php echo $dat_email; ?>">
					<input type="hidden" name="tgt" value="furikomi">
					<input  class="send_btn" type="submit" value="銀行振込でお支払の場合はこちら" />
				</form>
			</div>
		</div>
	</div>


</div>