{* ヘッダー部分　START *}
    {include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>会員情報　　<span class="label label-success">更　新</span></h3>
</div>

{form_open('my_memfile/complete/' , 'name="EntrywriterForm" class="form-horizontal"')}

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
    <label for="wr_email" class="col-sm-3 control-label">メールアドレス（代表）＆　ログインID</label>
    <div class="col-sm-8">
      {form_input('wr_email' , set_value('wr_email', $writer_info.wr_email) , 'class="col-sm-4 form-control" placeholder="メールアドレス（ログインID）を入力してください"')}
      {if form_error('wr_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_email')}</font></label>{/if}
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
    <label for="wr_password" class="col-sm-3 control-label">パスワード</label>
    <div class="col-sm-8">
      {form_password('wr_password' , set_value('wr_password', '') , 'class="form-control" placeholder="パスワード　(半角英数字・記号：８文字以上)"')}
      {if form_error('wr_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_password')}</font></label>{/if}
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
    <label for="wr_bank_cd" class="col-sm-3 control-label">振込先銀行コード</label>
    <div class="col-sm-2">
      {form_input('wr_bank_cd' , set_value('wr_bank_cd', $writer_info.wr_bank_cd) , 'class="col-sm-4 form-control" placeholder="振込先銀行コード"')}
      {if form_error('wr_bank_cd')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_bank_cd')}</font></label>{/if}
    </div>
    <label for="wr_bank" class="col-sm-2 control-label">振込先銀行名</label>
    <div class="col-sm-4">
      {form_input('wr_bank' , set_value('wr_bank', $writer_info.wr_bank) , 'class="col-sm-4 form-control" placeholder="振込先銀行名を入力してください"')}
      {if form_error('wr_bank')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_bank')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_bank'}
      {form_button($attr , '更　新' , 'class="btn btn-default"')}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_bk_branch_cd" class="col-sm-3 control-label">支店コード</label>
    <div class="col-sm-2">
      {form_input('wr_bk_branch_cd' , set_value('wr_bk_branch_cd', $writer_info.wr_bk_branch_cd) , 'class="col-sm-4 form-control" placeholder="支店コード"')}
      {if form_error('wr_bk_branch_cd')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_bk_branch_cd')}</font></label>{/if}
    </div>
    <label for="wr_bk_branch" class="col-sm-2 control-label">支店名</label>
    <div class="col-sm-4">
      {form_input('wr_bk_branch' , set_value('wr_bk_branch', $writer_info.wr_bk_branch) , 'class="col-sm-4 form-control" placeholder="支店名を入力してください"')}
      {if form_error('wr_bk_branch')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_bk_branch')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_bk_item" class="col-sm-3 control-label">種目</label>
    <div class="col-sm-2">
      {form_input('wr_bk_item' , set_value('wr_bk_item', $writer_info.wr_bk_item) , 'class="col-sm-4 form-control" placeholder="種目を入力してください"')}
      {if form_error('wr_bk_item')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_bk_item')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_bk_no" class="col-sm-3 control-label">口座番号</label>
    <div class="col-sm-2">
      {form_input('wr_bk_no' , set_value('wr_bk_no', $writer_info.wr_bk_no) , 'class="col-sm-4 form-control" placeholder="口座番号"')}
      {if form_error('wr_bk_no')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_bk_no')}</font></label>{/if}
    </div>
    <label for="wr_bk_name" class="col-sm-2 control-label">口座名義人 (半角カナ)</label>
    <div class="col-sm-4">
      {form_input('wr_bk_name' , set_value('wr_bk_name', $writer_info.wr_bk_name) , 'class="col-sm-4 form-control" placeholder="口座名義人を入力してください"')}
      {if form_error('wr_bk_name')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_bk_name')}</font></label>{/if}
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
