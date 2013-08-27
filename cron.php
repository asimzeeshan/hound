<?php

function processNode($obj) {
	//print_r($obj);
	echo "Found <strong>".$obj->ipaddr."</strong> having MAC <strong>".$obj->mac."</strong> and the description says <strong>".$obj->descr."</strong><br>";
}

echo "Cron Job Begins <br />";				
$xml = simplexml_load_file('https://dmz.nextbridge.org/5ebe2294ecd0e0f08eab7690d2a6ee69.php');
$node_1_records = $xml->dhcpd->lan->staticmap;
foreach ($xml->dhcpd->lan->staticmap as $node) {
	processNode($node);
}

echo "<h2>Start OPT1</h2>";

foreach ($xml->dhcpd->opt1->staticmap as $node) {
	processNode($node);
}

echo "<h2>Start OPT2</h2>";

foreach ($xml->dhcpd->opt2->staticmap as $node) {
	processNode($node);
}

echo "<h2>Start OPT3</h2>";

foreach ($xml->dhcpd->opt3->staticmap as $node) {
	processNode($node);
}

echo "<h2>Start OPT4</h2>";

foreach ($xml->dhcpd->opt4->staticmap as $node) {
	processNode($node);
}

echo "<h2>Start OPTXXXX</h2>";

foreach ($xml->dhcpd->optxxxx->staticmap as $node) {
	processNode($node);
}

echo "Cron Job End";
?>