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

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >

<script>
  $(function() {
    $("#datepicker_1").datepicker();
    $("#datepicker_2").datepicker();
    $("#datepicker_3").datepicker();
    $("#datepicker_4").datepicker();
  });
</script>

</head>


<small>グリッド&レスポンシブ対応</small>
<div>
  <section class="container">
    <!-- TwitterBootstrapのグリッドシステムclass="row"で開始 -->
    <div class="row">

    {if $login_chk==TRUE}
      {if $auth_cd==10 OR $auth_cd==0}
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
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">申請案件管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/client/entrylist/">申請案件一覧</a></li>
                    <li><a href="/client/entryorder/index/0/">新規作成</a></li>
                  </ul>
                </li>
                <li><a href="/client/orderlist/">案件状況管理</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">支払管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/client/pay_list/">支払＆請求 月次実績</a></li>
                    <li><a href="/client/pay_detail/">支払＆請求ポイント 明細</a></li>
                  </ul>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{$login_name}<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/client/cl_member/">メンバー管理</a></li>
                    <li><a href="/client/cl_profile/">プロフィール編集</a></li>
                    <li><a href="/client/cl_info/">システム設定</a></li>
                    <li><a href="/client/cl_contract/">契約情報</a></li>
                    <li><a href="/client/login/logout/">ログアウト</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      {elseif $auth_cd==11}
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
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">申請案件管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/client/entrylist/">申請案件一覧</a></li>
                    <li><a href="/client/entryorder/index/0/">新規作成</a></li>
                  </ul>
                </li>
                <li><a href="/client/orderlist/">案件状況管理</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{$login_name}<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/client/login/logout/">ログアウト</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      {/if}
    {else}
    <div class="page-header">
      <h1>C<small>rowd</small> S<small>ourcing</small></h1>

      <ul class="list-inline text-right">
        <li><a href="/entrywriter/">新規会員登録</a></li>
        <li><a href="/writer/login/">ログイン</a></li>
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
