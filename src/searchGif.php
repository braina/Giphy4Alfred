<?php

require_once('workflows.php');
$wf = new Workflows();
$searchWord = $argv[1];

$randomURL= "http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC";
$url = $randomURL."&tag=".urlencode( $searchWord );

$json = json_decode( $wf -> request($url));
$url = $json->data->image_url;

if(count($json->data)==0)
    $wf -> result (time(),$url, "no result","$url", 'icon.png');
else
    $wf -> result (time(),$url, "search Giphy for $searchWord","$url", 'icon.png');


echo $wf->toxml();


?>



