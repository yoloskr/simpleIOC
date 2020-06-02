<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 11:27
 */

namespace App\Factory;


/**
 * 通过工厂来生成依赖对象，依赖关系从Moment依赖Aliyun变成 Moment依赖UploaderFactory,依赖从一对多到一对一
 * Class Moment
 */
class  Moment
{

    /**
     * 图片上传类
     * @var Aliyun|Qiniuyun
     */
    public $uploader;

    /**
     * 图片处理类
     * @var void
     */
    public $image;

    public function __construct()
    {
        $factory        = new Factory();
        $this->uploader = $factory->createUploader();
        $this->image    = $factory->createdImage();
    }

    public function publish($images)
    {
        $this->uploader->upload($images);
    }

    public function createdImage()
    {
        //todo
    }
}




/**
 *
 * 依赖的资源从"主动"自己创造到"被动"等待注入(依赖注入)
 *
 * Class Moment2
 */
class  Moment2
{

    public $uploader;

    public function __construct(UploadInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function publish($images)
    {
        $this->uploader->upload($images);
    }
}



