{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">新規登録</span></h3>
</div>

{form_open('entrywriter/complete/' , 'name="CompForm" class="form-horizontal"')}
  <div class="form-group">
    <label for="wr_name" class="col-sm-4 control-label">お名前</label>
    <div class="col-sm-8">
      {set_value('wr_name01', '')}　
      {form_hidden('wr_name01', set_value('wr_name01', ''))}
      {set_value('wr_name02', '')}
      {form_hidden('wr_name02', set_value('wr_name02', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_namekana" class="col-sm-4 control-label">お名前カナ</label>
    <div class="col-sm-8">
      {set_value('wr_namekana01', '')}　
      {form_hidden('wr_namekana01', set_value('wr_namekana01', ''))}
      {set_value('wr_namekana02', '')}
      {form_hidden('wr_namekana02', set_value('wr_namekana02', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-4 control-label">ニックネーム</label>
    <div class="col-sm-8">
      {set_value('wr_nickname', '')}
      {form_hidden('wr_nickname', set_value('wr_nickname', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_zip01" class="col-sm-4 control-label">郵便番号</label>
    <div class="col-sm-8">
      {set_value('wr_zip01', '')} -
      {form_hidden('wr_zip01', set_value('wr_zip01', ''))}
      {set_value('wr_zip02', '')}
      {form_hidden('wr_zip02', set_value('wr_zip02', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_pref" class="col-sm-4 control-label">都道府県</label>
    <div class="col-sm-8">
      {$pref_name}
      {form_hidden('wr_pref', set_value('wr_pref', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr01" class="col-sm-4 control-label">市区町村</label>
    <div class="col-sm-8">
      {set_value('wr_addr01', '')}
      {form_hidden('wr_addr01', set_value('wr_addr01', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr02" class="col-sm-4 control-label">町名・番地</label>
    <div class="col-sm-8">
      {set_value('wr_addr02', '')}
      {form_hidden('wr_addr02', set_value('wr_addr02', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_buil" class="col-sm-4 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      {set_value('wr_buil', '')}
      {form_hidden('wr_buil', set_value('wr_buil', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email" class="col-sm-4 control-label">メールアドレス＆ログインID</label>
    <div class="col-sm-8">
      {set_value('wr_email', '')}
      {form_hidden('wr_email', set_value('wr_email', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email_mobile" class="col-sm-4 control-label">携帯メールアドレス</label>
    <div class="col-sm-8">
      {set_value('wr_email_mobile', '')}
      {form_hidden('wr_email_mobile', set_value('wr_email_mobile', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_tel" class="col-sm-4 control-label">電話番号</label>
    <div class="col-sm-8">
      {set_value('wr_tel', '')}
      {form_hidden('wr_tel', set_value('wr_tel', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mobile" class="col-sm-4 control-label">携帯番号</label>
    <div class="col-sm-8">
      {set_value('wr_mobile', '')}
      {form_hidden('wr_mobile', set_value('wr_mobile', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mailmaga_flg" class="col-sm-4 control-label">メルマガ配信希望</label>
    <div class="col-sm-8">
      {if $mailmaga_flg}配信を希望する{else}配信を希望しない{/if}
      {form_hidden('wr_mailmaga_flg', $mailmaga_flg)}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$attr01['name'] = '_back'}
      {$attr01['type'] = 'submit'}
      {$attr01['value'] = '_back'}
      {form_button($attr01 , '戻　　る' , 'class="btn btn-default"')}

      {$attr02['name'] = 'submit'}
      {$attr02['type'] = 'submit'}
      {form_button($attr02 , '登　　録' , 'class="btn btn-default"')}
    </div>
  </div>

  {form_hidden('ticket', $ticket)}
  {form_hidden('wr_password', set_value('wr_password', ''))}
  {form_hidden('retype_password', set_value('retype_password', ''))}

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
