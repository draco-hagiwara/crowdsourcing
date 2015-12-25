<?php /* Smarty version 3.1.27, created on 2015-11-25 13:55:26
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/my_memfile/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:126497723856553f3e87c457_16965683%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a3a453582316e01130b39458e3c2bef9ef98b3a' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/my_memfile/index.tpl',
      1 => 1448427324,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126497723856553f3e87c457_16965683',
  'variables' => 
  array (
    'writer_info' => 0,
    'options_wr_status02' => 0,
    'options_wr_mm_rank_id' => 0,
    'err_email' => 0,
    'attr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56553f3e938cd9_09179814',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56553f3e938cd9_09179814')) {
function content_56553f3e938cd9_09179814 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '126497723856553f3e87c457_16965683';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>会員情報　　<span class="label label-success">更　新</span></h3>
</div>

<?php echo form_open('my_memfile/complete/','name="EntrywriterForm" class="form-horizontal"');?>


  <div class="form-group">
    <label for="wr_id" class="col-sm-2 control-label">ライターID</label>
    <div class="col-sm-2">
      <?php echo $_smarty_tpl->tpl_vars['writer_info']->value['wr_id'];?>

      <?php echo form_hidden('wr_id',$_smarty_tpl->tpl_vars['writer_info']->value['wr_id']);?>

    </div>
    <label for="wr_status" class="col-sm-2 control-label">ステータス (状態)</label>
    <div class="col-sm-2">
      <?php echo $_smarty_tpl->tpl_vars['options_wr_status02']->value[$_smarty_tpl->tpl_vars['writer_info']->value['wr_status']];?>

    </div>
    <label for="wr_mm_rank_id" class="col-sm-2 control-label">会員ランク</label>
    <div class="col-sm-2">
      <?php echo $_smarty_tpl->tpl_vars['options_wr_mm_rank_id']->value[$_smarty_tpl->tpl_vars['writer_info']->value['wr_mm_rank_id']];?>

    </div>
  </div>

  <div class="form-group">
    <label for="wr_email" class="col-sm-3 control-label">メールアドレス（代表）＆　ログインID</label>
    <div class="col-sm-8">
      <?php echo form_input('wr_email',set_value('wr_email',$_smarty_tpl->tpl_vars['writer_info']->value['wr_email']),'class="col-sm-4 form-control" placeholder="メールアドレス（ログインID）を入力してください"');?>

      <?php if (form_error('wr_email')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_email');?>
</font></label><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['err_email']->value == TRUE) {?><span class="label label-danger">Error : </span><label><font color=red>「メールアドレス」欄で入力したアドレスは既に他で使用されています。再度他のアドレスを入力してください。</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['value'] = '_mail';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'更　新','class="btn btn-default"');?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_password" class="col-sm-3 control-label">パスワード</label>
    <div class="col-sm-8">
      <?php echo form_password('wr_password',set_value('wr_password',''),'class="form-control" placeholder="パスワード　(半角英数字・記号：８文字以上)"');?>

      <?php if (form_error('wr_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_password');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['value'] = '_passwd';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'更　新','class="btn btn-default"');?>

    </div>
  </div>
  <div class="form-group">
    <label for="retype_password" class="col-sm-3 control-label">パスワード再入力</label>
    <div class="col-sm-8">
      <?php echo form_password('retype_password',set_value('retype_password',''),'class="form-control" placeholder="パスワード再入力　(半角英数字・記号：８文字以上)"');?>

      <p><small>確認のため、もう一度入力してください。</small></p>
      <?php if (form_error('retype_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('retype_password');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1"></div>
  </div>

  <div class="form-group">
    <label for="wr_bank_cd" class="col-sm-3 control-label">振込先銀行コード</label>
    <div class="col-sm-2">
      <?php echo form_input('wr_bank_cd',set_value('wr_bank_cd',$_smarty_tpl->tpl_vars['writer_info']->value['wr_bank_cd']),'class="col-sm-4 form-control" placeholder="振込先銀行コード"');?>

      <?php if (form_error('wr_bank_cd')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_bank_cd');?>
</font></label><?php }?>
    </div>
    <label for="wr_bank" class="col-sm-2 control-label">振込先銀行名</label>
    <div class="col-sm-4">
      <?php echo form_input('wr_bank',set_value('wr_bank',$_smarty_tpl->tpl_vars['writer_info']->value['wr_bank']),'class="col-sm-4 form-control" placeholder="振込先銀行名を入力してください"');?>

      <?php if (form_error('wr_bank')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_bank');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['value'] = '_bank';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'更　新','class="btn btn-default"');?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_bk_branch_cd" class="col-sm-3 control-label">支店コード</label>
    <div class="col-sm-2">
      <?php echo form_input('wr_bk_branch_cd',set_value('wr_bk_branch_cd',$_smarty_tpl->tpl_vars['writer_info']->value['wr_bk_branch_cd']),'class="col-sm-4 form-control" placeholder="支店コード"');?>

      <?php if (form_error('wr_bk_branch_cd')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_bk_branch_cd');?>
</font></label><?php }?>
    </div>
    <label for="wr_bk_branch" class="col-sm-2 control-label">支店名</label>
    <div class="col-sm-4">
      <?php echo form_input('wr_bk_branch',set_value('wr_bk_branch',$_smarty_tpl->tpl_vars['writer_info']->value['wr_bk_branch']),'class="col-sm-4 form-control" placeholder="支店名を入力してください"');?>

      <?php if (form_error('wr_bk_branch')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_bk_branch');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_bk_item" class="col-sm-3 control-label">種目</label>
    <div class="col-sm-2">
      <?php echo form_input('wr_bk_item',set_value('wr_bk_item',$_smarty_tpl->tpl_vars['writer_info']->value['wr_bk_item']),'class="col-sm-4 form-control" placeholder="種目を入力してください"');?>

      <?php if (form_error('wr_bk_item')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_bk_item');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_bk_no" class="col-sm-3 control-label">口座番号</label>
    <div class="col-sm-2">
      <?php echo form_input('wr_bk_no',set_value('wr_bk_no',$_smarty_tpl->tpl_vars['writer_info']->value['wr_bk_no']),'class="col-sm-4 form-control" placeholder="口座番号"');?>

      <?php if (form_error('wr_bk_no')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_bk_no');?>
</font></label><?php }?>
    </div>
    <label for="wr_bk_name" class="col-sm-2 control-label">口座名義人 (半角カナ)</label>
    <div class="col-sm-4">
      <?php echo form_input('wr_bk_name',set_value('wr_bk_name',$_smarty_tpl->tpl_vars['writer_info']->value['wr_bk_name']),'class="col-sm-4 form-control" placeholder="口座名義人を入力してください"');?>

      <?php if (form_error('wr_bk_name')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_bk_name');?>
</font></label><?php }?>
    </div>
  </div>

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