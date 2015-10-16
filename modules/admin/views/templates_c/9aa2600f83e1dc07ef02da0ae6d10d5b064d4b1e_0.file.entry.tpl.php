<?php /* Smarty version 3.1.27, created on 2015-10-09 19:43:34
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/entry.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:37015504256179a56740174_84953833%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9aa2600f83e1dc07ef02da0ae6d10d5b064d4b1e' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/entry.tpl',
      1 => 1444387410,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37015504256179a56740174_84953833',
  'variables' => 
  array (
    'options_pref' => 0,
    'err_email' => 0,
    'err_passwd' => 0,
    'mailmaga_flg' => 0,
    'attr' => 0,
    'ticket' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56179a5680efb6_15919789',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56179a5680efb6_15919789')) {
function content_56179a5680efb6_15919789 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '37015504256179a56740174_84953833';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>会員情報　　<span class="label label-success">新規登録</span></h3>
</div>

<?php echo form_open('entrywriter/confirm/','name="EntrywriterForm" class="form-horizontal"');?>

  <div class="form-group">
    <label for="wr_name" class="col-sm-3 control-label">お名前<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('wr_name01',set_value('wr_name01',''),'class="form-control" placeholder="お名前姓を入力してください"');?>

      <?php if (form_error('wr_name01')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_name01');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-4">
      <?php echo form_input('wr_name02',set_value('wr_name02',''),'class="form-control" placeholder="お名前名を入力してください"');?>

      <?php if (form_error('wr_name02')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_name02');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_namekana" class="col-sm-3 control-label">お名前カナ（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('wr_namekana01',set_value('wr_namekana01',''),'class="form-control" placeholder="お名前セイを入力してください"');?>

      <?php if (form_error('wr_namekana01')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_namekana01');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-4">
      <?php echo form_input('wr_namekana02',set_value('wr_namekana02',''),'class="form-control" placeholder="お名前メイを入力してください"');?>

      <?php if (form_error('wr_namekana02')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_namekana02');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-3 control-label">ニックネーム<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_input('wr_nickname',set_value('wr_nickname',''),'class="form-control" placeholder="ニックネームを入力してください"');?>

      <?php if (form_error('wr_nickname')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_nickname');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-primary">表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_zip" class="col-sm-3 control-label">郵便番号<font color=red>【必須】</font></label>
    <div class="col-sm-2">
      <?php echo form_input('wr_zip01',set_value('wr_zip01',''),'class="form-control" placeholder="郵便番号（3ケタ）"');?>

      <?php if (form_error('wr_zip01')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_zip01');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-2">
      <?php echo form_input('wr_zip02',set_value('wr_zip02',''),'class="form-control" placeholder="郵便番号（4ケタ）"');?>

      <?php if (form_error('wr_zip02')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_zip02');?>
</font></label><?php }?>
    </div>
    <div class=" col-sm-offset-4 col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_pref" class="col-sm-3 control-label">都道府県<font color=red>【必須】</font></label>
    <div class="col-sm-2 btn-lg">
      <?php echo form_dropdown('wr_pref',$_smarty_tpl->tpl_vars['options_pref']->value,set_value('wr_pref',''));?>

      <?php if (form_error('wr_pref')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_pref');?>
</font></label><?php }?>
    </div>
    <div class=" col-sm-offset-6 col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr01" class="col-sm-3 control-label">市区町村<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_input('wr_addr01',set_value('wr_addr01',''),'class="form-control" placeholder="市区町村を入力してください"');?>

      <?php if (form_error('wr_addr01')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_addr01');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr02" class="col-sm-3 control-label">町名・番地<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_input('wr_addr02',set_value('wr_addr02',''),'class="form-control" placeholder="町名・番地を入力してください"');?>

      <?php if (form_error('wr_addr02')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_addr02');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_buil" class="col-sm-3 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      <?php echo form_input('wr_buil',set_value('wr_buil',''),'class="form-control" placeholder="ビル・マンション名などを入力してください"');?>

      <?php if (form_error('wr_buil')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_buil');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email" class="col-sm-3 control-label">メールアドレス（代表）<br>＆　ログインID<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_input('wr_email',set_value('wr_email',''),'class="col-sm-4 form-control" placeholder="メールアドレス（ログインID）を入力してください"');?>

      <?php if (form_error('wr_email')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_email');?>
</font></label><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['err_email']->value == TRUE) {?><span class="label label-danger">Error : </span><label><font color=red>「メールアドレス」欄で入力したアドレスは既に他で使用されています。再度他のアドレスを入力してください。</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_password" class="col-sm-3 control-label">パスワード<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_password('wr_password',set_value('wr_password',''),'class="form-control" placeholder="パスワード　(半角英数字・記号：８文字以上)"');?>

      <p class="redText"><small>※お客様のお名前や、生年月日、またはその他の個人情報など、推測されやすい情報は使用しないでください</small></p>
      <?php if (form_error('wr_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_password');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="retype_password" class="col-sm-3 control-label">パスワード再入力<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_password('retype_password',set_value('retype_password',''),'class="form-control" placeholder="パスワード再入力　(半角英数字・記号：８文字以上)"');?>

      <p><small>確認のため、もう一度入力してください。</small></p>
      <?php if (form_error('retype_password')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('retype_password');?>
</font></label><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['err_passwd']->value == TRUE) {?><span class="label label-danger">Error : </span><label><font color=red>「パスワード」欄で入力した文字と違います。再度入力してください。</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email_mobile" class="col-sm-3 control-label">携帯メールアドレス</label>
    <div class="col-sm-8">
      <?php echo form_input('wr_email_mobile',set_value('wr_email_mobile',''),'class="col-sm-4 form-control" placeholder="携帯メールアドレス（予備）を入力してください"');?>

      <?php if (form_error('wr_email_mobile')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_email_mobile');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_tel" class="col-sm-3 control-label">電話番号<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_input('wr_tel',set_value('wr_tel',''),'class="form-control" placeholder="電話番号を入力してください"');?>

      <?php if (form_error('wr_tel')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_tel');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mobile" class="col-sm-3 control-label">携帯番号</label>
    <div class="col-sm-8">
      <?php echo form_input('wr_mobile',set_value('wr_mobile',''),'class="form-control" placeholder="携帯番号を入力してください"');?>

      <?php if (form_error('wr_mobile')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_mobile');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mailmaga_flg" class="col-sm-3 control-label">メルマガ配信希望</label>
    <div class="col-sm-8">
      <?php echo form_checkbox('wr_mailmaga_flg[]','1',$_smarty_tpl->tpl_vars['mailmaga_flg']->value);?>
メルマガ配信を希望します
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'確　　認','class="btn btn-default"');?>

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