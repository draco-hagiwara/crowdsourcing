<?php /* Smarty version 3.1.27, created on 2015-10-15 00:09:47
         compiled from "/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/login/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2124712656561e703bb6b3f2_98729438%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03e077d5ab2a71cb6757befa58d3028c71dd46f4' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/login/index.tpl',
      1 => 1444835384,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2124712656561e703bb6b3f2_98729438',
  'variables' => 
  array (
    'err_mess' => 0,
    'attr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_561e703bbc0ab6_97305438',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_561e703bbc0ab6_97305438')) {
function content_561e703bbc0ab6_97305438 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2124712656561e703bb6b3f2_98729438';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>ログイン画面　　<span class="label label-danger">アドミン</span></h3>
</div>

<?php echo form_open('/login/check/','name="LoginForm" class="form-horizontal"');?>



  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <?php if ($_smarty_tpl->tpl_vars['err_mess']->value != '') {?><span class="label label-danger">Error : </span><label><font color=red><?php echo $_smarty_tpl->tpl_vars['err_mess']->value;?>
</font></label><?php }?>
    </div>
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="ad_email">ログインID　（メールアドレス）</label>
      <?php echo form_input('ad_email',set_value('ad_email',''),'class="form-control" placeholder="ログインID（メールアドレス）を入力してください。"');?>

      <?php if (form_error('ad_email')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('ad_email');?>
</font></label><?php }?>
  </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="ad_password">パスワード</label>
      <?php echo form_password('ad_password','','class="form-control" placeholder="パスワードを入力してください。"');?>

      <?php if (form_error('ad_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('ad_password');?>
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