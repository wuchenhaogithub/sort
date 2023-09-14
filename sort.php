<?php
ini_set('display_errors','on');


/**
 * 最大自增子序列
 * @param Integer[] $nums
 * @return Integer
 */
function lengthOfLIS($nums) {
    $maxArr = [];
    $len = count($nums);
    if ($len == 0){
        return  $len;
    }
    for ($i=0;$i<$len;$i++){
        $max = 1;
        for ($j=$i;$j<$len;$j++){
            if ($nums[$i]>$nums[$j]){
                $max = $max>$maxArr[$j]+1?$max:$maxArr[$j]+1;
            }
            $maxArr[$i]=$max;
        }
    }
var_dump($maxArr);die();


}

$nums = [10,9,2,5,3,7,101,18];
lengthOfLIS($nums);











/**
 * 排列组合
 * @param $teams
 * @param $m
 * @param array $result
 * @return array|mixed
 * @author: Wu ChenHao
 * @Time: 2021/3/11 16:59
 */

function combine($teams, $m, array $result = []){
   
    if (count($result) == $m)
    {
        return  $result;
    }else{
        $arr =[];
        for ($i = 0;$i<count($teams);$i++){
            $newResult = $result;
            $newResult[] = $teams[$i];
            $rest_teams  = array_slice($teams,$i+1,count($teams));
            $ret =  combine($rest_teams,$m,$newResult);
            if ($ret){
                $arr[] = $ret;
            }
        }
        return  $arr;
    }
}


$arr = combine(["t1", "t2", "t3","t4"],2);
print_r($arr);
die();



//田忌赛马--穷举法
function get_password($n,$result = ''){

    $password = 'bacd';
    $classes = ['a', 'b', 'c', 'd'];
    if ($n == 0) {
        if ($result == $password) {
            return $result ;
        }
        $n = 4;
        $result = '';
    }
    $key = array_rand($classes, 1);
    $new_result = $result;
    $new_result =$new_result.$classes[$key];
    return get_password($n - 1, $new_result);
}
$pass = get_password(4);
var_dump($pass);die();




/**
 * 并归排序
 * @param $to_sort
 * @return array
 * @author: Wu ChenHao
 * @Time: 2021/3/11 10:33
 */
function marge_sort($to_sort){
    if(count($to_sort) <= 1) return $to_sort;
    $length = count($to_sort);
    $mid = floor($length/2);
    $left = array_slice($to_sort,0,$mid);
    $right = array_slice($to_sort,$mid,$length);
    $left = marge_sort((array)$left);
    $right = marge_sort((array)$right);
    $data =  merge((array)$left,(array)$right);
    return  $data;
}

function merge( $left, $right){
    $marge_one = [];
    while(count($left) >0 && count($right) > 0)
    {
        if($left[0] <= $right[0]){
            array_push($marge_one,array_shift($left));
        }else{
            array_push($marge_one,array_shift($right));
        }
    }
    array_splice($marge_one,count($marge_one),0,$left);
    array_splice($marge_one,count($marge_one),0,$right);
    return $marge_one;
}
print_r(marge_sort(array(5,1,2,6,3,9,8)));die;





 






/**
 * 冒泡算法
 * @param array $arr
 * @return array
 */
function bubbleSort(array  $arr){
    $len = count($arr);
    for ($i = 1 ; $i <$len ; $i++){
        for ($j = 0 ; $j<$len - $i ; $j++){
            if ($arr[$j] > $arr[$j+1]){
                $temp = $arr[$j+1];
                $arr[$j+1] =  $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
    return $arr;
}

/**
 * 选择排序
 * @param array $arr
 * @return array
 */
function selectSort(array $arr) {
    $len = count($arr);
    for ($i = 0 ; $i <$len-1 ; $i++){
       //设置最小值
        $min = $i;
        for ($k = $i+1 ; $k <$len;$k++){
            //$arr[$p] 是 当前已知的最小值
            //比较，发现更小的,记录下最小值的位置；并且在下次比较时，应该采用已知的最小值进行比较。
            $min = ($arr[$min] <= $arr[$k]) ? $min : $k;
        }
        if ($min != $i){
            $tmp     = $arr[$min];
            $arr[$min] = $arr[$i];
            $arr[$i] = $tmp;
        }
    }
    return $arr;
}

/**
 * 二分查找
 * @param array $arr 有序排列
 * @param $item
 * @return false|float|null
 */
function arraySearch(array $arr,$item)
{
    $low = 0;
    $high = count($arr) - 1;
    while($low < $high) {
        $min = floor(($high + $low)/2);
        if ($item == $arr[$min]){
            return $min;
        }elseif($item >$arr[$min]){
            $low = $min+1;
        }elseif ($item < $arr[$min]){
            $high = $min -1;
        }
    }
    return null;
}

/**
 * 欧几里得算法【求最大公约数】
 * @param $p
 * @param $q
 * @return mixed
 */
function gcd($p,$q){
    if ($q == 0)return $p;
    $i = $p%$q;
    return gcd($q,$i);
}


/**
 *
 * @param $stage_data
 * @param $stage_num
 * @return false|int|string
 * @author: Wu ChenHao
 * @Time: 2021/1/29 11:03
 */
function sorts($stage_data,$stage_num) {
    array_push($stage_data,$stage_num);
    $data = array_unique($stage_data);
    sort($data);
    return array_search($stage_num,$data);
}

//$stage_data = [100,200,300,400,500,600,700];
//$stage_num = 630;
//echo sorts($stage_data,$stage_num);







function arrayMarge($keyArr)
{
    for ($i=0;$i<count($keyArr);$i++){
        if ($keyArr[$i]>-1){
            for ($j=$i+1;$j<count($keyArr);$j++){
                if ($keyArr[$i] == $keyArr[$j]){
                    $keyArr[$j] = -1;
                }
            }
        }
    }
    return $keyArr;
}


function array2Marge($array){
        foreach ($array[0] as $key=>$value){
            $keyArr = array_column($array,$key);
            $keyMarge = array_map(function ($v)use ($key){return array($key=>$v);},arrayMarge($keyArr));
            array_walk($array, function (&$value, $key, $arr) {
                $value = array_merge($value, $arr[$key]);
            },$keyMarge );
        }
    return $array;
}


$keyArr = $old_arr = array(
    ['id'=>1,'key1'=>10,'key2'=>12],
    ['id'=>2,'key1'=>10,'key2'=>12],
    ['id'=>3,'key1'=>11,'key2'=>12],
    ['id'=>4,'key1'=>11,'key2'=>13],
    ['id'=>5,'key1'=>11,'key2'=>13],
);;

//$arr =  array2Marge($keyArr);
//var_dump($arr);
