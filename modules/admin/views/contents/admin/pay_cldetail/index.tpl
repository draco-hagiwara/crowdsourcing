{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandcsvdl.js"></script>

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【請求＆ポイント明細　検索】</h4>
{form_open('/pay_cldetail/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
    <tbody>

    <div class="row">
      <tr>
        <td class="col-sm-2">クライアントID</td>
        <td class="col-sm-2">
          {form_input('pj_en_cl_id' , set_value('pj_en_cl_id', $serch_item.pj_en_cl_id) , 'class="form-control" placeholder="クライアントID"')}
          {if form_error('pj_en_cl_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_en_cl_id')}</font></label>{/if}
        </td>
        <td class="col-sm-2">作業ID</td>
        <td class="col-sm-2">
          {form_input('pj_id' , set_value('pj_id', $serch_item.pj_id) , 'class="form-control" placeholder="作業ID"')}
          {if form_error('pj_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_id')}</font></label>{/if}
        </td>
        <td class="col-sm-2">支払有無</td>
        <td class="col-sm-2">
          {form_dropdown('pj_pay_status', $options_paystatus, set_value('pj_pay_status', $serch_item.pj_pay_status))}
        </td>
      </tr>
      <tr>
        <td class="col-sm-2">作業件名</td>
        <td class="col-sm-10" colspan="5">
          {form_input('pj_title' , set_value('pj_title', $serch_item.pj_title) , 'class="form-control" placeholder="作業件名を入力してください。"')}
          {if form_error('pj_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_title')}</font></label>{/if}
        </td>
      </tr>
      <tr>
        <td class="col-sm-2">納品日</td>
        <td class="col-sm-4" colspan="2">
          {form_input('delivery_date_st' , set_value('delivery_date_st', $serch_item.delivery_date_st) , 'id="datepicker_1" class="form-control" placeholder="抽出開始日付 (20xx/xx/xx)"')}
          {if form_error('delivery_date_st')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('delivery_date_st')}</font></label>{/if}
        </td>
        <td class="col-sm-2">
          ～
        </td>
        <td class="col-sm-4" colspan="2">
          {form_input('delivery_date_ed' , set_value('delivery_date_ed', $serch_item.delivery_date_ed) , 'id="datepicker_2" class="form-control" placeholder="抽出終了日付 (20xx/xx/xx)"')}
          {if form_error('delivery_date_ed')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('delivery_date_ed')}</font></label>{/if}
        </td>
      </tr>
      <tr>
        <td class="col-sm-2">請求予定日</td>
        <td class="col-sm-4" colspan="2">
          {form_input('pay_date_st' , set_value('pay_date_st', $serch_item.pay_date_st) , 'id="datepicker_3" class="form-control" placeholder="開始日付 (20xx/xx/xx)"')}
          {if form_error('pay_date_st')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pay_date_st')}</font></label>{/if}
        </td>
        <td class="col-sm-2">
          ～
        </td>
        <td class="col-sm-4" colspan="2">
          {form_input('pay_date_ed' , set_value('pay_date_ed', $serch_item.pay_date_ed) , 'id="datepicker_4" class="form-control" placeholder="終了日付 (20xx/xx/xx)"')}
          {if form_error('pay_date_ed')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pay_date_ed')}</font></label>{/if}
        </td>
      </tr>
    </div>

    </tbody>
  </table>

  <div class="row">
    <div class="col-sm-3 col-sm-offset-2">
      {$attr['name']  = 'submit'}
      {$attr['type']  = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr , '検　　索' , 'class="btn btn-default"')}
    </div>
    <div class="col-sm-offset-2 col-sm-5">
      {$js = 'class="btn btn-default" onClick="return cnfmAndcsvdown()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_dlcsv'}
      {form_button($attr , 'CSV ダウンロード' , $js)}
    </div>
  </div>

{form_close()}


    <ul class="pagination pagination-sm">
        検索結果： {$countall}件<br />
        {$set_pagination}
    </ul>


{form_open('/pay_cldetail/detail/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>支払状況</th>
                <th>CL ID</th>
                <th>作業ID</th>
                <th>タイトル</th>
                <th>ポイント</th>
                <th>調整</th>
                <th>納品日</th>
                <th>請求金額</th>
                <th>請求日</th>
                <th></th>
            </tr>
        </thead>

        {foreach from=$listall item=list name="loop"}
        <tbody>
            <tr>
                <td>
                    {$smarty.foreach.loop.iteration}
                </td>
                <td>
                    {$options_paystatus[$list.pj_pay_status]}
                </td>
                <td>
                    {$list.pj_en_cl_id}
                </td>
                <td>
                    {$list.pj_id}
                </td>
                <td style="width: 450px; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {$list.pj_title}
                </td>
                <td>
                    {$list.pj_wi_point} pt
                </td>
                <td>
                    {$list.pj_wi_point_adjust} pt
                </td>
                <td>
                    {$list.pj_delivery_date|date_format:"%Y-%m-%d"}
                </td>
                <td>
                    {$list.pj_pay_money} 円
                </td>
                <td>
                    {$list.pj_pay_schedule|date_format:"%Y-%m-%d"}
                </td>
                <td>
                    <button type="submit" class="btn btn-success btn-xs" name="pjid_uniq" value="{$list.pj_id}">編集</button>
                </td>
            </tr>
        </tbody>
        {foreachelse}
            検索結果はありませんでした。
        {/foreach}

    </table>
{form_close()}


    <ul class="pagination pagination-sm">
      {$set_pagination}
    </ul>


</div>


{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
