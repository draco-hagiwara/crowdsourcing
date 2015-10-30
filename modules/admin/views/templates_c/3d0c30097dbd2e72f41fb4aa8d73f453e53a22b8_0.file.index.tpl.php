<?php /* Smarty version 3.1.27, created on 2015-10-30 12:49:41
         compiled from "/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/entrylist/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1935227955632e8d51ab8c5_45011343%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d0c30097dbd2e72f41fb4aa8d73f453e53a22b8' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/entrylist/index.tpl',
      1 => 1445828063,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1935227955632e8d51ab8c5_45011343',
  'variables' => 
  array (
    'serch_item' => 0,
    'options_pe_status' => 0,
    'options_genre_list' => 0,
    'options_orderstatus' => 0,
    'options_orderid' => 0,
    'attr' => 0,
    'countall' => 0,
    'set_pagination' => 0,
    'entry_list' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5632e8d525b1b1_92120641',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5632e8d525b1b1_92120641')) {
function content_5632e8d525b1b1_92120641 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/modules/admin/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '1935227955632e8d51ab8c5_45011343';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div id="contents" class="container">

<h4>【申請案件　検索】</h4>
<?php echo form_open('/entrylist/search/','name="searchForm" class="form-horizontal"');?>

  <table class="table table-hover table-bordered">
	<tbody>

	<div class="row">
	  <tr>
		<td class="col-sm-2">申請ID</td>
		<td class="col-sm-2">
		  <?php echo form_input('pe_id',set_value('pe_id',$_smarty_tpl->tpl_vars['serch_item']->value['pe_id']),'class="form-control" placeholder=""');?>

		  <?php if (form_error('pe_id')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_id');?>
</font></label><?php }?>
		</td>
		<td class="col-sm-2">クライアントID</td>
		<td class="col-sm-2">
		  <?php echo form_input('pe_cl_id',set_value('pe_cl_id',$_smarty_tpl->tpl_vars['serch_item']->value['pe_cl_id']),'class="form-control" placeholder=""');?>

		  <?php if (form_error('pe_cl_id')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_cl_id');?>
</font></label><?php }?>
		</td>
		<td class="col-sm-2">ステータス</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('pe_status',$_smarty_tpl->tpl_vars['options_pe_status']->value,set_value('pe_status',$_smarty_tpl->tpl_vars['serch_item']->value['pe_status']));?>

		</td>
	  </tr>
	  <tr>
		<td class="col-sm-2">申請案件タイトル</td>
		<td class="col-sm-6" colspan="3">
		  <?php echo form_input('pe_entry_title',set_value('pe_entry_title',$_smarty_tpl->tpl_vars['serch_item']->value['pe_entry_title']),'class="form-control" placeholder="申請案件タイトルを入力してください。"');?>

		  <?php if (form_error('pe_entry_title')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_entry_title');?>
</font></label><?php }?>
		</td>
		<td class="col-sm-2">ジャンル</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('pe_genre01',$_smarty_tpl->tpl_vars['options_genre_list']->value,set_value('pe_genre01',$_smarty_tpl->tpl_vars['serch_item']->value['pe_genre01']));?>

		</td>
	  </tr>
	</div>

	</tbody>
  </table>

  <table class="table table-hover table-bordered">
	<tbody>
	  <tr>
		<td class="col-sm-2">並び替え</td>
		<td class="col-sm-2">ステータス</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('orderstatus',$_smarty_tpl->tpl_vars['options_orderstatus']->value,set_value('orderstatus',$_smarty_tpl->tpl_vars['serch_item']->value['orderstatus']));?>

		</td>
		<td class="col-sm-2">案件申請ID</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('orderid',$_smarty_tpl->tpl_vars['options_orderid']->value,set_value('orderid',$_smarty_tpl->tpl_vars['serch_item']->value['orderid']));?>

		</td>
		<td class="col-sm-offset-2"></td>
	  </tr>
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








<?php echo form_open('/entrylist/detail00/','name="detailForm" class="form-horizontal"');?>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>申請ID</th>
				<th>clientID</th>
				<th>status</th>
				<th>申請案件タイトル</th>
				<th>ジャンル</th>
				<th>申請日</th>
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
					<button type="submit" class="btn btn-success btn-xs" name="peid_uniq" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['pe_id'];?>
">更新</button>
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pe_id'];?>

				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pe_cl_id'];?>

				</td>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['list']->value['pe_status'] == "1") {?><font color="#ffffff" style="background-color:#0000ff">申 請 中</font>
					<?php } elseif ($_smarty_tpl->tpl_vars['list']->value['pe_status'] == "3") {?><font color="#ffffff" style="background-color:#a9a9a9">非 承 認</font>
					<?php } else { ?>}エラー
					<?php }?>
				</td>
				<td style="text-overflow: ellipsis;">
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pe_entry_title'];?>

				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['options_genre_list']->value[$_smarty_tpl->tpl_vars['list']->value['pe_genre01']];?>

				</td>
				<td>
					<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value['pe_entry_date'],"%Y-%m-%d");?>

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

<?php echo $_smarty_tpl->getSubTemplate ("../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



</body>
</html>
<?php }
}
?>