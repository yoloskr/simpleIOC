<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 12:08
 */

namespace App\SimpleIOC;

interface UploadInterface
{

    public function upload($content);

    public function download();

}