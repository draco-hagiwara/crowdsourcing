<?php /* Smarty version 3.1.27, created on 2015-12-15 12:56:46
         compiled from "/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/login/reissue.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1670360996566f8f7e96fd07_31173136%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '132a5d6563b2037a8da8d1b5022e5191c705a9cc' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/login/reissue.tpl',
      1 => 1450151763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1670360996566f8f7e96fd07_31173136',
  'variables' => 
  array (
    'err_mess' => 0,
    'captcha' => 0,
    'err_captcha' => 0,
    'attr' => 0,
    'ticket' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566f8f7e9d7214_51795504',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f8f7e9d7214_51795504')) {
function content_566f8f7e9d7214_51795504 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1670360996566f8f7e96fd07_31173136';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>パスワード再発行画面　　<span class="label label-success">ライター</span></h3>
</div>

<?php echo form_open('login/reissuecheck/','name="reLoginForm" class="form-horizontal"');?>


  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="wr_email">ログインID　（メールアドレス）</label>
      <?php echo form_input('wr_email',set_value('wr_email',''),'class="form-control" placeholder="ログインID（メールアドレス）を入力してください。"');?>

      <?php if (form_error('wr_email')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_email');?>
</font></label><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['err_mess']->value != '') {?><span class="label label-danger">Error : </span><label><font color=red><?php echo $_smarty_tpl->tpl_vars['err_mess']->value;?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="wr_password">再発行パスワード</label>
      <?php echo form_password('wr_password','','class="form-control" placeholder="パスワードを入力してください。"');?>

      <?php if (form_error('wr_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_password');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="retype_password">パスワード再入力</label>
      <?php echo form_password('retype_password','','class="form-control" placeholder="上記で入力したパスワードを再入力してください。"');?>

      <?php if (form_error('retype_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('retype_password');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="captcha_img">画像認証コード</label><br />
      <?php echo $_smarty_tpl->tpl_vars['captcha']->value['image'];?>

    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-3 col-sm-offset-8">
      <?php echo form_input('captcha_chr','','class="form-control" placeholder="画像認証コードを入力してください。"');?>

      <?php if (form_error('captcha_chr')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('captcha_chr');?>
</font></label><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['err_captcha']->value != '') {?><span class="label label-danger">Error : </span><label><font color=red><?php echo $_smarty_tpl->tpl_vars['err_captcha']->value;?>
</font></label><?php }?>
    </div>
  </div>

  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'パスワード仮発行','class="btn btn-default"');?>

    </div>
  </div>

  <?php echo form_hidden('ticket',$_smarty_tpl->tpl_vars['ticket']->value);?>

  <?php echo form_hidden('captcha_word',$_smarty_tpl->tpl_vars['captcha']->value['word']);?>


<?php echo form_close();?>




    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("../../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



</body>
</html>
<?php }
}
?>