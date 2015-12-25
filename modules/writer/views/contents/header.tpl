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
          <li>こんにちは　{$login_name} さん。
          　　現在のあなたのランクは {if $mem_rank==1}ブロンズ{elseif $mem_rank==2}シルバー{elseif $mem_rank==3}ゴールド{/if} です。
          {if $mem_entry}<br>エントリー中{/if}
          </li>
        </ul>

        <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">CS</a>
        </div>

        <div id="patern05" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/writer/">TOP</a></li>
            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">仕事を探す<b class="caret"></b></a>
              <ul class="dropdown-menu right">
                <li><a href="/writer/search_list/">案件一覧</a></li>
                <li><a href="/writer/search_genre/">ジャンル一覧</a></li>
              </ul>
            </li>

            {form_open('/search_list/search/' , 'name="seachForm" class="navbar-form navbar-left" role="search"')}
              <div class="form-group">
                 {form_input('pj_order_title' , set_value('pj_order_title', '') , 'class="form-control" placeholder="仕事を探す"')}
              </div>

              {$attr['name']  = 'submit'}
              {$attr['type']  = 'submit'}
              {$attr['value'] = '_navsearch'}
              {form_button($attr , '検　　索' , 'class="btn btn-default"')}
            {form_close()}

            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">マイページ<b class="caret"></b></a>
              <ul class="dropdown-menu right">
                <li><a href="/writer/my_entrylist/">エントリー一覧</a></li>
                <li><a href="/writer/my_pay/">月別明細</a></li>
                <li><a href="/writer/my_profile/">プロフィール 編集</a></li>
                <li><a href="/writer/my_memfile/">会員情報 編集</a></li>
                <li><a href="/writer/my_byebye/">登録解除</a></li>
              </ul>
            </li>
            <li><a href="/writer/top/guide/">ご利用ガイド</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/writer/top/logout/">ログアウト</a></li>
          </ul>
        </div>
        </nav>

      </div>

    {else}

      <div class="page-header">
        <h1>C<small>rowd</small> S<small>ourcing</small></h1>

        <ul class="list-inline text-right">
          <li><a href="/entrywriter/">新規会員登録</a></li>
          <li><a href="/writer/login/">ログイン</a></li>
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

    {/if}
