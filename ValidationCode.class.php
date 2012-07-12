<?php
/* 
 * /**
 * Micoolcoder
 *
 * An open source application development framework for PHP 5.2.1 or newer
 *
 * @package	    sadecode	 
 * @author	    micool	
 * @copyright	    micool.cn
 * @mail            micool@micool.cn
 * @license		http://app.micool.cn/php/guide/license.html
 * @link		http://app.micool.cn/php
 * @filesource  ValidationCode.class.php
 * @version         1.0 
 **********************************************************************************
 * defined this active
 * ValidationCode  class   类名
 * 字串：VC_Str
 * 字体大小：VC_FontSize   字体大小
 * 字符长度：VC_FontLen     字符长度 4-6个
 * 字体颜色：VC_FontColor   颜色 一致  随机
 * 排列方式：VC_FontAlign   正常排列  不规则排列
 * 背景图片：VC_BackGround  随机背景  固定图片库背景
 * 图片大小：VC_ImgSize_W  宽
 * 图片大小：VC_ImgSize_H  高
 * 是否开启干扰：VC_Switch  0 为关闭  D为加点  R为加圆弧  L加线条  X混色  G英文与数字中是否整齐排列
 * 舍去不再随机列的数据：VC_Delstr
 * 杂点数量：VC_Dott
 * 线条数量：VC_Line
 * 是否自动大小字体：$VC_Autosize
 * 图片输出格式：VC_ImgType  png jpeg gif
 * 服务器变量存储：VC_SessionDir 
                  VC_SessionName 
                  VC_SessionTime 
 ****************************************************************
 */
if (! defined ( 'IN_SYS' ))
	die ( 'Charles is no such page!' );
	
/*
 *---------------------------------------------------------------
 * PHP ERROR REPORTING LEVEL
 *---------------------------------------------------------------
 *
 */

error_reporting ( E_ALL );//错误调试
define('Safe_Code_sThis_Path', ereg_replace ( "[/\\]{1,}", '/',  dirname ( __file__ ) ));
class validationSafeCode {
	var $VC_Str;
	var $VC_Font;
	var $VC_FontSize;
	var $VC_FontLen;
	var $VC_FontColor;
	var $VC_FontAlign;
	var $VC_BackGround;
	var $VC_ImgSize_W;
	var $VC_ImgSize_H;
	var $VC_ImgType;
	var $VC_Switch;
	var $VC_Dott;
	var $VC_Line;
	var $VC_Autosize;
	var $VC_Delstr;
	var $VC_SessionDir;
	var $VC_SessionName;
	var $VC_SessionTime;
	
	function __construct($SessionSavePath='') {
		$this->CLength ();
	}
	/*
	 * Enter config here...
	 */
	public function SetCon($C_type, $C_fontsize = 12, $C_fontLength, $C_font, $C_fontcolor, $C_fontalign, $C_background, $C_S_W, $C_S_H, $C_imgtype, $C_Switch, $C_Dott, $C_Line, $C_Autosize, $C_Delstr, $C_SessionDir, $C_SessionName, $C_SessionTime) {
		$this->VC_Str = $C_type;
		$this->VC_Font = $C_font;
		$this->VC_FontSize = $C_fontsize;
		$this->VC_FontLen = $C_fontLength;
		$this->VC_FontColor = $C_fontcolor;
		$this->VC_FontAlign = $C_fontalign;
		$this->VC_BackGround = $C_background;
		$this->VC_ImgSize_W = $C_S_W <= 0 ? 80 : $C_S_W;
		$this->VC_ImgSize_H = $C_S_H <= 0 ? 30 : $C_S_H;
		$this->VC_ImgType = $C_imgtype;
		$this->VC_Switch = $C_Switch;
		$this->VC_Dott = $C_Dott;
		$this->VC_Line = $C_Line;
		$this->VC_Autosize = $C_Autosize;
		$this->VC_Delstr = $C_Delstr;
		$this->VC_SessionDir = $C_SessionDir;
		$this->VC_SessionName = $C_SessionName;
		$this->VC_SessionTime = $C_SessionTime;
	}
	/*
	 * 长度
	 */
	public function CLength() {
		if (is_int ( $this->VC_FontLen )) {
			if ($this->VC_FontLen <= 0) {
				$this->VC_FontLen = 3;
			}
		}
		return $this->VC_FontLen;
	}
	
	/*
     * 字体大小
     */
	public function CFontsize() {
		if (is_int ( $this->VC_FontSize )) {
			return $this->VC_FontSize;
		} else {
			return $this->VC_FontLen = 12;
		}
	
	}
	
	/*
     * 共5个字体提供选择 
     * 1.宋体 2.黑体 3.微软雅黑 4.ARBLI 5.Alabama  后2个英文字体
     */
	function Cfont() {
		$dir = Safe_Code_sThis_Path. '/font/';
		switch ($this->VC_Font) {
			case 1 :
				$fontdirname = 'simsun.ttc';
				break;
			case 2 :
				$fontdirname = 'STKAITI.TTF';
				break;
			case 3 :
				$fontdirname = 'msyh.ttf';
				break;
			case 4 :
				$fontdirname = 'cosmicaldisfase.ttf';
				break;
			case 5 :
				if ($this->VC_Str !== 'CS' && $this->VC_Str !== 'CT') {
					$fontdirname = 'ARBLI.TTF';
				} else {
					$fontdirname = 'simsun.ttc';
				}
				break;
			case 6 :
				if ($this->VC_Str !== 'CS' && $this->VC_Str !== 'CT') {
					$fontdirname = 'Alabama.TTF';
				} else {
					$fontdirname = 'simsun.ttc';
				}
				break;
			default :
				$fontdirname = 'simsun.ttc';
				break;
		
		}
		return $dir . $fontdirname;
	}
	/*
     * 
     */
	public function select_type() {
		//CS=Chinese Simplified,CT=Chinese Traditional,E=English,D=Digital
		switch ($this->VC_Str) {
			case 'CS' :
				require 'ZhStr.php';
				$The_Str = $Ch_Simplified;
				break;
			case 'CT' :
				require 'ZhStr.php';
				$The_Str = $Ch_Traditional;
				break;
			case 'E' :
				$The_Str = 'ENA';
				break;
			case 'e' :
				$The_Str = 'ENB';
				break;
			case 'D' :
				$The_Str = 'DIG';
				break;
			case 'Ee' :
				$The_Str = 'ENL';
				break;
			case 'EeD' :
				$The_Str = 'ALL';
				break;
			case 'ED' :
				$The_Str = 'EAD';
				break;
			case 'eD' :
				$The_Str = 'EBD';
				break;
			case 'EUD' :
				$The_Str = 'EUD';
				break;
			default :
				$The_Str = 'DIG';
				break;
		}
		return $The_Str;
	}
	
	/*
	 * 颜色配置
	 */
	function FontColor() {
		if ($this->VC_FontColor == 'X') {
			return $this->randcolor ();
		} elseif (Checkcolor ( $this->VC_FontColor )) {
			return color2rgb ( $this->VC_FontColor );
		} else {
			return "0x00,0x00,0x00";
		}
	}
	
	/*
	 * 字排序
	 */
	function Fontalign() {
		if (empty ( $this->VC_FontAlign ) || is_int ( $this->VC_FontAlign )) {
			return $this->VC_FontAlign;
		} else {
			return 0;
		}
	}
	
	/*
	 * 背景
	 */
	function Background() {
		if (Checkcolor ( $this->VC_BackGround )) {
			return color2rgb ( $this->VC_BackGround );
		} elseif ($this->VC_BackGround == 'img') {
			return rand ( 1, 10 );
			//return color2rgb($this->VC_BackGround);
		} elseif ($this->VC_BackGround == 'X') {
			return mt_rand ( 0, 255 ) . ',' . mt_rand ( 0, 255 ) . ',' . mt_rand ( 0, 255 );
			//return color2rgb($this->VC_BackGround);
		} else {
			return color2rgb ( '#ffffff' );
		}
	}
	
	/*
	 * 宽度
	 */
	function Imgwidth() {
		return $this->VC_ImgSize_W;
	}
	
	/*
	 * 高度
	 */
	function Imgheight() {
		return $this->VC_ImgSize_H;
	}
	
	/*
	 * 图片格式 gif jpg png
	 */
	function ImgType() {
		$type = array ('gif', 'png', 'jpg' );
		if (in_array ( $this->VC_ImgType, $type )) {
			return $this->VC_ImgType;
		} else {
			return 'png';
		}
	}
	
	function ArrColor($str) {
		return explode ( ',', $str );
	}
	
	/*
	 * 随机颜色
	 */
	function randcolor() {
		$colorarr = array ('#000000', '#663300', '#993399', '#FF3300', '#999999', '#9966FF', '#0000FF', '#339900', '#CC6633', '#CC9999', '#666600', '#990000', '#FFFF00', '#9999CC', '#3333CC', '#CCCCCC' );
		return color2rgb ( $colorarr [rand ( 0, 15 )] );
	}
	
	function Autosize() {
		if (empty ( $this->VC_Autosize ) || is_int ( $this->VC_Autosize )) {
			$toszie = abs ( $this->VC_Autosize );
			$tosize = $toszie > 5 ? rand ( $this->CFontsize () - rand ( 1, 3 ), $this->CFontsize () + rand ( 1, 3 ) ) : rand ( $this->CFontsize () - rand ( 1, $toszie ), $this->CFontsize () + rand ( 1, $toszie ) );
			return $tosize;
		} else {
			return $this->CFontsize ();
		}
	}
	
	/*
    * 产生随机字符串
   */
	function RandStr($len = 6, $format = 'ALL', $Isolation) {
		switch ($format) {
			case 'ALL' :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				break;
			case 'ENL' :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
				break;
			case 'DIG' :
				$chars = '0123456789';
				break;
			case 'ENA' :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'EAD' :
				$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
				break;
			case 'ENB' :
				$chars = 'abcdefghijklmnopqrstuvwxyz';
				break;
			case 'EBD' :
				$chars = 'abcdefghijkmnpqrstuvwxyz123456789';
				break;
			default :
				$chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'; //排除某些干扰类的数字与字母
				break;
		}
		
		// print_r($StrDiscard);
		if (isset ( $Isolation ) && ! empty ( $Isolation )) {
			$StrDiscard = array ();
			for($i = 0; $i < strlen ( $Isolation ); $i += 1) {
				$StrDiscard [] = $Isolation [$i];
			}
			$chars = str_replace ( $StrDiscard, '', $chars );
		}
		
		$string = "";
		while ( strlen ( $string ) < $len )
			$string .= substr ( $chars, (mt_rand () % strlen ( $chars )), 1 );
		return $string;
	}
	
	function ODRLX($STR, $FOR) {
		if (preg_match ( "/^([$STR])/", $FOR ))
			return true;
		
		return false;
	
	}
	
	function easy_color($img) {
		return imagecolorallocate ( $img, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) );
	}
	/*
	 * 中文验证码
	 */
	function Chinese() {
		if (is_writeable ( $this->VC_SessionDir ) && is_readable ( $this->VC_SessionDir )) {
			session_save_path ( $this->VC_SessionDir );
		} else {
			session_save_path ( Safe_Code_sThis_Path . '/temp' );
		}
		//session_start ();
		session_register ( $this->VC_SessionName );
		//session_register ( $this->VC_SessionName . 'time' );
		

		// 新建一个基于调色板的图像
		header ( "Content-type: image/" . $this->ImgType () );
		$im = imagecreate ( $this->Imgwidth (), $this->Imgheight () );
		//这里取背景颜色
		

		if ($this->VC_BackGround == 'img') {
			$source = imagecreatefrompng ( Safe_Code_sThis_Path. '/img/' . $this->Background () . '.png' );
			imagecopyresized ( $im, $source, 0, 0, 0, 0, $this->Imgwidth (), $this->Imgheight (), $this->Imgwidth (), $this->Imgheight () );
		} else {
			$bkgarr = $this->ArrColor ( $this->Background () );
			ImageColorAllocate ( $im, $bkgarr [0], $bkgarr [1], $bkgarr [2] );
		}
		
		//显示的字体样式
		//        $thefont='font/'.$this->Cfont();
		$thefontsize = $this->CFontsize ();
		// 为图像分配一些颜色
		// $Colorarr = $this->ArrColor($this->randcolor());
		// $white=ImageColorAllocate($im,$Colorarr[0],$Colorarr[1],$Colorarr[2]);
		// 2种随机颜色 
		$Colorarr = $this->ArrColor ( $this->randcolor () ); //固定组色
		$the_color = imagecolorallocate ( $im, $Colorarr [0], $Colorarr [1], $Colorarr [2] );
		
		$easy_color = imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) );
		
		//字体颜色
		$fontColor = $this->ArrColor ( $this->FontColor () );
		$font_color = imagecolorallocate ( $im, $fontColor [0], $fontColor [1], $fontColor [2] );
		
		//   D为加点  R为加圆弧  L加线条 X混色
		if ($this->ODRLX ( $this->VC_Switch, 'R' )) {
			//在图片上画椭圆弧,指定下坐标点
			$imagearccolora = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $easy_color;
			$imagearccolorb = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $imagearccolora;
			$imagearccolorc = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $imagearccolora;
			imagearc ( $im, $this->Imgwidth () / 2, $this->Imgheight () / 2, $this->Imgwidth () / 3, $this->Imgheight () / 3, rand ( 0, 180 ), rand ( 190, 360 ), $imagearccolora );
			imagearc ( $im, $this->Imgwidth () / 3, $this->Imgheight () / 3, $this->Imgwidth () / 4, $this->Imgheight () / 4, rand ( 50, 140 ), rand ( 150, 360 ), $imagearccolorb );
			imagearc ( $im, $this->Imgwidth () / 2, $this->Imgheight () / 3, $this->Imgwidth () / 4, $this->Imgheight () / 3, rand ( 22, 123 ), rand ( 150, 280 ), $imagearccolorc );
		}
		
		//乱点的数量
		$noise_num = $this->VC_Dott;
		//干扰线数量
		$line_num = $this->VC_Line;
		
		//在一个坐标点上画一个单一像素,这个点上面定义了，颜色随机。
		if ($this->ODRLX ( $this->VC_Switch, 'D' )) {
			for($i = 0; $i < $this->VC_Dott; $i ++) {
				$imagesetpixelcolor = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $the_color;
				imagesetpixel ( $im, mt_rand ( 0, $this->Imgwidth () ), mt_rand ( 0, $this->Imgheight () ), $imagesetpixelcolor );
			}
		}
		
		//在两个坐标点间画一条线，颜色在上面定义
		if ($this->ODRLX ( $this->VC_Switch, 'L' )) {
			for($i = 0; $i < $this->VC_Line; $i ++) {
				$imagelincolor = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $the_color;
				imageline ( $im, mt_rand ( 0, $this->Imgwidth () ), mt_rand ( 0, $this->Imgheight () ), mt_rand ( 0, $this->Imgwidth () ), mt_rand ( 0, $this->Imgheight () ), $imagelincolor );
			}
		}
		
		//中文编码  的汉字UTF-8编码下是3个字节
		$str = array ();
		$strin = $this->select_type ();
		for($i = 0; $i < strlen ( $strin ); $i += 3) {
			$str [] = $strin [$i] . $strin [$i + 1] . $strin [$i + 2];
		}
		
		$randnum = rand ( 0, count ( $str ) - $this->CLength () );
		
		//保持是偶数
		if ($randnum % 2) {
			$randnum += 1;
		}
		
		$sessionname = '';
		for($i = 0; $i < $this->CLength (); $i ++) {
			$font_color_for = ($this->ODRLX ( $this->VC_Switch, 'C' )) ? imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) ) : $font_color;
			ImageTTFText ( $im, $this->Autosize (), $this->Fontalign (), rand ( ($this->Imgwidth () / $this->CLength ()) * $i + $this->Imgwidth () / ($this->CLength () * 3), ($this->Imgwidth () / $this->CLength ()) * $i + $this->Imgwidth () / ($this->CLength () * 3) ), rand ( $this->Imgheight () / 2 + $this->Imgheight () / 10, $this->Imgheight () / 2 + $this->Imgheight () / 5 ), $font_color_for, $this->Cfont (), $str [$randnum + $i] );
			$sessionname .= $str [$randnum + $i];
		}
		
		$_SESSION [$this->VC_SessionName] = $sessionname;
		//$_SESSION [$this->VC_SessionName . 'time'] = $this->VC_SessionTime + time ();
		

		//参照格式输出
		$ImageFun = 'Image' . $this->ImgType ();
		$ImageFun ( $im );
		@ImageDestroy ( $im );
	}
	
	/*
	 * 英文数字验证码
	 */
	function EnglishDig() {
		if (is_writeable ( $this->VC_SessionDir ) && is_readable ( $this->VC_SessionDir )) {
			session_save_path ( $this->VC_SessionDir );
		} else {
			session_save_path (Safe_Code_sThis_Path.'/temp' );
		}
		//session_start ();
		session_register ( $this->VC_SessionName );
		//session_register ( $this->VC_SessionName . 'time' );
		

		header ( "Content-type: image/" . $this->VC_ImgType );
		$im = imagecreate ( $this->Imgwidth (), $this->Imgheight () );
		
		if ($this->VC_BackGround == 'img') {
			$source = imagecreatefrompng ( Safe_Code_sThis_Path . '/img/' . $this->Background () . '.png' );
			imagecopyresized ( $im, $source, 0, 0, 0, 0, $this->Imgwidth (), $this->Imgheight (), $this->Imgwidth (), $this->Imgheight () );
		} else {
			$bkgarr = $this->ArrColor ( $this->Background () );
			ImageColorAllocate ( $im, $bkgarr [0], $bkgarr [1], $bkgarr [2] );
		}
		
		//2种随机颜色 
		$Colorarr = $this->ArrColor ( $this->randcolor () ); //固定组色
		$the_color = imagecolorallocate ( $im, $Colorarr [0], $Colorarr [1], $Colorarr [2] );
		
		$easy_color = imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) );
		
		//字体颜色
		$fontColor = $this->ArrColor ( $this->FontColor () );
		$font_color = imagecolorallocate ( $im, $fontColor [0], $fontColor [1], $fontColor [2] );
		//$textcolor = imagecolorallocate($im, 0, 0, 255);
		

		//   D为加点  R为加圆弧  L加线条 X混色 G作用与英文数字 提高排列复杂度 C字符表示混搭颜色
		if ($this->ODRLX ( $this->VC_Switch, 'R' )) {
			//在图片上画椭圆弧,指定下坐标点
			$imagearccolora = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $easy_color;
			$imagearccolorb = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $imagearccolora;
			$imagearccolorc = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $imagearccolora;
			imagearc ( $im, $this->Imgwidth () / 2, $this->Imgheight () / 2, $this->Imgwidth () / 3, $this->Imgheight () / 3, rand ( 0, 180 ), rand ( 190, 360 ), $imagearccolora );
			imagearc ( $im, $this->Imgwidth () / 3, $this->Imgheight () / 3, $this->Imgwidth () / 4, $this->Imgheight () / 4, rand ( 50, 140 ), rand ( 150, 360 ), $imagearccolorb );
			imagearc ( $im, $this->Imgwidth () / 2, $this->Imgheight () / 3, $this->Imgwidth () / 4, $this->Imgheight () / 3, rand ( 22, 123 ), rand ( 150, 280 ), $imagearccolorc );
		}
		
		//在一个坐标点上画一个单一像素,这个点上面定义了，颜色随机。
		if ($this->ODRLX ( $this->VC_Switch, 'D' )) {
			for($i = 0; $i < $this->VC_Dott; $i ++) {
				$imagesetpixelcolor = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $the_color;
				imagesetpixel ( $im, mt_rand ( 0, $this->Imgwidth () ), mt_rand ( 0, $this->Imgheight () ), $imagesetpixelcolor );
			}
		}
		
		//在两个坐标点间画一条线，颜色在上面定义
		if ($this->ODRLX ( $this->VC_Switch, 'L' )) {
			for($i = 0; $i < $this->VC_Line; $i ++) {
				$imagelincolor = ($this->ODRLX ( $this->VC_Switch, 'X' )) ? $this->easy_color ( $im ) : $the_color;
				imageline ( $im, mt_rand ( 0, $this->Imgwidth () ), mt_rand ( 0, $this->Imgheight () ), mt_rand ( 0, $this->Imgwidth () ), mt_rand ( 0, $this->Imgheight () ), $imagelincolor );
			}
		}
		
		//G只做用与数字与英文，G表示提高排列复杂
		$sessionname = '';
		if ($this->ODRLX ( $this->VC_Switch, 'G' )) {
			
			for($i = 0; $i < $this->CLength (); $i ++) {
				$font_color_for = ($this->ODRLX ( $this->VC_Switch, 'C' )) ? imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) ) : $font_color;
				$C_RandStrG = $this->RandStr ( 1, $this->select_type (), $this->VC_Delstr );
				ImageTTFText ( $im, $this->Autosize (), $this->Fontalign (), rand ( ($this->Imgwidth () / $this->CLength ()) * $i + $this->Imgwidth () / ($this->CLength () * 8), ($this->Imgwidth () / $this->CLength ()) * $i + $this->Imgwidth () / ($this->CLength () * 5) ), rand ( $this->Imgheight () / 2 + $this->Imgheight () / 8, $this->Imgheight () / 2 + $this->Imgheight () / 3 ), $font_color_for, $this->Cfont (), $C_RandStrG );
				$sessionname .= $C_RandStrG;
			}
		} else {
			$C_RandStr = $this->RandStr ( $this->CLength (), $this->select_type (), $this->VC_Delstr );
			@imagestring ( $im, $this->Autosize () / 2, $this->Imgwidth () / $this->CLength (), $this->Imgheight () / 4, $C_RandStr, $font_color );
			$sessionname = $C_RandStr;
		}
		
		$_SESSION [$this->VC_SessionName] = $sessionname;
		//$_SESSION [$this->VC_SessionName . 'time'] = $this->VC_SessionTime + time ();
		//参照格式输出
		$ImageFun = 'Image' . $this->VC_ImgType;
		$ImageFun ( $im );
		@ImageDestroy ( $im );
	
	}
	
	function SafeCode() {
		if ($this->VC_Str == 'CS' || $this->VC_Str == 'CT') {
			$this->Chinese ();
		} else {
			$this->EnglishDig ();
		}
	}
	
	function __destruct() {
		
		$this->VC_Str = '';
		$this->VC_Font = '';
		$this->VC_FontSize = '';
		$this->VC_FontLen = '';
		$this->VC_FontColor = '';
		$this->VC_FontAlign = '';
		$this->VC_BackGround = '';
		$this->VC_ImgSize_W = '';
		$this->VC_ImgSize_H = '';
		$this->VC_ImgType = '';
		$this->VC_Switch = '';
		$this->VC_Dott = '';
		$this->VC_Line = '';
		$this->VC_Autosize = '';
		$this->VC_Delstr = '';
	}
}

/*
  * PHP下16进制的颜色判断
  */
function Checkcolor($Colorsixth) {
	if (preg_match ( "/^\#([A-Fa-f0-9]{2})([A-Fa-f0-9]{2})([A-Fa-f0-9]{2})/", $Colorsixth ))
		return true;
	return false;
}

/*
  * PHP下16进制的颜色转RGB
  */
function getrgb($matches) {
	// return "(".intval($matches[1],16).",".intval($matches[2],16).",".intval($matches[3],16).")";
	return intval ( $matches [1], 16 ) . "," . intval ( $matches [2], 16 ) . "," . intval ( $matches [3], 16 );
}
/*
 * #FFFFFF->255,255,255
 */
function color2rgb($value) {
	
	if (preg_match ( "/^\#[A-F]{6}$/i", $value )) {
		
		return preg_replace_callback ( "/^\#([A-Fa-f]{2})([A-Fa-f]{2})([A-Fa-f]{2})/i", "getrgb", $value );
	
	} else {
		return preg_replace_callback ( "/^\#([A-Fa-f0-9]{2})([A-Fa-f0-9]{2})([A-Fa-f0-9]{2})/i", "getrgb", $value );
		// return false;
	

	}
}

?>