<?php
	include "./inc_menu.php";
	include "./inc_dbopen.php";
?>
<h2>ユーザー管理</h2>

<?php

	$dat_msg = @$_POST['msg'];

	if ($dat_act == 'push' || $dat_act == 'send' || $dat_act == 'msg')	{
		echo '<div class="area1">';
		echo '■メッセージ送信<br/>';
		$cnt = 0;
		$query = "SELECT * FROM m_user WHERE id = ".$dat_id;
		if ($result = mysqli_query($link, $query)) {
			foreach ($result as $row) {
				$cnt++;
				$line_user = $row['line_user'];
				switch($row['friend'])	{
					case 1:
						$status = '○友達';
						break;
					case 9:
						$status = '×ブロック';
						break;
					default:
						$status = '[[不明]]';
				}
				echo '<form action="./user.php?act=push&id='.$dat_id.'" method="post">';
				echo '状態 ['.$status.']　　お客様番号 ['.$row['k_no'].']<br/>';
				echo 'メッセージ：<input type=text size="60" name="msg" value="'.$dat_msg.'" /><br/>';
				echo '<input type=submit value="送信" onclick="return(confirm(\'メッセージを送信しますか？\'));"/>';
				echo '</form>';
			}
		}
		echo '</div>';
	}

	if ($dat_act == 'push')	{
		$reply_token = '';
		// T_MSG 追加
		$ins_t_msg  = "INSERT t_msg ( mtype, mstatus, msg, msg_type, line_type, reply_token, line_user, ins_date, upd_date )";
		$ins_t_msg .= " values ( ";
		$ins_t_msg .= " 'send'";
		$ins_t_msg .= " ,1";
		$ins_t_msg .= " ,'$dat_msg'";
		$ins_t_msg .= " ,'text'";
		$ins_t_msg .= " ,'message'";
		$ins_t_msg .= " ,'$reply_token'";
		$ins_t_msg .= " ,'$line_user'";
		$ins_t_msg .= " ,'".date("Y-m-d h:i:s")."'";
		$ins_t_msg .= " ,'".date("Y-m-d h:i:s")."'";
		$ins_t_msg .= " ) ";
		if (!mysqli_query($link, $ins_t_msg)) {
	        error_log('Sql error : ' . $ins_t_msg);
		}
		echo '<div class="area2">';
		echo '送信準備完了 '.date("Y-m-d h:i:s").'<br/>['.$dat_msg.']<br/>';
		echo '</div>';
	}

	if ($dat_act == 'msg')	{
		echo '<div class="area1">';
		echo '■メッセージ履歴<br/>';
		$cnt = 0;
		$query = "SELECT * FROM t_msg WHERE line_user = '".$line_user."' and mstatus = 2 and line_type = 'message' ";
		if ($result = mysqli_query($link, $query)) {
			foreach ($result as $row) {
				$cnt++;
				$mtype = $row['mtype'];
				$dotime = $row['ins_date'];
				$msg = $row['msg'];
				echo '<div class="'.$mtype.'">'.$dotime.'<br/>'.$msg.'</div>';
			}
		}
		echo '</div>';
	}

?>

<div class="area1">
■ユーザ一覧<br/>
<?php

	$cnt = 0;
	$query = "SELECT * FROM m_user WHERE status = 1 ORDER BY id";
	if ($result = mysqli_query($link, $query)) {
		echo '<table border="1">';
		echo '<tr>';
		echo '<th>状態</th>';
		echo '<th>アクション</th>';
		echo '<th>お客様番号</th>';
		echo '<th>KEY NAME</th>';
		echo '<th>KEY TEL</th>';
		echo '<th>KEY EMAIL</th>';
		echo '<th>友達日</th>';
		echo '<th>ブロック日</th>';
//		echo '<th>LINE</th>';
		echo '</tr>';
		foreach ($result as $row) {
			$cnt++;

			echo "<tr>";
			switch($row['friend'])	{
				case 1:
					$status = '○友達';
					break;
				case 9:
					$status = '×ブロック';
					break;
				default:
					$status = '[[不明]]';
			}
			$k_no = $row['k_no'];
			if ($k_no == '')	{
				$k_no = '未登録';
			}

			echo '<td>'.$status.'</td>';
			echo '<td>';
			echo '<a class="btn" href="./user.php?act=send&id='.$row['id'].'">SEND</a>';
			echo '<a class="btn" href="./user.php?act=msg&id='.$row['id'].'">MESSAGE</a>';
			echo '</td>';
			echo '<td>'.$k_no.'</td>';
			echo '<td>'.$row['key_name'].'</td>';
			echo '<td>'.$row['key_tel'].'</td>';
			echo '<td>'.$row['key_email'].'</td>';
			echo '<td>'.$row['follow_date'].'</td>';
			echo '<td>'.$row['unfollow_date'].'</td>';
//			echo '<td>'.$row['line_user'].'</td>';
			echo '</tr>';

		}
		echo '</table>';
	}

?>
</div>
<?php
	include "./inc_dbclose.php";
	include "./inc_footer.php";
?>
