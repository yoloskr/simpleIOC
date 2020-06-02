<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-10
 * Time: 18:05
 */
include './vendor/autoload.php';

use App\SimpleIOC\Container;
use App\SimpleIOC\ContainerPlus;


#
$moment = (new Container())->make('moment'); $moment->publish('moment');

var_dump((new Container())->make('test'));

var_dump((new ContainerPlus())->make('aliyun2'));
