{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">内容編集</span></h3>
  <br>※「会社名」「会社名カナ」を変更される場合は、メールにてお知らせください。
</div>

{form_open('cl_profile/complete/' , 'name="profileForm" class="form-horizontal"')}
  <div class="form-group">
    <label for="cl_company" class="col-sm-4 control-label">会　社　名</label>
    <div class="col-sm-8">
      {$client_info.cl_company}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_company_kana" class="col-sm-4 control-label">会社名カナ（全角）</label>
    <div class="col-sm-8">
      {$client_info.cl_company_kana}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_president" class="col-sm-4 control-label">代表者<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_president01' , set_value('cl_president01', $client_info.cl_president01) , 'class="form-control" placeholder="代表者姓を入力してください"')}
      {if form_error('cl_president01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_president02' , set_value('cl_president02', $client_info.cl_president02) , 'class="form-control" placeholder="代表者名を入力してください"')}
      {if form_error('cl_president02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_president_kana" class="col-sm-4 control-label">代表者カナ（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_president_kana01' , set_value('cl_president_kana01', $client_info.cl_president_kana01) , 'class="form-control" placeholder="代表者セイを入力してください"')}
      {if form_error('cl_president_kana01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president_kana01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_president_kana02' , set_value('cl_president_kana02', $client_info.cl_president_kana02) , 'class="form-control" placeholder="代表者メイを入力してください"')}
      {if form_error('cl_president_kana02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_president_kana02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_department" class="col-sm-4 control-label">担当部署</label>
    <div class="col-sm-4">
      {form_input('cl_department' , set_value('cl_department', $client_info.cl_department) , 'class="form-control" placeholder="担当部署を入力してください"')}
      {if form_error('cl_department')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_department')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_person" class="col-sm-4 control-label">担当者<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_person01' , set_value('cl_person01', $client_info.cl_person01) , 'class="form-control" placeholder="担当者姓を入力してください"')}
      {if form_error('cl_person01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_person02' , set_value('cl_person02', $client_info.cl_person02) , 'class="form-control" placeholder="担当者名を入力してください"')}
      {if form_error('cl_person02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_person_kana" class="col-sm-4 control-label">担当者カナ（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cl_person_kana01' , set_value('cl_person_kana01', $client_info.cl_person_kana01) , 'class="form-control" placeholder="担当者セイを入力してください"')}
      {if form_error('cl_person_kana01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person_kana01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cl_person_kana02' , set_value('cl_person_kana02', $client_info.cl_person_kana02) , 'class="form-control" placeholder="担当者メイを入力してください"')}
      {if form_error('cl_person_kana02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_person_kana02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_zip" class="col-sm-4 control-label">郵便番号<font color=red>【必須】</font></label>
    <div class="col-sm-2">
      {form_input('cl_zip01' , set_value('cl_zip01', $client_info.cl_zip01) , 'class="form-control" placeholder="郵便番号（3ケタ）"')}
      {if form_error('cl_zip01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_zip01')}</font></label>{/if}
    </div>
    <div class="col-sm-2">
      {form_input('cl_zip02' , set_value('cl_zip02', $client_info.cl_zip02) , 'class="form-control" placeholder="郵便番号（4ケタ）"')}
      {if form_error('cl_zip02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_zip02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_pref" class="col-sm-4 control-label">都道府県<font color=red>【必須】</font></label>
    <div class="col-sm-2 btn-lg">
      {form_dropdown('cl_pref', $options_pref, set_value('cl_pref', $client_info.cl_pref))}
      {if form_error('cl_pref')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_pref')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr01" class="col-sm-4 control-label">市区町村<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_addr01' , set_value('cl_addr01', $client_info.cl_addr01) , 'class="form-control" placeholder="市区町村を入力してください"')}
      {if form_error('cl_addr01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_addr01')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr02" class="col-sm-4 control-label">町名・番地<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_addr02' , set_value('cl_addr02', $client_info.cl_addr02) , 'class="form-control" placeholder="町名・番地を入力してください"')}
      {if form_error('cl_addr02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_addr02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_buil" class="col-sm-4 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      {form_input('cl_buil' , set_value('cl_buil', $client_info.cl_buil) , 'class="form-control" placeholder="ビル・マンション名などを入力してください"')}
      {if form_error('cl_buil')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_buil')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_email" class="col-sm-4 control-label">メールアドレス（代表）<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_email' , set_value('cl_email', $client_info.cl_email) , 'class="col-sm-4 form-control" placeholder="メールアドレス（予備）を入力してください"')}
      {if form_error('cl_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_email')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_email2" class="col-sm-4 control-label">メールアドレス（予備）</label>
    <div class="col-sm-8">
      {form_input('cl_email2' , set_value('cl_email2', $client_info.cl_email2) , 'class="col-sm-4 form-control" placeholder="メールアドレス（予備）を入力してください"')}
      {if form_error('cl_email2')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_email2')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel01" class="col-sm-4 control-label">代表電話番号<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('cl_tel01' , set_value('cl_tel01', $client_info.cl_tel01) , 'class="form-control" placeholder="代表電話番号を入力してください"')}
      {if form_error('cl_tel01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_tel01')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel02" class="col-sm-4 control-label">担当者電話番号</label>
    <div class="col-sm-8">
      {form_input('cl_tel02' , set_value('cl_tel02', $client_info.cl_tel02) , 'class="form-control" placeholder="担当者電話番号を入力してください"')}
      {if form_error('cl_tel02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_tel02')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_mobile" class="col-sm-4 control-label">担当者携帯番号</label>
    <div class="col-sm-8">
      {form_input('cl_mobile' , set_value('cl_mobile', $client_info.cl_mobile) , 'class="form-control" placeholder="担当者携帯番号を入力してください"')}
      {if form_error('cl_mobile')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_mobile')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_fax" class="col-sm-4 control-label">ＦＡＸ番号</label>
    <div class="col-sm-8">
      {form_input('cl_fax' , set_value('cl_fax', $client_info.cl_fax) , 'class="form-control" placeholder="ＦＡＸ番号を入力してください"')}
      {if form_error('cl_fax')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_fax')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_hp" class="col-sm-4 control-label">会社ＨＰ(http://～)</label>
    <div class="col-sm-8">
      {form_input('cl_hp' , set_value('cl_hp', $client_info.cl_hp) , 'class="form-control" placeholder="会社ＨＰ(http://～)を入力してください"')}
      {if form_error('cl_hp')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_hp')}</font></label>{/if}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$attr02['name'] = 'submit'}
      {$attr02['type'] = 'submit'}
      {form_button($attr02 , '更　　新' , 'class="btn btn-default"')}
    </div>
  </div>

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
