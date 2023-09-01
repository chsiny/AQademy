<?php namespace App\Models;
//Week 6
use CodeIgniter\Model;

class ImageModel extends Model {

    protected $allowedFields = ['filename', 'path'];

    // Crop image
    public function crop($path, $filename) {
        echo $path, $filename;
        $imagick = new \Imagick($path.$filename);
        $width = $imagick->getImageWidth();
        $height = $imagick->getImageHeight();
        $imagick->cropImage($width/2, $height/2, $width/4, $height/4);
        //echo str_replace('jpeg','crop.jpeg',$filename);
        $imagick->writeImage($path.'crop_'.$filename);
        $imagick->clear();
        $imagick->destroy();
        return 'crop_'.$filename;
    }

    // Resize image
    public function resize($filename, $width, $height) {
      // add your code here
    }

    // Rotate image
    public function rotate($path,$filename, $degrees=180) {
        $imagick = new \Imagick($path.$filename);
        $imagick->rotateImage(new \ImagickPixel(), $degrees);
        $imagick->writeImage($path.'rot_'.$filename);
        $imagick->clear();
        $imagick->destroy();
        return 'rot_'.$filename;
    }

    // Flip image
    public function flip($filename, $flip) {
        // add your code here
    }

    // Add text watermark
    public function addTextWatermark($path, $filename) {
        // add your code here
    }

}
