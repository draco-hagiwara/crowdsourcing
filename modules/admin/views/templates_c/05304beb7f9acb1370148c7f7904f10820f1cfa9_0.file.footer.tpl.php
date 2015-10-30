<?php /* Smarty version 3.1.27, created on 2015-10-23 15:55:11
         compiled from "/home/cs/www/cs.com.dev/modules/client/views/contents/client/footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2791096525629d9cfb98d16_29981302%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05304beb7f9acb1370148c7f7904f10820f1cfa9' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/client/views/contents/client/footer.tpl',
      1 => 1445323607,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2791096525629d9cfb98d16_29981302',
  'variables' => 
  array (
    'login_chk' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5629d9cfbab263_93039784',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5629d9cfbab263_93039784')) {
function content_5629d9cfbab263_93039784 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/modules/client/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '2791096525629d9cfb98d16_29981302';
?>
<div class="panel panel-default">
  <div class="panel-body">
	<ul class="list-inline text-center">
      <?php if ($_smarty_tpl->tpl_vars['login_chk']->value == TRUE) {?>
	    <li><a href="#">会社概要</a></li>
	    <li><a href="#">個人情報保護方針</a></li>
	    <li><a href="#">サイトマップ</a></li>
	    <li><a href="<?php echo base_url();?>
../contact">問合せ</a></li>
 	  <?php } else { ?>
	    <li><a href="#">会社概要</a></li>
	    <li><a href="#">個人情報保護方針</a></li>
	    <li><a href="#">サイトマップ</a></li>
	    <li><a href="<?php echo base_url();?>
../contact">問合せ</a></li>
	    <li><a href="<?php echo base_url();?>
../entryclient">クライアント新規登録</a></li>
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