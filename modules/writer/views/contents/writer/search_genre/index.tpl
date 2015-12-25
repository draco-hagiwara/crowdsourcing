{* ヘッダー部分　START *}
    {include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【ジャンル＆仕事　検索】</h4>
{form_open('/search_genre/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
    <tbody>

    <div class="row">
      <tr>
      <tr>
        <td class="col-sm-2">ジャンル</td>
        <td class="col-sm-2">
          {form_dropdown('pj_genre01', $options_genre_list, set_value('pj_genre01', $serch_item.pj_genre01))}
        </td>
        <td class="col-sm-2">仕事タイトル</td>
        <td class="col-sm-6" colspan="3">
          {form_input('pj_order_title' , set_value('pj_order_title', $serch_item.pj_order_title) , 'class="form-control" placeholder="タイトルを入力してください。"')}
          {if form_error('pj_order_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_order_title')}</font></label>{/if}
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


{form_open('/search_genre/detail00/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>ジャンル</th>
                <th>仕事タイトル</th>
                <th>対象ランク</th>
                <th>文字単価</th>
                <th>最低文字数</th>
                <th>～応募期間</th>
            </tr>
        </thead>

        {foreach from=$order_list item=list}
        <tbody>
            <tr>
                <td>
                    {if ($mem_entry == FALSE) AND ($mem_rank >= $list.pj_mm_rank_id)}
                    <button type="submit" class="btn btn-success btn-xs" name="pjid_uniq" value="{$list.pj_id}">詳細</button>
                    {/if}
                </td>
                <td>
                    {$options_diff_list[$list.pj_taa_difficulty_id]}
                </td>
                <td>
                    {$options_genre_list[$list.pj_genre01]}
                </td>
                <td style="width: 450px; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {$list.pj_title}
                </td>
                <td>
                    {$options_rank_list[$list.pj_mm_rank_id]} 以上
                </td>
                <td>
                    {$list.word_tanka} 円
                </td>
                <td>
                    {$list.pj_char_cnt} 文字
                </td>
                <td>
                    {$list.pj_end_time|date_format:"%Y-%m-%d %H:%M"}
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
