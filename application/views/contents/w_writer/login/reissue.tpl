{* ヘッダー部分　START *}
	{include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>パスワード再発行画面　　<span class="label label-success">ライター</span></h3>
</div>

{form_open('login/reissuecheck/' , 'name="reLoginForm" class="form-horizontal"')}

  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="wr_email">ログインID　（メールアドレス）</label>
      {form_input('wr_email' , set_value('wr_email', '') , 'class="form-control" placeholder="ログインID（メールアドレス）を入力してください。"')}
      {if form_error('wr_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_email')}</font></label>{/if}
      {if $err_mess !=''}<span class="label label-danger">Error : </span><label><font color=red>{$err_mess}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="wr_password">再発行パスワード</label>
      {form_password('wr_password' , '' , 'class="form-control" placeholder="パスワードを入力してください。"')}
      {if form_error('wr_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_password')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="retype_password">パスワード再入力</label>
      {form_password('retype_password' , '' , 'class="form-control" placeholder="上記で入力したパスワードを再入力してください。"')}
      {if form_error('retype_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('retype_password')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      <label for="captcha_img">画像認証コード</label><br />
      {$captcha['image']}
    </div>
  </div>
  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-3 col-sm-offset-8">
      {form_input('captcha_chr' , '' , 'class="form-control" placeholder="画像認証コードを入力してください。"')}
      {if form_error('captcha_chr')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('captcha_chr')}</font></label>{/if}
      {if $err_captcha !=''}<span class="label label-danger">Error : </span><label><font color=red>{$err_captcha}</font></label>{/if}
    </div>
  </div>

  <div class="form-group">
    <div class=" col-sm-offset-1 col-sm-6 col-sm-offset-5">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {form_button($attr , 'パスワード仮発行' , 'class="btn btn-default"')}
    </div>
  </div>

  {form_hidden('ticket', $ticket)}
  {form_hidden('captcha_word', $captcha['word'])}

{form_close()}


{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
