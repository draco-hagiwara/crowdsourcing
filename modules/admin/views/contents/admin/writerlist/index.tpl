{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>ログイン画面　　<span class="label label-danger">アドミン</span></h3>
</div>



<script type="text/javascript">
<!--
function fmSubmit(formName, url, method, num) {
  var f1 = document.forms[formName];

  console.log(num);

  /* エレメント作成&データ設定&要素追加 */
  var e1 = document.createElement('input');
  e1.setAttribute('type', 'hidden');
  e1.setAttribute('name', 'chg_uniq');
  e1.setAttribute('value', num);
  f1.appendChild(e1);

  /* サブミットするフォームを取得 */
  f1.method = method;                                   // method(GET or POST)を設定する
  f1.action = url;                                      // action(遷移先URL)を設定する
  f1.submit();                                          // submit する
  return true;
}
// -->
</script>












<div id="contents" class="container">

<h4>【ライター検索】</h4>
{form_open('/writerlist/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
    <tbody>

      <tr>
        <td class="col-sm-2">ニックネーム</td>
        <td class="col-sm-6">
          {form_input('wr_nickname' , set_value('wr_nickname', '') , 'class="form-control" placeholder="会社名を入力してください。"')}
          {if form_error('wr_nickname')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_nickname')}</font></label>{/if}
        </td>
        <td class="col-sm-2">ライターID</td>
        <td class="col-sm-2">
          {form_input('wr_id' , set_value('wr_id', '') , 'class="form-control" placeholder=""')}
          {if form_error('wr_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_id')}</font></label>{/if}
        </td>
      </tr>

      <tr>
        <td class="col-sm-2">メールアドレス</td>
        <td class="col-sm-6">
          {form_input('wr_email' , set_value('wr_email', '') , 'class="form-control" placeholder="メールアドレスを入力してください。"')}
          {if form_error('wr_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('wr_email')}</font></label>{/if}
        </td>
        <td class="col-sm-2">ステータス</td>
        <td class="col-sm-2">
          {form_dropdown('wr_status', $options_wr_status01, set_value('wr_status', ''))}
        </td>
      </tr>
    </tbody>
  </table>

  <table class="table table-hover table-bordered">
    <tbody>
      <tr>
        <td class="col-sm-2">並び替え</td>
        <td class="col-sm-2">ライターID</td>
        <td class="col-sm-2">
          {form_dropdown('orderid', $options_orderid, set_value('orderid', ''))}
        </td>
        <td class="col-sm-2">ステータス</td>
        <td class="col-sm-2">
          {form_dropdown('orderstatus', $options_orderstatus, set_value('orderstatus', ''))}
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








{form_open('/writerlist/detail/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>status</th>
                <th>ランク</th>
                <th>ニックネーム</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>TEL</th>
            </tr>
        </thead>


        {foreach from=$writer_list item=wr}
        <tbody>
            <tr>
                <td>
                    <button type="submit" class="btn btn-success btn-xs" name="wrid_uniq" value="{$wr.wr_id}">更新</button>
                </td>
                <td>
                    {$wr.wr_id|escape}
                </td>
                <td>
                    {if $wr.wr_status == "1"}<font color="#ffffff" style="background-color:#90ee90">仮　申　請</font>
                    {elseif $wr.wr_status == "2"}<font color="#ffffff" style="background-color:#008000">登録申請中</font>
                    {elseif $wr.wr_status == "3"}<font color="#ffffff" style="background-color:#ff6347">仮　登　録</font>
                    {elseif $wr.wr_status == "4"}<font color="#ffffff" style="background-color:#0000ff">登　　　録</font>
                    {elseif $wr.wr_status == "7"}<font color="#8a2be2">一時停止</font>
                    {elseif $wr.wr_status == "8"}<font color="#ffffff" style="background-color:#800000">強制停止</font>
                    {elseif $wr.wr_status == "9"}<font color="#ffffff" style="background-color:#a9a9a9">退　　　会</font>
                    {else}}エラー
                    {/if}
                </td>
                <td>
                    {if $wr.wr_mm_rank_id == "0"}<font color="#ffffff" style="background-color:lime">ゲスト</font>
                    {elseif $wr.wr_mm_rank_id == "1"}<font color="#ffffff" style="background-color:sienna">ブロンズ</font>
                    {elseif $wr.wr_mm_rank_id == "2"}<font color="#ffffff" style="background-color:silver">シルバー</font>
                    {elseif $wr.wr_mm_rank_id == "3"}<font color="#ffffff" style="background-color:gold">ゴールド</font>
                    {else}}エラー
                    {/if}
                </td>
                <td>
                    {$wr.wr_nickname|escape}
                </td>
                <td>
                    {$wr.wr_name01|escape} {$wr.wr_name02|escape}
                </td>
                <td>
                    {$wr.wr_email|escape}
                </td>
                <td>
                    {$wr.wr_tel|escape}
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
