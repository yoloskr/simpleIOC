<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 11:29
 */

namespace App\SimpleIOC;

class Qiniuyun implements UploadInterface
{

    public function upload($content)
    {
        echo "qin niu uploading\n";
    }

    public function download()
    {
        // TODO: Implement download() method.
    }
}