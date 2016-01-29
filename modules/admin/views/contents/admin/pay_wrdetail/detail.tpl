{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>請求明細情報　　<span class="label label-success">更新</span></h3>
</div>

{form_open('/pay_wrdetail/detailchk/' , 'name="writerDetailForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="wi_pay_status" class="col-sm-4 control-label">入金状況<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_dropdown('wi_pay_status', $options_paystatus, set_value('wi_pay_status', $list.wi_pay_status))}
      {if form_error('wi_pay_status')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wi_pay_status')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_wr_id" class="col-sm-4 control-label">ライターID</label>
    <div class="col-sm-8">
      {$list.wi_wr_id}
      {form_hidden('wi_wr_id', $list.wi_wr_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-4 control-label">ライター名</label>
    <div class="col-sm-8">
      {$list.wr_nickname}
      {form_hidden('wr_nickname', $list.wr_nickname)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_id" class="col-sm-4 control-label">作業ID</label>
    <div class="col-sm-8">
      {$list.pj_id}
      {form_hidden('pj_id', $list.pj_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_title" class="col-sm-4 control-label">タイトル</label>
    <div class="col-sm-8">
      {$list.pj_title}
      {form_hidden('pj_title', $list.pj_title)}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_point" class="col-sm-4 control-label">獲得ポイント</label>
    <div class="col-sm-8">
      {$list.wi_point}
      {form_hidden('wi_point', $list.wi_point)}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_point_adjust" class="col-sm-4 control-label">調整ポイント</label>
    <div class="col-sm-8">
      {form_input('wi_point_adjust' , $list.wi_point_adjust , 'class="form-control" placeholder=""')}
      {if form_error('wi_point_adjust')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wi_point_adjust')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_pay_money" class="col-sm-4 control-label">ポイント合計<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('wi_pay_money' , $list.wi_pay_money , 'class="form-control" placeholder=""')}
      {if form_error('wi_pay_money')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wi_pay_money')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_check_date" class="col-sm-4 control-label">ポイント獲得日</label>
    <div class="col-sm-8">
      {$list.wi_check_date|date_format:"%Y-%m-%d %H:%M"}
      {form_hidden('wi_check_date', $list.wi_check_date)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_pay_limit_date" class="col-sm-4 control-label">締　　日</label>
    <div class="col-sm-8">
      {$options_paylimit[$list.wr_pay_limit_date]}
      {form_hidden('wr_pay_limit_date', $list.wr_pay_limit_date)}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_pay_schedule" class="col-sm-4 control-label">入金予定日</label>
    <div class="col-sm-8">
      {form_input('wi_pay_schedule' , $list.wi_pay_schedule , 'class="form-control" placeholder="20xx-xx-xx"')}
      {if form_error('wi_pay_schedule')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wi_pay_schedule')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_pay_date" class="col-sm-4 control-label">入金日</label>
    <div class="col-sm-8">
      {form_input('wi_pay_date' , $list.wi_pay_date , 'class="form-control" placeholder="20xx-xx-xx"')}
      {if form_error('wi_pay_date')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wi_pay_date')}</font></label>{/if}
    </div>
  </div>

  {form_hidden('wi_id', $list.wi_id)}

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
      {$attr02['name'] = 'submit'}
      {$attr02['type'] = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr02 , '更　　新' , $js)}
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
