<?php /* Smarty version 3.1.27, created on 2015-10-30 08:22:46
         compiled from "/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2973071485632aa4603b036_70366576%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d7fbd144864e1fb40b3d4a39758274ee207c811' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/header.tpl',
      1 => 1446005484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2973071485632aa4603b036_70366576',
  'variables' => 
  array (
    'login_chk' => 0,
    'login_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5632aa4604dcb0_32165558',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5632aa4604dcb0_32165558')) {
function content_5632aa4604dcb0_32165558 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2973071485632aa4603b036_70366576';
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

<link rel="stylesheet" href="<?php echo base_url();?>
../css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>
../css/normalize.css">
<link rel="stylesheet" href="<?php echo base_url();?>
../css/main.css">

<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/jquery-2.1.4.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/jquery-ui-3.0.2.custom.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/main.js"><?php echo '</script'; ?>
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

      <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#patern05">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
  		  <a href="#" class="navbar-brand">アドミンTOP</a>
        </div>

        <div id="patern05" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		    <li><a href="/admin/top/">TOP</a></li>
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">CL申請管理<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="/admin/entrylist/">CL案件申請一覧</a></li>
			  </ul>
		    </li>
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">案件管理<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="/admin/orderlist/">案件一覧</a></li>
			  </ul>
		    </li>
		    <li><a href="">投稿記事管理</a></li>
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">ライター管理<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="/admin/writerlist/">ライター一覧</a></li>
				<li><a href="#">新規登録</a></li>
			  </ul>
		    </li>
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">クライアント管理<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="/admin/clientlist/">クライアント一覧</a></li>
				<li><a href="#">新規登録</a></li>
			  </ul>
		    </li>
		    <li><a href="">決済管理</a></li>
          </ul>

		  <ul class="nav navbar-nav navbar-right">
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_smarty_tpl->tpl_vars['login_name']->value;?>
<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="#">会社情報</a></li>
				<li><a href="#">問合せ</a></li>
				<li><a href="/admin/login/logout/">ログアウト</a></li>
			  </ul>
		    </li>
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
		<div class="navbar-header">toggle="collapse" data-target="#patern05">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <a href="/admin/login/" class="navbar-brand">アドミン管理</a>
		</div>
	  </nav>

      <ul class="list-inline text-right">
        <li><a href="/client/login/">Clientログイン</a></li>
        <li><a href="/admin/login/">ADMIINログイン</a></li>
      </ul>

	</div>
    <?php }

}
}
?>