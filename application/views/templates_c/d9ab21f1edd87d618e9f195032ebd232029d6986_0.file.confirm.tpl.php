<?php /* Smarty version 3.1.27, created on 2015-10-17 23:55:34
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/entryclient/confirm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:18562568245622616635b061_39666342%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9ab21f1edd87d618e9f195032ebd232029d6986' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/entryclient/confirm.tpl',
      1 => 1444802410,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18562568245622616635b061_39666342',
  'variables' => 
  array (
    'pref_name' => 0,
    'attr01' => 0,
    'attr02' => 0,
    'ticket' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5622616645bb89_49037838',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5622616645bb89_49037838')) {
function content_5622616645bb89_49037838 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '18562568245622616635b061_39666342';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">新規登録</span></h3>
</div>

<?php echo form_open('entryclient/complete/','name="ConfirmForm" class="form-horizontal"');?>

  <div class="form-group">
    <label for="cl_company" class="col-sm-4 control-label">会　社　名</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_company','');?>

      <?php echo form_hidden('cl_company',set_value('cl_company',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_company_kana" class="col-sm-4 control-label">会　社　名（カナ）</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_company_kana','');?>

      <?php echo form_hidden('cl_company_kana',set_value('cl_company_kana',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_president" class="col-sm-4 control-label">代表者</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_president01','');?>
　
      <?php echo form_hidden('cl_president01',set_value('cl_president01',''));?>

      <?php echo set_value('cl_president02','');?>

      <?php echo form_hidden('cl_president02',set_value('cl_president02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_president_kana" class="col-sm-4 control-label">代表者カナ</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_president_kana01','');?>
　
      <?php echo form_hidden('cl_president_kana01',set_value('cl_president_kana01',''));?>

      <?php echo set_value('cl_president_kana02','');?>
　
      <?php echo form_hidden('cl_president_kana02',set_value('cl_president_kana02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_department" class="col-sm-4 control-label">担当部署</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_department','');?>

      <?php echo form_hidden('cl_department',set_value('cl_department',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_person" class="col-sm-4 control-label">担当者</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_person01','');?>
　
      <?php echo form_hidden('cl_person01',set_value('cl_person01',''));?>

      <?php echo set_value('cl_person02','');?>

      <?php echo form_hidden('cl_person02',set_value('cl_person02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_person_kana" class="col-sm-4 control-label">担当者カナ</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_person_kana01','');?>
　
      <?php echo form_hidden('cl_person_kana01',set_value('cl_person_kana01',''));?>

      <?php echo set_value('cl_person_kana02','');?>

      <?php echo form_hidden('cl_person_kana02',set_value('cl_person_kana02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_zip" class="col-sm-4 control-label">郵便番号</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_zip01','');?>
 -
      <?php echo form_hidden('cl_zip01',set_value('cl_zip01',''));?>

      <?php echo set_value('cl_zip02','');?>

      <?php echo form_hidden('cl_zip02',set_value('cl_zip02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_pref" class="col-sm-4 control-label">都道府県</label>
    <div class="col-sm-8">
      <?php echo $_smarty_tpl->tpl_vars['pref_name']->value;?>

      <?php echo form_hidden('cl_pref',set_value('cl_pref',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr01" class="col-sm-4 control-label">市区町村</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_addr01','');?>

      <?php echo form_hidden('cl_addr01',set_value('cl_addr01',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr02" class="col-sm-4 control-label">町名・番地</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_addr02','');?>

      <?php echo form_hidden('cl_addr02',set_value('cl_addr02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_buil" class="col-sm-4 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_buil','');?>

      <?php echo form_hidden('cl_buil',set_value('cl_buil',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_email" class="col-sm-4 control-label">メールアドレス（代表）<br>＆　ログインID</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_email','');?>

      <?php echo form_hidden('cl_email',set_value('cl_email',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_email2" class="col-sm-4 control-label">メールアドレス（予備）</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_email2','');?>

      <?php echo form_hidden('cl_email2',set_value('cl_email2',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel01" class="col-sm-4 control-label">代表電話番号</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_tel01','');?>

      <?php echo form_hidden('cl_tel01',set_value('cl_tel01',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel02" class="col-sm-4 control-label">担当者電話番号</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_tel02','');?>

      <?php echo form_hidden('cl_tel02',set_value('cl_tel02',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_mobile" class="col-sm-4 control-label">担当者携帯番号</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_mobile','');?>

      <?php echo form_hidden('cl_mobile',set_value('cl_mobile',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_fax" class="col-sm-4 control-label">ＦＡＸ番号</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_fax','');?>

      <?php echo form_hidden('cl_fax',set_value('cl_fax',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="cl_hp" class="col-sm-4 control-label">会社ＨＰ(http://～)</label>
    <div class="col-sm-8">
      <?php echo set_value('cl_hp','');?>

      <?php echo form_hidden('cl_hp',set_value('cl_hp',''));?>

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

  <?php echo form_hidden('cl_password',set_value('cl_password',''));?>

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