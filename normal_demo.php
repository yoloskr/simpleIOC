<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-10
 * Time: 17:05
 */
include './vendor/autoload.php';


use App\Normal\Moment;

//正常模式，自己解决自己的依赖，需要什么类，自己new
$moment  = new Moment();  echo $moment->publish('moment image');


