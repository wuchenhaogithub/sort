<?php
ini_set('display_errors','on');
class Change{
    protected $moneyArr = [1,2,5,10];
    protected $changeMethod;

    public function __construct($moneyArr = null)
    {
        if ($moneyArr != null) $this->moneyArr = $moneyArr;
        rsort($this->moneyArr);//倒序排序零钱
    }

    /**
     *简单版动态规划
     * @param int $moneyNum
     * @param array|null $moneyArr
     * @return array|null
     * @author: Wu ChenHao
     * @Time: 2021/3/18 17:43
     */
    public function change(int $moneyNum, ?array $moneyArr=null){
        if ($moneyArr===null){
            $moneyArr =$this->moneyArr;
        }
        $changeMethod = [];
        while ($faceValue = array_shift($moneyArr)) {//从大到小 比较钱币
            if ($faceValue <= $moneyNum){ //面值必须小于等于找零金额
                $quotient = floor($moneyNum / $faceValue);//做除数运算
                for ($i=$quotient;$i>0;$i--) {
                    $changeMethodTemp = [];//找零方法缓存
                    $moneyNumTemp = $moneyNum; //金额缓存
                    $moneyNumTemp -= intval($i * $faceValue);//减去已经找过的
                    if (isset($changeMethodTemp[$faceValue])) {
                        $changeMethodTemp[$faceValue] += $i;
                    } else {
                        $changeMethodTemp[$faceValue] = $i;
                    }
                    //如果当前没有找清,则尝试判断剩余情况是否能找清
                    if ($moneyNumTemp == 0) {
                        $moneyNum = 0;
                        $changeMethod = $changeMethodTemp;
                        break;
                    } elseif ($moneyNumTemp > 0) {
                        $changeMethodTemp2 = $this->change($moneyNumTemp, $moneyArr);
                        if ($changeMethodTemp2 === null) {
                            continue;
                        }
                        //有值代表能找清
                        $moneyNum = 0;
                        $changeMethod = $changeMethodTemp + $changeMethodTemp2;
                        break;
                    }
                }
            }
        }
        if ($moneyNum > 0){
            return null;
        }
        $this->changeMethod = $changeMethod;
        return  $this->changeMethod;
    }


    /**
     * 加强版动态规划
     * @param int $moneyNum
     * @param array|null $moneyArr
     * @return array|null
     * @author: Wu ChenHao
     * @Time: 2021/3/19 09:13
     */
    public function strongChange(int $moneyNum, ?array $moneyArr=null){
        if ($moneyArr===null){
            $moneyArr =$this->moneyArr;
        }
        $optimalChangeMethod = [];
        $optimalNum = -1;//当前最优张数
        while ($faceValue = array_shift($moneyArr)){
            if ($faceValue <= $moneyNum){
                $quotient = floor($moneyNum / $faceValue);//做除数运算
                for ($i = $quotient; $i > 0; $i--) {
                    $changeMethodTemp = [];//找零方法缓存
                    $moneyNumTemp=$moneyNum;//金额缓存
                    $moneyNumTemp -= intval($i * $faceValue);//减去已经找过的
                    if (isset($changeMethodTemp[$faceValue])){
                        $changeMethodTemp[$faceValue] +=$i;
                    }else{
                        $changeMethodTemp[$faceValue] =$i;
                    }
                    if ($moneyNumTemp == 0){
                        $banknoteNum = array_sum($changeMethodTemp);
                        if ($optimalNum==-1||$banknoteNum<$optimalNum){
                            $optimalNum = $banknoteNum;
                            $optimalChangeMethod = $changeMethodTemp;
                        }
                    }elseif($moneyNumTemp > 0) {
                        $changeMethodTemp2 = $this->strongChange($moneyNumTemp,$moneyArr);
                        if ($changeMethodTemp2 === null){
                            continue;
                        }
                        $banknoteNum = array_sum($changeMethodTemp2)+ array_sum($changeMethodTemp);
                        if ($optimalNum == -1 ||  $banknoteNum <$optimalNum){
                            $optimalNum = $banknoteNum;
                            $optimalChangeMethod = $changeMethodTemp + $changeMethodTemp2;
                        }
                    }

                }
            }
        }
        if ($optimalNum==-1){
            return null;
        }
        $this->changeMethod = $optimalChangeMethod;
        return $this->changeMethod;
    }



}

$change = new Change([1,30,50]);
var_dump($change->strongChange(90));




