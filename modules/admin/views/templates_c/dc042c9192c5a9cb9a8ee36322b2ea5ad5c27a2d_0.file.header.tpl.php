<?php /* Smarty version 3.1.27, created on 2015-10-28 13:55:46
         compiled from "/home/cs/www/cs.com.dev/modules/client/views/contents/client/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:56189191356305552cb1ea4_65739817%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc042c9192c5a9cb9a8ee36322b2ea5ad5c27a2d' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/client/views/contents/client/header.tpl',
      1 => 1445999384,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56189191356305552cb1ea4_65739817',
  'variables' => 
  array (
    'login_chk' => 0,
    'login_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56305552da0238_43950716',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56305552da0238_43950716')) {
function content_56305552da0238_43950716 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '56189191356305552cb1ea4_65739817';
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
  		  <a href="#" class="navbar-brand">クライアントTOP</a>
        </div>

        <div id="patern05" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		    <li><a href="/client/top/">TOP</a></li>
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">申請案件<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="/client/entrylist/">申請案件一覧</a></li>
				<li><a href="/client/entryorder/index/0/">新規作成</a></li>
			  </ul>
		    </li>
		    <li><a href="">案件</a></li>
		    <li><a href="">支払管理</a></li>
          </ul>

		  <ul class="nav navbar-nav navbar-right">
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_smarty_tpl->tpl_vars['login_name']->value;?>
<b class="caret"></b></a>
			  <ul class="dropdown-menu right">
				<li><a href="#">会社情報</a></li>
				<li><a href="#">問合せ</a></li>
				<li><a href="/client/login/logout/">ログアウト</a></li>
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
		  <a href="/client/login/" class="navbar-brand">クライアント管理</a>
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