<!DOCTYPE html>
<html class="no-js" lang="jp">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>CS &#xB7; Crowd Sourcing</title>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/normalize.css">
<link rel="stylesheet" href="../../css/main.css">

<script src="../../js/jquery-2.1.4.min.js"></script>
<script src="../../js/jquery-ui-3.0.2.custom.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/main.js"></script>
</head>


<small>グリッド&レスポンシブ対応</small>
<div>
  <section class="container">
    <!-- TwitterBootstrapのグリッドシステムclass="row"で開始 -->
    <div class="row">

    {if $login_chk==TRUE}
      <div class="page-header">
        <h1>C<small>rowd</small> S<small>ourcing</small></h1>

        <ul class="list-inline text-right">
           <li class=""><a href="/entrywriter/">マイページ</a></li>
           <li class=""><a href="/top/logout/">ログアウト</a></li>
        </ul>


		<nav class="navbar navbar-inverse">
		<div class="navbar-header">toggle="collapse" data-target="#patern05">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <a href="/" class="navbar-brand">TOP</a>
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
    {else}
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

        <ul class="list-inline text-right">
          <li><a href="/client/login/">Clientログイン</a></li>
          <li><a href="/admin/login/">ADMIINログイン</a></li>
        </ul>

	  </div>
    {/if}
