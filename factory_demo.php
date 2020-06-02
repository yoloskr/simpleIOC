<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-10
 * Time: 17:05
 */
include './vendor/autoload.php';


use App\Factory\Moment;
use App\Factory\Moment2;
use App\Factory\Factory;


//依赖工厂类上传图片
$moment = new Moment(); echo  $moment->publish('moment');


//通过"依赖注入"的方式得到上传"对象"上传图片
$uploader = (new Factory())->createUploader();
$moment = new Moment2($uploader); echo $moment->publish('moment2');


