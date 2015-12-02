{* ヘッダー部分　START *}
	{include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<!--Body content-->


{if $login_chk == TRUE}

  <div id="typo">
    <div class="inner">Crowd Sourcing</div>
  </div>

  <br><br>
  <div>
  <h4>【ジャンル＆仕事　検索】</h4>
  {form_open('/search_genre/search/' , 'name="searchForm" class="form-horizontal"')}
    <input type="hidden" name="pj_order_title" value="">
    <input type="hidden" name="submit" value="_submit">
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="2">ファション</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="3">アパレル</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="4">アクセサリーン</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="5">美容</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="6">健康</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="7">不動産/賃貸</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="8">住宅/生活</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="9">住宅関連</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="10">地名/人名</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="11">生活/暮らし</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="12">冠婚葬祭/暮らしのマナー</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="13">通信販売</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="14">恋愛/占い</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="15">お悩み</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="16">イベント</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="17">ビジネス/オフィス</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="18">IT・通信関連</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="19">自動車関連</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="20">メディア</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="21">サブカル</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="22">旅行関連</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="23">趣味/娯楽</button>
    <button type="submit" class="btn btn-success btn-xs" name="pj_genre01" value="24">グルメ/食べ物</button>
    <button type="submit" class="btn btn-success btn-lg" name="pj_genre01" value="25">医療</button>
  {form_close()}
  </div>
  <br><br>


{else}

	<div class="jumbotron">
	  <h3>案件情報　　<span class="label label-success">掲載の一部抜粋</span></h3>
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>案件タイトル</th>
				<th>ジャンル</th>
				<th>掲載日</th>
			</tr>
		</thead>

		{foreach from=$seach_list item=list}
			<tbody>
				<tr class="success">
					<td style="text-overflow: ellipsis;">
						{$list.pj_title}
					</td>
					<td>
						{$options_genre_list[$list.pj_genre01]}
					</td>
					<td>
						{$list.pj_open_date|date_format:"%Y-%m-%d"}
					</td>
				</tr>
			</tbody>
		{foreachelse}
			検索結果はありませんでした。
		{/foreach}
	</table>


  <div id="typo">
    <div class="inner">Crowd Sourcing</div>
  </div>

{/if}


{* フッター部分　START *}
    <!-- TwitterBootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
