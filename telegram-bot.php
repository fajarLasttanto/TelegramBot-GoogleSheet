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
		$currentUser["reply1"]=$replyMessage['main menu'];
		break;
	default:
		$currentUser = parseMessage1($currentUser);
		if ($currentUser["nama"]==""||$currentUser["contact"]=="") 
		{
			$currentUser["reply1"]=	$replyMessage['format tidak sesuai'];
			$currentUser["reply2"]=	$replyMessage['main menu open']."\n\n".
									$replyMessage['exit']."\n\n".
									$replyMessage['main menu close'];
		}
		else 
		{
			$currentUser["reply1"]="[RESULT]\n\nnama : ".$currentUser["nama"] . "\ncontact : ".$currentUser["contact"];
		}
		break;
	}
}

sendMessage($currentUser);

 ?>