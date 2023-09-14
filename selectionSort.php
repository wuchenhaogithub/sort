<?php
/**
 * 选择排序
 * 工作原理是每次从待排序的元素中的第一个元素设置为最小值，
 * 遍历每一个没有排序过的元素，如果元素小于现在的最小值，
 * 就将这个元素设置成为最小值，遍历结束就将最小值和第一个没有排过序交换位置，
 * 这样的遍历需要进行元素个数-1次
 * 这是一个不稳定的排序算法(排序后相对次序改变了)
 * 对于选择排序如何找到最小元是关键 所以我们需要使用堆排序
 */

require_once 'uniqueRandom.php';


function selectSort(&$sort){
    $len = count($sort);
    for ($i = 0;$i<$len;$i++){
        $minPos = $i;		//把第一个没有排过序的元素设置为最小值
        //遍历每一个没有排过序的元素
        for ($j = $i+1;$j<$len;$j++){
            if ($sort[$minPos] > $sort[$j]){
                //把最小值的位置设置为这个元素的位置
                $minPos = $j;
            }
        }
        //内循环结束把最小值和没有排过序的元素交换
        if ($minPos != $i) {
            $temp = $sort[$i];
            $sort[$i] = $sort[$minPos];
            $sort[$minPos] = $temp;
        }
    }
}
$arr = uniqueRandom(1, 10000, 5000);
$start = microtime(true);
$ret = selectSort($arr);
$end = microtime(true);
$used = $end - $start;
echo "selectSort used $used s" . PHP_EOL;//selectSort used 1.6184890270233 s




