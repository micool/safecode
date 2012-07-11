<?php
/*
  http://phpnow.org
  YinzCN_at_Gmail.com
*/

error_reporting(E_ALL);

function GET($n) {
  return isset($_GET[$n]) ? $_GET[$n] : NULL;
}

if (GET('act') == 'phpinfo') { phpinfo(); exit; }

// get IP
if (GET('act') == 'getip') {
  $MYLIB_VER = function_exists('mysql_close') ? mysql_get_client_info() : '';
  $info = $_SERVER['SERVER_NAME'].'|'.$_SERVER['REMOTE_ADDR'].'|'.$_SERVER['SERVER_SOFTWARE'].'|'.$MYLIB_VER.'|'.$_SERVER['DOCUMENT_ROOT'];
  $c = @file_get_contents('http://phpnow.org/myip.php?'.base64_encode($info));
  if (preg_match('/^\d+\.\d+\.\d+\.\d+$/', $c) == 1) echo $c;
  else echo 'false';
  exit;
}

define('YES', '<span style="color: #008000; font-weight : bold;">Yes</span>');
define('NO', '<span style="color: #ff0000; font-weight : bold;">No</span>');

function colorname() {
  $c = array('87cefa', 'ffa500', 'ff6347', '9acd32', '32cd32', 'ee82ee');

  $s = ucfirst($_SERVER['SERVER_NAME']);
  $a = explode('.', $s);
  if ($a[0] == 'Www' || $a[0] == 'Bbs') {
   $a[1] = ucwords($a[1]);
   $a[0] = strtolower($a[0]);
  }

  $ran = rand(0, count($c));
  $s = implode('.', $a);

  $s = preg_replace('/([a-zA-Z]+|[0-9]+)/', '<span style="color: #'.$c[rand(0, count($c))%count($c)].'">$1</span>', $s, 1);

  for($i=1; $i<=24; $i++) $s = preg_replace('/>([a-zA-Z]+|[0-9]+|\.|-)([^<]*$)/', '><span style="color: #'.$c[($i+$ran)%count($c)].';">$1</span>$2', $s, 1);
  return $s;
}

function get_ea_info($name) { $ea_info = eaccelerator_info(); return $ea_info[$name]; }
function get_gd_info($name) { $gd_info = gd_info(); return $gd_info[$name]; }

@header('content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PHPnow works!</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="YinzCN" />
<meta name="reply-to" content="YinzCN@Gmail.com" />
<meta name="copyright" content="YinzCN" />
<style type="text/css">
<!--
body {
font-family : verdana, tahoma;
font-size : 12px;
margin-top : 10px;
}

form {
margin : 0;
}

table {
border-collapse : collapse;
}

.info tr td {
border : 1px solid #000000;
padding : 3px 10px 3px 10px ;
}

.info th {
border : 1px solid #000000;
font-weight : bold;
height : 16px;
padding : 3px 10px 3px 10px;
background-color : #9acd32;
}

input {
border : 1px solid #000000;
background-color : #fafafa;
}

a {
text-decoration : none;
color : #000000;
}

a:hover {
text-decoration : underline;
}

a.arrow {
font-family : webdings, sans-serif;
font-size : 10px;
}

a.arrow:hover {
color : #ff0000;
text-decoration : none;
}
-->
</style>
<script type="text/JavaScript">
function CreateXMLHttp() {
  var XMLHttp;
  try { XMLHttp = new XMLHttpRequest(); }
  catch (e) {
    try { XMLHttp = new ActiveXObject("Msxml2.XMLHTTP"); }
    catch (e) {
      try { XMLHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
      catch (e) { XMLHttp = false; }
    }
  }
  return XMLHttp;
}

function $(id) { return document.getElementById(id); }

function get_ip() {
  var r;
  XMLHttp = CreateXMLHttp();
  XMLHttp.onreadystatechange = function()
  {
    if(XMLHttp.readyState == 4)
    {
      r = XMLHttp.responseText;
      if (r == 'false') ip_display('ip_false');
      else {
        $('ip_a').href = 'http://' + r;
        $('ip_a').innerHTML = r;
        ip_display('ip_show');
      }
    }
  }
  XMLHttp.open("GET", "?act=getip", true);
  XMLHttp.send(null);
}

function ip_display(id) {
  var items = ['ip_reading', 'ip_show', 'ip_false'];
  for (k in items) $(items[k]).style.display = 'none';
  $(id).style.display = 'inline';
}
</script>
</head>
<body onload="get_ip();">
<div style="margin: 0 auto; width: 600px;">

<div style="width: 120px; float: right; padding: 4px; text-align: center;">
 <div><a style="color: #ffa500;" href="http://phpnow.org/go.php?id=1005">为何只能本地访问?</a></div>
 <div id="ip_reading" style="color: #999999;">正在读取 IP 地址</div>
 <div id="ip_show" style="display: none; color: #999999;">此服务器外网 IP<br /><a id="ip_a" style="color: #999999;"></a></div>
 <div id="ip_false" style="display: none;">获取外网 IP 失败!</div>
</div>

<div style="height: 64px; float: left; text-align: center;">
 <div style="font-weight: bold; font-size: 2.2em;"><a href="<?=$_SERVER['PHP_SELF']?>?" style="text-decoration: none;"><?=colorname()?></a></div>
 <div style="margin: 3px auto;">+ Powered by PHPnow 1.5 +</div>
</div>

<br />

<table width="100%" class="info">
  <tr>
    <th colspan="2">Server Information</th>
  </tr>

  <tr>
    <td>主机名 (IP:端口)</td>
    <td><?=$_SERVER['SERVER_NAME']?> (<?=$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT']?>)</td>
  </tr>

  <tr>
    <td>服务器软件</td>
    <td><?=$_SERVER['SERVER_SOFTWARE']?></td>
  </tr>

  <tr>
    <td>PHP 运行方式</td>
    <td><?=PHP_SAPI?></td>
  </tr>

  <tr>
    <td>网站主目录</td>
    <td><?=$_SERVER['DOCUMENT_ROOT']?></td>
  </tr>

  <tr>
    <td>服务器时间</td>
    <td><?=gmdate('Y-m-d H:i:s', time()+8*60*60)?> <span style="color: #999999;">(+08:00)</span></td>
  </tr>

  <tr>
    <td>Other Links</td>
    <td>
    <a href='<?=$_SERVER['PHP_SELF']?>?act=phpinfo'>phpinfo()</a>
    | <?=file_exists('phpMyAdmin') ? '<a href="/phpMyAdmin">phpMyAdmin</a>' : '<a href="http://phpnow.org">PHPnow.org</a>'?>
    </td>
  </tr>
</table>

<hr />

<table width="100%" class="info">
  <tr>
    <th colspan="2">PHP 组件支持</th>
  </tr>

  <tr>
    <td>Zend Optimizer</td>
    <td><?=defined('OPTIMIZER_VERSION') ? YES.' / '.OPTIMIZER_VERSION : NO?></td>
  </tr>

  <tr>
    <td>MySQL 支持</td>
    <td><?=function_exists('mysql_close') ? YES.' / client lib version '.mysql_get_client_info() : NO?></td>
  </tr>

  <tr>
    <td>GD library</td>
    <td><?=function_exists('gd_info') ? YES.' / '.get_gd_info('GD Version') : NO?></td>
  </tr>

  <tr>
    <td>eAccelerator</td>
    <td><?=function_exists('eaccelerator_info') ? YES.' / '.get_ea_info('version') : NO?></td>
  </tr>
</table>

<hr />

<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
<table width="100%" class="info">
  <tr>
    <th colspan="4">MySQL 连接测试</th>
  </tr>

  <tr>
    <td>MySQL 服务器</td>
    <td><input type="text" name="mysqlHost" value="localhost" /></td>
    <td>MySQL 数据库名</td>
    <td><input type="text" name="mysqlDb" value="test" /></td>
  </tr>

  <tr>
    <td>MySQL 用户名</td>
    <td><input type="text" name="mysqlUser" value="root" /></td>
    <td>MySQL 用户密码</td>
    <td><input type="text" name="mysqlPassword" /></td>
  </tr>

  <tr>
    <td colspan="4" align="right"><input type="submit" value="连接" name="act" /> &nbsp;</td>
  </tr>
</table>
</form>

<?php if(isset($_POST['act'])) {?>
<br />

<table width="100%" class="info">
  <tr>
    <th colspan="4">MySQL 测试结果</th>
  </tr>

<?php
$link = @mysql_connect($_POST['mysqlHost'], $_POST['mysqlUser'], $_POST['mysqlPassword']);
$errno = mysql_errno();
if ($link) $str1 = '<span style="color: #008000;">连接正常</span> ('.mysql_get_server_info($link).')';
else $str1 = '<span style="color: #ff0000;">连接失败</span><br />'.mysql_error();
?>
  <tr>
    <td colspan="2">服务器 <?=$_POST['mysqlHost']?></td>
    <td colspan="2"><?=$str1?></td>
  </tr>

  <tr>
    <td colspan="2">数据库 <?=$_POST['mysqlDb']?></td>
    <td colspan="2"><?=(@mysql_select_db($_POST['mysqlDb'],$link))?'<span style="color: #008000">连接正常</span>':'<span style="color: #ff0000;">连接失败</span>'?></td>
  </tr>
</table>
<?}?>
<hr />

<p style="text-align: right; margin: 0;"><a href="http://validator.w3.org/check?uri=referer" style="color: #999999;">Valid XHTML 1.0 Strict</a> / <a href="http://wiki.w3china.org/wiki/index.php/Copyleft" style="color: #008000;"><b>Copyleft</b></a> ! 2009 ? <a href="http://phpnow.org">PHPnow.org</a></p>

</div>
</body>
</html>