{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>請求明細情報　　<span class="label label-success">更新</span></h3>
</div>

{form_open('/pay_cldetail/detailchk/' , 'name="clientDetailForm" class="form-horizontal"')}


  <div class="form-group">
    <label for="pj_pay_status" class="col-sm-4 control-label">支払状況</label>
    <div class="col-sm-8">
      {form_dropdown('pj_pay_status', $options_paystatus, set_value('pj_pay_status', $list.pj_pay_status))}
      {if form_error('pj_pay_status')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_pay_status')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_en_cl_id" class="col-sm-4 control-label">クライアントID</label>
    <div class="col-sm-8">
      {$list.pj_en_cl_id}
      {form_hidden('pj_en_cl_id', $list.pj_en_cl_id)}
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
    <label for="pj_wi_point" class="col-sm-4 control-label">獲得ポイント<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('pj_wi_point' , $list.pj_wi_point , 'class="form-control" placeholder=""')}
      {if form_error('pj_wi_point')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_wi_point')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_wi_point_adjust" class="col-sm-4 control-label">調整ポイント</label>
    <div class="col-sm-8">
      {form_input('pj_wi_point_adjust' , $list.pj_wi_point_adjust , 'class="form-control" placeholder=""')}
      {if form_error('pj_wi_point_adjust')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_wi_point_adjust')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_delivery_date" class="col-sm-4 control-label">納品日<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('pj_delivery_date' , $list.pj_delivery_date|date_format:"%Y-%m-%d %H:%M" , 'class="form-control" placeholder="20xx-xx-xx hh:mm"')}
      {if form_error('pj_delivery_date')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_delivery_date')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_pay_money" class="col-sm-4 control-label">請求金額<font color=red>【必須】</font></label>
    <div class="col-sm-8">
      {form_input('pj_pay_money' , $list.pj_pay_money , 'class="form-control" placeholder=""')}
      {if form_error('pj_pay_money')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_pay_money')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_pay_schedule" class="col-sm-4 control-label">請求(予定)日</label>
    <div class="col-sm-8">
      {form_input('pj_pay_schedule' , $list.pj_pay_schedule , 'class="form-control" placeholder="20xx-xx-xx"')}
      {if form_error('pj_pay_schedule')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_pay_schedule')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_pay_date" class="col-sm-4 control-label">領収日</label>
    <div class="col-sm-8">
      {form_input('pj_pay_date' , $list.pj_pay_date , 'class="form-control" placeholder="20xx-xx-xx"')}
      {if form_error('pj_pay_date')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_pay_date')}</font></label>{/if}
    </div>
  </div>

  {form_hidden('pj_wr_id', $list.pj_wr_id)}

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
