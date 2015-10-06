<?php /* Smarty version 3.1.27, created on 2015-10-05 13:37:11
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:18507496425611fe774964e3_74395464%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '994fef42c885d1454cadc639a68c5c6045862f40' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/footer.tpl',
      1 => 1444019803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18507496425611fe774964e3_74395464',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5611fe77542a02_35248028',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5611fe77542a02_35248028')) {
function content_5611fe77542a02_35248028 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/application/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '18507496425611fe774964e3_74395464';
?>
<div class="panel panel-default">
  <div class="panel-body">
	<ul class="list-inline text-center">
	  <li><a href="#">会社概要</a></li>
	  <li><a href="#">個人情報保護方針</a></li>
	  <li><a href="#">サイトマップ</a></li>
	  <li><a href="./contact">問合せ</a></li>
	  <li><a href="./entryclient">クライアント新規登録</a></li>
	</ul>
  </div>
  <div class="panel-footer text-center">
    Copyright(C) 2015,<?php ob_start();
echo smarty_modifier_date_format(time(),"%Y");
$_tmp1=ob_get_clean();
echo $_tmp1;?>
 Lavender Marketing Inc. All Rights Reserved.
  </div>
</div><?php }
}
?>