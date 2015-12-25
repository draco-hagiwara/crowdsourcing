<?php /* Smarty version 3.1.27, created on 2015-12-15 12:28:10
         compiled from "/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/my_profile/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1979715985566f88ca114b39_84783694%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd05a16a34ac4c7a2f059cabe4ffe055ecd64b84' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/my_profile/index.tpl',
      1 => 1450141352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1979715985566f88ca114b39_84783694',
  'variables' => 
  array (
    'writer_info' => 0,
    'options_wr_status02' => 0,
    'options_wr_mm_rank_id' => 0,
    'options_pref' => 0,
    'mailmaga_flg' => 0,
    'attr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566f88ca1cbe58_14238272',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f88ca1cbe58_14238272')) {
function content_566f88ca1cbe58_14238272 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1979715985566f88ca114b39_84783694';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>会員プロフィール情報　　<span class="label label-success">更　新</span></h3>
</div>

<?php echo form_open('my_profile/complete/','name="EntrywriterForm" class="form-horizontal"');?>


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
    <label for="wr_name" class="col-sm-3 control-label">お名前<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('wr_name01',set_value('wr_name01',$_smarty_tpl->tpl_vars['writer_info']->value['wr_name01']),'class="form-control" placeholder="お名前姓を入力してください"');?>

      <?php if (form_error('wr_name01')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_name01');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-4">
      <?php echo form_input('wr_name02',set_value('wr_name02',$_smarty_tpl->tpl_vars['writer_info']->value['wr_name02']),'class="form-control" placeholder="お名前名を入力してください"');?>

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
      <?php echo form_input('wr_namekana01',set_value('wr_namekana01',$_smarty_tpl->tpl_vars['writer_info']->value['wr_namekana01']),'class="form-control" placeholder="お名前セイを入力してください"');?>

      <?php if (form_error('wr_namekana01')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_namekana01');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-4">
      <?php echo form_input('wr_namekana02',set_value('wr_namekana02',$_smarty_tpl->tpl_vars['writer_info']->value['wr_namekana02']),'class="form-control" placeholder="お名前メイを入力してください"');?>

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
      <?php echo form_input('wr_nickname',set_value('wr_nickname',$_smarty_tpl->tpl_vars['writer_info']->value['wr_nickname']),'class="form-control" placeholder="ニックネームを入力してください"');?>

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
      <?php echo form_input('wr_zip01',set_value('wr_zip01',$_smarty_tpl->tpl_vars['writer_info']->value['wr_zip01']),'class="form-control" placeholder="郵便番号（3ケタ）"');?>

      <?php if (form_error('wr_zip01')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_zip01');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-2">
      <?php echo form_input('wr_zip02',set_value('wr_zip02',$_smarty_tpl->tpl_vars['writer_info']->value['wr_zip02']),'class="form-control" placeholder="郵便番号（4ケタ）"');?>

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
    <div class="col-sm-offset-6 col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr01" class="col-sm-3 control-label">市区町村<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      <?php echo form_input('wr_addr01',set_value('wr_addr01',$_smarty_tpl->tpl_vars['writer_info']->value['wr_addr01']),'class="form-control" placeholder="市区町村を入力してください"');?>

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
      <?php echo form_input('wr_addr02',set_value('wr_addr02',$_smarty_tpl->tpl_vars['writer_info']->value['wr_addr02']),'class="form-control" placeholder="町名・番地を入力してください"');?>

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
      <?php echo form_input('wr_buil',set_value('wr_buil',$_smarty_tpl->tpl_vars['writer_info']->value['wr_buil']),'class="form-control" placeholder="ビル・マンション名などを入力してください"');?>

      <?php if (form_error('wr_buil')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('wr_buil');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email_mobile" class="col-sm-3 control-label">携帯メールアドレス</label>
    <div class="col-sm-8">
      <?php echo form_input('wr_email_mobile',set_value('wr_email_mobile',$_smarty_tpl->tpl_vars['writer_info']->value['wr_email_mobile']),'class="col-sm-4 form-control" placeholder="携帯メールアドレス（予備）を入力してください"');?>

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
      <?php echo form_input('wr_tel',set_value('wr_tel',$_smarty_tpl->tpl_vars['writer_info']->value['wr_tel']),'class="form-control" placeholder="電話番号を入力してください"');?>

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
      <?php echo form_input('wr_mobile',set_value('wr_mobile',$_smarty_tpl->tpl_vars['writer_info']->value['wr_mobile']),'class="form-control" placeholder="携帯番号を入力してください"');?>

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
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'更　　新','class="btn btn-default"');?>

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