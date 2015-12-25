<?php /* Smarty version 3.1.27, created on 2015-12-15 11:56:04
         compiled from "/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/my_entrylist/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1576340384566f81444dae11_72593848%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11acd7c382cf6584b87583bcc25fbfafcc365f8f' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/my_entrylist/index.tpl',
      1 => 1450141352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1576340384566f81444dae11_72593848',
  'variables' => 
  array (
    'serch_item' => 0,
    'options_workstatus' => 0,
    'attr' => 0,
    'countall' => 0,
    'set_pagination' => 0,
    'entry_list' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566f814456d9f3_89359756',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f814456d9f3_89359756')) {
function content_566f814456d9f3_89359756 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/modules/writer/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '1576340384566f81444dae11_72593848';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div id="contents" class="container">

<h4>【仕事　検索】</h4>
<?php echo form_open('/my_entrylist/search/','name="searchForm" class="form-horizontal"');?>

  <table class="table table-hover table-bordered">
	<tbody>

	<div class="row">
	  <tr>
	  <tr>
		<td class="col-sm-2">作業ID</td>
		<td class="col-sm-4">
		  <?php echo form_input('pj_id',set_value('pj_id',$_smarty_tpl->tpl_vars['serch_item']->value['pj_id']),'class="form-control" placeholder="作業IDを入力してください。"');?>

		  <?php if (form_error('pj_id')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_id');?>
</font></label><?php }?>
		</td>
		<td class="col-sm-2">作業状態</td>
		<td class="col-sm-4">
		  <?php echo form_dropdown('wi_pj_work_status',$_smarty_tpl->tpl_vars['options_workstatus']->value,set_value('wi_pj_work_status',$_smarty_tpl->tpl_vars['serch_item']->value['wi_pj_work_status']));?>

		</td>
	  </tr>
	</div>

	</tbody>
  </table>

  <div class="row">
	<div class="col-sm-5 col-sm-offset-5">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['value'] = '_submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'検　　索','class="btn btn-default"');?>

	</div>
  </div>

<?php echo form_close();?>



	<ul class="pagination pagination-sm">
		検索結果： <?php echo $_smarty_tpl->tpl_vars['countall']->value;?>
件<br />
		<?php echo $_smarty_tpl->tpl_vars['set_pagination']->value;?>

	</ul>


<?php echo form_open('/my_entrylist/detail00/','name="detailForm" class="form-horizontal"');?>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>状態</th>
				<th>ID</th>
				<th>タイトル</th>
				<th>エントリー日</th>
				<th>投稿〆切日</th>
				<th>文字数</th>
				<th>ポイント</th>
			</tr>
		</thead>

		<?php
$_from = $_smarty_tpl->tpl_vars['entry_list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['list'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['list']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
$foreach_list_Sav = $_smarty_tpl->tpl_vars['list'];
?>
		<tbody>
			<tr>
				<td>
					<?php if (($_smarty_tpl->tpl_vars['list']->value['wi_pj_entry_status'] == TRUE)) {?>
					<button type="submit" class="btn btn-success btn-xs" name="pjid_uniq" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_id'];?>
">作 成</button>
					<?php } else { ?>
					<button type="submit" class="btn btn-primary btn-xs" disabled="disabled" name="pjid_uniq" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_id'];?>
"></button>
					<?php }?>
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['options_workstatus']->value[$_smarty_tpl->tpl_vars['list']->value['wi_pj_work_status']];?>

				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_id'];?>

				</td>
				<td style="width: 450px; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_title'];?>

				</td>
				<td>
					<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value['wi_entry_date'],"%Y-%m-%d %H:%M");?>

				</td>
				<td>
					<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value['wi_posting_limit_date'],"%Y-%m-%d %H:%M");?>

				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['list']->value['wi_word_count'];?>

				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['list']->value['wi_point'];?>

				</td>
			</tr>
		</tbody>
		<?php
$_smarty_tpl->tpl_vars['list'] = $foreach_list_Sav;
}
if (!$_smarty_tpl->tpl_vars['list']->_loop) {
?>
			検索結果はありませんでした。
		<?php
}
?>

	</table>
<?php echo form_close();?>



	<ul class="pagination pagination-sm">
	  <?php echo $_smarty_tpl->tpl_vars['set_pagination']->value;?>

	</ul>


</div>



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