<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class FileController extends Controller
{
    public function index()
    {
      // $text = 'John Doe\nJane Doe';
      // Storage::disk('local')->put('lorem.txt',$text);
      // Storage::disk('local')->append('lorem.txt','tes');
      File::put('lorem.txt',"Isi\ntes");
      // fopen("lorem.txt","w");
      // fwrite("lorem.txt","tes");
      // fclose("lorem.txt");
      // file_put_contents()
      // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
      // $txt = "Mickey Mouse\n";
      // fwrite($myfile, $txt);
      // $txt = "Minnie Mouse\n";
      // fwrite($myfile, $txt);
      // fclose($myfile);
      // file_put_contents('test.txt','Revando\nRevando');
      // File::put('test.txt','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
    }

    public function resizeImage($imagePath,$width,$height,$filterType,$blur,$bestFit,$cropZoom)
    {
      $imagick = new \Imagick(realpath($imagePath));

      $imagick->resizeImage($width,$height,$filterType,$blur,$bestFit);

      $cropWidth = $imagick->getImageWidth();
      $cropHeight = $imagick->getImageHeight();

      if ($cropZoom) {
        $newWidth = $cropWidth / 2;
        $newHeight = $cropHeight / 2;

        $imagick->cropImage(
          $newWidth,
          $newHeight,
          ($cropWidth - $newWidth) / 2,
          ($cropHeight - $newHeight) / 2
        );

        $imagick->scaleImage(
          $imagick->getImageWidth() * 4,
          $imagick->getImageHeight() * 4
        );
      }

      header("Content-Type: image/jpg");
      echo $imagick->getImageBlob();
    }

    public function callResizeImage()
    {
      $thumb = new Imagick('tes.jpg');
      $thumb->resizeImage(320,240,Imagick::FILTER_LANCZOS,1);
      $thumb->writeImage('tes-1.jpg');
      $thumb->destroy();
    }

    public function manualImageResize()
    {
      $filename = 'sample.png';
      $percent = 0.1;

      header('Content-Type: image/png');

      list($width, $height) = getimagesize($filename);
      $newwidth = $width * $percent;
      $newheight = $height * $percent;

      $thumb = imagecreatetruecolor($newwidth,$newheight);
      $source = imagecreatefrompng($filename);

      imagecopyresized($thumb,$source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
      imagepng($thumb,'revando-again.png');
      imagedestroy($thumb);
      // return $thumb;
      // File::put('revando.jpg',imagejpeg($thumb));
    }
}
