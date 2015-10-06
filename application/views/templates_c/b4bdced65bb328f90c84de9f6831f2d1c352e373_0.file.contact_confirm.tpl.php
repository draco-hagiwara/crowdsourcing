<?php /* Smarty version 3.1.27, created on 2015-10-02 18:29:07
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/contact_confirm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1986470841560e4e631ee477_19343441%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4bdced65bb328f90c84de9f6831f2d1c352e373' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/contact_confirm.tpl',
      1 => 1443777011,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1986470841560e4e631ee477_19343441',
  'variables' => 
  array (
    'attr01' => 0,
    'attr02' => 0,
    'ticket' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560e4e63252d61_23083669',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560e4e63252d61_23083669')) {
function content_560e4e63252d61_23083669 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1986470841560e4e631ee477_19343441';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<h2>お問い合せ　確認</h2>

<?php echo form_open('contact/complete/','name="ConfirmForm" class="form-horizontal"');?>

  <div class="form-group">
    <label for="inputName" class="col-sm-2 control-label">名　前</label>
    <div class="col-sm-10">
      <?php echo set_value('inputName','');?>

      <?php echo form_hidden('inputName',set_value('inputName',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">メールアドレス</label>
    <div class="col-sm-10">
      <?php echo set_value('inputEmail','');?>

      <?php echo form_hidden('inputEmail',set_value('inputEmail',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="inputTel" class="col-sm-2 control-label">連絡先</label>
    <div class="col-sm-10">
      <?php echo set_value('inputTel','');?>

      <?php echo form_hidden('inputTel',set_value('inputTel',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="inputComment" class="col-sm-2 control-label">お問合せ内容</label>
    <div class="col-sm-10">
      <?php echo set_value('inputComment','');?>

      <?php echo form_hidden('inputComment',set_value('inputComment',''));?>

    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <?php $_smarty_tpl->createLocalArrayVariable('attr01', null, 0);
$_smarty_tpl->tpl_vars['attr01']->value['name'] = '_back';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr01', null, 0);
$_smarty_tpl->tpl_vars['attr01']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr01', null, 0);
$_smarty_tpl->tpl_vars['attr01']->value['value'] = '_back';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr01']->value,'戻　　る','class="btn btn-default"');?>


      <?php $_smarty_tpl->createLocalArrayVariable('attr02', null, 0);
$_smarty_tpl->tpl_vars['attr02']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr02', null, 0);
$_smarty_tpl->tpl_vars['attr02']->value['type'] = 'submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr02']->value,'問 合 せ','class="btn btn-default"');?>

    </div>
  </div>

  <?php echo form_hidden('ticket',$_smarty_tpl->tpl_vars['ticket']->value);?>


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