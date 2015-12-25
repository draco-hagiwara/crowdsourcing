<?php /* Smarty version 3.1.27, created on 2015-11-26 09:20:03
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/my_byebye/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:11784832405656503387d428_51140445%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e72166e7ab3eea3913074190f6561986a13bd79a' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/my_byebye/index.tpl',
      1 => 1448497198,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11784832405656503387d428_51140445',
  'variables' => 
  array (
    'writer_info' => 0,
    'options_wr_status02' => 0,
    'options_wr_mm_rank_id' => 0,
    'attr' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_565650338c8660_57761679',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_565650338c8660_57761679')) {
function content_565650338c8660_57761679 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11784832405656503387d428_51140445';
?>

<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/my/cnfmandsubmit.js"><?php echo '</script'; ?>
>

<body>


<div class="jumbotron">
  <h3>会員登録解除　　<span class="label label-success">退　会</span></h3>
</div>

<?php echo form_open('my_byebye/complete/','name="EntrywriterForm" class="form-horizontal"');?>


  <div class="form-group">
    <label for="wr_id" class="col-sm-2 control-label">ライターID</label>
    <div class="col-sm-2">
      <?php echo $_smarty_tpl->tpl_vars['writer_info']->value['wr_id'];?>

      <?php echo form_hidden('wr_id',$_smarty_tpl->tpl_vars['writer_info']->value['wr_id']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_status" class="col-sm-2 control-label">ステータス (状態)</label>
    <div class="col-sm-2">
      <?php echo $_smarty_tpl->tpl_vars['options_wr_status02']->value[$_smarty_tpl->tpl_vars['writer_info']->value['wr_status']];?>

    </div>
  </div>
  <div class="form-group">
    <label for="wr_mm_rank_id" class="col-sm-2 control-label">会員ランク</label>
    <div class="col-sm-2">
      <?php echo $_smarty_tpl->tpl_vars['options_wr_mm_rank_id']->value[$_smarty_tpl->tpl_vars['writer_info']->value['wr_mm_rank_id']];?>

    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <p>登録を解除すると確定前のポイントおよび付与されていないポイントは無効になります。</p>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <?php $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable('class="btn btn-default" onClick="return orderSubmit()"', null, 0);?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['value'] = '_submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'上記確認し、登録を解除する',$_smarty_tpl->tpl_vars['js']->value);?>

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