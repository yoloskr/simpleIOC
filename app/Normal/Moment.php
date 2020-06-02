<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 11:27
 */


namespace App\Normal;

/**
 * 典型的A类依赖B类时，由A类"主动"创建B，解决依赖关系问题
 * Class Moment
 */
class  Moment {

    public $uploader;

    public function __construct()
    {
        $this->uploader     = new Aliyun();
        $this->imageHandler = new Image();

    }

    public function publish($images)
    {
        $images = $this->imageHandler($images);
        $this->uploader->upload($images);
    }
}
/**
 * 问题
 * 1.如果从阿里云切到七牛云怎么办？很多类里面都使用这中方式，要改很多类
 * 2.Aliyun类有依赖怎么办？比如构造方法需要传参数，Moment类是不是还要关心Aliyun类需要什么依赖？
 */