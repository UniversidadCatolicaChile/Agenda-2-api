<?php

$extra = '';
if(isset($_GET) && !empty($_GET)){
    foreach($_GET as $key => &$value){
        $extra .= '&'.$key.'='.urlencode($value);
    }
}
$posts = file_get_contents("https://agenda.uc.cl/json-data/?passcode=g5g3yLqVsduQ6f8p".$extra);
header('Content-Type: application/json');
echo $posts;
exit();
