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

<h4>【クライアント検索】</h4>
{form_open('/clientlist/search/' , 'name="searchForm" class="form-horizontal"')}
  <table class="table table-hover table-bordered">
    <tbody>

      <tr>
        <td class="col-sm-2">会社名</td>
        <td class="col-sm-6">
          {form_input('cl_company' , set_value('cl_company', '') , 'class="form-control" placeholder="会社名を入力してください。"')}
          {if form_error('cl_company')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_company')}</font></label>{/if}
        </td>
        <td class="col-sm-2">クライアントID</td>
        <td class="col-sm-2">
          {form_input('cl_id' , set_value('cl_id', '') , 'class="form-control" placeholder=""')}
          {if form_error('cl_id')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_id')}</font></label>{/if}
        </td>
      </tr>

      <tr>
        <td class="col-sm-2">メールアドレス</td>
        <td class="col-sm-6">
          {form_input('cl_email' , set_value('cl_email', '') , 'class="form-control" placeholder="メールアドレスを入力してください。"')}
          {if form_error('cl_email')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cl_email')}</font></label>{/if}
        </td>
        <td class="col-sm-2">ステータス</td>
        <td class="col-sm-2">
          {form_dropdown('cl_status', $options_cl_status01, set_value('cl_status', ''))}
        </td>
      </tr>
    </tbody>
  </table>

  <table class="table table-hover table-bordered">
    <tbody>
      <tr>
        <td class="col-sm-2">並び替え</td>
        <td class="col-sm-2">クライアントID</td>
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








{form_open('/clientlist/detail/' , 'name="detailForm" class="form-horizontal"')}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>status<br>料金</th>
                <th>会社名</th>
                <th>メールアドレス<br>契約開始</th>
                <th>TEL<br>契約終了</th>
            </tr>
        </thead>


        {foreach from=$client_list item=cl}
        <tbody>
            <tr>
                <td>
                    <button type="submit" class="btn btn-success btn-xs" name="clid_uniq" value="{$cl.cl_id}">更新</button>
                </td>
                <td>
                    {$cl.cl_id|escape}
                </td>
                <td>
                    {if $cl.cl_status == "0"}<font color="#ffffff" style="background-color:#008000">申 請 中</font>
                    {elseif $cl.cl_status == "1"}<font color="#ffffff" style="background-color:#0000ff">承　　認</font>
                    {elseif $cl.cl_status == "2"}<font color="#ffffff" style="background-color:#ff6347">非 承 認</font>
                    {elseif $cl.cl_status == "7"}<font color="#8a2be2">一時停止</font>
                    {elseif $cl.cl_status == "8"}<font color="#ffffff" style="background-color:#800000">強制停止</font>
                    {elseif $cl.cl_status == "9"}<font color="#ffffff" style="background-color:#a9a9a9">退　　会</font>
                    {else}}エラー
                    {/if}
                    <br>
                    {if $cl.ci_contract_id == "0"}固定
                    {elseif $cl.ci_contract_id == "1"}成果
                    {else}固+成
                    {/if}
                </td>
                <td>
                    {$cl.cl_company|escape}
                </td>
                <td>
                    {$cl.cl_email|escape}
                    <br>
                    {$cl.ci_contract_st}
                </td>
                <td>
                    {$cl.cl_tel01|escape}
                    <br>
                    {$cl.ci_contract_end}
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
