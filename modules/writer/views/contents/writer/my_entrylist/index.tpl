{* ヘッダー部分　START *}
    {include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【仕事　検索】</h4>
{form_open('/my_entrylist/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
    <tbody>

    <div class="row">
      <tr>
      <tr>
        <td class="col-sm-2">作業ID</td>
        <td class="col-sm-4">
          {form_input('pj_id' , set_value('pj_id', $serch_item.pj_id) , 'class="form-control" placeholder="作業IDを入力してください。"')}
          {if form_error('pj_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_id')}</font></label>{/if}
        </td>
        <td class="col-sm-2">作業状態</td>
        <td class="col-sm-4">
          {form_dropdown('wi_pj_work_status', $options_workstatus, set_value('wi_pj_work_status', $serch_item.wi_pj_work_status))}
        </td>
      </tr>
    </div>

    </tbody>
  </table>

  <div class="row">
    <div class="col-sm-5 col-sm-offset-5">
      {$attr['name']  = 'submit'}
      {$attr['type']  = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr , '検　　索' , 'class="btn btn-default"')}
    </div>
  </div>

{form_close()}


    <ul class="pagination pagination-sm">
        検索結果： {$countall}件<br />
        {$set_pagination}
    </ul>


{form_open('/my_entrylist/detail00/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>状態</th>
                <th>ID</th>
                <th>タイトル</th>
                <th>エントリー日</th>
                <th>投稿〆切日</th>
                <th>文字数</th>
                <th>ポイント</th>
            </tr>
        </thead>

        {foreach from=$entry_list item=list}
        <tbody>
            <tr>
                <td>
                    {if ($list.wi_pj_entry_status == TRUE)}
                    <button type="submit" class="btn btn-success btn-xs" name="pjid_uniq" value="{$list.pj_id}">作 成</button>
                    {else}
                    <button type="submit" class="btn btn-primary btn-xs" disabled="disabled" name="pjid_uniq" value="{$list.pj_id}"></button>
                    {/if}
                </td>
                <td>
                    {$options_workstatus[$list.wi_pj_work_status]}
                </td>
                <td>
                    {$list.pj_id}
                </td>
                <td style="width: 450px; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {$list.pj_title}
                </td>
                <td>
                    {$list.wi_entry_date|date_format:"%Y-%m-%d %H:%M"}
                </td>
                <td>
                    {$list.wi_posting_limit_date|date_format:"%Y-%m-%d %H:%M"}
                </td>
                <td>
                    {$list.wi_word_count}
                </td>
                <td>
                    {$list.wi_point}
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

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
