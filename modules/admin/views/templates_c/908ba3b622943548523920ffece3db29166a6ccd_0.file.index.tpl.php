<?php /* Smarty version 3.1.27, created on 2015-10-30 13:21:14
         compiled from "/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/clientlist/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1120230905632f03ad3e220_90719435%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '908ba3b622943548523920ffece3db29166a6ccd' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/clientlist/index.tpl',
      1 => 1445094504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1120230905632f03ad3e220_90719435',
  'variables' => 
  array (
    'options_cl_status01' => 0,
    'options_orderid' => 0,
    'options_orderstatus' => 0,
    'attr' => 0,
    'countall' => 0,
    'set_pagination' => 0,
    'client_list' => 0,
    'cl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5632f03adc44b2_69896350',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5632f03adc44b2_69896350')) {
function content_5632f03adc44b2_69896350 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1120230905632f03ad3e220_90719435';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>ログイン画面　　<span class="label label-danger">アドミン</span></h3>
</div>



<?php echo '<script'; ?>
 type="text/javascript">
<!--
function fmSubmit(formName, url, method, num) {
  var f1 = document.forms[formName];

  console.log(num);

  /* エレメント作成&データ設定&要素追加 */
  var e1 = document.createElement('input');
  e1.setAttribute('type', 'hidden');
  e1.setAttribute('name', 'chg_uniq');
  e1.setAttribute('value', num);
  f1.appendChild(e1);

  /* サブミットするフォームを取得 */
  f1.method = method;                                   // method(GET or POST)を設定する
  f1.action = url;                                      // action(遷移先URL)を設定する
  f1.submit();                                          // submit する
  return true;
}
// -->
<?php echo '</script'; ?>
>












<div id="contents" class="container">

<h4>【クライアント検索】</h4>
<?php echo form_open('/clientlist/search/','name="searchForm" class="form-horizontal"');?>

  <table class="table table-hover table-bordered">
	<tbody>

	  <tr>
		<td class="col-sm-2">会社名</td>
		<td class="col-sm-6">
		  <?php echo form_input('cl_company',set_value('cl_company',''),'class="form-control" placeholder="会社名を入力してください。"');?>

		  <?php if (form_error('cl_company')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('cl_company');?>
</font></label><?php }?>
		</td>
		<td class="col-sm-2">クライアントID</td>
		<td class="col-sm-2">
		  <?php echo form_input('cl_id',set_value('cl_id',''),'class="form-control" placeholder=""');?>

		  <?php if (form_error('cl_id')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('cl_id');?>
</font></label><?php }?>
		</td>
	  </tr>

	  <tr>
		<td class="col-sm-2">メールアドレス</td>
		<td class="col-sm-6">
		  <?php echo form_input('cl_email',set_value('cl_email',''),'class="form-control" placeholder="メールアドレスを入力してください。"');?>

		  <?php if (form_error('cl_email')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('cl_email');?>
</font></label><?php }?>
		</td>
		<td class="col-sm-2">ステータス</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('cl_status',$_smarty_tpl->tpl_vars['options_cl_status01']->value,set_value('cl_status',''));?>

		</td>
	  </tr>
	</tbody>
  </table>

  <table class="table table-hover table-bordered">
	<tbody>
	  <tr>
		<td class="col-sm-2">並び替え</td>
		<td class="col-sm-2">クライアントID</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('orderid',$_smarty_tpl->tpl_vars['options_orderid']->value,set_value('orderid',''));?>

		</td>
		<td class="col-sm-2">ステータス</td>
		<td class="col-sm-2">
		  <?php echo form_dropdown('orderstatus',$_smarty_tpl->tpl_vars['options_orderstatus']->value,set_value('orderstatus',''));?>

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








<?php echo form_open('/clientlist/detail/','name="detailForm" class="form-horizontal"');?>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>ID</th>
				<th>status</th>
				<th>会社名</th>
				<th>メールアドレス</th>
				<th>TEL</th>
			</tr>
		</thead>


		<?php
$_from = $_smarty_tpl->tpl_vars['client_list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['cl'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['cl']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cl']->value) {
$_smarty_tpl->tpl_vars['cl']->_loop = true;
$foreach_cl_Sav = $_smarty_tpl->tpl_vars['cl'];
?>
		<tbody>
			<tr>
				<td>
					<button type="submit" class="btn btn-success btn-xs" name="clid_uniq" value="<?php echo $_smarty_tpl->tpl_vars['cl']->value['cl_id'];?>
">更新</button>
				</td>
				<td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cl']->value['cl_id'], ENT_QUOTES, 'UTF-8', true);?>

				</td>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['cl']->value['cl_status'] == "0") {?><font color="#ffffff" style="background-color:#008000">申 請 中</font>
					<?php } elseif ($_smarty_tpl->tpl_vars['cl']->value['cl_status'] == "1") {?><font color="#ffffff" style="background-color:#0000ff">承　　認</font>
					<?php } elseif ($_smarty_tpl->tpl_vars['cl']->value['cl_status'] == "2") {?><font color="#ffffff" style="background-color:#ff6347">非 承 認</font>
					<?php } elseif ($_smarty_tpl->tpl_vars['cl']->value['cl_status'] == "7") {?><font color="#8a2be2">一時停止</font>
					<?php } elseif ($_smarty_tpl->tpl_vars['cl']->value['cl_status'] == "8") {?><font color="#ffffff" style="background-color:#800000">強制停止</font>
					<?php } elseif ($_smarty_tpl->tpl_vars['cl']->value['cl_status'] == "9") {?><font color="#ffffff" style="background-color:#a9a9a9">退　　会</font>
					<?php } else { ?>}エラー
					<?php }?>
				</td>
				<td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cl']->value['cl_company'], ENT_QUOTES, 'UTF-8', true);?>

				</td>
				<td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cl']->value['cl_email'], ENT_QUOTES, 'UTF-8', true);?>

				</td>
				<td>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cl']->value['cl_tel01'], ENT_QUOTES, 'UTF-8', true);?>

				</td>
			</tr>
		</tbody>
		<?php
$_smarty_tpl->tpl_vars['cl'] = $foreach_cl_Sav;
}
if (!$_smarty_tpl->tpl_vars['cl']->_loop) {
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