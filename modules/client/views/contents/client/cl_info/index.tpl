{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">更　新</span></h3>
</div>

{form_open('cl_info/complete/' , 'name="infoForm" class="form-horizontal"')}

  <div class="form-group">
      {$res_mess}
  </div>

  <div class="form-group">
    <label for="wr_id" class="col-sm-2 control-label">クライアントID</label>
    <div class="col-sm-2">
      {$client_info.cl_id}
      {form_hidden('cl_id', $client_info.cl_id)}
    </div>
    <div class="col-sm-offset-8"></div>
  </div>

  <div class="form-group">
    <label for="cl_email" class="col-sm-3 control-label">メールアドレス（代表）＆　ログインID</label>
    <div class="col-sm-8">
      {form_input('cl_email' , set_value('cl_email', $client_info.cl_email) , 'class="col-sm-4 form-control" placeholder="メールアドレス（ログインID）を入力してください"')}
      {if form_error('cl_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_email')}</font></label>{/if}
      {if $err_email==TRUE}<span class="label label-danger">Error : </span><label><font color=red>「メールアドレス」欄で入力したアドレスは既に他で使用されています。再度他のアドレスを入力してください。</font></label>{/if}
    </div>
    <div class="col-sm-1">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_mail'}
      {form_button($attr , '更　新' , 'class="btn btn-default"')}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_password" class="col-sm-3 control-label">パスワード</label>
    <div class="col-sm-8">
      {form_password('cl_password' , set_value('cl_password', '') , 'class="form-control" placeholder="パスワード　(半角英数字・記号：８文字以上)"')}
      {if form_error('cl_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_password')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_passwd'}
      {form_button($attr , '更　新' , 'class="btn btn-default"')}
    </div>
  </div>
  <div class="form-group">
    <label for="retype_password" class="col-sm-3 control-label">パスワード再入力</label>
    <div class="col-sm-8">
      {form_password('retype_password' , set_value('retype_password', '') , 'class="form-control" placeholder="パスワード再入力　(半角英数字・記号：８文字以上)"')}
      <p><small>確認のため、もう一度入力してください。</small></p>
      {if form_error('retype_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('retype_password')}</font></label>{/if}
    </div>
    <div class="col-sm-1"></div>
  </div>




  <div class="form-group">
    <label for="ta_price" class="col-sm-3 control-label">１文字単価設定（円）</label>
    <label for="ta_price" class="col-sm-4 control-label">※少数点第一位まで入力してください。</label>
  </div>
  <div class="form-group">
    <div class="col-sm-3"></div>
    <label for="ta_price" class="col-sm-2 control-label">会員ランク別設定：</label>
    <label for="ta_price" class="col-sm-1 control-label">ブロンズ</label>
    <div class="col-sm-1">
      {form_input('ta_price1' , set_value('ta_price1', $tanka_list[1]['ta_price']) , 'class="col-sm-4 form-control" placeholder=""')}
      {if form_error('ta_price1')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ta_price1')}</font></label>{/if}
    </div>
    <label for="ta_price" class="col-sm-1 control-label">シルバー</label>
    <div class="col-sm-1">
      {form_input('ta_price2' , set_value('ta_price2', $tanka_list[2]['ta_price']) , 'class="col-sm-4 form-control" placeholder=""')}
      {if form_error('ta_price2')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ta_price2')}</font></label>{/if}
    </div>
    <label for="ta_price" class="col-sm-1 control-label">ゴールド</label>
    <div class="col-sm-1">
      {form_input('ta_price3' , set_value('ta_price3', $tanka_list[3]['ta_price']) , 'class="col-sm-4 form-control" placeholder=""')}
      {if form_error('ta_price3')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ta_price3')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_rank'}
      {form_button($attr , '更　新' , 'class="btn btn-default"')}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3"></div>
    <label for="taa_price" class="col-sm-2 control-label">難易度別設定：</label>
    <label for="taa_price" class="col-sm-1 control-label">カンタン</label>
    <div class="col-sm-1">
      {form_input('taa_price1' , set_value('taa_price1', $tankaadd_list[0]['taa_price']) , 'class="col-sm-4 form-control" placeholder=""')}
      {if form_error('taa_price1')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('taa_price1')}</font></label>{/if}
    </div>
    <label for="taa_price" class="col-sm-1 control-label">ふつう</label>
    <div class="col-sm-1">
      {form_input('taa_price2' , set_value('taa_price2', $tankaadd_list[1]['taa_price']) , 'class="col-sm-4 form-control" placeholder=""')}
      {if form_error('taa_price2')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('taa_price2')}</font></label>{/if}
    </div>
    <label for="taa_price" class="col-sm-1 control-label">難しい</label>
    <div class="col-sm-1">
      {form_input('taa_price3' , set_value('taa_price3', $tankaadd_list[2]['taa_price']) , 'class="col-sm-4 form-control" placeholder=""')}
      {if form_error('taa_price3')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('taa_price3')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_diff'}
      {form_button($attr , '更　新' , 'class="btn btn-default"')}
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
