{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

{* ヘッダー部分　END *}

<body>

<div id="contents" class="container">

<div class="jumbotron">
  <h3>メンバー管理　　<span class="label label-success">更　新</span></h3>
</div>





{form_open('/cl_member/up_date/' , 'name="up_dateForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="cm_person" class="col-sm-2 control-label">担当者<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cm_person01' , set_value('cm_person01', $client_info.cm_person01) , 'class="form-control" placeholder="担当者姓を入力してください"')}
      {if form_error('cm_person01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cm_person01')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_input('cm_person02' , set_value('cm_person02', $client_info.cm_person02) , 'class="form-control" placeholder="担当者名を入力してください"')}
      {if form_error('cm_person02')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cm_person02')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_chg'}
      {form_button($attr , '更　新' , $js)}
    </div>
    <div class="col-sm-1">
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_new'}
      {form_button($attr , '新　規' , $js)}
    </div>
  </div>
  <div class="form-group">
    <label for="cm_department" class="col-sm-2 control-label">担当部署</label>
    <div class="col-sm-4">
      {form_input('cm_department' , set_value('cm_department', $client_info.cm_department) , 'class="form-control" placeholder="担当部署を入力してください"')}
      {if form_error('cm_department')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cm_department')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cm_login" class="col-sm-2 control-label">ログインID<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('cm_login' , set_value('cm_login', $client_info.cm_login) , 'class="col-sm-4 form-control" placeholder="メールアドレス（ログインID）を入力してください"')}
      {if form_error('cm_login')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cm_login')}</font></label>{/if}
      {if $err_email==TRUE}<span class="label label-danger">Error : </span><label><font color=red>「メールアドレス」欄で入力したアドレスは既に他で使用されています。再度他のアドレスを入力してください。</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cm_password" class="col-sm-2 control-label">パスワード</label>
    <div class="col-sm-4">
      {form_password('cm_password' , set_value('cm_password', '') , 'class="form-control" placeholder="パスワード　(半角英数字・記号：８文字以上)"')}
      {if form_error('cm_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cm_password')}</font></label>{/if}
    </div>
    <div class="col-sm-4">
      {form_password('retype_password' , set_value('retype_password', '') , 'class="form-control" placeholder="パスワード再入力　(半角英数字・記号：８文字以上)"')}
      <p><small>確認のため、もう一度入力してください。</small></p>
      {if form_error('retype_password')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('retype_password')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cm_authority" class="col-sm-2 control-label">権限設定<font color=red>【必須】</font></label>
    <div class="col-sm-4">
          {form_dropdown('cm_authority', $options_cm_authority, set_value('cm_authority', $client_info.cm_authority))}
          {if form_error('cm_authority')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cm_authority')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="cm_status" class="col-sm-2 control-label">稼働有無<font color=red>【必須】</font></label>
    <div class="col-sm-4">
          {form_dropdown('cm_status', $options_cm_status, set_value('cm_status', $client_info.cm_status))}
          {if form_error('cm_status')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('cm_status')}</font></label>{/if}
    </div>
  </div>

  {form_hidden('cm_mem_id', $client_info.cm_mem_id)}

{form_close()}


{form_open('/cl_member/detail/' , 'name="detailForm" class="form-horizontal"')}

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                <th>名　　前</th>
                <th>所　　属</th>
                <th>権　　限</th>
                <th></th>
            </tr>
        </thead>


        {foreach from=$listall item=list name="loop"}
        <tbody>
            <tr>
                <td></td><td></td><td></td><td></td>
                <td>
                    {$smarty.foreach.loop.iteration}
                </td>
                <td>
                    <button type="submit" class="btn btn-success btn-xs" name="memid_chg" value="{$list.cm_mem_id}">編集</button>
                </td>
                <td>
                    {if $list.cm_status == "1"}<font color="#ffffff" style="background-color:navy">稼働中</font>
                    {else}<font color="#ffffff" style="background-color:lavender">非稼働</font>
                    {/if}
                </td>
                <td>
                    {$list.cm_person01} {$list.cm_person02}
                </td>
                <td>
                    {$list.cm_department}
                </td>
                <td>
                    {if $list.cm_authority == "10"}<font color="#ffffff" style="background-color:navy">管理者</font>
                    {elseif $list.cm_authority == "11"}<font color="#ffffff" style="background-color:hotpink">運用者</font>
                    {elseif $list.cm_authority == "0"}<font color="#ffffff" style="background-color:hotpink">管理者</font>
                    {elseif $list.cm_authority == "1"}<font color="#ffffff" style="background-color:hotpink">運用者</font>
                    {/if}
                </td>
                <td>
                    {if $smarty.foreach.loop.iteration != 1}
                    <button type="submit" class="btn btn-warning btn-xs" name="memid_del" value="{$list.cm_mem_id}">削除</button>
                    {/if}
                </td>
            </tr>
        </tbody>
        {foreachelse}
            登録情報がありませんでした。
        {/foreach}
    </table>

{form_close()}

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
