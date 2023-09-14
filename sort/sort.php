<?php
require_once "uniqueRandom.php";
/**
 * 冒泡算法
 * @param $arr
 * @author: Wu ChenHao
 * @Time: 2022/7/22 11:44
 * 时间复杂度O(n^2)
 */
function bubbleSort($arr){
    $len = count($arr);
    for ($i = 0 ; $i<$len;$i++){
        for ($j = $i+1;$j <$len;$j++){
            if ($arr[$i]>$arr[$j]){
                [$arr[$i],$arr[$j]] = array($arr[$j],$arr[$i]);
            }
        }
    }
    return $arr;
}
$arr = uniqueRandom(0, 100, 10);
//var_dump(bubbleSort($arr));

/**
 * 选择排序
 * 时间复杂度O(n^2)
 * @param $arr
 * @return mixed
 * @author: Wu ChenHao
 * @Time: 2022/7/22 12:01
 */
function selectionSort($arr){
    $len = count($arr);
    for ($i=0;$i<$len;$i++){
        $minPos = $i; //把第一个没有排序的值下标设置为最小值
        for ($j = $i + 1;$j<$len;$j++){
            if ($arr[$minPos]>$arr[$j]){
                $minPos = $j; //把最小值的位置设置为这个元素的位置
            }
        }
        //把没有排序的值和最小值调换位置
        if ($i != $minPos){
            $temp = $arr[$i];
            $arr[$i] = $arr[$minPos];
            $arr[$minPos] = $temp;
        }
    }
    return $arr;
}
//var_dump(selectionSort($arr));

/**
 * 插入排序
 * 时间复杂度O(n2)
 * @param $arr
 * @return mixed
 * @author: Wu ChenHao
 * @Time: 2022/7/22 12:20
 */
function insertionSort($arr){
    $len = count($arr);
    if ($len < 2) return $arr;
    for ($c = 1 ;$c <$len ;$c++){ //获取未排序的值,默认第一个已排序
        $temp = $arr[$c];
        for ($j = $c -1;$j>=0;$j--){
            if ($temp<$arr[$j]){
                [$arr[$j],$arr[$j+1]] = array($temp,$arr[$j]);
            }
        }
    }
    return $arr;
}
//var_dump(insertionSort($arr));

/**
 * 希尔排序
 * 根据定义因子 分段排序，时间复杂度最差 O(n^2) 平均时间复杂度 O(n(log(n))2)
 * @param $arr
 * @return mixed
 * @author: Wu ChenHao
 * @Time: 2022/7/22 21:32
 */
function ShellSort($arr){
    $len = count($arr);
    $f = 3; //定义因子
    $h = 1; //最小为1
    while ($h < $len/$f){
        $h = $f*$h + 1;
    }

    while ($h>=1){
        for ($i = $h ;$i<$len;$i++){
            for ($j = $i;$j>=$h;$j-=$h){
                if ($arr[$j]<$arr[$j-$h]){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j-$h];
                    $arr[$j-$h] = $temp;
                }else{
                    break;
                }
            }
        }
        $h = intval($h/$f);
    }
    return $arr;
}
//var_dump(ShellSort($arr));


