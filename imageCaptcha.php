<?php
/**
 * Created by PhpStorm.
 * User: pushaowei
 * Date: 2016/9/17 0017
 * Time: 18:55
 */
class Imagecode{

	private $width ;
	private $height;
	private $counts;
	private $distrubcode;
	private $fonturl;
	private $session;

	const FONTURL  = "./psv.ttf"; 	//字体包
	const FONT_MIN = 30; 			//字体最小
	const FONT_MAX = 35;  			//字体最大

	const WIDTH    = 130;
	const HEIGHT   = 50;
	const COUNTS   = 4;

	const STRINGS  = '"1235467890qwertyuipkjhgfdaszxcvbnm';

	function __construct(){

		$this->width=Imagecode::WIDTH;
		$this->height=Imagecode::HEIGHT;
		$this->counts=Imagecode::COUNTS;
		$this->distrubcode=Imagecode::STRINGS;
		$this->fonturl=Imagecode::FONTURL;
		$this->session=$this->sessioncode();
		session_start();
		$_SESSION['code']=$this->session;
	}
	
	 function imageout(){

		$im=$this->createimagesource();
		$this->setbackgroundcolor($im);
		$this->set_code($im);
		$this->setdistrubecode($im);
		ImageGIF($im);
		ImageDestroy($im); 
	}
	
	private function createimagesource(){
		return imagecreate($this->width,$this->height);
	}
	private function setbackgroundcolor($im){

		$bgcolor = ImageColorAllocate($im, 255,255,255);//背景色
		//$bgcolor = ImageColorAllocate($im, rand(200,255),rand(200,255),rand(200,255));
		imagefill($im,0,0,$bgcolor);
	}
	private function setdistrubecode($im){

		$count_h=$this->height;
		$cou=floor($count_h*2);
		for($i=0;$i<$cou;$i++){
			$x=rand(0,$this->width);
			$y=rand(0,$this->height);
			$jiaodu=rand(0,180);
			$fontsize=rand(1,8);			
			$fonturl=$this->fonturl;
			$originalcode = $this->distrubcode;
			$countdistrub = strlen($originalcode);
			$dscode = $originalcode[rand(0,$countdistrub-1)];
			$_r=mt_rand(150,255);
			$_g=mt_rand(150,255);
			$_b=mt_rand(150,255);

			$color = ImageColorAllocate($im, $_r,$_g,$_b);
			imagettftext($im,$fontsize,$jiaodu,$x,$y,$color,$fonturl,$dscode);
		}
	}
	private function set_code($im){

		$width=$this->width;
		$counts=$this->counts;
		$height=$this->height;
		$scode=$this->session;
		$y=floor($height/2)+floor($height/4);
		$fontsize=rand(Imagecode::FONT_MIN,Imagecode::FONT_MAX);
		$fonturl=$this->fonturl;
		
		$counts=$this->counts;
		for($i=0;$i<$counts;$i++){
			$char=$scode[$i];
			$x=floor($width/$counts)*$i+8;
			$jiaodu=rand(-20,30);			
			$_r=mt_rand(128,255);
			$_g=mt_rand(128,255);
			$_b=mt_rand(128,255);
			$color = ImageColorAllocate($im, $_r,$_g,$_b);
			//$color = ImageColorAllocate($im,rand(0,50),rand(50,100),rand(100,140));
			imagettftext($im,$fontsize,$jiaodu,$x,$y,$color,$fonturl,$char);
		}		
	}
	private function sessioncode(){

		$originalcode = $this->distrubcode;
		$countdistrub = strlen($originalcode);
		$_dscode = "";
		$counts=$this->counts;
		for($j=0;$j<$counts;$j++){
			$dscode = $originalcode[rand(0,$countdistrub-1)];
			$_dscode.=$dscode;
		}
		return $_dscode;
	}
}
	Header("Content-type: image/GIF");
	$imagecode=new  Imagecode(160,50);
	$imagecode->imageout();