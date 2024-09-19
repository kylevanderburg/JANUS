<?php
//Postmark Inbound Script
//Kyle Vanderburg
//From https://github.com/jjaffeux/postmark-inbound-php
//TODO: VALIDATE SENDER
require_once "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$time_start = microtime(true);

function fcomplete($email,$time,$job,$message,$hammer){
	$time_end = microtime(true);
	$time_total = $time_end - $time;
	$m = "Figaro completed job name ".$job." in ".$time_total." seconds.

The information as received is printed below for diagnostic purposes.

========================
Liszt/Figaro Mail Parser v.0.5.b
(c) NoteForge LLC
========================

".$message;
$hammer->pmail($email,"liszt@liszt.me","Liszt Job Completed",$m);
}

//Error Reporting
if (isset($_GET['e'])){ini_set('display_errors',1); error_reporting(E_ALL);}
//Require
//Get our input
$inbound = new \Postmark\Inbound(file_get_contents('php://input'));
if($inbound){
	//Get Mailbox Hash
	$to = $inbound->OriginalRecipient();
	$parts = explode('@', $to);
	$handle = $parts[0];
	$hashparts = explode('+', $handle);
	$guid = strtoupper($hashparts[1]);
	
	if($inbound->FromEmail()=="kyle@noteforge.com"||$inbound->FromEmail()=="kyle.vanderburg@ndsu.edu"){
	$hammer->setHS(1);
		//Get recipients
		if($parts[1]=="inbound.vanderburg.app"){//This is us, do things
			//Split the Handle from the Hash/GUID
			$split = explode('+', $parts[0]);
			$handle = $split[0];
			//$guid = strtoupper($split[1]);
			switch($handle){
				case "email":
					$mail = new people_email($hammer);
					//$hammer->setHS($guid);
					//AHHH AHHH AHHH
					$mail->create();
					$push['toemail'] = $inbound->OriginalRecipient();
					$push['toname'] = $inbound->OriginalRecipient();
					$push['fromemail'] = $inbound->FromEmail();;
					$push['fromname'] = $inbound->FromName();
					$push['messid'] = $inbound->MessageID();
					$push['subject'] = $inbound->Subject();
					$push['body'] = $hammer->sanitize($inbound->HtmlBody());
					// $push['date'] = $inbound->Date();
					$date = new DateTime($inbound->Date());
					$push['date'] = $date->format('Y-m-d H:i:s');
					$mail->update($push);
					$return = "Email Received".$hammer->getSiteVar('sitetitle');
					// $hammer->kmail($push['date']);
				break;
				
		
				default:
					//DEBUG //$message = $message."|DefaultHandle";
					$hammer->pmail($inbound->FromEmail(),"franz@lisztapp.com",$inbound->Subject(),"Figaro has no idea what to do with this command. Either the command itself is incorrect or the mailbox hash could not be resolved.

	The information as received is printed below for diagnostic purposes.

	========================
	Liszt/Figaro Mail Parser v.0.5.b
	(c) NoteForge LLC
	========================

	".json_encode($inbound));
						break;
			}//Handle Switch
		}//Addess to inbound.liszt.me
	}//foreach recipient
}

else{die();}
?>