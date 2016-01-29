{* ヘッダー部分　START *}
	{include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>会員プロフィール情報　　<span class="label label-success">更　新</span></h3>
</div>

{form_open('my_profile/complete/' , 'name="EntrywriterForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="wr_id" class="col-sm-2 control-label">ライターID</label>
    <div class="col-sm-2">
      {$writer_info.wr_id}
      {form_hidden('wr_id', $writer_info.wr_id)}
    </div>
    <label for="wr_status" class="col-sm-2 control-label">ステータス (状態)</label>
    <div class="col-sm-2">
      {$options_wr_status02[$writer_info.wr_status]}
    </div>
    <label for="wr_mm_rank_id" class="col-sm-2 control-label">会員ランク</label>
    <div class="col-sm-2">
      {$options_wr_mm_rank_id[$writer_info.wr_mm_rank_id]}
    </div>
  </div>

  <div class="form-group">
    <label for="wr_name" class="col-sm-3 control-label">お名前<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('wr_name01' , set_value('wr_name01', $writer_info.wr_name01) , 'class="form-control" placeholder="お名前姓を入力してください"')}
      {if form_error('wr_name01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_name01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('wr_name02' , set_value('wr_name02', $writer_info.wr_name02) , 'class="form-control" placeholder="お名前名を入力してください"')}
      {if form_error('wr_name02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_name02')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_namekana" class="col-sm-3 control-label">お名前カナ（全角）<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('wr_namekana01' , set_value('wr_namekana01', $writer_info.wr_namekana01) , 'class="form-control" placeholder="お名前セイを入力してください"')}
      {if form_error('wr_namekana01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_namekana01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('wr_namekana02' , set_value('wr_namekana02', $writer_info.wr_namekana02) , 'class="form-control" placeholder="お名前メイを入力してください"')}
      {if form_error('wr_namekana02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_namekana02')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-3 control-label">ニックネーム<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_nickname' , set_value('wr_nickname', $writer_info.wr_nickname) , 'class="form-control" placeholder="ニックネームを入力してください"')}
      {if form_error('wr_nickname')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_nickname')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-primary">表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_zip" class="col-sm-3 control-label">郵便番号<font color=red>【必須】</font></label>
    <div class="col-sm-2">
      {form_input('wr_zip01' , set_value('wr_zip01', $writer_info.wr_zip01) , 'class="form-control" placeholder="郵便番号（3ケタ）"')}
      {if form_error('wr_zip01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_zip01')}</font></label>{/if}
    </div>
    <div class="col-sm-2">
      {form_input('wr_zip02' , set_value('wr_zip02', $writer_info.wr_zip02) , 'class="form-control" placeholder="郵便番号（4ケタ）"')}
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
      {form_input('wr_addr01' , set_value('wr_addr01', $writer_info.wr_addr01) , 'class="form-control" placeholder="市区町村を入力してください"')}
      {if form_error('wr_addr01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_addr01')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr02" class="col-sm-3 control-label">町名・番地<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_addr02' , set_value('wr_addr02', $writer_info.wr_addr02) , 'class="form-control" placeholder="町名・番地を入力してください"')}
      {if form_error('wr_addr02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_addr02')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_buil" class="col-sm-3 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      {form_input('wr_buil' , set_value('wr_buil', $writer_info.wr_buil) , 'class="form-control" placeholder="ビル・マンション名などを入力してください"')}
      {if form_error('wr_buil')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_buil')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email_mobile" class="col-sm-3 control-label">携帯メールアドレス</label>
    <div class="col-sm-8">
      {form_input('wr_email_mobile' , set_value('wr_email_mobile', $writer_info.wr_email_mobile) , 'class="col-sm-4 form-control" placeholder="携帯メールアドレス（予備）を入力してください"')}
      {if form_error('wr_email_mobile')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_email_mobile')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_tel" class="col-sm-3 control-label">電話番号<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wr_tel' , set_value('wr_tel', $writer_info.wr_tel) , 'class="form-control" placeholder="電話番号を入力してください"')}
      {if form_error('wr_tel')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_tel')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="label label-default">非表示</span>
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mobile" class="col-sm-3 control-label">携帯番号</label>
    <div class="col-sm-8">
      {form_input('wr_mobile' , set_value('wr_mobile', $writer_info.wr_mobile) , 'class="form-control" placeholder="携帯番号を入力してください"')}
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
      {form_button($attr , '更　　新' , 'class="btn btn-default"')}
    </div>
  </div>

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
