<?php /* Smarty version 3.1.27, created on 2015-12-10 16:30:45
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/top/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:147628657156692a2571bf48_72313568%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6bff29de03074faf78b3ed19501201ba19e6a81' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/top/index.tpl',
      1 => 1449732643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147628657156692a2571bf48_72313568',
  'variables' => 
  array (
    'login_chk' => 0,
    'seach_list' => 0,
    'list' => 0,
    'options_genre_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56692a2576a7b9_28778319',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56692a2576a7b9_28778319')) {
function content_56692a2576a7b9_28778319 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/application/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '147628657156692a2571bf48_72313568';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<?php echo '<script'; ?>
 src="../../js/main.js"><?php echo '</script'; ?>
>

<!--Body content-->


<?php if ($_smarty_tpl->tpl_vars['login_chk']->value == TRUE) {?>

  <br><br>
  <div>
  <h4>【ジャンル＆仕事　検索】</h4>
  <?php echo form_open('/search_genre/search/','name="searchForm" class="form-horizontal"');?>

    <input type="hidden" name="pj_order_title" value="">
    <input type="hidden" name="submit" value="_submit">
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="2">ファション</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="3">アパレル</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="4">アクセサリーン</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="5">美容</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="6">健康</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="7">不動産/賃貸</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="8">住宅/生活</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="9">住宅関連</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="10">地名/人名</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="11">生活/暮らし</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="12">冠婚葬祭/暮らしのマナー</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="13">通信販売</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="14">恋愛/占い</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="15">お悩み</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="16">イベント</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="17">ビジネス/オフィス</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="18">IT・通信関連</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="19">自動車関連</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="20">メディア</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="21">サブカル</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="22">旅行関連</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="23">趣味/娯楽</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="24">グルメ/食べ物</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="25">医療</button>
  <?php echo form_close();?>

  </div>
  <br><br>


<?php } else { ?>

	<div class="jumbotron">
	  <h3>案件情報　　<span class="label label-success">掲載の一部抜粋</span></h3>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>案件タイトル</th>
				<th>ジャンル</th>
				<th>掲載日</th>
			</tr>
		</thead>

		<?php
$_from = $_smarty_tpl->tpl_vars['seach_list']->value;
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
				<tr class="success">
					<td style="text-overflow: ellipsis;">
						<?php echo $_smarty_tpl->tpl_vars['list']->value['pj_title'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['options_genre_list']->value[$_smarty_tpl->tpl_vars['list']->value['pj_genre01']];?>

					</td>
					<td>
						<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value['pj_open_date'],"%Y-%m-%d");?>

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


  <div id="typo">
    <div class="inner">Crowd Sourcing</div>
  </div>

<?php }?>


<br><br><label>■■　お知らせ</label>
<dl class="dl-horizontal">
  <dt>2015.12.07</dt><dd>CrowdSourcing テストスタート</dd>
  <dt>2015.10.10</dt><dd>CrowdSourcing 開発スタート</dd>
</dl>




    <!-- TwitterBootstrapのグリッドシステムclass="row"で終了 -->
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