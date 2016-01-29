{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandcsvdl.js"></script>

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【獲得ポイント　検索】</h4>
{form_open('/pay_wrdetail/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
    <tbody>

    <div class="row">
      <tr>
        <td class="col-sm-2">ライターID</td>
        <td class="col-sm-2">
          {form_input('wi_wr_id' , set_value('wi_wr_id', $serch_item.wi_wr_id) , 'class="form-control" placeholder="作業IDを入力してください。"')}
          {if form_error('wi_wr_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wi_wr_id')}</font></label>{/if}
        </td>
        <td class="col-sm-2">作業ID</td>
        <td class="col-sm-2">
          {form_input('wi_pj_id' , set_value('wi_pj_id', $serch_item.wi_pj_id) , 'class="form-control" placeholder="作業IDを入力してください。"')}
          {if form_error('wi_pj_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wi_pj_id')}</font></label>{/if}
        </td>
        <td class="col-sm-2">入金有無</td>
        <td class="col-sm-2">
          {form_dropdown('wi_pay_status', $options_paystatus, set_value('wi_pay_status', $serch_item.wi_pay_status))}
        </td>
      </tr>
      <tr>
        <td class="col-sm-2">作業件名</td>
        <td class="col-sm-6" colspan="3">
          {form_input('pj_title' , set_value('pj_title', $serch_item.pj_title) , 'class="form-control" placeholder="作業件名を入力してください。"')}
          {if form_error('pj_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_title')}</font></label>{/if}
        </td>
        <td class="col-sm-2">締日設定</td>
        <td class="col-sm-2">
          {form_dropdown('wr_pay_limit_date', $options_paylimit, set_value('wr_pay_limit_date', $serch_item.wr_pay_limit_date))}
        </td>
      </tr>
      <tr>
        <td class="col-sm-2">ポイント獲得日</td>
        <td class="col-sm-4" colspan="2">
          {form_input('check_date_st' , set_value('check_date_st', $serch_item.check_date_st) , 'id="datepicker_1" class="form-control" placeholder="抽出開始日付 (20xx/xx/xx)"')}
          {if form_error('check_date_st')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('check_date_st')}</font></label>{/if}
        </td>
        <td class="col-sm-2">
          ～
        </td>
        <td class="col-sm-4" colspan="2">
          {form_input('check_date_ed' , set_value('check_date_ed', $serch_item.check_date_ed) , 'id="datepicker_2" class="form-control" placeholder="抽出終了日付 (20xx/xx/xx)"')}
          {if form_error('check_date_ed')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('check_date_ed')}</font></label>{/if}
        </td>
      </tr>
      <tr>
        <td class="col-sm-2">入金日</td>
        <td class="col-sm-4" colspan="2">
          {form_input('pay_date_st' , set_value('pay_date_st', $serch_item.pay_date_st) , 'id="datepicker_3" class="form-control" placeholder="支払開始日付 (20xx/xx/xx)"')}
          {if form_error('pay_date_st')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pay_date_st')}</font></label>{/if}
        </td>
        <td class="col-sm-2">
          ～
        </td>
        <td class="col-sm-4" colspan="2">
          {form_input('pay_date_ed' , set_value('pay_date_ed', $serch_item.pay_date_ed) , 'id="datepicker_4" class="form-control" placeholder="支払終了日付 (20xx/xx/xx)"')}
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

{form_open('/pay_wrdetail/detail/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>入金状況</th>
                <th>WR ID</th>
                <th>作業ID</th>
                <th>タイトル</th>
                <th>ポイント</th>
                <th>調整</th>
                <th>ポイント合計</th>
                <th>ポイント獲得日</th>
                <th>締日</th>
                <th>入金日</th>
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
                    {$options_paystatus[$list.wi_pay_status]}
                </td>
                <td>
                    {$list.wi_wr_id}
                </td>
                <td>
                    {$list.wi_pj_id}
                </td>
                <td style="width: 250px; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {$list.pj_title}
                </td>
                <td>
                    {$list.wi_point} pt
                </td>
                <td>
                    {$list.wi_point_adjust} pt
                </td>
                <td>
                    {$list.wi_pay_money} pt
                </td>
                <td>
                    {$list.wi_check_date|date_format:"%Y-%m-%d"}
                </td>
                <td>
                    {$options_paylimit[$list.wr_pay_limit_date]}
                </td>
                <td>
                    {$list.wi_pay_date|date_format:"%Y-%m-%d"}
                </td>
                <td>
                    <button type="submit" class="btn btn-success btn-xs" name="wiid_uniq" value="{$list.wi_id}">編集</button>
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
