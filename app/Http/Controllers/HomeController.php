<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Timer;

class HomeController extends Controller
{
    //

    public function anyTest(){

        echo $_GET['name'] ?? 'NULL';

    }

    public function test(){
        echo 'tes';
    }

    public function Home(){
        Timer::getInstance()->start();

        for($i=0;$i<1000000;$i++){}

        echo Timer::getInstance()->stop();
        dd(route('testx'));
    }
}
