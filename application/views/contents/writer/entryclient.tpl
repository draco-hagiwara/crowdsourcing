{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">新規登録</span></h3>
</div>

{form_open('entryclient/confirm/' , 'name="EntryclientForm" class="form-horizontal"')}
  <div class="form-group">
    <label for="cl_company" class="col-sm-4 control-label">会　社　名<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_company' , set_value('cl_company', '') , 'class="form-control" placeholder="会社名を入力してください"')}
      {if form_error('cl_company')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_company')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_company_kana" class="col-sm-4 control-label">会　社　名（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_company_kana' , set_value('cl_company_kana', '') , 'class="form-control" placeholder="会社名カナを入力してください"')}
      {if form_error('cl_company_kana')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_company_kana')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_president" class="col-sm-4 control-label">代表者<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_president01' , set_value('cl_president01', '') , 'class="form-control" placeholder="代表者姓を入力してください"')}
      {if form_error('cl_president01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_president02' , set_value('cl_president02', '') , 'class="form-control" placeholder="代表者名を入力してください"')}
      {if form_error('cl_president02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_president_kana" class="col-sm-4 control-label">代表者カナ（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_president_kana01' , set_value('cl_president_kana01', '') , 'class="form-control" placeholder="代表者セイを入力してください"')}
      {if form_error('cl_president_kana01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president_kana01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_president_kana02' , set_value('cl_president_kana02', '') , 'class="form-control" placeholder="代表者メイを入力してください"')}
      {if form_error('cl_president_kana02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president_kana02')}</font></label>{/if}
    </div>
  </div>
    <div class="form-group">
    <label for="cl_department" class="col-sm-4 control-label">担当部署</label>
    <div class="col-sm-4">
      {form_input('cl_department' , set_value('cl_department', '') , 'class="form-control" placeholder="担当部署を入力してください"')}
      {if form_error('cl_department')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_department')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_person" class="col-sm-4 control-label">担当者<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_person01' , set_value('cl_person01', '') , 'class="form-control" placeholder="担当者姓を入力してください"')}
      {if form_error('cl_person01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_person02' , set_value('cl_person02', '') , 'class="form-control" placeholder="担当者名を入力してください"')}
      {if form_error('cl_person02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_person_kana" class="col-sm-4 control-label">担当者カナ（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_person_kana01' , set_value('cl_person_kana01', '') , 'class="form-control" placeholder="担当者セイを入力してください"')}
      {if form_error('cl_person_kana01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person_kana01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_person_kana02' , set_value('cl_person_kana02', '') , 'class="form-control" placeholder="担当者メイを入力してください"')}
      {if form_error('cl_person_kana02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person_kana02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_zip" class="col-sm-4 control-label">郵便番号<font color=red>【必須】</font></label>
    <div class="col-sm-2">
      {form_input('cl_zip01' , set_value('cl_zip01', '') , 'class="form-control" placeholder="郵便番号（3ケタ）"')}
      {if form_error('cl_zip01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_zip01')}</font></label>{/if}
    </div>
    <div class="col-sm-2">
      {form_input('cl_zip02' , set_value('cl_zip02', '') , 'class="form-control" placeholder="郵便番号（4ケタ）"')}
      {if form_error('cl_zip02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_zip02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_pref" class="col-sm-4 control-label">都道府県<font color=red>【必須】</font></label>
    <div class="col-sm-2 btn-lg">
      {form_dropdown('cl_pref', $options_pref, set_value('cl_pref', ''))}
      {if form_error('cl_pref')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_pref')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr01" class="col-sm-4 control-label">市区町村<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_addr01' , set_value('cl_addr01', '') , 'class="form-control" placeholder="市区町村を入力してください"')}
      {if form_error('cl_addr01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_addr01')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr02" class="col-sm-4 control-label">町名・番地<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_addr02' , set_value('cl_addr02', '') , 'class="form-control" placeholder="町名・番地を入力してください"')}
      {if form_error('cl_addr02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_addr02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_buil" class="col-sm-4 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      {form_input('cl_buil' , set_value('cl_buil', '') , 'class="form-control" placeholder="ビル・マンション名などを入力してください"')}
      {if form_error('cl_buil')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_buil')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_email1" class="col-sm-4 control-label">メールアドレス（代表）<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_email1' , set_value('cl_email1', '') , 'class="col-sm-4 form-control" placeholder="メールアドレス（代表）を入力してください"')}
      {if form_error('cl_email1')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_email1')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_email2" class="col-sm-4 control-label">メールアドレス（予備）</label>
    <div class="col-sm-8">
      {form_input('cl_email2' , set_value('cl_email2', '') , 'class="col-sm-4 form-control" placeholder="メールアドレス（予備）を入力してください"')}
      {if form_error('cl_email2')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_email2')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel01" class="col-sm-4 control-label">代表電話番号<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_tel01' , set_value('cl_tel01', '') , 'class="form-control" placeholder="代表電話番号を入力してください"')}
      {if form_error('cl_tel01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_tel01')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel02" class="col-sm-4 control-label">担当者電話番号</label>
    <div class="col-sm-8">
      {form_input('cl_tel02' , set_value('cl_tel02', '') , 'class="form-control" placeholder="担当者電話番号を入力してください"')}
      {if form_error('cl_tel02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_tel02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_mobile" class="col-sm-4 control-label">担当者携帯番号</label>
    <div class="col-sm-8">
      {form_input('cl_mobile' , set_value('cl_mobile', '') , 'class="form-control" placeholder="担当者携帯番号を入力してください"')}
      {if form_error('cl_mobile')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_mobile')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_fax" class="col-sm-4 control-label">ＦＡＸ番号</label>
    <div class="col-sm-8">
      {form_input('cl_fax' , set_value('cl_fax', '') , 'class="form-control" placeholder="ＦＡＸ番号を入力してください"')}
      {if form_error('cl_fax')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_fax')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_hp" class="col-sm-4 control-label">会社ＨＰ(http://～)</label>
    <div class="col-sm-8">
      {form_input('cl_hp' , set_value('cl_hp', '') , 'class="form-control" placeholder="会社ＨＰ(http://～)を入力してください"')}
      {if form_error('cl_hp')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_hp')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_password" class="col-sm-4 control-label">パスワード</label>
    <div class="col-sm-8">
      {form_password('cl_password' , set_value('cl_password', '') , 'class="form-control" placeholder="パスワード　(半角英数字・記号：８文字以上)"')}
      <p class="redText"><small>※お客様のお名前や、生年月日、またはその他の個人情報など、推測されやすい情報は使用しないでください</small></p>
      {if form_error('cl_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_password')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="retype_password" class="col-sm-4 control-label">パスワード再入力</label>
    <div class="col-sm-8">
      {form_password('retype_password' , set_value('retype_password', '') , 'class="form-control" placeholder="パスワード再入力　(半角英数字・記号：８文字以上)"')}
      <p><small>確認のため、もう一度入力してください。</small></p>
      {if form_error('retype_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('retype_password')}</font></label>{/if}
      {if $err_passwd==FALSE}<span class="label label-danger">Error : </span><label><font color=red>「パスワード」欄で入力した文字と違います。再度入力してください。</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$attr02['name'] = 'submit'}
      {$attr02['type'] = 'submit'}
      {form_button($attr02 , '確　　認' , 'class="btn btn-default"')}
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

{include file="../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
