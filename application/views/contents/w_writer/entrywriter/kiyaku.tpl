{* ヘッダー部分　START *}
	{include file="../../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}


<h2>利用規約</h2>


<div class="alert alert-info" role="alert">
  <p class="lead">こちらの　<a href="#" class="alert-link">会員規約.pdf</a>　を必ずご覧ください。</p>
</div>



{form_open('entrywriter/entry/' , 'name="EntrywiterForm" class="form-horizontal"')}
  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-7">
      {form_checkbox('checkKiyaku[]','1',set_checkbox('checkKiyaku[]', '1'))}規約に同意します。
      {if $err_checkKiyaku==TRUE}<p><span class="label label-danger">Error : </span><label><font color=red>「規約に同意」にチェックを入れてください。</font></label><p>{/if}
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {form_button($attr , '会員登録画面へ' , 'class="btn btn-default"')}
    </div>
  </div>

  {form_hidden('ticket', $ticket)}

{form_close()}






{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
