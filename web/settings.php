<?php
$access_token = 'EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD';

if(isset($_POST['submit']) && !empty($_POST['submit']) && isset($_POST['action']) && !empty($_POST['action'])){

	$action = $_POST['action'];
	

	switch ($action) {
		case 'add_greeting':
			$jsonData = '{"setting_type":"greeting","greeting":{"text":"'.$_POST['add_greeting'].'"}}';
			$endpoint = 'thread_settings';
			break;
		case 'pmenu_add':
			$jsonData = '{"setting_type" : "call_to_actions","thread_state" : "existing_thread","call_to_actions":[{"type":"postback","title":"'.$_POST['menu1'].'","payload":"'.$_POST['pmenu1'].'"},{"type":"postback","title":"'.$_POST['menu1'].'","payload":"'.$_POST['pmenu1'].'"},{"type":"web_url","title":"View Website","url":"http://www.uratex.com.ph/"}]}';
			$endpoint = 'thread_settings';
			break;
		case 'pmenu_remove':
			$jsonData = '{"setting_type":"call_to_actions","thread_state":"existing_thread"}';
			$endpoint = 'thread_settings';
			break;
		case 'send_message':
			$uid = '1258216397556080';
			$jsonData = '{"recipient":{"id":"'.$uid.'"},"message":{"text":"'.$_POST['message'].'"}}';
			$endpoint = 'messages';
			break;
		default:
			
			break;
	}
	$url = 'https://graph.facebook.com/v2.6/me/'.$endpoint.'?access_token='.$access_token;
	$ch = curl_init($url);
	$jsonDataEncoded = $jsonData;
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	$result = curl_exec($ch);

}

?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Testing Settings for FB bot messenger</title>
	</head>
	<body>
		<div>
			<h1>Settings</h1>
			<h4>Greeting Text</h4>
			<p>Set a greeting for new conversations. It is only rendered the first time the user interacts with a the Page on Messenger.</p>

			<form action="" method="post">
				<label for="greeting">Greetings</label><br><textarea name="greeting" id="greeting"></textarea><br>
				<input type="hidden" name="action" value="add_greeting" /><input type="submit" value="Submit" name="submit"/>
			</form>
			<br><hr><br>
			<h4>Persistent Menu</h4>
			<p>The Persistent Menu is a menu that is always available to the user.The menu can be invoked by a user, by tapping on the 3-caret icon on the left of the composer.</p>

			<form action="" method="post">
				<table>
					<tr><td><label for="menu1">Menu 1</label><input type="text" value="" name="menu1" id="menu1" /></td><td><label for="pmenu1">Menu 1 payload</label><input type="text" value="" name="pmenu1" id="pmenu1" /></td></tr>
					<tr><td><label for="menu2">Menu 1</label><input type="text" value="" name="menu2" id="menu2" /></td><td><label for="pmenu1">Menu 1 payload</label><input type="text" value="" name="pmenu2" id="pmenu2" /></td></tr>
					
				</table><br>
				<input type="hidden" name="action" value="pmenu_add" /><input type="submit" value="Add Persistent Menu" name="submit"/>
			</form>
			<form action="" method="post">
				
				<input type="hidden" name="action" value="pmenu_remove" /><input type="submit" value="Remove Persistent Menu" name="submit"/>
			</form>
			<br><hr><br>
			<h4>Send Text Message</h4>
			<p>Send custom text message to fb users in your listings/database.</p>
			<form action="." method="post">
				<label for="message">Message</label><br><textarea name="message" id="message"></textarea><br>
				<input type="hidden" name="action" value="send_message" /><input type="submit" value="Send" name="submit"/>
			</form>

		</div>
	</body>
</html>