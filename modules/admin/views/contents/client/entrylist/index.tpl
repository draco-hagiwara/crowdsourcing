{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【案件申請　検索】</h4>
{form_open('/entrylist/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
	<tbody>

	<div class="row">
	  <tr>
		<td class="col-sm-2">案件申請ID</td>
		<td class="col-sm-2">
		  {form_input('pe_id' , set_value('pe_id', $serch_item.pe_id) , 'class="form-control" placeholder=""')}
		  {if form_error('pe_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_id')}</font></label>{/if}
		</td>
		<td class="col-sm-2">ステータス</td>
		<td class="col-sm-2">
		  {form_dropdown('pe_status', $options_pe_status, set_value('pe_status', $serch_item.pe_status))}
		</td>
		<td class="col-sm-2">ジャンル</td>
		<td class="col-sm-2">
		  {form_dropdown('pe_genre01', $options_genre_list, set_value('pe_genre01', $serch_item.pe_genre01))}
		</td>
	  </tr>
	  <tr>
		<td class="col-sm-2">申請案件タイトル</td>
		<td class="col-sm-6" colspan="3">
		  {form_input('pe_entry_title' , set_value('pe_entry_title', $serch_item.pe_entry_title) , 'class="form-control" placeholder="申請案件タイトルを入力してください。"')}
		  {if form_error('pe_entry_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_entry_title')}</font></label>{/if}
		</td>
		<td class="col-sm-offset-4" colspan="2"></td>
	  </tr>
	</div>

	</tbody>
  </table>

  <table class="table table-hover table-bordered">
	<tbody>
	  <tr>
		<td class="col-sm-2">並び替え</td>{* ORDERBY の優先順位があるので注意 *}
		<td class="col-sm-2">ステータス</td>
		<td class="col-sm-2">
		  {form_dropdown('orderstatus', $options_orderstatus, set_value('orderstatus', $serch_item.orderstatus))}
		</td>
		<td class="col-sm-2">案件申請ID</td>
		<td class="col-sm-2">
		  {form_dropdown('orderid', $options_orderid, set_value('orderid', $serch_item.orderid))}
		</td>
		<td class="col-sm-offset-2"></td>
	  </tr>
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








{form_open('/entrylist/detail00/' , 'name="detailForm" class="form-horizontal"')}
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>ID</th>
				<th>status</th>
				<th>申請案件タイトル</th>
				<th>ジャンル</th>
				<th>作成日時</th>
				<th>更新日時</th>
			</tr>
		</thead>


		{foreach from=$entry_list item=list}
		<tbody>
			<tr>
				<td>
					<button type="submit" class="btn btn-success btn-xs" name="peid_uniq" value="{$list.pe_id}">更新</button>
				</td>
				<td>
					{$list.pe_id}
				</td>
				<td>
					{if $list.pe_status == "0"}<font color="#ffffff" style="background-color:green">準 備 中</font>
					{elseif $list.pe_status == "1"}<font color="#ffffff" style="background-color:blue">申 請 中</font>
					{elseif $list.pe_status == "3"}<font color="#ffffff" style="background-color:silver">非 承 認</font>
					{elseif $list.pe_status == "4"}<font color="#ffffff" style="background-color:gray">取　　消</font>
					{else}}エラー
					{/if}
				</td>
				<td style="text-overflow: ellipsis;">
					{$list.pe_entry_title}
				</td>
				<td>
					{$options_genre_list[$list.pe_genre01]}
				</td>
				<td>
					{$list.pe_create_date|date_format:"%Y-%m-%d"}
				</td>
				<td>
					{$list.pe_update_date|date_format:"%Y-%m-%d"}
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
