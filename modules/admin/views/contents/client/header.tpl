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

<link rel="stylesheet" href="{base_url()}../css/bootstrap.min.css">
<link rel="stylesheet" href="{base_url()}../css/normalize.css">
<link rel="stylesheet" href="{base_url()}../css/main.css">

<script src="{base_url()}../js/jquery-2.1.4.min.js"></script>
<script src="{base_url()}../js/jquery-ui-3.0.2.custom.min.js"></script>
<script src="{base_url()}../js/bootstrap.min.js"></script>
<script src="{base_url()}../js/main.js"></script>
</head>


<small>グリッド&レスポンシブ対応</small>
<div>
  <section class="container">
    <!-- TwitterBootstrapのグリッドシステムclass="row"で開始 -->
    <div class="row">

    {if $login_chk==TRUE}
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
		    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{$login_name}<b class="caret"></b></a>
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
		  <a href="/client/login/" class="navbar-brand">クライアント管理</a>
		</div>
	  </nav>

      <ul class="list-inline text-right">
        <li><a href="/client/login/">Clientログイン</a></li>
        <li><a href="/admin/login/">ADMIINログイン</a></li>
      </ul>

	</div>
    {/if}
