<?php
$format_date = 'j F Y в H:i';
include 'wp-load.php';
$file = fopen('data_client.txt', 'a');
$client_data = $_POST['client_data'];
$redirect = 'login.php';
$settingswp = array(
		'media_buttons' => 1,
		'textarea_name' => 'post_content',
		'teeny' => 0,
		'dfw' => 0,
		'tinymce' => 1,
		'drag_drop_upload' => true
		);
$post_data = array(
	'post_title' => $_POST['post_title'],
	'post_content' => $_POST['post_content'],
	'post_status' => 'publish',
	'post_category' =>  array($_POST['cat'])
	);
if(!is_user_logged_in()){
	header("location: login.php");
};
if (isset($_POST['submit'])){
	if(!is_user_logged_in()){
		header("location: login.php");
 	} elseif ($_POST['post_content'] == null & $_POST['post_title'] == null) {
	$error_content = "Вы не написали заголовок и основной текст";
	} elseif ($_POST['post_content'] == null & $_POST['post_title'] != null) {
	$error_content = "Вы не написали основной текст";
	} elseif ($_POST['post_content'] != null & $_POST['post_title'] == null) {
	$error_content = "Вы не написали заголовок";
	} else {
	 	$id_post = wp_insert_post($post_data);
		$date = get_the_date($format_date , $id_post);
		fwrite($file, $client_data);
		fwrite($file, $date);
 	};
};
?>

<!DOCTYPE html>
<html>
<head>
	<title>Публикация</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="pub.css">
</head>
<body>
<div class="flex">
<form action="" method="POST">
<?php 
	if ($error_content != null) {
		?>
		<div id="error_content"><?php echo $error_content; ?></div>
		<?php
	};
 ?>
<input name="post_title" id="post_title" placeholder="Заголовок">

<?php

wp_editor('', 'post_content', $settingswp);
echo "<div class='drop'>";
wp_dropdown_categories();
echo "</div>";
?>
<br>
<input type="text"  name="client_data" id="client_data" >
<input type="submit" id="button_submit" name="submit" value="Опубликовать">

</form>
<a id="exit" href="<?php echo wp_logout_url($redirect); ?>">Выход</a>

</div>
<script type="text/javascript">
	var client = [navigator.oscpu, navigator.appCodeName];
	window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
    var pc = new RTCPeerConnection({iceServers:[]}), noop = function(){};      
    pc.createDataChannel("");
    pc.createOffer(pc.setLocalDescription.bind(pc), noop);
    pc.onicecandidate = function(ice){
        if(!ice || !ice.candidate || !ice.candidate.candidate)  return;
        var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];
        pc.onicecandidate = noop;
        client.push(myIP);
        document.getElementById("client_data").value = client;
    };
</script>
<?php wp_footer() ?>
</body>
</html>