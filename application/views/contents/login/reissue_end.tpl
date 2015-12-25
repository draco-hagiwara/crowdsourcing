{* ヘッダー部分　START *}
    {include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

{if $reissue_status == 'temp'}
  <div class="jumbotron">
    <h3>メールが送信されました。</h3>
    <p class="redText"><small>送信されたメールの内容を確認し、{$tmp_time}分以内に手続きを完了させてください。</small></p>
  </div>
{elseif $reissue_status == 'ok'}
  <div class="jumbotron">
    <h3>パスワードの変更が完了いたしました。</h3>
  </div>
{else}
  <div class="jumbotron">
    <h3>パスワードの変更に失敗しました。</h3>
  </div>
{/if}


{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
