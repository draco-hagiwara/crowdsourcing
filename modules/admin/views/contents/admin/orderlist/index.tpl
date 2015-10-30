{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【案件　検索】</h4>
{form_open('/orderlist/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
	<tbody>

	<div class="row">
	  <tr>
		<td class="col-sm-2">案件ID</td>
		<td class="col-sm-2">
		  {form_input('pj_id' , set_value('pj_id', $serch_item.pj_id) , 'class="form-control" placeholder=""')}
		  {if form_error('pj_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_id')}</font></label>{/if}
		</td>
		<td class="col-sm-2">申請ID</td>
		<td class="col-sm-2">
		  {form_input('pj_pe_id' , set_value('pj_pe_id', $serch_item.pj_pe_id) , 'class="form-control" placeholder=""')}
		  {if form_error('pj_pe_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_pe_id')}</font></label>{/if}
		</td>
		<td class="col-sm-2">クライアントID</td>
		<td class="col-sm-2">
		  {form_input('pj_pe_cl_id' , set_value('pj_pe_cl_id', $serch_item.pj_pe_cl_id) , 'class="form-control" placeholder=""')}
		  {if form_error('pj_pe_cl_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_pe_cl_id')}</font></label>{/if}
		</td>
	  </tr>
	  <tr>
		<td class="col-sm-2">案件タイトル</td>
		<td class="col-sm-6" colspan="3">
		  {form_input('pj_order_title' , set_value('pj_order_title', $serch_item.pj_order_title) , 'class="form-control" placeholder="案件タイトルを入力してください。"')}
		  {if form_error('pj_order_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_order_title')}</font></label>{/if}
		</td>
		<td class="col-sm-2">ジャンル</td>
		<td class="col-sm-2">
		  {form_dropdown('pj_genre01', $options_genre_list, set_value('pj_genre01', $serch_item.pj_genre01))}
		</td>
	  </tr>
	</div>

	</tbody>
  </table>

  <table class="table table-hover table-bordered">
	<tbody>
	  <tr>
		<td class="col-sm-2">並び替え</td>{* ORDERBY の優先順位があるので注意 *}
		<td class="col-sm-2">案件ID</td>
		<td class="col-sm-2">
		  {form_dropdown('orderpjid', $options_orderpjid, set_value('orderpjid', $serch_item.orderpjid))}
		</td>
		<td class="col-sm-2">申請ID</td>
		<td class="col-sm-2">
		  {form_dropdown('orderpeid', $options_orderpeid, set_value('orderpeid', $serch_item.orderpeid))}
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








{form_open('/orderlist/detail00/' , 'name="detailForm" class="form-horizontal"')}
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>案件ID</th>
				<th>申請ID</th>
				<th>clientID</th>
				<th>status</th>
				<th>案件タイトル</th>
				<th>ジャンル</th>
				<th>申請日</th>
			</tr>
		</thead>


		{foreach from=$order_list item=list}
		<tbody>
			<tr>
				<td>
					<button type="submit" class="btn btn-success btn-xs" name="pjid_uniq" value="{$list.pj_id}">更新</button>
				</td>
				<td>
					{$list.pj_id}
				</td>
				<td>
					{$list.pj_pe_id}
				</td>
				<td>
					{$list.pj_pe_cl_id}
				</td>
				<td>
					{if $list.pj_status == "0"}<font color="#ffffff" style="background-color:#0000ff">準 備 中</font>
					{elseif $list.pj_status == "8"}<font color="#ffffff" style="background-color:#a9a9a9">保 留 中</font>
					{else}}エラー
					{/if}
				</td>
				<td style="width: 450px; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
					{$list.pj_order_title}
				</td>
				<td>
					{$options_genre_list[$list.pj_genre01]}
				</td>
				<td>
					{$list.pj_pe_entry_date|date_format:"%Y-%m-%d"}
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
