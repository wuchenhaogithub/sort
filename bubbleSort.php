<?php
/**
 * 冒泡排序
 * 原理：两两比较，如果反序就交换
 * 时间复杂度O(n2)
 * 空间复杂度 O(1)
 */

require_once "uniqueRandom.php";

function bubbleSort(&$arr){
    for ($i = 0 , $l = count($arr); $i< $l;$i++){
        $swapped  = FALSE;
        for ($j=$i+1;$j<$l;$j++){
            if ($arr[$i] > $arr[$j]){
                [$arr[$i], $arr[$j]] = array($arr[$j], $arr[$i]);
                $swapped = true;
            }
        }
        if (!$swapped) break; //没有发生交换，算法结束
    }
    return $arr;
}
$arr = uniqueRandom(1, 100000, 5000);
$start = microtime(true);
bubbleSort($arr);
$end = microtime(true);
$used = $end - $start;
echo "V1 used $used s" . PHP_EOL; //V1 used 2.9839401245117 s


//$start = microtime(true);
//asort($arr);
//$end = microtime(true);
//$used = $end - $start;
//echo "asort() used $used s" . PHP_EOL;
