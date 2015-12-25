<?php /* Smarty version 3.1.27, created on 2015-11-05 13:15:02
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/confirm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:297053936563ad7c60c62f0_48339386%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46e7b398332135d3c622154947d0005f9d202284' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/confirm.tpl',
      1 => 1444384266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '297053936563ad7c60c62f0_48339386',
  'variables' => 
  array (
    'pref_name' => 0,
    'mailmaga_flg' => 0,
    'attr01' => 0,
    'attr02' => 0,
    'ticket' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_563ad7c61669d5_50770150',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_563ad7c61669d5_50770150')) {
function content_563ad7c61669d5_50770150 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '297053936563ad7c60c62f0_48339386';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">新規登録</span></h3>
</div>

<?php echo form_open('entrywriter/complete/','name="CompForm" class="form-horizontal"');?>

  <div class="form-group">
    <label for="wr_name" class="col-sm-4 control-label">お名前</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_name01','');?>
　
      <?php echo form_hidden('wr_name01',set_value('wr_name01',''));?>

      <?php echo set_value('wr_name02','');?>

      <?php echo form_hidden('wr_name02',set_value('wr_name02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_namekana" class="col-sm-4 control-label">お名前カナ</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_namekana01','');?>
　
      <?php echo form_hidden('wr_namekana01',set_value('wr_namekana01',''));?>

      <?php echo set_value('wr_namekana02','');?>

      <?php echo form_hidden('wr_namekana02',set_value('wr_namekana02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-4 control-label">ニックネーム</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_nickname','');?>

      <?php echo form_hidden('wr_nickname',set_value('wr_nickname',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_zip01" class="col-sm-4 control-label">郵便番号</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_zip01','');?>
 -
      <?php echo form_hidden('wr_zip01',set_value('wr_zip01',''));?>

      <?php echo set_value('wr_zip02','');?>

      <?php echo form_hidden('wr_zip02',set_value('wr_zip02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_pref" class="col-sm-4 control-label">都道府県</label>
    <div class="col-sm-8">
      <?php echo $_smarty_tpl->tpl_vars['pref_name']->value;?>

      <?php echo form_hidden('wr_pref',set_value('wr_pref',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr01" class="col-sm-4 control-label">市区町村</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_addr01','');?>

      <?php echo form_hidden('wr_addr01',set_value('wr_addr01',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr02" class="col-sm-4 control-label">町名・番地</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_addr02','');?>

      <?php echo form_hidden('wr_addr02',set_value('wr_addr02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_buil" class="col-sm-4 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_buil','');?>

      <?php echo form_hidden('wr_buil',set_value('wr_buil',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_email" class="col-sm-4 control-label">メールアドレス＆ログインID</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_email','');?>

      <?php echo form_hidden('wr_email',set_value('wr_email',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_email_mobile" class="col-sm-4 control-label">携帯メールアドレス</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_email_mobile','');?>

      <?php echo form_hidden('wr_email_mobile',set_value('wr_email_mobile',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_tel" class="col-sm-4 control-label">電話番号</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_tel','');?>

      <?php echo form_hidden('wr_tel',set_value('wr_tel',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_mobile" class="col-sm-4 control-label">携帯番号</label>
    <div class="col-sm-8">
      <?php echo set_value('wr_mobile','');?>

      <?php echo form_hidden('wr_mobile',set_value('wr_mobile',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_mailmaga_flg" class="col-sm-4 control-label">メルマガ配信希望</label>
    <div class="col-sm-8">
      <?php if ($_smarty_tpl->tpl_vars['mailmaga_flg']->value) {?>配信を希望する<?php } else { ?>配信を希望しない<?php }?>
      <?php echo form_hidden('wr_mailmaga_flg',$_smarty_tpl->tpl_vars['mailmaga_flg']->value);?>

    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
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
      <?php echo form_button($_smarty_tpl->tpl_vars['attr02']->value,'登　　録','class="btn btn-default"');?>

    </div>
  </div>

  <?php echo form_hidden('ticket',$_smarty_tpl->tpl_vars['ticket']->value);?>

  <?php echo form_hidden('wr_password',set_value('wr_password',''));?>

  <?php echo form_hidden('retype_password',set_value('retype_password',''));?>


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