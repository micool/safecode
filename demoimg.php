<?php
/*
 *  * Micoolcoder
 *
 * An open source application development framework for PHP 5.2.1 or newer
 *
 * @package	    system/sadecode	 
 * @author	    micool	
 * @copyright	    micool.cn
 * @mail            micool@micool.cn
 * @license		http://app.micool.cn/php/guide/license.html
 * @link		http://app.micool.cn/php
 * @version         1.0 
 * *********************************************************************************
 * 参数说明：
 * 第一个参数
 * CS:简体中文
 * CT:繁体中文
 * E:大小英文
 * e:小写英文
 * D:数字
 * Ee:大小写英文
 * EeD:大小英文数字
 * ED:大写数字
 * eD:小写中文
 * EUD:英文数字优化
 * 第二：  字体大小
 * 第三：  随机字符长度
 * 第四： 字体选择   1：宋体 2：隶属 3：雅黑 4：英文字体5：英文字体 6：英文字体
 * 第五： 字体颜色 填写16进制色安装其颜色显示，如果是参数"X"则为随机色
 * 第六：填正数顺时针倾斜相应的值  负数则逆时针
 * 第七：背景颜色  填写16进制色安装其颜色显示，如果填写 "img" 表示使用背景库图片做背景
 * 第八：图片宽度
 * 第九：图片高度
 * 第十：输出格式
 * 十一：R表示 圆弧干扰，L表示 线条干扰，D表示点干扰，X表示 前面3种干扰颜色随机干扰，G表示复杂话英文数字验证码排列，C表示字符颜色随机不雷同  当未有G的状态不生效， 效果可累加
 * 十二：干扰杂点数量
 * 十三：干扰线条数量
 * 十四：字体大小干扰
 * 十五：排除参与随机列的字串
 * 十六：Session位置  default 表示使用本身的php环境默认位置
 * 十七：Session名称  
 * 十八：Session时间 
 * ***************************************************
 */
//标注在最前页
define('IN_SYS', true);
//判断是否登录 true为需要判断 false不判断用于登录页面
$isLogins = false;
//include_once SITE_INC . 'inc.common.php';
require 'ValidationCode.class.php';
$vsafecode = new validationSafeCode ( );
session_start();
//$sessionsavepath=$SessionSavePath;
$sessionsavepath = 'default';
switch (@$_GET ['T']) {
    case 1 :
        $vsafecode->SetCon('CS', 16, 2, 1, '#000000', 0, 'img', 66, 28, 'png', 'LDXG', 40, 3, 3, '', $sessionsavepath, 'SafeCode1', 0);
        break;
    case 2 :
        $vsafecode->SetCon('CT', 14, 2, 2, '#000000', 0, 'img', 66, 28, 'png', 'LDXG', 40, 3, 3, '', $sessionsavepath, 'SafeCode2', 0);
        break;
    case 3 :
        $vsafecode->SetCon('E', 14, 5, 5, '#000000', 0, 'img', 66, 28, 'png', 'LDXCG', 50, 5, 3, '', $sessionsavepath, 'SafeCode3', 0);
        break;
    case 4 :
        $vsafecode->SetCon('e', 14, 5, 3, '#000000', 0, 'img', 66, 28, 'png', 'LDXCG', 50, 5, 3, '', $sessionsavepath, 'SafeCode4', 0);
        break;
    case 5 :
        $vsafecode->SetCon('EeD', 14, 5, 3, '#000000', 0, '#FFFFFF', 66, 28, 'png', 'RLDXCG', 50, 5, 3, '', $sessionsavepath, 'SafeCode5', 0);
        break;
    case 6 :
        $vsafecode->SetCon('ED', 15, 4, 5, '#000000', 0, '#FFFFFF', 70, 28, 'png', 'LDXCG', 50, 5, 3, '', $sessionsavepath, 'SafeCode6', 0);
        break;
    case 7 :
        $vsafecode->SetCon('CS', 20, 5, 1, '#000000', 0, '#FFFFFF', 300, 60, 'png', 'RLDXCG', 50, 5, 3, '', $sessionsavepath, 'SafeCode7', 0);
        break;
    case 'getpass' :
        $vsafecode->SetCon('D', 14, 5, 5, '#5364A5', 0, '#FFFFFF', 70, 30, 'png', 'LDG', 70, 8, 1, '', $sessionsavepath, 'SafeCodegetpass', 0);
        break;
    case 'login' :
        $vsafecode->SetCon('eD', 14, 4, 5, '#5399A5', 0, '#FFFFFF', 100, 30, 'png', 'RLDXCG', 70, 6, 9, '', $sessionsavepath, 'SafeCodelogin', 0);
        break;
    case 'getpro' :
        $vsafecode->SetCon('D', 15, 4, 5, '#000000', 0, '#FFFFFF', 70, 30, 'png', 'LDXCG', 50, 5, 3, '', $sessionsavepath, 'SafeCodegetpro', 0);
        break;
    case 'useredit' :
        $vsafecode->SetCon('D', 15, 3, 4, '#5364A5', 0, '#FFFFFF', 50, 30, 'png', 'RLDXG', 50, 5, 0, '', $sessionsavepath, 'SafeCodeuseredit', 0);
        break;
    case 'reg' :
        $vsafecode->SetCon('D', 16, 5, 4, '#5364A5', 0, 'img', 75, 33, 'png', 'LDG', 60, 6, 4, '', $sessionsavepath, 'SafeCodereg', 0);
        break;
    default :
        $vsafecode->SetCon('D', 16, 5, 5, '#000000', 0, '#FFFFFF', 70, 30, 'png', 'LDXCG', 50, 5, 3, '', $sessionsavepath, 'SafeCode', 0);
        break;
}
echo $vsafecode->SafeCode();
?>