<?php
//创建画布
$width=130;
$height=50;
$image=imagecreatetruecolor($width, $height);
//创建颜色
	$_r=mt_rand(0,80);
	$_g=mt_rand(0,80);
	$_b=mt_rand(0,80);
$color=imagecolorallocate($image, $_r,$_g, $_b);
//填充画布区域
imagefill($image, 0, 0, $color);
//随机生成字符串
$length=5;
$string='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456798';
$word='';
for($i=0;$i<$length;$i++)
{
	$x=mt_rand(0,61);
	$word.=$string[$x];
}


//像画布中写字
$fontFile='psv.ttf';
$text='hell word!';

for ($i=0; $i <$length ; $i++) 
{	$_r=mt_rand(128,255);
	$_g=mt_rand(128,255);
	$_b=mt_rand(128,255);
	$angle=mt_rand(-30,30);
	$size=mt_rand(20,30);
	$fontcolor=imagecolorallocate($image,$_r, $_g, $_b);
	imagettftext($image, $size,$angle, ($i+1)*15, 36, $fontcolor, $fontFile, $word[$i]);
	
}

//参数1：画布； 
//参数2：字体大小；
//参数3：旋转角度；0代表不旋转
//参数4和参数5;第一个字符的左下角坐标；
//参数6：字体颜色;
//参数7：字体文件
//参数8：字体内容
/**********画点**************/
//先指定颜色
$white=imagecolorallocate($image,255,255,255);
//随机画1W个点
for($i=0;$i<30;$i++)
{
	//mt_rand(最小,最大);
	$x=mt_rand(0,$width);
	$y=mt_rand(0,$height);
	imagesetpixel($image, $x, $y, $white);
}
/*********画矩形**************************/
/*$pointcount=mt_rand(3,10);

$points=[];//点的空数组

for($i=0;$i<$pointcount;$i++)
{
	$x=mt_rand(0,$width);
	$y=mt_rand(0,$height);
	$points[]=$x;
	$points[]=$y;
}
imagepolygon($image, $points, $pointcount, $white);*/

/**************画弧形**************************/


$r=$width/2 - $width/32 ; //radius
$cx=$width/2;
$cy=$height/2;

$black_1 = imagecolorallocate($image, 255, 255, 255);
// 画一个黑色的圆
imagearc($image, $cx, $cy, $r, $r,0, 120, $black_1);

/******申明文件*************/
header('content-type:image/png');
//输出文件
imagepng($image);
imagepng($image,'./1.png');

