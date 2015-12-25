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
