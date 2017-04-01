<?php
namespace App\Services;

//生命一个计算脚本运行时间的类
class Timer{

    private $startTime  = 0; //保存脚本开始执行时的时间（以微秒的形式保存）

    private $stopTime   = 0; //保存脚本结束执行时的时间（以微秒的形式保存）

    private $spent = 0.00;

    private static $_instance  = NULL;

    private function __construct(){ }

    private function __clone(){}

    public static function getInstance(){
        if(is_null(self::$_instance) || !(self::$_instance instanceof self)){
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    //在脚本开始处调用获取脚本开始时间的微秒值
    public function start(){
        $this->startTime = microtime(true); //将获取的时间赋值给成员属性$startTime
    }

    //脚本结束处嗲用脚本结束的时间微秒值
    public function stop(){
        $this->stopTime = microtime(true); //将获取的时间赋给成员属性$stopTime
        $this->spent = round(($this->stopTime-$this->startTime),4); //计算后4舍5入保留4位返回

        return $this->spent;
    }

    //返回同一脚本中两次获取时间的差值
    private function spent(){
        return $this->spent;
    }
}

/* example
use App\Services\Timer;

Timer::getInstance()->start();

for($i=0;$i<100000;$++){}

// The first way :
$usage = Timer::getInstance()->stop();
echo "执行该脚本用时<b>".$usage."</b>";

//OR the second way:
Timer::getInstance()->stop();
echo "执行该脚本用时<b>" . Timer::getInstance()->spent() . "</b>";

*/


?>