{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>請求明細情報　　<span class="label label-success">更新</span></h3>
</div>

{form_open('/pay_cllist/detailchk/' , 'name="clientDetailForm" class="form-horizontal"')}


  <div class="form-group">
    <label for="cp_cl_id" class="col-sm-4 control-label">クライアントID</label>
    <div class="col-sm-8">
      {$list.cp_cl_id}
      {form_hidden('cp_cl_id', $list.cp_cl_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="cl_company" class="col-sm-4 control-label">会　社　名</label>
    <div class="col-sm-8">
      {$clcompany}
      {form_hidden('cl_company', $clcompany)}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_date" class="col-sm-4 control-label">請求年月</label>
    <div class="col-sm-8">
      {$list.cp_pay_date|substr:0:4}年{$list.cp_pay_date|substr:4:2}月
      {form_hidden('cp_pay_date', $list.cp_pay_date)}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_status" class="col-sm-4 control-label">支払状況</label>
    <div class="col-sm-8">
      {form_dropdown('cp_status', $options_paystate, set_value('cp_status', $list.cp_status))}
      {if form_error('cp_status')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_status')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_fix" class="col-sm-4 control-label">支払(請求)：月額固定</label>
    <div class="col-sm-2">
      {form_input('cp_pay_fix' , $list.cp_pay_fix , 'class="form-control" placeholder=""')}
      {if form_error('cp_pay_fix')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_pay_fix')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_writer" class="col-sm-4 control-label">支払(請求)：ライター発注額</label>
    <div class="col-sm-2">
      {form_input('cp_pay_writer' , $list.cp_pay_writer , 'class="form-control" placeholder=""')}
      {if form_error('cp_pay_writer')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_pay_writer')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_result" class="col-sm-4 control-label">支払(請求)：成果報酬</label>
    <div class="col-sm-2">
      {form_input('cp_pay_result' , $list.cp_pay_result , 'class="form-control" placeholder=""')}
      {if form_error('cp_pay_result')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_pay_result')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_adjust" class="col-sm-4 control-label">支払(請求)：調整額</label>
    <div class="col-sm-2">
      {form_input('cp_pay_adjust' , $list.cp_pay_adjust , 'class="form-control" placeholder=""')}
      {if form_error('cp_pay_adjust')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_pay_adjust')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_taxrate" class="col-sm-4 control-label">支払(請求)：消費税率</label>
    <div class="col-sm-2">
      {form_input('cp_pay_taxrate' , $list.cp_pay_taxrate , 'class="form-control" placeholder=""')}
      {if form_error('cp_pay_taxrate')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_pay_taxrate')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_tax" class="col-sm-4 control-label">支払(請求)：消費税額</label>
    <div class="col-sm-2">
      {form_input('cp_pay_tax' , $list.cp_pay_tax , 'class="form-control" placeholder=""')}
      {if form_error('cp_pay_tax')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_pay_tax')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_pay_total" class="col-sm-4 control-label">支払(請求)：総合計<font color=red>【必須】</font></label>
    <div class="col-sm-2">
      {form_input('cp_pay_total' , $list.cp_pay_total , 'class="form-control" placeholder=""')}
      {if form_error('cp_pay_total')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_pay_total')}</font></label>{/if}
    </div>
  </div>

  <div class="form-group">
    <label for="cp_contract_initial" class="col-sm-4 control-label">契約内容：初期費用</label>
    <div class="col-sm-2">
      {form_input('cp_contract_initial' , $list.cp_contract_initial , 'class="form-control" placeholder=""')}
      {if form_error('cp_contract_initial')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_contract_initial')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_contract_id" class="col-sm-4 control-label">契約内容：手数料ID</label>
    <div class="col-sm-2">
      {form_dropdown('cp_contract_id', $options_payfee, set_value('cp_contract_id', $list.cp_contract_id))}
      {if form_error('cp_contract_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_contract_id')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_contract_fix" class="col-sm-4 control-label">契約内容：固定手数料</label>
    <div class="col-sm-2">
      {form_input('cp_contract_fix' , $list.cp_contract_fix , 'class="form-control" placeholder=""')}
      {if form_error('cp_contract_fix')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_contract_fix')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_contract_result" class="col-sm-4 control-label">契約内容：成果手数料</label>
    <div class="col-sm-2">
      {form_input('cp_contract_result' , $list.cp_contract_result , 'class="form-control" placeholder=""')}
      {if form_error('cp_contract_result')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_contract_result')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_contract_taxrule" class="col-sm-4 control-label">契約内容：消費税計算</label>
    <div class="col-sm-2">
      {form_dropdown('cp_contract_taxrule', $options_paytaxrule, set_value('cp_contract_taxrule', $list.cp_contract_taxrule))}
      {if form_error('cp_contract_taxrule')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_contract_taxrule')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_contract_calrule" class="col-sm-4 control-label">契約内容：計算方法</label>
    <div class="col-sm-2">
      {form_dropdown('cp_contract_calrule', $options_paytaxcal, set_value('cp_contract_calrule', $list.cp_contract_calrule))}
      {if form_error('cp_contract_calrule')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_contract_calrule')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cp_comment" class="col-sm-4 control-label">メモ</label>
    <div class="col-sm-8">
      {$attr['name'] = 'cp_comment'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('cp_comment', $list.cp_comment) , 'class="form-control" placeholder="メモを入力してください"')}
      {if form_error('cp_comment')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_comment')}</font></label>{/if}
    </div>
  </div>

  {form_hidden('cp_id', $list.cp_id)}

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr , '更　　新' , $js)}
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
