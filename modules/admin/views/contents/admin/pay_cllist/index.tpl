{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandcsvdl.js"></script>

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【請求 月次実績（予定）】</h4>

{form_open('/pay_cllist/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
    <tbody>

    <div class="row">
      <tr>
        <td class="col-sm-2">クライアントID</td>
        <td class="col-sm-2">
          {form_input('cp_cl_id' , set_value('cp_cl_id', $serch_item.cp_cl_id) , 'class="form-control" placeholder="クライアントID"')}
          {if form_error('cp_cl_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cp_cl_id')}</font></label>{/if}
        </td>
        <td class="col-sm-2">支払有無</td>
        <td class="col-sm-2">
          {form_dropdown('cp_status', $options_paystatus, set_value('cp_status', $serch_item.cp_status))}
        </td>
        <td class="col-sm-4"></td>
      </tr>
      <tr>
        <td class="col-sm-2">請求年月日</td>
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

{form_open('/pay_cllist/detail/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>請求年月</th>
                <th>CL ID</th>
                <th>支払状況</th>
                <th>月額固定</th>
                <th>ライター発注</th>
                <th>成果報酬</th>
                <th>調整金額</th>
                <th>消費税</th>
                <th>請求金額</th>
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
                    {$list.cp_pay_date|substr:0:4}年{$list.cp_pay_date|substr:4:2}月
                </td>
                <td>
                    {$list.cp_cl_id}
                </td>
                <td>
                    {$options_paystatus[$list.cp_status]}
                </td>
                <td>
                    {$list.cp_pay_fix|number_format} 円
                </td>
                <td>
                    {$list.cp_pay_writer|number_format} 円
                </td>
                <td>
                    {$list.cp_pay_result|number_format} 円
                </td>
                <td>
                    {$list.cp_pay_adjust|number_format} 円
                </td>
                <td>
                    {$list.cp_pay_tax|number_format} 円
                </td>
                <td>
                    {$list.cp_pay_total|number_format} 円
                </td>
                <td>
                    <button type="submit" class="btn btn-success btn-xs" name="cpid_uniq" value="{$list.cp_id}">編集</button>
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
