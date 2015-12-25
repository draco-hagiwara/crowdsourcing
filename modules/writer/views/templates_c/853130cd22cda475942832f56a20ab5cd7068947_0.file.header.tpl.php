<?php /* Smarty version 3.1.27, created on 2015-12-15 09:21:49
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:954551463566f5d1d3ff4e9_87664915%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '853130cd22cda475942832f56a20ab5cd7068947' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/header.tpl',
      1 => 1450138749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '954551463566f5d1d3ff4e9_87664915',
  'variables' => 
  array (
    'login_chk' => 0,
    'login_name' => 0,
    'mem_rank' => 0,
    'mem_entry' => 0,
    'attr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566f5d1d447620_21466117',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f5d1d447620_21466117')) {
function content_566f5d1d447620_21466117 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '954551463566f5d1d3ff4e9_87664915';
?>
<!DOCTYPE html>
<html class="no-js" lang="jp">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>CS &#xB7; Crowd Sourcing</title>

<?php echo '<script'; ?>
 type="text/javascript" src="https://www.google.com/jsapi"><?php echo '</script'; ?>
>

<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/normalize.css">
<link rel="stylesheet" href="../../css/main.css">

<?php echo '<script'; ?>
 src="../../js/jquery-2.1.4.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../js/jquery-ui-3.0.2.custom.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../js/bootstrap.min.js"><?php echo '</script'; ?>
>

</head>


<small>グリッド&レスポンシブ対応</small>
<div>
  <section class="container">
    <!-- TwitterBootstrapのグリッドシステムclass="row"で開始 -->
    <div class="row">

    <?php if ($_smarty_tpl->tpl_vars['login_chk']->value == TRUE) {?>

      <div class="page-header">
        <h1>C<small>rowd</small> S<small>ourcing</small></h1>

        <ul class="list-inline text-right">
          <li>こんにちは　<?php echo $_smarty_tpl->tpl_vars['login_name']->value;?>
 さん。
          　　現在のあなたのランクは <?php if ($_smarty_tpl->tpl_vars['mem_rank']->value == 1) {?>ブロンズ<?php } elseif ($_smarty_tpl->tpl_vars['mem_rank']->value == 2) {?>シルバー<?php } elseif ($_smarty_tpl->tpl_vars['mem_rank']->value == 3) {?>ゴールド<?php }?> です。
          <?php if ($_smarty_tpl->tpl_vars['mem_entry']->value) {?><br>エントリー中<?php }?>
          </li>
        </ul>

        <nav class="navbar navbar-inverse">
        <div class="navbar-header">
  		  <a href="#" class="navbar-brand">CS</a>
        </div>

        <div id="patern05" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		    <li><a href="/">TOP</a></li>
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">仕事を探す<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="/search_list/">案件一覧</a></li>
				<li><a href="/search_genre/">ジャンル一覧</a></li>
			  </ul>
		    </li>

			<?php echo form_open('/search_list/search/','name="seachForm" class="navbar-form navbar-left" role="search"');?>

		      <div class="form-group">
		         <?php echo form_input('pj_order_title',set_value('pj_order_title',''),'class="form-control" placeholder="仕事を探す"');?>

		      </div>

		      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'submit';?>
              <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['type'] = 'submit';?>
              <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['value'] = '_navsearch';?>
              <?php echo form_button($_smarty_tpl->tpl_vars['attr']->value,'検　　索','class="btn btn-default"');?>

		    <?php echo form_close();?>


		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">マイページ<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="/my_entrylist/">エントリー一覧</a></li>
				<li><a href="/my_pay/">月別明細</a></li>
				<li><a href="/my_profile/">プロフィール 編集</a></li>
				<li><a href="/my_memfile/">会員情報 編集</a></li>
				<li><a href="/my_byebye/">登録解除</a></li>
			  </ul>
		    </li>
		    <li><a href="/top/guide/">ご利用ガイド</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
		    <li><a href="/top/logout/">ログアウト</a></li>
          </ul>
        </div>
        </nav>

	  </div>

    <?php } else { ?>

      <div class="page-header">
        <h1>C<small>rowd</small> S<small>ourcing</small></h1>

        <ul class="list-inline text-right">
          <li><a href="/entrywriter/">新規会員登録</a></li>
          <li><a href="/login/">ログイン</a></li>
        </ul>

        <nav class="navbar navbar-inverse">
        <div class="navbar-header">
  		  <a href="#" class="navbar-brand">CS</a>
        </div>

        <div id="patern05" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		    <li><a href="/">TOP</a></li>
		    <li><a href="/top/guide/">ご利用ガイド</a></li>
          </ul>
        </div>
        </nav>

        <ul class="list-inline text-right">
          <li><a href="../../entryclient">クライアント新規登録</a></li>
          <li><a href="/client/login/">Clientログイン</a></li>
          <li><a href="/admin/login/">ADMIINログイン</a></li>
        </ul>
	  </div>

    <?php }

}
}
?>