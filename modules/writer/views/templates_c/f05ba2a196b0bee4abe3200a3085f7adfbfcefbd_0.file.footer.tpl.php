<?php /* Smarty version 3.1.27, created on 2015-12-15 12:15:22
         compiled from "/home/cs/www/cs.com.dev/modules/writer/views/contents/footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1104561512566f85cab399a3_95164609%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f05ba2a196b0bee4abe3200a3085f7adfbfcefbd' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/writer/views/contents/footer.tpl',
      1 => 1450149320,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1104561512566f85cab399a3_95164609',
  'variables' => 
  array (
    'login_chk' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566f85cabe1786_87051945',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f85cabe1786_87051945')) {
function content_566f85cabe1786_87051945 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/modules/writer/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '1104561512566f85cab399a3_95164609';
?>
<div class="panel panel-default">
  <div class="panel-body">
	<ul class="list-inline text-center">
      <?php if ($_smarty_tpl->tpl_vars['login_chk']->value == TRUE) {?>
	    <li><a href="/top/aboutus/" target="_blank">会社概要</a></li>
	    <li><a href="/top/privacy/" target="_blank">個人情報保護方針</a></li>
	    <li><a href="/top/sitemap/" target="_blank">サイトマップ</a></li>
	    <li><a href="<?php echo base_url();?>
../contact">問合せ</a></li>
 	  <?php } else { ?>
	    <li><a href="/top/aboutus/">会社概要</a></li>
	    <li><a href="/top/privacy/">個人情報保護方針</a></li>
	    <li><a href="/top/sitemap/">サイトマップ</a></li>
	    <li><a href="<?php echo base_url();?>
../contact">問合せ</a></li>
  	  <?php }?>
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