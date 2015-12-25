<?php /* Smarty version 3.1.27, created on 2015-12-15 12:28:16
         compiled from "/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/my_byebye/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1303154033566f88d053ac54_28575606%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f91e551914928a1fbcbebcc9046bc0b62a133e6b' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/my_byebye/index.tpl',
      1 => 1450141352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1303154033566f88d053ac54_28575606',
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
  'unifunc' => 'content_566f88d057e2a5_21440193',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f88d057e2a5_21440193')) {
function content_566f88d057e2a5_21440193 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1303154033566f88d053ac54_28575606';
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