<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 11:29
 */

namespace App\Factory;

class Aliyun  implements UploadInterface
{

    public function upload($content)
    {
        echo "ali uploaded $content\n";
    }

    public function download()
    {
        // TODO: Implement download() method.
    }
}