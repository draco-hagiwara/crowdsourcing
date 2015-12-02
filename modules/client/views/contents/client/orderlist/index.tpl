{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div id="contents" class="container">

<h4>【投稿状況　検索】</h4>
{form_open('/orderlist/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
	<tbody>

	<div class="row">
	  <tr>
		<td class="col-sm-2">案件タイトル</td>
		<td class="col-sm-10" colspan="5">
		  {form_input('pj_title' , set_value('pj_title', $serch_item.pj_title) , 'class="form-control" placeholder="案件タイトルを入力してください。"')}
		  {if form_error('pj_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_title')}</font></label>{/if}
		</td>
	  </tr>
	  <tr>
		<td class="col-sm-2">申請ID</td>
		<td class="col-sm-2">
		  {form_input('pj_pe_id' , set_value('pj_pe_id', $serch_item.pj_pe_id) , 'class="form-control" placeholder=""')}
		  {if form_error('pj_pe_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_pe_id')}</font></label>{/if}
		</td>
		<td class="col-sm-2">ジャンル</td>
		<td class="col-sm-6" colspan="4">
		  {form_dropdown('pj_genre01', $options_genre_list, set_value('pj_genre01', $serch_item.pj_genre01))}
		</td>
	  </tr>
	  <tr>
		<td class="col-sm-2">ステータス</td>
		<td class="col-sm-2">
		  {form_dropdown('pj_status', $options_pj_status, set_value('pj_status', $serch_item.pj_status))}
		</td>
		<td class="col-sm-2">エントリー</td>
		<td class="col-sm-2">
		  {form_dropdown('pj_entry_status', $options_pj_entry_status, set_value('pj_entry_status', $serch_item.pj_entry_status))}
		</td>
		<td class="col-sm-2">作業ステータス</td>
		<td class="col-sm-2">
		  {form_dropdown('pj_work_status', $options_pj_work_status, set_value('pj_work_status', $serch_item.pj_work_status))}
		</td>
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
		<td class="col-sm-2">申請ID</td>
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








{form_open('/orderlist/detail00/' , 'name="detailForm" class="form-horizontal"')}
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>ステータス<br>エントリー</th>
				<th>申請ID<br>WR作業</th>
				<th>案件タイトル</th>
				<th>ジャンル<br>申請日</th>
				<th>予定納期<br>納品日</th>
			</tr>
		</thead>


		{foreach from=$listall item=list}
		<tbody>
			<tr>
				<td>
					<button type="submit" class="btn btn-success btn-xs" name="pjid_uniq" value="{$list.pj_id}">更新</button>
				</td>
				<td>
				  {if $list.pj_deliver_flg == FALSE}
					{if $list.pj_status == "1"}<font color="#ffffff" style="background-color:navy">公 開 中</font>
					{elseif $list.pj_status == "2"}<font color="#ffffff" style="background-color:blue">再 公 開</font>
					{elseif $list.pj_status == "3"}<font color="#ffffff" style="background-color:lime">プレ公開</font>
					{elseif $list.pj_status == "4"}<font color="#ffffff" style="background-color:yellowgreen">指名公開</font>
					{elseif $list.pj_status == "5"}<font color="#ffffff" style="background-color:whitesmoke">非 公 開</font>
					{elseif $list.pj_status == "6"}<font color="#ffffff" style="background-color:plum">公開終了</font>
					{elseif $list.pj_status == "8"}<font color="#ffffff" style="background-color:orange">保　　留</font>
					{elseif $list.pj_status == "9"}<font color="#ffffff" style="background-color:gray">削　　除</font>
					{else}エラー
					{/if}
				  {else}
				    <font color="#ffffff" style="background-color:red">納品済</font>
				  {/if}
				  <br>
				  {if $list.pj_entry_status == "1"}<font color="#ffffff" style="background-color:hotpink">ｴﾝﾄﾘｰ中</font>{/if}
				</td>
				<td>
					{$list.pj_pe_id}
					<br>
					{if $list.pj_entry_status == "1"}
						{if $list.pj_work_status == "0"}<font color="#ffffff" style="background-color:navy">投稿なし</font>
						{elseif $list.pj_work_status == "1"}<font color="#ffffff" style="background-color:blue">作成中</font>
						{elseif $list.pj_work_status == "2"}<font color="#ffffff" style="background-color:lime">再作成中</font>
						{elseif $list.pj_work_status == "3"}<font color="#ffffff" style="background-color:yellowgreen">審査待ち</font>
						{elseif $list.pj_work_status == "4"}<font color="#ffffff" style="background-color:plum">審査OK</font>
						{elseif $list.pj_work_status == "5"}<font color="#ffffff" style="background-color:gray">審査NG</font>
						{elseif $list.pj_work_status == "6"}<font color="#ffffff" style="background-color:violet">時間オーバ</font>
						{elseif $list.pj_work_status == "7"}<font color="#ffffff" style="background-color:whitesmoke">ライターキャンセル</font>
						{else}エラー
						{/if}
					{/if}
				</td>
				<td style="width: 450px; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
					{$list.pj_order_title}
				</td>
				<td>
					{$options_genre_list[$list.pj_genre01]}<br>
					{$list.pj_pe_entry_date|date_format:"%Y-%m-%d %H:%M"}
				</td>
				<td>
					{$list.pj_pe_delivery_date|date_format:"%Y-%m-%d"}<br>
					{$list.pj_delivery_date|date_format:"%Y-%m-%d %H:%M"}
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
