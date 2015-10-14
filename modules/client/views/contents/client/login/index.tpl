{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>ログイン画面　　<span class="label label-info">クライアント</span></h3>
</div>

{form_open('/login/check/' , 'name="LoginForm" class="form-horizontal"')}


  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      {if $err_mess !=''}<span class="label label-danger">Error : </span><label><font color=red>{$err_mess}</font></label>{/if}
    </div>
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="cl_email">ログインID　（メールアドレス）</label>
      {form_input('cl_email' , set_value('cl_email', '') , 'class="form-control" placeholder="ログインID（メールアドレス）を入力してください。"')}
      {if form_error('cl_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_email')}</font></label>{/if}
  </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="cl_password">パスワード</label>
      {form_password('cl_password' , '' , 'class="form-control" placeholder="パスワードを入力してください。"')}
      {if form_error('cl_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_password')}</font></label>{/if}
  </div>
  </div>

  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {form_button($attr , 'ログイン' , 'class="btn btn-default"')}
    </div>
  </div>

{form_close()}


{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
