{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">更新</span></h3>
</div>

{form_open('/clientlist/detailchk/' , 'name="clientDetailForm" class="form-horizontal"')}


  <div class="form-group">
    <label for="cl_status" class="col-sm-2 control-label">ステータス (状態)</label>
    <div class="col-sm-4">
		  {form_dropdown('cl_status', $options_cl_status02, {$client_info.cl_status})}
    </div>
    <label for="ci_fee_id" class="col-sm-2 control-label">手数料設定<font color=red>【必須】</font></label>
    <div class="col-sm-2">
		  {form_dropdown('ci_fee_id', $options_ci_fee_id, {$ci_fee_id})}
    </div>
    <div class="col-sm-2">
      {form_input('ci_fee' , $ci_fee , 'class="form-control" placeholder=""')}
      {if form_error('ci_fee')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ci_fee')}</font></label>{/if}
    </div>
  </div>

  <div class="form-group">
    <label for="ci_agreement_st" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
    </div>
    <label for="ci_agreement_end" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
    ※「率」は 0.00(0%) ～ 1.00(100%) 少数点第二。<br>「月額固定」は数値(円)を入力してください。
    </div>
  </div>

  <div class="form-group">
    <label for="ci_agreement_st" class="col-sm-2 control-label">契約開始日</label>
    <div class="col-sm-4">
      {form_input('ci_agreement_st' , $client_info.ci_agreement_st , 'class="form-control" placeholder="20xx-xx-xx の形式で入力してください"')}
      {if form_error('ci_agreement_st')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ci_agreement_st')}</font></label>{/if}
    </div>
    <label for="ci_agreement_end" class="col-sm-2 control-label">契約終了(予定)日</label>
    <div class="col-sm-4">
      {form_input('ci_agreement_end' , $client_info.ci_agreement_end , 'class="form-control" placeholder="20xx-xx-xx の形式で入力してください"')}
      {if form_error('ci_agreement_end')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ci_agreement_end')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="ci_comment" class="col-sm-2 control-label">備考</label>
    <div class="col-sm-10">
      {form_input('ci_comment' , $client_info.ci_comment , 'class="form-control" placeholder=""')}
      {if form_error('ci_comment')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ci_comment')}</font></label>{/if}
    </div>
  </div>

<HR>

  <div class="form-group">
    <label for="cl_company" class="col-sm-4 control-label">クライアントID</label>
    <div class="col-sm-8">
      {$client_info.cl_id}
      {form_hidden('cl_id', $client_info.cl_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_company" class="col-sm-4 control-label">会　社　名</label>
    <div class="col-sm-8">
      {$client_info.cl_company}
      {form_hidden('cl_company', $client_info.cl_company)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_company_kana" class="col-sm-4 control-label">会　社　名（全角）</label>
    <div class="col-sm-8">
      {$client_info.cl_company_kana}
      {form_hidden('cl_company_kana', $client_info.cl_company_kana)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_president" class="col-sm-4 control-label">代表者</label>
    <div class="col-sm-4">
      {$client_info.cl_president01} {$client_info.cl_president02}
      {form_hidden('cl_president01', $client_info.cl_president01)}
      {form_hidden('cl_president02', $client_info.cl_president02)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_president_kana" class="col-sm-4 control-label">代表者カナ（全角）</label>
    <div class="col-sm-4">
      {$client_info.cl_president_kana01} {$client_info.cl_president_kana02}
      {form_hidden('cl_president_kana01', $client_info.cl_president_kana01)}
      {form_hidden('cl_president_kana02', $client_info.cl_president_kana02)}
    </div>
  </div>
    <div class="form-group">
    <label for="cl_department" class="col-sm-4 control-label">担当部署</label>
    <div class="col-sm-4">
      {$client_info.cl_department}
      {form_hidden('cl_department', $client_info.cl_department)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_person" class="col-sm-4 control-label">担当者</label>
    <div class="col-sm-4">
      {$client_info.cl_person01} {$client_info.cl_person02} {form_hidden('cl_person01', $client_info.cl_person01)}
      {form_hidden('cl_person02', $client_info.cl_person02)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_person_kana" class="col-sm-4 control-label">担当者カナ（全角）</label>
    <div class="col-sm-4">
      {$client_info.cl_person_kana01} {$client_info.cl_person_kana02}
      {form_hidden('cl_person_kana01', $client_info.cl_person_kana01)}
      {form_hidden('cl_person_kana02', $client_info.cl_person_kana02)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_zip" class="col-sm-4 control-label">郵便番号</label>
    <div class="col-sm-2">
      {$client_info.cl_zip01} - {$client_info.cl_zip02}
      {form_hidden('cl_zip01', $client_info.cl_zip01)}
      {form_hidden('cl_zip02', $client_info.cl_zip02)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_pref" class="col-sm-4 control-label">都道府県</label>
    <div class="col-sm-2 btn-lg">
      {$pref_name}
      {form_hidden('cl_pref', $client_info.cl_pref)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr01" class="col-sm-4 control-label">市区町村</label>
    <div class="col-sm-8">
      {$client_info.cl_addr01}
      {form_hidden('cl_addr01', $client_info.cl_addr01)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_addr02" class="col-sm-4 control-label">町名・番地</label>
    <div class="col-sm-8">
      {$client_info.cl_addr02}
      {form_hidden('cl_addr02', $client_info.cl_addr02)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_buil" class="col-sm-4 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      {$client_info.cl_buil}
      {form_hidden('cl_buil', $client_info.cl_buil)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_email1" class="col-sm-4 control-label">メールアドレス（代表）<br>＆　ログインID</label>
    <div class="col-sm-8">
      {$client_info.cl_email}
      {form_hidden('cl_email', $client_info.cl_email)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_email2" class="col-sm-4 control-label">メールアドレス（予備）</label>
    <div class="col-sm-8">
      {$client_info.cl_email2}
      {form_hidden('cl_email2', $client_info.cl_email2)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel01" class="col-sm-4 control-label">代表電話番号</label>
    <div class="col-sm-8">
      {$client_info.cl_tel01}
      {form_hidden('cl_tel01', $client_info.cl_tel01)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_tel02" class="col-sm-4 control-label">担当者電話番号</label>
    <div class="col-sm-8">
      {$client_info.cl_tel02}
      {form_hidden('cl_tel02', $client_info.cl_tel02)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_mobile" class="col-sm-4 control-label">担当者携帯番号</label>
    <div class="col-sm-8">
      {$client_info.cl_mobile}
      {form_hidden('cl_mobile', $client_info.cl_mobile)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_fax" class="col-sm-4 control-label">ＦＡＸ番号</label>
    <div class="col-sm-8">
      {$client_info.cl_fax}
      {form_hidden('cl_fax', $client_info.cl_fax)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_hp" class="col-sm-4 control-label">会社ＨＰ(http://～)</label>
    <div class="col-sm-8">
      {$client_info.cl_hp}
      {form_hidden('cl_hp', $client_info.cl_hp)}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$attr02['name'] = 'submit'}
      {$attr02['type'] = 'submit'}
      {$attr['value'] = '_submit'}
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
