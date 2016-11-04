<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/4/2016
 * Time: 4:03 PM
 */
namespace core\lib;

class ValidateCode {
    private $code;       //验证码
    private $codeLen = 6;     //验证码长度
    private $width = 150;     //宽度
    private $height = 50;     //高度
    private $img;        //图形资源句柄
    private $fontSize = 18;    //指定字体大小
    private $fontColor;      //指定字体颜色
    public function __construct() {
        $this->font ='./core/lib/font/ALGER.TTF';
    }
    private function createCode() {

        for ($i = 0; $i < $this->codeLen; $i++)
        {
            $num=mt_rand(1,3);
            if ($num==1)
            {
                $this->code .= chr(mt_rand(48,57));
            }
            else if ($num==2)
            {
                $this->code .= chr(mt_rand(65,90));
            }
            else
            {
                $this->code .= chr(mt_rand(97,122));
            }

        }
    }
    private function createBg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
    }
    private function createStr() {
        for ($i=0;$i<$this->codeLen;$i++)
        {
            $this->fontColor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img,$this->fontSize,mt_rand(-20,20),$i*25,$this->height / 1.5,$this->fontColor,$this->font,$this->code[$i]);
        }

    }
    private function createLine() {
        for ($i=0;$i<10;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
        }
        for ($i=0;$i<100;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }
    private function outPut() {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }
    public function doImg($len) {
        if ($len<=6&&$len>=4)
        {
            $this->codeLen=$len;
            $this->width=$len*25;
            $this->createBg();
            $this->createCode();
            $this->createLine();
            $this->createStr();
            $this->outPut();
        }
        else
        {
            exit();
        }

    }
    public function getCode() {
        return strtolower($this->code);
    }

}
