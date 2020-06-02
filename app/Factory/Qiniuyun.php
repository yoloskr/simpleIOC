<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 11:29
 */

namespace App\Factory;

class QinNiuYun implements UploadInterface
{

    public function upload($content)
    {
        echo 'qin niu uploading';
    }

    public function download()
    {
        // TODO: Implement download() method.
    }
}