<?php /* Smarty version 3.1.27, created on 2015-12-09 12:49:52
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/search_list/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:919516165667a4e0b66337_85651669%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef8773032c397750a6cff01783deca9e6d78ca10' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/search_list/index.tpl',
      1 => 1449632988,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '919516165667a4e0b66337_85651669',
  'variables' => 
  array (
    'serch_item' => 0,
    'options_genre_list' => 0,
    'attr' => 0,
    'countall' => 0,
    'set_pagination' => 0,
    'order_list' => 0,
    'mem_entry' => 0,
    'mem_rank' => 0,
    'list' => 0,
    'options_diff_list' => 0,
    'options_rank_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5667a4e0bdd3c3_26686930',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5667a4e0bdd3c3_26686930')) {
function content_5667a4e0bdd3c3_26686930 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/application/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '919516165667a4e0b66337_85651669';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div id="contents" class="container">

<h4>【仕事　検索】</h4>
<?php echo form_open('/search_list/search/','name="searchForm" class="form-horizontal"');?>

  <table class="table table-hover table-bordered">
	<tbody>

	<div class="row">
	  <tr>
	  <tr>
		<td class="col-sm-2">仕事タイトル</td>
		<td class="col-sm-6" colspan="3">
		  <?php echo form_input('pj_order_title',set_value('pj_order_title',$_smarty_tpl->tpl_vars['serch_item']->value['pj_order_title']),'class="form-control" placeholder="タイトルを入力してください。"');?>

		  <?php if (form_error('pj_order_title')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_order_title');?>
</font></label><?php }?>
		</td>
		<td class="col-sm-2">ジャンル</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('pj_genre01',$_smarty_tpl->tpl_vars['options_genre_list']->value,set_value('pj_genre01',$_smarty_tpl->tpl_vars['serch_item']->value['pj_genre01']));?>

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


<?php echo form_open('/search_list/detail00/','name="detailForm" class="form-horizontal"');?>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th></th>
				<th>仕事タイトル</th>
				<th>ジャンル</th>
				<th>対象ランク</th>
				<th>文字単価</th>
				<th>最低文字数</th>
				<th>～応募期間</th>
			</tr>
		</thead>

		<?php
$_from = $_smarty_tpl->tpl_vars['order_list']->value;
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
					<?php if (($_smarty_tpl->tpl_vars['mem_entry']->value == FALSE) && ($_smarty_tpl->tpl_vars['mem_rank']->value >= $_smarty_tpl->tpl_vars['list']->value['pj_mm_rank_id'])) {?>
					<button type="submit" class="btn btn-success btn-xs" name="pjid_uniq" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_id'];?>
">詳細</button>
					<?php } else { ?>
					<button type="submit" class="btn btn-success btn-xs" disabled="disabled" name="pjid_uniq" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_id'];?>
">詳細</button>
					<?php }?>
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['options_diff_list']->value[$_smarty_tpl->tpl_vars['list']->value['pj_taa_difficulty_id']];?>

				</td>
				<td style="width: 450px; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_title'];?>

				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['options_genre_list']->value[$_smarty_tpl->tpl_vars['list']->value['pj_genre01']];?>

				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['options_rank_list']->value[$_smarty_tpl->tpl_vars['list']->value['pj_mm_rank_id']];?>
 以上
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['list']->value['word_tanka'];?>
 円
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_char_cnt'];?>
 文字
				</td>
				<td>
					<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value['pj_end_time'],"%Y-%m-%d %H:%M");?>

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