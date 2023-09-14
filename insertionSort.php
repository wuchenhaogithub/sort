<?php
/**
 * 插入排序
 *
 * 时间复杂度O(n2)
 * 空间复杂度 O(1)
 * 算法：
 *  1、从第一个元素默认已经排序
 *  2、取出下一个元素，在已排序的元素序列中从后还是扫描
 *  3、若该元素（已排序）大于新元素，将该元素移动到新元素后面
 *  4、重复步骤3，直到找到已排序的元素小于或者等于新元素的位置
 *  5、将新元素插入到排序数组中 重复2-4
 */
require_once 'uniqueRandom.php';

function insertionSort(&$sort){
    $c = count($sort);
    if ($c < 2) return  $sort;
    //外层循环用于从未排序区域中取出待排序元素
    for ($i = 1;$i<$c;$i++){
        $temp = $sort[$i]; //获取当前需要排序插入已排序数组中的元素
        for ($j=$i-1;$j>=0;$j--){ //内层循环用于从已排序中寻找新元素的插入位置
            if ($sort[$j] > $temp){
                [$sort[$j+1],$sort[$j]] = array($sort[$j],$temp);
            }else{
                break;
            }
        }
    }
    return $sort;
}
$arr = uniqueRandom(1, 100000, 5000);
$start = microtime(true);
$ret = insertionSort($arr);
$end = microtime(true);
$used = $end - $start;
echo "insertionSort used $used s" . PHP_EOL;//insertionSort used 2.2305538654327 s

