<?php /* Smarty version 3.1.27, created on 2015-10-09 14:10:10
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/kiyaku.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:56543412756174c32a35e24_54759482%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '805e5e37574f26d04d54c4d919e687b32a708a8e' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/kiyaku.tpl',
      1 => 1444367401,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56543412756174c32a35e24_54759482',
  'variables' => 
  array (
    'err_checkKiyaku' => 0,
    'attr' => 0,
    'ticket' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56174c32a78c41_94778622',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56174c32a78c41_94778622')) {
function content_56174c32a78c41_94778622 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '56543412756174c32a35e24_54759482';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>



<h2>利用規約</h2>


<div class="alert alert-info" role="alert">
  <p class="lead">こちらの　<a href="#" class="alert-link">会員規約.pdf</a>　を必ずご覧ください。</p>
</div>



<?php echo form_open('entrywriter/entry/','name="EntrywiterForm" class="form-horizontal"');?>

  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-7">
      <?php echo form_checkbox('checkKiyaku[]','1',set_checkbox('checkKiyaku[]','1'));?>
規約に同意します。
      <?php if ($_smarty_tpl->tpl_vars['err_checkKiyaku']->value == TRUE) {?><p><span class="label label-danger">Error : </span><label><font color=red>「規約に同意」にチェックを入れてください。</font></label><p><?php }?>
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'会員登録画面へ','class="btn btn-default"');?>

    </div>
  </div>

  <?php echo form_hidden('ticket',$_smarty_tpl->tpl_vars['ticket']->value);?>


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