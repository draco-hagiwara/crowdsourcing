{* ヘッダー部分　START *}
	{include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>会員情報　　<span class="label label-success">新規登録</span></h3>
</div>

{form_open('entrywriter/confirm/' , 'name="EntrywriterForm" class="form-horizontal"')}
  <div class="form-group">
    <label for="wr_name" class="col-sm-3 control-label">お名前<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('wr_name01' , set_value('wr_name01', '') , 'class="form-control" placeholder="お名前姓を入力してください"')}
      {if form_error('wr_name01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_name01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('wr_name02' , set_value('wr_name02', '') , 'class="form-control" placeholder="お名前名を入力してください"')}
      {if form_error('wr_name02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_name02')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_namekana" class="col-sm-3 control-label">お名前カナ（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('wr_namekana01' , set_value('wr_namekana01', '') , 'class="form-control" placeholder="お名前セイを入力してください"')}
      {if form_error('wr_namekana01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_namekana01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('wr_namekana02' , set_value('wr_namekana02', '') , 'class="form-control" placeholder="お名前メイを入力してください"')}
      {if form_error('wr_namekana02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_namekana02')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-3 control-label">ニックネーム<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_nickname' , set_value('wr_nickname', '') , 'class="form-control" placeholder="ニックネームを入力してください"')}
      {if form_error('wr_nickname')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_nickname')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-primary">表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_zip" class="col-sm-3 control-label">郵便番号<font color=red>【必須】</font></label>
    <div class="col-sm-2">
      {form_input('wr_zip01' , set_value('wr_zip01', '') , 'class="form-control" placeholder="郵便番号（3ケタ）"')}
      {if form_error('wr_zip01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_zip01')}</font></label>{/if}
    </div>
    <div class="col-sm-2">
      {form_input('wr_zip02' , set_value('wr_zip02', '') , 'class="form-control" placeholder="郵便番号（4ケタ）"')}
      {if form_error('wr_zip02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_zip02')}</font></label>{/if}
    </div>
    <div class=" col-sm-offset-4 col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_pref" class="col-sm-3 control-label">都道府県<font color=red>【必須】</font></label>
    <div class="col-sm-2 btn-lg">
      {form_dropdown('wr_pref', $options_pref, set_value('wr_pref', ''))}
      {if form_error('wr_pref')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_pref')}</font></label>{/if}
    </div>
    <div class="col-sm-offset-6 col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr01" class="col-sm-3 control-label">市区町村<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_addr01' , set_value('wr_addr01', '') , 'class="form-control" placeholder="市区町村を入力してください"')}
      {if form_error('wr_addr01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_addr01')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr02" class="col-sm-3 control-label">町名・番地<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_addr02' , set_value('wr_addr02', '') , 'class="form-control" placeholder="町名・番地を入力してください"')}
      {if form_error('wr_addr02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_addr02')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_buil" class="col-sm-3 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      {form_input('wr_buil' , set_value('wr_buil', '') , 'class="form-control" placeholder="ビル・マンション名などを入力してください"')}
      {if form_error('wr_buil')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_buil')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email" class="col-sm-3 control-label">メールアドレス（代表）<br>＆　ログインID<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_email' , set_value('wr_email', '') , 'class="col-sm-4 form-control" placeholder="メールアドレス（ログインID）を入力してください"')}
      {if form_error('wr_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_email')}</font></label>{/if}
      {if $err_email==TRUE}<span class="label label-danger">Error : </span><label><font color=red>「メールアドレス」欄で入力したアドレスは既に他で使用されています。再度他のアドレスを入力してください。</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_password" class="col-sm-3 control-label">パスワード<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_password('wr_password' , set_value('wr_password', '') , 'class="form-control" placeholder="パスワード　(半角英数字・記号：８文字以上)"')}
      <p class="redText"><small>※お客様のお名前や、生年月日、またはその他の個人情報など、推測されやすい情報は使用しないでください</small></p>
      {if form_error('wr_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_password')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="retype_password" class="col-sm-3 control-label">パスワード再入力<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_password('retype_password' , set_value('retype_password', '') , 'class="form-control" placeholder="パスワード再入力　(半角英数字・記号：８文字以上)"')}
      <p><small>確認のため、もう一度入力してください。</small></p>
      {if form_error('retype_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('retype_password')}</font></label>{/if}
      {if $err_passwd==TRUE}<span class="label label-danger">Error : </span><label><font color=red>「パスワード」欄で入力した文字と違います。再度入力してください。</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email_mobile" class="col-sm-3 control-label">携帯メールアドレス</label>
    <div class="col-sm-8">
      {form_input('wr_email_mobile' , set_value('wr_email_mobile', '') , 'class="col-sm-4 form-control" placeholder="携帯メールアドレス（予備）を入力してください"')}
      {if form_error('wr_email_mobile')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_email_mobile')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_tel" class="col-sm-3 control-label">電話番号<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_tel' , set_value('wr_tel', '') , 'class="form-control" placeholder="電話番号を入力してください"')}
      {if form_error('wr_tel')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_tel')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mobile" class="col-sm-3 control-label">携帯番号</label>
    <div class="col-sm-8">
      {form_input('wr_mobile' , set_value('wr_mobile', '') , 'class="form-control" placeholder="携帯番号を入力してください"')}
      {if form_error('wr_mobile')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_mobile')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mailmaga_flg" class="col-sm-3 control-label">メルマガ配信希望</label>
    <div class="col-sm-8">
      {form_checkbox('wr_mailmaga_flg[]','1',$mailmaga_flg)}メルマガ配信を希望します
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {form_button($attr , '確　　認' , 'class="btn btn-default"')}
    </div>
  </div>

  {form_hidden('ticket', $ticket)}

{form_close()}
<!-- </form> -->


{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
