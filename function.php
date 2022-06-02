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
				'reply3' => ""
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
	if ($currentUser_["reply1"]!="") {
			send2Telegram($currentUser_["reply1"],$currentUser_);
		}
	if ($currentUser_["reply2"]!="") {
			send2Telegram($currentUser_["reply2"],$currentUser_);
		}
	if ($currentUser_["reply3"]!="") {
			send2Telegram($currentUser_["reply3"],$currentUser_);
		}	
}

function send2Telegram($message,$currentUser_)
{
	$token ="YourToken";
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