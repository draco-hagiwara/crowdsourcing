{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【支払＆請求 月次実績（予定）】</h4>

<ul class="pagination pagination-sm">
    検索結果： {$countall}件<br />
    {$set_pagination}
</ul>

{form_open('/pay_list/detail/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>請求年月</th>
                <th>支払状況</th>
                <th>月額固定</th>
                <th>ライター発注</th>
                <th>成果報酬</th>
                <th>調整金額</th>
                <th>消費税</th>
                <th>ご請求金額</th>
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
