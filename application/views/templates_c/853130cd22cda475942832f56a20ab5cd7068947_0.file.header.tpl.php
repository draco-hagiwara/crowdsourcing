<?php /* Smarty version 3.1.27, created on 2015-09-28 19:14:09
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:416100172560912f1183dc4_97592088%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '853130cd22cda475942832f56a20ab5cd7068947' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/header.tpl',
      1 => 1443435244,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '416100172560912f1183dc4_97592088',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560912f11a8863_67571704',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560912f11a8863_67571704')) {
function content_560912f11a8863_67571704 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '416100172560912f1183dc4_97592088';
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
<?php echo '<script'; ?>
 src="../../js/main.js"><?php echo '</script'; ?>
>
</head>


<small>グリッド&レスポンシブ対応</small>
<div>
  <section class="container">
    <!-- TwitterBootstrapのグリッドシステムclass="row"で開始 -->
    <div class="row">

    <div class="page-header">
      <h1>C<small>rowd</small> S<small>ourcing</small></h1>

      <ul class="list-inline text-right">
        <li><a href="#">新規会員登録</a></li>
        <li><a href="#">ログイン</a></li>
      </ul>


	  <nav class="navbar navbar-inverse">
	  <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#patern05">
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
		<a href="/" class="navbar-brand">ｸﾗｳﾄﾞｿｰｼﾝｸﾞ</a>
	  </div>

	  <div id="patern05" class="collapse navbar-collapse">
	    <ul class="nav navbar-nav">
	      <li><a href="">Link1</a></li>
	      <li><a href="">Link2</a></li>

	    <form class="navbar-form navbar-left" role="search">
	       <div class="form-group">
	         <input type="text" class="form-control" placeholder="Search">
	       </div>
	       <button type="submit" class="btn btn-default">Submit</button>
	    </form>
	    </ul>

	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Link3<b class="caret"></b></a>
		    <ul class="dropdown-menu right">
			<li><a href="#">Link3-1</a></li>
			<li><a href="#">Link3-2</a></li>
			<li><a href="#">Link3-3</a></li>
		  </ul>
	     </li>
	    </ul>
	  </div>
	  </nav>

    </div>
<?php }
}
?>