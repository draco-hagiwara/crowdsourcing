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
      {if $auth_cd==0}
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
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">案件管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/entrylist/">申請一覧</a></li>
                    <li><a href="/admin/orderlist/">案件準備一覧</a></li>
                    <li><a href="/admin/posting/">投稿記事一覧</a></li>
                  </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">ライター管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/writerlist/">ライター一覧</a></li>
                    <li><a href="/admin/entrywriter/">新規登録</a></li>
                  </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">クライアント管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/clientlist/">クライアント一覧</a></li>
                    <li><a href="/admin/entryclient/">新規登録</a></li>
                  </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">決済管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/pay_cldetail/">クライアント請求明細</a></li>
                    <li><a href="/admin/pay_cllist/">クライアント請求一覧</a></li>
                    <li><a href="/admin/pay_wrdetail/">ライター入金明細</a></li>
                    <li><a href="/admin/pay_wrlist/">ライター入金一覧</a></li>
                    <li><a href="/admin/pay_csvup/">CSVデータ入力</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{$login_name}<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/a_member/">メンバー管理</a></li>
                    <li><a href="/admin/a_profile/">プロフィール</a></li>
                    <li><a href="/admin/login/logout/">ログアウト</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      {elseif $auth_cd==1}
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
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">案件管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/entrylist/">申請一覧</a></li>
                    <li><a href="/admin/orderlist/">案件準備一覧</a></li>
                    <li><a href="/admin/posting/">投稿記事一覧</a></li>
                  </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">ライター管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/writerlist/">ライター一覧</a></li>
                    <li><a href="/admin/entrywriter/">新規登録</a></li>
                  </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">クライアント管理<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/clientlist/">クライアント一覧</a></li>
                    <li><a href="/admin/entryclient/">新規登録</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{$login_name}<b class="caret"></b></a>
                  <ul class="dropdown-menu right">
                    <li><a href="/admin/login/logout/">ログアウト</a></li>
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
          <a href="/admin/login/" class="navbar-brand">アドミン管理</a>
        </div>
      </nav>

      <ul class="list-inline text-right">
        <li><a href="/client/login/">Clientログイン</a></li>
        <li><a href="/admin/login/">ADMIINログイン</a></li>
      </ul>

    </div>
    {/if}
