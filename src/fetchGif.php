<?php

require_once('workflows.php');
$wf = new Workflows();


//GET Giphy json
$randomURL= "http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC";

$opts = array(
    'http'=>array(
        'method' => "GET",
        'header' => "Accept:application/json, text/javascript"
    )
);

$context = stream_context_create($opts);
$json = json_decode(file_get_contents($randomURL,false,$context));


//define image path
$image_dir = './thumbs';
$image_url = $json->data->image_url;
$image_type = substr($image_url, strrpos($image_url, '.') + 1);
$image_path = $image_dir.'/icon.png';

//Delete old image
$res_dir = opendir( $image_dir );
while( $file_name = readdir($res_dir)) {
    if(is_file($image_dir.'/'.$file_name)) {
        unlink($image_dir.'/'.$file_name);
    }
}

$random = $json->data->image_url;


$wf -> result (time(),$random,"random gif image",$random,$image_path);



echo $wf->toxml();


//create new image
$image_data = file_get_contents($image_url);
file_put_contents($image_path,$image_data);

?>