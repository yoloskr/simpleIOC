<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 11:45
 */

namespace App\Factory;

class  Factory {

    /**
     *  也可以从配置文件读取
     * @var string
     */
    public $upload_driver  = ['Aliyun','Qiniuyun'];
    public $upload_default =  'Aliyun';

    public function createUploader()
    {
        switch ($this->upload_default){
            case "Aliyun":
                return new Aliyun();
            case "Qiniuyun":
                return new QinNiuYun();
        }
    }

    public function createdImage()
    {
        //todo 返回图片对象
    }
}