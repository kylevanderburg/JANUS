<?php
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$hr = new vio_pagechange($hammer);
$hammer->debug();
$hammer->setHS(1);

foreach($hr->q("") as $site)
{
	$hr->checkChanged($site['hash']);
	echo $site['url']."<br />";
}