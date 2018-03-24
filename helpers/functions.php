<?php
function createToken(){
    $token = '';
    $string = "QWERTYUIOASDFGHJKZXCVBNMqwertyuioasdfghjklzxcvbnm1234567890";
    $length = strlen($string);

    for($i=1;$i<=40;$i++){
        $start = rand(0,$length-1);
        $token .= substr($string,$start,1);
    }
    return $token;
}

//echo createToken(); 
//eaYsZjyCbuNnayqEFfvK9ibMC90fMvSbxMm1srjg
//ayy87rJfJ2DwhzRzN68hV09uVF1hKBAZ9SbQc0GS

?>