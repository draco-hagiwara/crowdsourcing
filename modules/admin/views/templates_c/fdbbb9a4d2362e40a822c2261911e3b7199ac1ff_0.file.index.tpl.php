<?php /* Smarty version 3.1.27, created on 2015-10-23 15:55:11
         compiled from "/home/cs/www/cs.com.dev/modules/client/views/contents/client/login/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:15905961595629d9cfb0c9b0_98472312%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fdbbb9a4d2362e40a822c2261911e3b7199ac1ff' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/client/views/contents/client/login/index.tpl',
      1 => 1444816565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15905961595629d9cfb0c9b0_98472312',
  'variables' => 
  array (
    'err_mess' => 0,
    'attr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5629d9cfb7f241_71510289',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5629d9cfb7f241_71510289')) {
function content_5629d9cfb7f241_71510289 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '15905961595629d9cfb0c9b0_98472312';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>ログイン画面　　<span class="label label-info">クライアント</span></h3>
</div>

<?php echo form_open('/login/check/','name="LoginForm" class="form-horizontal"');?>



  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <?php if ($_smarty_tpl->tpl_vars['err_mess']->value != '') {?><span class="label label-danger">Error : </span><label><font color=red><?php echo $_smarty_tpl->tpl_vars['err_mess']->value;?>
</font></label><?php }?>
    </div>
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="cl_email">ログインID　（メールアドレス）</label>
      <?php echo form_input('cl_email',set_value('cl_email',''),'class="form-control" placeholder="ログインID（メールアドレス）を入力してください。"');?>

      <?php if (form_error('cl_email')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('cl_email');?>
</font></label><?php }?>
  </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="cl_password">パスワード</label>
      <?php echo form_password('cl_password','','class="form-control" placeholder="パスワードを入力してください。"');?>

      <?php if (form_error('cl_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('cl_password');?>
</font></label><?php }?>
  </div>
  </div>

  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'ログイン','class="btn btn-default"');?>

    </div>
  </div>

<?php echo form_close();?>




    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



</body>
</html>
<?php }
}
?>