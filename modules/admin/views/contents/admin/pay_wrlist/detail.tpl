{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>入金明細情報　　<span class="label label-success">更新</span></h3>
</div>

{form_open('/pay_wrlist/detailchk/' , 'name="clientDetailForm" class="form-horizontal"')}


  <div class="form-group">
    <label for="wp_wr_id" class="col-sm-4 control-label">ライターID</label>
    <div class="col-sm-8">
      {$list.wp_wr_id}
      {form_hidden('wp_wr_id', $list.wp_wr_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-4 control-label">ライター：ニックネーム</label>
    <div class="col-sm-8">
      {$wrnickname}
      {form_hidden('wr_nickname', $wrnickname)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_pay_limit_date" class="col-sm-4 control-label">入金締日</label>
    <div class="col-sm-8">
      {$options_paylimit[$pay_limitdate]}
      {form_hidden('wr_pay_limit_date', $pay_limitdate)}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_pay_date" class="col-sm-4 control-label">入金年月日</label>
    <div class="col-sm-8">
      {$list.wp_pay_date|substr:0:4}年{$list.wp_pay_date|substr:4:2}月{$list.wp_pay_date|substr:6:2}日
      {form_hidden('wp_pay_date', $list.wp_pay_date)}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_status" class="col-sm-4 control-label">入金状況</label>
    <div class="col-sm-8">
      {form_dropdown('wp_status', $options_paystate, set_value('wp_status', $list.wp_status))}
      {if form_error('wp_status')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wp_status')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_pay_result" class="col-sm-4 control-label">報酬金額</label>
    <div class="col-sm-2">
      {form_input('wp_pay_result' , $list.wp_pay_result , 'class="form-control" placeholder=""')}
      {if form_error('wp_pay_result')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wp_pay_result')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_pay_adjust" class="col-sm-4 control-label">調整金額</label>
    <div class="col-sm-2">
      {form_input('wp_pay_adjust' , $list.wp_pay_adjust , 'class="form-control" placeholder=""')}
      {if form_error('wp_pay_adjust')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wp_pay_adjust')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_pay_total" class="col-sm-4 control-label">入金金額</label>
    <div class="col-sm-2">
      {form_input('wp_pay_total' , $list.wp_pay_total , 'class="form-control" placeholder=""')}
      {if form_error('wp_pay_total')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wp_pay_total')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_bank_cd" class="col-sm-4 control-label">銀行コード</label>
    <div class="col-sm-2">
      {form_input('wp_bank_cd' , $list.wp_bank_cd , 'class="form-control" placeholder=""')}
      {if form_error('wp_bank_cd')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wp_bank_cd')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_bk_no" class="col-sm-4 control-label">口座番号</label>
    <div class="col-sm-2">
      {form_input('wp_bk_no' , $list.wp_bk_no , 'class="form-control" placeholder=""')}
      {if form_error('wp_bk_no')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wp_bk_no')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wp_comment" class="col-sm-4 control-label">メモ</label>
    <div class="col-sm-8">
      {$attr['name'] = 'wp_comment'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('wp_comment', $list.wp_comment) , 'class="form-control" placeholder="メモを入力してください"')}
      {if form_error('wp_comment')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wp_comment')}</font></label>{/if}
    </div>
  </div>

  {form_hidden('wp_id', $list.wp_id)}

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-2">
      {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr , '更　　新' , $js)}
    </div>
    <div class="col-sm-offset-2 col-sm-4">
      {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr , '削除？' , $js)}
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
