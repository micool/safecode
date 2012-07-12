<?php
/*
 *  * Micoolcoder
 *
 * An open source application development framework for PHP 5.2.1 or newer
 *
 * @package	    sadecode	 
 * @author	    micool	
 * @copyright	    micool.cn
 * @mail            micool@micool.cn
 * @license		http://app.micool.cn/php/guide/license.html
 * @link		http://app.micool.cn/php
 * @version         1.0 
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAFE CODE</title>
<script>
//重载验证码
function reloadcode(id){
var verify=document.getElementById('imgcode'+id);
var randnub=Math.ceil(Math.random()*1000000000);
verify.setAttribute('src','demoimg.php?T='+id+'&t='+randnub);
}
</script>
</head>

<body>
  
上一个验证码：<?php session_start(); echo @$_SESSION['SafeCode1'];?><br />
<IMG id="imgcode1" src="demoimg.php?T=1" align="absmiddle" onclick="reloadcode('1');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCode2'];?><br />
<IMG id="imgcode2" src="demoimg.php?T=2" align="absmiddle" onclick="reloadcode('2');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCode3'];?><br />
<IMG id="imgcode3" src="demoimg.php?T=3" align="absmiddle" onclick="reloadcode('3');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCode4'];?><br />
<IMG id="imgcode4" src="demoimg.php?T=4" align="absmiddle" onclick="reloadcode('4');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCode5'];?><br />
<IMG id="imgcode5" src="demoimg.php?T=5" align="absmiddle" onclick="reloadcode('5');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCode6'];?><br />
<IMG id="imgcode6" src="demoimg.php?T=6" align="absmiddle" onclick="reloadcode('6');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCode7'];?><br />
<IMG id="imgcode7" src="demoimg.php?T=7" align="absmiddle" onclick="reloadcode('7');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCodegetpass'];?><br />
<IMG id="imgcodegetpass" src="demoimg.php?T=getpass" align="absmiddle" onclick="reloadcode('getpass');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCodelogin'];?><br />
<IMG id="imgcodelogin" src="demoimg.php?T=login" align="absmiddle" onclick="reloadcode('login');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCodegetpro'];?><br />
<IMG id="imgcodegetpro" src="demoimg.php?T=getpro" align="absmiddle" onclick="reloadcode('getpro');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCodereg'];?><br />
<IMG id="imgcodereg" src="demoimg.php?T=reg" align="absmiddle" onclick="reloadcode('reg');" /><br />
上一个验证码：<?php  echo @$_SESSION['SafeCodeuseredit'];?><br />
<IMG id="imgcodeuseredit" src="demoimg.php?T=useredit" align="absmiddle" onclick="reloadcode('useredit');" /><br />

</body>
</html>
