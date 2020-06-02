<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 11:27
 */

namespace App\SimpleIOC;

/**
 * Class Moment
 */
class  Moment
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




