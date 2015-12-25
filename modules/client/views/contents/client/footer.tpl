<div class="panel panel-default">
  <div class="panel-body">
    <ul class="list-inline text-center">
      {if $login_chk==TRUE}
        <li><a href="/top/aboutus/" target="_blank">会社概要</a></li>
        <li><a href="/top/privacy/" target="_blank">個人情報保護方針</a></li>
        <li><a href="/top/sitemap/" target="_blank">サイトマップ</a></li>
        <li><a href="{base_url()}../contact">問合せ</a></li>
       {else}
        <li><a href="/top/aboutus/">会社概要</a></li>
        <li><a href="/top/privacy/">個人情報保護方針</a></li>
        <li><a href="/top/sitemap/">サイトマップ</a></li>
        <li><a href="{base_url()}../contact">問合せ</a></li>
        <li><a href="{base_url()}../entryclient">クライアント新規登録</a></li>
        {/if}
    </ul>
  </div>
  <div class="panel-footer text-center">
    Copyright(C) 2015,{{$smarty.now|date_format:"%Y"}} Lavender Marketing Inc. All Rights Reserved.
  </div>
</div>