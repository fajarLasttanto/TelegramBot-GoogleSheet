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
	for ($i=1;  $i<=5 ; $i++) { 
		
		if ($currentUser_["reply".$i]!="") {
			send2Telegram($currentUser_["reply".$i],$currentUser_);
		}
	}
}

function send2Telegram($message,$currentUser_)
{
	$token ="5240315186:AAFA9TGjcj8A0ZOKt4YQBzTkQjk3MtVMfEU";
	$URL="https://api.telegram.org/bot".$token;
	$ch = curl_init($URL."/sendMessage"); 
    $postfield = "chat_id=".$currentUser_["chatId"]."&"."text=".$message;
    postRequest($postfield,$ch);      
}

function googleAPI($currentUser_)
{
	$ch = curl_init("https://fajarlasttanto.space/telegram-service/google-sheet-api/google-upload.php");
    $currentUser_ = array('currentUser'=> $currentUser_);
    $postfield = http_build_query($currentUser_);
  	return postRequest($postfield,$ch);
}

function postRequest($postfield,$ch)
{
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfield);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    $output = curl_exec($ch); 
    curl_close($ch);
    return $output;
}

 ?>