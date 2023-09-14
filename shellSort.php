<?php
/**
 * 希尔排序
 * 是一种高效的插入排序,区别在于插入排序是相邻的一个个比较，而希尔排序是有自定义因子，将数组分成若干个小数组，先进行粗略调整每个小组
 * 希尔排序是距离h 的比较，替换
 * 希尔排序中有增量 h
 * 示例中所使用的分组跨度（3280，1093 ...，1），被称为希尔排序的增量
 * 时间复杂度：最差 O(n2) 平均时间复杂度 O(n(log(n))2)
 * 空间复杂度  O(1)
 * 漫画理解希尔排序:https://blog.csdn.net/bjweimengshu/article/details/100681410
 */

require_once "uniqueRandom.php";

function ShellSort(&$sort){
    $len = count($sort);
    $f = 3; //定义因子
    $h = 1; //最小为1
    while ($h < $len/$f){
        $h = $f*$h + 1;
    }
    while ($h>=1){
        for ($i = $h ; $i<$len;$i++){
            for ($j = $i; $j >= $h;  $j -= $h){
                if ($sort[$j] < $sort[$j-$h]){
                    $temp = $sort[$j];
                    $sort[$j] = $sort[$j-$h];
                    $sort[$j-$h] = $temp;
                }else{
                    break;
                }
            }
        }
        $h = intval($h/$f);
    }

}

$arr = uniqueRandom(1, 100000, 5000);
$start = microtime(true);
$ret = ShellSort($arr);
$end = microtime(true);
$used = $end - $start;
echo "ShellSort used $used s" . PHP_EOL;//selectSort used 1.6091730594635 s