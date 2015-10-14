<?php /* Smarty version 3.1.27, created on 2015-10-09 20:03:58
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/contact/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:96554417256179f1ec65224_15918989%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36c27edbf712fac752af0e7b85a9002f9c6cada9' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/contact/index.tpl',
      1 => 1444388604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96554417256179f1ec65224_15918989',
  'variables' => 
  array (
    'attr01' => 0,
    'attr02' => 0,
    'ticket' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56179f1ecc1725_39394615',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56179f1ecc1725_39394615')) {
function content_56179f1ecc1725_39394615 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '96554417256179f1ec65224_15918989';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>



<h2>お問い合せ</h2>


<?php echo form_open('contact/confirm/','name="ContactForm" class="form-horizontal"');?>

<!-- <form class="form-horizontal" name="ContactForm" method="post" action="contact/confirm/"> -->
  <div class="form-group">
    <label for="inputName" class="col-sm-2 control-label">名　前<font color=red>【必須】</font></label>
    <div class="col-sm-10">
      <?php echo form_input('inputName',set_value('inputName',''),'class="form-control" placeholder="名前を入力してください"');?>

      <!-- <input type="text" class="form-control" id="inputName" placeholder="名前を入力してください"> -->
      <?php if (form_error('inputName')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('inputName');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">メールアドレス<font color=red>【必須】</font></label>
    <div class="col-sm-10">
      <?php echo form_input('inputEmail',set_value('inputEmail',''),'class="col-sm-2 form-control" placeholder="メールアドレスを入力してください"');?>

      <!-- <input type="email" class="col-sm-2 form-control" id="inputEmail" placeholder="メールアドレスを入力してください"> -->
      <?php if (form_error('inputEmail')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('inputEmail');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputTel" class="col-sm-2 control-label">連絡先</label>
    <div class="col-sm-10">
      <?php echo form_input('inputTel',set_value('inputTel',''),'class="form-control" placeholder="連絡先の電話番号を入力してください"');?>

      <!-- <input type="text" class="form-control" id="inputTel" placeholder="連絡先の電話番号を入力してください"> -->
      <?php if (form_error('inputTel')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('inputTel');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputComment" class="col-sm-2 control-label">お問合せ内容</label>
    <div class="col-sm-10">
      <?php $_smarty_tpl->createLocalArrayVariable('attr01', null, 0);
$_smarty_tpl->tpl_vars['attr01']->value['name'] = 'inputComment';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr01', null, 0);
$_smarty_tpl->tpl_vars['attr01']->value['rows'] = 10;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr01']->value,set_value('inputComment',''),'class="form-control"');?>

      <!-- <textarea class="form-control" id="inputComment" rows="5"></textarea> -->
      <?php if (form_error('inputComment')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('inputComment');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <?php $_smarty_tpl->createLocalArrayVariable('attr02', null, 0);
$_smarty_tpl->tpl_vars['attr02']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr02', null, 0);
$_smarty_tpl->tpl_vars['attr02']->value['type'] = 'submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr02']->value,'確　　認','class="btn btn-default"');?>

      <!-- <button type="submit" class="btn btn-default">確　　認</button> -->
    </div>
  </div>

  <?php echo form_hidden('ticket',$_smarty_tpl->tpl_vars['ticket']->value);?>


<?php echo form_close();?>

<!-- </form> -->



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