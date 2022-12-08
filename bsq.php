<?php

function getMap($path) {
    $map = [];
    $file = fopen($path, 'r');
    while (($line = fgets($file))) {
        $map[] = trim($line);
    }
    return $map;
}

function checkSquare($map, $x, $y, $size) {

    if($y + $size > count($map) || $x + $size > strlen($map[$y])){
        return false;
    }
    for($i = 0; $i < $size ; $i++){
        for($j = 0 ; $j < $size; $j++){
            if($map[$i + $y][$j + $x] =='o'){

                return $j;
            }
        }
    }
    return -1 ;
}

function fileSquare($map, $x, $y, $size){
    for($i = 0; $i < $size ; $i++){
        for($j = 0 ; $j < $size; $j++){
            $map[$j +$y][$i +$x] = 'x';
        }
    }
    return $map;
}

function bsq($map)
{
    $maxSize = 0;

    for($i = 0; $i < count($map); $i++){
        for($j = 0 ; $j < strlen($map[$i]); $j++ ){
            while (($ret = checkSquare($map,$j,$i, $maxSize +1 )) == -1){

                $maxSize++;
                $sol_y = $i;
                $sol_x = $j;
 
            }
            $j += $ret;
        }
    }
    $map = fileSquare($map, $sol_x, $sol_y, $maxSize);
    
    //convert map into a string 
    array_shift($map);
    $map = implode("\n", $map);
    echo $map;
}
$path = $argv[1];

$map = getMap($path);
ini_set('memory_limit', '1024M');
bsq($map);
echo "\n";
?>