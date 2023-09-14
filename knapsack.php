<?php
/**
    PHP实现动态规划背包问题
    有一堆货物，有各种大小和价值不等的多个物品，而你只有固定大小的背包，拿走哪些能保证你的背包带走的价值最多
    动态规划就是可以记录前一次递归过程中计算出的最大值，在之后的递归期间使用，以免重复计算。
 */

$thing_arr = array(
    array('size' => 9, 'weight' =>10),
    array('size' => 4, 'weight' => 5),
    array('size' => 6, 'weight' => 4),
    array('size' => 7, 'weight' => 9),
);

$max_package_arr = array();
$max_thing_arr   = array();

$max_value = 0; //剩余空间
function package($space){
    global $thing_arr , $max_package_arr,$max_thing_arr,$max_value;
    if (isset($max_package_arr[$space])) return $max_package_arr[$space];
//    print_r($max_package_arr);
    print_r($max_thing_arr);
    print_r($max_value);
    foreach($thing_arr as $thing){
        $rest_space = $space - $thing['size'] ;
        if ($rest_space > 0){
            $value = package($rest_space) + $thing['weight'] ;
            if ($value > $max_value){
                $max_package_arr[$space] = $max_value= $value;
                $max_thing_arr[$space] = $thing['weight'];
            }
        }
    }
    return $max_value;
}


 package(13);
//print_r($max_thing_arr);