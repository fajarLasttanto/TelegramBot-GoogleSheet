<?php 

function setCurrentUser($chatid, $username, $message_)
{
	$currentUser_ = array(
				'chatId' => "",
				'username' => "",
				'message' => "",
				'nama' => "",
				'contact' => "",
				'reply1' => "",
				'reply2' => "",
				'reply3' => "",
				'reply4' => "",
				'reply5' => ""
				);

	$currentUser_["chatId"] = $chatid;
	$currentUser_["username"] = $username;
	$currentUser_["message"] = $message_;

	return $currentUser_;
}

function getCurrentData($messageInput)
{
	list($variable, $value) = explode(":", $messageInput);
	list($messageOutput) = explode(PHP_EOL, $value);

	return $messageOutput;
}

function parseMessage1($currentUser_)
{
	list($message,$nama,$contact) = explode("#", $currentUser_["message"]);
	$currentUser_["nama"] = getCurrentData($nama);
	$currentUser_["contact"] = getCurrentData($contact);

	return $currentUser_;
}

function sendMessage($currentUser_)
{
	$j = true;
	for ($i=1;  $j ; $i++) { 
		
		if ($currentUser_["reply".$i]!="") {
			send2Telegram($currentUser_["reply".$i],$currentUser_);
		}
		else
		{
			$j=false;
		}
	}
}

function send2Telegram($message,$currentUser_)
{
	$token ="your token";
	$URL="https://api.telegram.org/bot".$token;
	$ch = curl_init($URL."/sendMessage"); 
    $postfield = "chat_id=".$currentUser_["chatId"]."&"."text=".$message;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfield);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    $output = curl_exec($ch); 
    curl_close($ch);      
}

 ?>