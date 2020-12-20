<?php

require('vendor/autoload.php');

$domain = 'http://localhost:8000/';

$start_file = 'a.html';
$compare_file = 'b.html';
$search_text_element = 'a';

$array_starter = array();
$array_second = array();

/*-------------------LOGIC--------------------*/
use Goutte\Client;
	
$client = new Client();
$crawler = $client->request('GET', $domain.$start_file);
$crawler->filter($search_text_element)->each(function ($node) use (&$array_starter){
	if (!empty($node->text()))
   	array_push($array_starter, $node->text()); 
});

$crawler2 = $client->request('GET',$domain.$compare_file);
$crawler2->filter($search_text_element)->each(function ($node) use (&$array_second){
   if (!empty($node->text()))
   array_push($array_second, $node->text()); 
});

foreach ($array_second as $value) {
	if (!in_array($value, $array_starter))
	  echo $value."\n";
}
/*-------------------END LOGIC--------------------*/

?>