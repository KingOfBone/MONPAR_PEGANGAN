<?php
if($_POST['submit']) {
	$nosurat = strip_tags($_POST[nosurat]);
    $perihal = strip_tags($_POST[perihal]);
	$email = strip_tags($_POST[email]);
	$subject = strip_tags($_POST[subject]);
	$file1_path = $_FILES['file_att']['tmp_name'];
	$file1_name = $_FILES['file_att']['name'];
	$file1_type = $_FILES['file_att']['type'];
	$file1_size = $_FILES['file_att']['size'];
	// cek file
	if($file1_size > 0) {
		if($file1_size <= $max_file) {
			require_once ('smtpmail/mail_setup/mail.php');
			$mail->From     = $email_pengirim; // email pengirim
			$mail->FromName = $nama_pengirim; // nama pengirim
			$mail->AddAddress($email ); // penerima
			$mail->AddReplyTo($email_pengirim); // kirim balik reply ke
			$mail->WordWrap = 50; // set word wrap
			$mail->AddAttachment($file1_path, $file1_name);
			$mail->IsHTML(false);                               // send as HTML
			$mail->Subject   =  $subject;
			$mail->Body     .=  "No Surat: $nosurat\n";
			$mail->Body     .=  "Perihal: $perihal\n";
			$mail->Body     .=  "\n\n";
			$mail->Body     .=  "----------\n";
			$mail->Body     .=  $set_web_title."\n";
			$mail->Body     .=  $web."\n";
			if(!$mail->Send()) {
				$error = 1;
				echo "<script>alert('Sorry, Mail Sent Error..., please try again.');</script>";
			} else {
				// EMAIL sukses terkirim
				$email_success = "<div class=\"good\">Email Sent Sucessfull.<br/>Thank You.</div>";
				$form = 0;
			}
		} else {
			$error = 1;
			echo "<script>alert('File terlalu besar! (Max. ".format_size($max_file).")');</script>";
			$error_cv = "<br/><span class=\"warning\">File terlalu besar, (Max. ".format_size($max_file).")</span>";
		}
	} else {
		$error = 1;
		$error_cv = "<br/><span class=\"warning\">File Kosong!</span>";
		echo "<script>alert('File Kosong!');</script>";
	}
}

?>