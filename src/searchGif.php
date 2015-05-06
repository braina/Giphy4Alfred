<?php

require_once('workflows.php');
$wf = new Workflows();
$searchWord = $argv[1];



define("REQUEST_URL", "http://api.giphy.com/v1/gifs/search?api_key=dc6zaTOxFJmzC");
$url = REQUEST_URL."&q=".urlencode( $searchWord );

$json = json_decode( $wf -> request($url));
$num = rand(0,count($json->data));
$url = $json->data[$num]->images->original -> url;


if(count($json->data)==0)
    $wf -> result (time(),$url, "no result","$url", 'icon.png');
else
    $wf -> result (time(),$url, "search Giphy for $searchWord","$url", 'icon.png');


echo $wf->toxml();


?>