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
 * 第二：字体大小
 * 第三：随机字符长度
 * 第四：字体选择   1：宋体 2：隶属 3：雅黑 4：英文字体5：英文字体 6：英文字体   （可以更具自己用到的字体来优化 删除不用字体 节省磁盘空间）
 * 第五：字体颜色 填写16进制色安装其颜色显示，如果是参数"X"则为随机色
 * 第六：填正数顺时针倾斜相应的值  负数则逆时针
 * 第七：背景颜色  填写16进制色安装其颜色显示，如果填写 "img" 表示使用背景库图片做背景 img文件夹即为背景 可自行修改  默认白色
 * 第八：图片宽度
 * 第九：图片高度
 * 第十：输出格式 jpg png gif 默认png
 * 十一：R表示 圆弧干扰，L表示 线条干扰，D表示点干扰，X表示 前面3种干扰颜色随机干扰，G表示复杂话英文数字验证码排列，C表示字符颜色随机不雷同  当未有G的状态不生效， 效果可累加
 * 十二：干扰杂点数量
 * 十三：干扰线条数量
 * 十四：字体大小干扰 每个字符都会根据值来随机一定范围内的大小
 * 十五：排除参与随机列的字串
 * 十六：Session位置  default 表示使用本身的php环境默认位置
 * 十七：Session名称  
 * 十八：Session时间 
 * ***************************************************
 * 2012-7-23 修复高版本php兼容bug
 * 优化session模块
 * $sessioninfo的赋值为array(); 
 * 例：array ('default', '', '', 'SafeCode1' ); 分别是：存储位置 ，要制定的session_name,session_time,session需要赋值的键值。 default 就的默认环境存储位
 */
//标注在最前页
define('IN_SYS', true);
require 'ValidationCode.class.php';
$vsafecode = new validationSafeCode ( );
session_start();//此处开启session是为了demo显示验证码
switch (@$_GET ['T']) {
    case 1 :
        $sessioninfo = array ('default', '', '', 'SafeCode1' );
        $vsafecode->SetCon('CS', 16, 2, 1, '#000000', 0, 'img', 66, 28, 'png', 'LDXG', 40, 3, 3, '', $sessioninfo);
        break;
    case 2 :
        $sessioninfo = array ('default', '', '', 'SafeCode2' );
        $vsafecode->SetCon('CT', 14, 2, 2, '#000000', 0, 'img', 66, 28, 'png', 'LDXG', 40, 3, 3, '', $sessioninfo);
        break;
    case 3 :
        $sessioninfo = array ('default', '', '', 'SafeCode3' );
        $vsafecode->SetCon('E', 14, 5, 5, '#000000', 0, 'img', 66, 28, 'png', 'LDXCG', 50, 5, 3, '', $sessioninfo);
        break;
    case 4 :
        $sessioninfo = array ('default', '', '', 'SafeCode4' );
        $vsafecode->SetCon('e', 14, 5, 3, '#000000', 0, 'img', 66, 28, 'png', 'LDXCG', 50, 5, 3, '', $sessioninfo);
        break;
    case 5 :
        $sessioninfo = array ('default', '', '', 'SafeCode5' );
        $vsafecode->SetCon('EeD', 14, 5, 3, '#000000', 0, '#FFFFFF', 66, 28, 'png', 'RLDXCG', 50, 5, 3, '', $sessioninfo);
        break;
    case 6 :
        $sessioninfo = array ('default', '', '', 'SafeCode6' );
        $vsafecode->SetCon('ED', 15, 4, 5, '#000000', 0, '#FFFFFF', 70, 28, 'png', 'LDXCG', 50, 5, 3, '', $sessioninfo);
        break;
    case 7 :
        $sessioninfo = array ('default', '', '', 'SafeCode7' );
        $vsafecode->SetCon('CS', 20, 5, 1, '#000000', 0, '#FFFFFF', 300, 60, 'png', 'RLDXCG', 50, 5, 3, '', $sessioninfo);
        break;
    case 'getpass' :
        $sessioninfo = array ('default', '', '', 'SafeCodegetpass' );
        $vsafecode->SetCon('D', 14, 5, 5, '#5364A5', 0, '#FFFFFF', 70, 30, 'png', 'LDG', 70, 8, 1, '', $sessioninfo);
        break;
    case 'login' :
        $sessioninfo = array ('default', '', '', 'SafeCodelogin' );
        $vsafecode->SetCon('eD', 14, 4, 5, '#5399A5', 0, '#FFFFFF', 100, 30, 'png', 'RLDXCG', 70, 6, 9, '', $sessioninfo);
        break;
    case 'getpro' :
        $sessioninfo = array ('default', '', '', 'SafeCodegetpro' );
        $vsafecode->SetCon('D', 15, 4, 5, '#000000', 0, '#FFFFFF', 70, 30, 'png', 'LDXCG', 50, 5, 3, '', $sessioninfo);
        break;
    case 'useredit' :
        $sessioninfo = array ('default', '', '', 'SafeCodeuseredit' );
        $vsafecode->SetCon('D', 15, 3, 4, '#5364A5', 0, '#FFFFFF', 50, 30, 'png', 'RLDXG', 50, 5, 0, '', $sessioninfo);
        break;
    case 'reg' :
        $sessioninfo = array ('default', '', '', 'SafeCodereg' );
        $vsafecode->SetCon('D', 16, 5, 4, '#5364A5', 0, 'img', 75, 33, 'png', 'LDG', 60, 6, 4, '', $sessioninfo);
        break;
    default :
        $sessioninfo = array ('default', '', '', 'SafeCode' );
        $vsafecode->SetCon('D', 16, 5, 5, '#000000', 0, '#FFFFFF', 70, 30, 'png', 'LDXCG', 50, 5, 3, '', $sessioninfo);
        break;
}
?>