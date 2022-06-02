<?php 

function setCurrentUser($chatid, $username, $message_)
{
	$currentUser_ = array(
				'chatId' => "",
				'username' => "",
				'message' => "",
				'nama' => "",
				'contact' => ""
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

 ?>