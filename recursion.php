<?php

//递归

/**
 * 递归的三大要素
 *  1、第一递归函数的功能
 *  2、寻找递归结束的条件
 *  3、找出函数的等价关系式
 */


/**
 *  @Fibonacci 斐波那契数列
 *  斐波那契数列 1 1 2 3 5 8 13 ... 第 n 项目为 f(n) = f(n-1) + f(n-2)
 *  1、第一递归函数功能
 *  假设f(n) 的功能是求第 n 项的值，代码如下：
 *  function f(int $n){}
 *
 *  2、寻找递归结束的条件
 *    当n = 1/2 时 return 1
 *    function f(int $n){ if($n <=2)return 1 }
 *  3、找出函数的等价关系式
 *     f(n) = f(n-1) + f(n-2)
 * @param int $n
 * @return int
 * @author: Wu ChenHao
 * @Time: 2021/4/12 09:45
 */
function Fibonacci(int $n){
    if ($n <=2){
        return 1;
    }
    return Fibonacci($n-1) +  Fibonacci($n-2);
}

/**
 * @froh 小青蛙跳台阶
 *  一只青蛙一次可以跳上1级台阶，也可以跳上2级。求该青蛙跳上一个n级的台阶总共有多少种跳法。
 * 公式推导
 * 每次跳的时候有2种选择
 * 第一种跳法：第一次我跳了一个台阶，那么还剩下n-1个台阶还没跳，剩下的n-1个台阶的跳法有f(n-1)种。
 * 第二种跳法：第一次跳了两个台阶，那么还剩下n-2个台阶还没，剩下的n-2个台阶的跳法有f(n-2)种。
 *  f(n) = f(n-1) + f(n-2)
 * @param int $n
 * @return int
 * @author: Wu ChenHao
 * @Time: 2021/4/12 10:05
 */
function frog(int $n){
    if ($n <=2){
        return $n;
    }
    return frog($n -1 )+ frog($n -2 );
}

/**
 * 给定一组非负整数 nums，重新排列每个数的顺序（每个数不可拆分）使之组成一个最大的整数。
 * demo 1
 *  输入：nums = [10,2]
 *  输出："210"
 * demo 2
 *  输入：nums = [3,30,34,5,9]
 *  输出："9534330"
 * @param $nums
 * @return string
 * @author: Wu ChenHao
 * @Time: 2021/4/12 13:32
 */
function largestNumber($nums){
    if(array_sum($nums) == 0) { // 防止[0, 0, 0] 输出000
        return '0';
    } else {
        usort($nums, function ($a, $b) {
            if ($a == $b) {
                return 0;
            } else {
                return ($a . $b) > ($b . $a) ? -1 : 1;
            }
        });
        return implode('', $nums);
    }
}


/**
 * 不使用 * 计算2数相乘
 * @param $a
 * @param $b
 * @return mixed
 * @author: Wu ChenHao
 * @Time: 2021/4/12 14:13
 */
function multiply($a, $b) {
    $val = $a>$b?$a:$b;
    $n = $a<$b?$a:$b;
    if ($n < 2){
        return  $val;
    }
    return $val + multiply($val,$n-1);
}


/**
 * 深度优先搜索的递归
 * @param $n [总玩家数 n】
 * @param $relation [玩家编号,对应可传递玩家编号] 关系组成的二维数组
 * @param $k [返回信息从小 A (编号 0 ) 经过 k 轮]
 * @return mixed [传递到编号为 n-1 的小伙伴处的方案数]
 * @author: Wu ChenHao
 * @Time: 2021/4/12 14:14
 */
function numWays($n, $relation, $k ) {
    return dfs(0,$relation,$k,$n);//深度优先遍历
}

function dfs($start,$relation, $k,$n ){
    if ($k == 0)
        return $start==$n-1?1:0;
    $ret = 0;
    foreach($relation as $key=>$item) {
        if ($item[0] == $start){
            $ret+=dfs($item[1],$relation,$k-1,$n);
        }
    }
    return $ret;
}


/**
 * 求最大二叉树
 *  二叉树的根是数组 nums 中的最大元素。
    左子树是通过数组中 最大值左边部分 递归构造出的最大二叉树。
    右子树是通过数组中 最大值右边部分 递归构造出的最大二叉树。
 *
 * 输入：nums = [3,2,1,6,0,5]
    输出：[6,3,5,null,2,0,null,null,1]
    解释：递归调用如下所示：
    - [3,2,1,6,0,5] 中的最大值是 6 ，左边部分是 [3,2,1] ，右边部分是 [0,5] 。
    - [3,2,1] 中的最大值是 3 ，左边部分是 [] ，右边部分是 [2,1] 。
    - 空数组，无子节点。
    - [2,1] 中的最大值是 2 ，左边部分是 [] ，右边部分是 [1] 。
    - 空数组，无子节点。
    - 只有一个元素，所以子节点是一个值为 1 的节点。
    - [0,5] 中的最大值是 5 ，左边部分是 [0] ，右边部分是 [] 。
    - 只有一个元素，所以子节点是一个值为 0 的节点。
    - 空数组，无子节点。
 *  思路
 *  1、找到最大值
    2、通过最大值获取左数组和右数组
    3、分治->递归获取左子树和右子树
 * @param $nums
 * @author: Wu ChenHao
 * @Time: 2021/4/12 14:59
 */
function constructMaximumBinaryTree($nums) {
    if(empty($nums)) return null;
    $max = max($nums);
    $index = array_search($max,$nums);
    $left = array_slice($nums,0,$index);
    $right = array_slice($nums,$index+1);
    $root = new TreeNode($max);//二叉树
    $root ->left = constructMaximumBinaryTree($left);
    $root -> right = constructMaximumBinaryTree($right);
    return $root;
}


function postorderTraversal($root) {
    $stack = new SplStack();
    $res = [];
    if ($root === null) return $res;
    $stack->push($root);
    while($stack->count()){
        $cur = $stack->pop();
        array_unshift($res, $cur->val);
        if ($cur->left !=null) $stack->push($cur->left);
        if ($cur->right !=null) $stack->push($cur->right);
    }
    return $res;
}



/**
 * 节点反转--迭代
 * @param $head
 * @author: Wu ChenHao
 * @Time: 2021/4/12 15:53
 */

class ListNode {
     public $val = 0;
     public $next = null;
     function __construct($val = 0, $next = null) {
             $this->val = $val;
             $this->next = $next;
     }
}
// double pointer
// 我们可以申请两个指针，第一个指针叫 prev，最初是指向 null 的。
// 第二个指针 cur 指向 head，然后不断遍历 cur。
// 每次迭代到 cur，都将 cur 的 next 指向 pre，然后 pre 和 cur 前进一位。
// 都迭代完了 (cur 变成 null 了)，pre 就是最后一个节点了。
function reverseList(ListNode $head) {
    $prev = null;
    $curr = $head;
    while ($curr){
        $next = $curr->next;
        $curr->next = $prev;
        $prev = $curr;
        $curr = $next;
    }
    return $prev;
}
//递归
function reverseList1($head){
    if($head == null || $head->next == null){
        return $head;
    }
    $reversedNode = reverseList1($head->next);
    $head->next->next = $head;
    $head->next = null;
    return $reversedNode;
}


function addDigits($num) {
    while(true){
        $data=str_split($num);//字符串分割成数组
        if(sizeof($data)==1)//判断数组长度
            return $data[0];
        $num=array_sum($data);;//数组加法
    }
}




class TreeNode {
     public $val = null;
     public $left = null;
     public $right = null;
     function __construct($val = 0, $left = null, $right = null) {
         $this->val = $val;
         $this->left = $left;
         $this->right = $right;
     }
 }

/**
 * //TODO
 * 给你一个二叉搜索树的根节点 root ，返回 树中任意两不同节点值之间的最小差值 。
 * https://leetcode-cn.com/problems/minimum-distance-between-bst-nodes/
输入：root = [4,2,6,1,3]
输出：1
 * @param $root
 * @author: Wu ChenHao
 * @Time: 2021/4/13 09:20
 */
function minDiffInBST(TreeNode $root) {

}

function minDiffInBST_dfs($val,$left,$right){
    if ($left->val !=null || $right != null){
        if ($left->val !=null ){
            $val<$left->val ? $left->val:$val;
        }
        if ($right != null ){
            $val<$right->val ? $left->val:$val;
        }
        return minDiffInBST_dfs($val,$left,$right);
    }
}

