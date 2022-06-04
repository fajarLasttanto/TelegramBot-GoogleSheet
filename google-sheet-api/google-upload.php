<?php 

require __DIR__ . '/vendor/autoload.php';


uploadGoogle($_POST["currentUser"]);

function uploadGoogle($currentUser_)
{
	$client = new Google_Client();
	$client->setApplicationName('Google Sheets API PHP Quickstart');
	$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
	$client->setAuthConfig('credentials.json');
	$client->setAccessType('offline');
	$client->setPrompt('select_account consent');

	$service = new Google_Service_Sheets($client);

	$spreadsheetId = '1gwTfFIcJ2j2Yt7FEWndOrf8CgB6Ka8bfDuGhalpefPQ';
	$range='Sheet1';

	$values = [
   		[	
    		$currentUser_["nama"],
    		$currentUser_["contact"]
    	],
    		// Additional rows ...
	];
	$body = new Google_Service_Sheets_ValueRange([
    	'values' => $values
	]);
	$params = [
    	'valueInputOption' => 'RAW'
	];
	$insert = [
		'insertDataOption' => 'INSERT_ROWS'
	];
	$result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params,$insert);
	printf("Response : %d cell berhasil di update", $result->getUpdates()->getUpdatedCells());
}

 ?>