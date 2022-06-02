<?php 

require 'function.php';
require 'bot-message.php';

$pesanTelegram = json_decode(file_get_contents("php://input"), TRUE);

$file = fopen("log.txt","w");
fwrite($file,var_export($pesanTelegram),true);
fclose($file);

$currentUser = setCurrentUser	(
									$pesanTelegram["message"]["chat"]["id"],
									$pesanTelegram["message"]["from"]["username"],
									$pesanTelegram["message"]["text"]
								);

switch ($currentUser["message"]) {
	case '/start':
		$currentUser["reply1"]=$replyMessage['main menu'];
		sendMessage($currentUser);
		break;
	
	default:
		$currentUser = parseMessage1($currentUser);
		if ($currentUser["nama"]==""||$currentUser["contact"]=="") 
		{
			$currentUser["reply1"]=$replyMessage['format tidak sesuai'];
			$currentUser["reply2"]=$replyMessage['main menu'];
			sendMessage($currentUser);
		}
		else 
		{
			$currentUser["reply1"]="[RESULT]\n\nnama : ".$currentUser["nama"] . "\ncontact : ".$currentUser["contact"];
			sendMessage($currentUser);
		}
		break;
}



 ?>