{* ヘッダー部分　START *}
    {include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【気になるリスト】</h4>

<ul class="pagination pagination-sm">
    検索結果： {$countall}件<br />
    {$set_pagination}
</ul>

{form_open('/my_favorite/detail/' , 'name="favoriteForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>タイトル</th>
                <th>指定会員</th>
                <th>難易度</th>
                <th>文字単価</th>
                <th>文字数</th>
                <th>募集開始日</th>
                <th>募集終了日</th>
                <th></th>
            </tr>
        </thead>

        {foreach from=$favorite_list item=list}
        <tbody>
            <tr>
                <td>
                    {$attr_sub['name']  = 'pjid_uniq'}
                    {$attr_sub['type']  = 'submit'}
                    {$attr_sub['value'] = $list.fa_pj_id}
                    {form_button($attr_sub , '詳細')}
                </td>
                <td>
                    {$list.fa_pj_id}
                </td>
                <td style="width: 400px; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {$list.fa_pj_title}
                </td>
                <td>
                    {$options_rank[$list.fa_pj_mm_rank_id]} ～
                </td>
                <td>
                    {$options_diff[$list.fa_pj_taa_difficulty_id]}
                </td>
                <td>
                    {$list.fa_wi_word_tanka} 円
                </td>
                <td>
                    {$list.fa_pj_char_cnt} 以上
                </td>
                <td>
                    {$list.fa_pj_start_time|date_format:"%Y-%m-%d"}
                </td>
                <td>
                    {$list.fa_pj_end_time|date_format:"%Y-%m-%d %H:%M"}
                </td>
                <td>
                    {$attr_sub['name']  = 'delid_uniq'}
                    {$attr_sub['type']  = 'submit'}
                    {$attr_sub['value'] = $list.fa_pj_id}
                    {form_button($attr_sub , '削除')}
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
