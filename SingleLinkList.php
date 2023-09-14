<?php
ini_set('display_errors','no');

class node{
    private $value;
    private $next;
    public function __construct($value=0,$next=null){
        $this->value=$value;
        $this->next=$next;
    }
    public function getValue(){
        return $this->value;
    }
    public function setValue($value){
        return $this->value=$value;
    }
    public function getNext(){
        return $this->next;
    }
    public function setNext($next){
        return $this->next=$next;
    }
}

/**
 * 颠倒节点
 * @param $node
 * @return mixed
 * @author: Wu ChenHao
 * @Time: 2021/4/12 10:59
 */
function reverse($node){
    if (null == $node || null == $node->getNext()) {
        return $node;
    }
    $reversednode = reverse($node->getNext());
    $node->getNext()->setNext($node);
    $node->setNext(null);
    return $reversednode;
}

/**
 * 新增节点
 * @param $node
 * @param $value
 * @param $position
 * @author: Wu ChenHao
 * @Time: 2021/4/12 11:00
 */
function insert($node,$value,$position){
    $tmp=$node;
    for($i=0;$i<$position;$i++){
        $tmp=$tmp->getNext();
    }
    $insertnode=new node($value);
    $insertnode->setNext($tmp->getNext());
    $tmp->setNext($insertnode);
}

/**
 * 删除节点
 * @param $node
 * @param $position
 * @author: Wu ChenHao
 * @Time: 2021/4/12 11:00
 */
function delete($node,$position){
    $tmp=$node;
    for($i=0;$i<$position;$i++){
        $tmp=$tmp->getNext();
    }
    $tmp->setNext($tmp->getNext()->getNext());
}
echo "<pre/>";
$node=new node();
$tmp=$node;
for($i=1;$i<3;$i++){
    $nextnode=new node($i);
    $tmp->setNext($nextnode);
    $tmp=$nextnode;
}
$node=reverse($node);
print_r($node);