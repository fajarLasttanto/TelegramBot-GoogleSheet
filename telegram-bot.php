<?php 

require 'function.php';
require 'bot-message.php';

$pesanTelegram = json_decode(file_get_contents("php://input"), TRUE);

$currentUser = setCurrentUser	(
									$pesanTelegram["message"]["chat"]["id"],
									$pesanTelegram["message"]["from"]["username"],
									$pesanTelegram["message"]["text"]
								);

//CEK USERNAME
if ($currentUser["username"]!="aang97") {
	$currentUser["reply1"]="user tidak terdaftar";
}
else
{
	switch ($currentUser["message"]) {
	case '/start':
		$currentUser["reply1"]=$replyMessage['welcome'];
		break;
	default:
		$currentUser = parseMessage1($currentUser);
		if ($currentUser["nama"]==""||$currentUser["contact"]=="") 
		{
			$currentUser["reply1"]=	$replyMessage['format tidak sesuai'];
		}
		else 
		{
			$currentUser["reply1"]="[RESULT]\n\nnama : ".$currentUser["nama"] . "\ncontact : ".$currentUser["contact"] ."\n\n".googleAPI($currentUser)."\n\n".$replyMessage['url gdrive'];
		}
		break;
	}
}
$currentUser["reply5"]=$replyMessage['main menu'];
sendMessage($currentUser);

 ?>