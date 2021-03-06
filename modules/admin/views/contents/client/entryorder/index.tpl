{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">新規案件申請登録</span></h3>
  ・一度の申請で案件を３つまで同時に登録申請できます。<br />
  ・「申請内容」「申請案件１」の登録は必須です。その他の「申請案件２」「申請案件３」は任意です。
</div>





<ul class="nav nav-tabs">
  {if $entry_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/">申請内容【必須】</a></li>
  {if $flashdata_peid}
    {if $entry_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/entry01/">申請案件１【必須】</a></li>
    {if $entry_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/entry02/">申請案件２【任意】</a></li>
    {if $entry_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/entry03/">申請案件３【任意】</a></li>
  {/if}
</ul>


<div class="jumbotron">
{if $entry_no == '00'}
{form_open('entryorder/data_entry/' , 'name="EntryorderForm" class="form-horizontal"')}

  {form_hidden('entry_no', '00')}

  {if $flashdata_peid}
  <div class="form-group">
    <label for="pe_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
		  {$flashdata_peid}
    </div>
  </div>
  {/if}
  <div class="form-group">
    <label for="pe_status" class="col-sm-3 control-label">ステータス (状態)<font color=red>【必須】</font></label>
    <div class="col-sm-4">
		  {form_dropdown('pe_status', $options_entry_status, {$client_info.pe_status})}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_entry_title" class="col-sm-3 control-label">タイトル（表示件名）<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {form_input('pe_entry_title' , set_value('pe_entry_title', $set_val.pe_entry_title) , 'class="form-control" placeholder="タイトル（表示件名）を入力してください"')}
      {if form_error('pe_entry_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_entry_title')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_genre01" class="col-sm-3 control-label">希望ジャンル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  {form_dropdown('pe_genre01', $options_genre_list, set_value('pe_genre01', ''))}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_title" class="col-sm-3 control-label">案件申請：タイトル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {form_input('pe_title' , set_value('pe_title', $set_val.pe_title) , 'class="form-control" placeholder="案件申請：タイトルを入力してください"')}
      {if form_error('pe_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_title')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_work" class="col-sm-3 control-label">案件申請：概要<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {$attr['name'] = 'pe_work'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pe_work', $set_val.pe_work) , 'class="form-control" placeholder="案件申請：内容を入力してください"')}
      {if form_error('pe_work')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_work')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_notice" class="col-sm-3 control-label">案件申請：注意事項</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pe_notice'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pe_notice', $set_val.pe_notice) , 'class="form-control" placeholder="案件申請：注意事項を入力してください"')}
      {if form_error('pe_notice')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_notice')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_example" class="col-sm-3 control-label">案件申請：例文</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pe_example'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pe_example', $set_val.pe_example) , 'class="form-control" placeholder="案件申請：例文を入力してください"')}
      {if form_error('pe_example')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_example')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_other" class="col-sm-3 control-label">案件申請：その他</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pe_other'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pe_other', $set_val.pe_other) , 'class="form-control" placeholder="案件申請：その他を入力してください"')}
      {if form_error('pe_other')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_other')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_addwork" class="col-sm-3 control-label">案件申請：追加内容</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pe_addwork'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pe_addwork', $set_val.pe_addwork) , 'class="form-control" placeholder="案件申請：追加内容を入力してください"')}
      {if form_error('pe_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_addwork')}</font></label>{/if}
    </div>
  </div>

  <div class="form-group">
    <label for="pe_word_tanka" class="col-sm-3 control-label">個別文字単価指定</label>
    <div class="col-sm-4">
      {form_input('pe_word_tanka' , set_value('pe_word_tanka', $set_val.pe_word_tanka) , 'class="form-control" placeholder="個別文字単価指定を入力してください"')}
      {if form_error('pe_word_tanka')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_word_tanka')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_open_date" class="col-sm-3 control-label">案件希望公開日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('pe_open_date' , set_value('pe_open_date', $set_val.pe_open_date) , 'class="form-control" placeholder="「20xx-xx-xx」の形式で入力してください"')}
      {if form_error('pe_open_date')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_open_date')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_delivery_date" class="col-sm-3 control-label">案件希望納期日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('pe_delivery_date' , set_value('pe_delivery_date', $set_val.pe_delivery_date) , 'class="form-control" placeholder="「20xx-xx-xx」の形式で入力してください"')}
      {if form_error('pe_delivery_date')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_delivery_date')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pe_comment" class="col-sm-3 control-label">備考</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pe_comment'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pe_comment', $set_val.pe_comment) , 'class="form-control"')}
      {if form_error('pe_comment')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pe_comment')}</font></label>{/if}
    </div>
  </div>
{/if}

{if $entry_no != '00'}
{$num = $entry_no}
{form_open('entryorder/data_entry/' , 'name="EntryorderForm" class="form-horizontal"')}
  <h3><span class="label label-primary">依頼案件　{$num}</span></h3>

  {form_hidden('entry_no', $num)}

  {if $flashdata_peid}
  <div class="form-group">
    <label for="pe_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
		  {$flashdata_peid}
    </div>
  </div>
  {/if}

  {section name=t_num start=1 loop=4}
  	{$t_num       = $smarty.section.t_num.index}
  	{$t_keywd_num = 'pei_t_keyword0'|cat:$smarty.section.t_num.index}
  	{$t_count_min = 'pei_t_count_min0'|cat:$smarty.section.t_num.index}
  	{$t_count_max = 'pei_t_count_max0'|cat:$smarty.section.t_num.index}
  	{*$t_char_min  = 'pei_t_char_min0'|cat:$smarty.section.t_num.index*}
  	{*$t_char_max  = 'pei_t_char_max0'|cat:$smarty.section.t_num.index*}

  <div class="form-group">
    <label for="pei_t_keyword0{$t_num}" class="col-sm-3 control-label">タイトル：必須ワード指定 {$t_num}</label>
    <div class="col-sm-9">
      {form_input($t_keywd_num , set_value($t_keywd_num , $set_val.$t_keywd_num) , 'class="form-control" placeholder="タイトルに使用するキーワードを指定してください。100文字以内。"')}
      {if form_error($t_keywd_num)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_keywd_num)}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pei_t_count_min0{$t_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {form_input($t_count_min , set_value($t_count_min , $set_val.$t_count_min) , 'class="form-control" placeholder="最低 使用回数"')}
      {if form_error($t_count_min)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_count_min)}</font></label>{/if}
    </div>
    <label for="pei_t_count_max0{$t_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {form_input($t_count_max , set_value($t_count_max , $set_val.$t_count_max) , 'class="form-control" placeholder="最大 使用回数"')}
      {if form_error($t_count_max)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_count_max)}</font></label>{/if}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="pei_t_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('pei_t_char_min' , set_value('pei_t_char_min' , $set_val.pei_t_char_min) , 'class="form-control" placeholder="最低 使用文字数"')}
      {if form_error('pei_t_char_min')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_t_char_min')}</font></label>{/if}
    </div>
    <label for="pei_t_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('pei_t_char_max' , set_value('pei_t_char_max' , $set_val.pei_t_char_max) , 'class="form-control" placeholder="最大 使用文字数"')}
      {if form_error('pei_t_char_max')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_t_char_max')}</font></label>{/if}
    </div>
  </div>


  <hr color="red">

  {section name=b_num start=1 loop=6}
  	{$b_num       = $smarty.section.b_num.index}
  	{$b_keywd_num = 'pei_b_word0'|cat:$smarty.section.b_num.index}
  	{$b_count_min = 'pei_b_count_min0'|cat:$smarty.section.b_num.index}
  	{$b_count_max = 'pei_b_count_max0'|cat:$smarty.section.b_num.index}
  	{*$b_char_min  = 'pei_b_char_min0'|cat:$smarty.section.b_num.index*}
  	{*$b_char_max  = 'pei_b_char_max0'|cat:$smarty.section.b_num.index*}

  <div class="form-group">
    <label for="pei_b_word0{$b_num}" class="col-sm-3 control-label">本文：必須ワード指定 {$b_num}</label>
    <div class="col-sm-9">
      {form_input($b_keywd_num , set_value($b_keywd_num , $set_val.$b_keywd_num) , 'class="form-control" placeholder="本文に使用するキーワードを指定してください。100文字以内。"')}
      {if form_error($b_keywd_num)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_keywd_num)}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pei_b_count_min0{$b_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {form_input($b_count_min , set_value($b_count_min , $set_val.$b_count_min) , 'class="form-control" placeholder="最低 使用回数"')}
      {if form_error($b_count_min)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_count_min)}</font></label>{/if}
    </div>
    <label for="pei_b_count_max0{$b_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {form_input($b_count_max , set_value($b_count_max , $set_val.$b_count_max) , 'class="form-control" placeholder="最大 使用回数"')}
      {if form_error($b_count_max)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_count_max)}</font></label>{/if}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="pei_b_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('pei_b_char_min' , set_value('pei_b_char_min' , $set_val.pei_b_char_min) , 'class="form-control" placeholder="最低 使用文字数"')}
      {if form_error('pei_b_char_min')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_b_char_min')}</font></label>{/if}
    </div>
    <label for="pei_b_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('pei_b_char_max' , set_value('pei_b_char_max' , $set_val.pei_b_char_max) , 'class="form-control" placeholder="最大 使用文字数"')}
      {if form_error('pei_b_char_max')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_b_char_max')}</font></label>{/if}
    </div>
  </div>


  <div class="form-group">
    <label for="pei_work" class="col-sm-3 control-label">個別申請：内容詳細<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {$attr['name'] = 'pei_work'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pei_work', $set_val.pei_work) , 'class="form-control" placeholder="個別申請：内容を入力してください"')}
      {if form_error('pei_work')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_work')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pei_notice" class="col-sm-3 control-label">個別申請：注意事項</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pei_notice'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pei_notice', $set_val.pei_notice) , 'class="form-control" placeholder="個別申請：注意事項を入力してください"')}
      {if form_error('pei_notice')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_notice')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pei_example" class="col-sm-3 control-label">個別申請：例文</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pei_example'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pei_example', $set_val.pei_example) , 'class="form-control" placeholder="個別申請：例文を入力してください"')}
      {if form_error('pei_example')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_example')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pei_other" class="col-sm-3 control-label">個別申請：その他</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pei_other'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pei_other', $set_val.pei_other) , 'class="form-control" placeholder="個別申請：その他を入力してください"')}
      {if form_error('pei_other')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_other')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pei_addwork" class="col-sm-3 control-label">個別申請：追加内容</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pei_addwork'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pei_addwork', $set_val.pei_addwork) , 'class="form-control" placeholder="個別申請：追加内容を入力してください"')}
      {if form_error('pei_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pei_addwork')}</font></label>{/if}
    </div>
  </div>

{/if}

  <br /><br />
  {if $flashdata_peid}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-1">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_new['value'] = '_submit'}
      {form_button($attr_sub , '更　新' , 'class="btn btn-default"')}
    </div>
    <div class="col-sm-offset-1 col-sm-1">
      {$attr_new['name']  = 'submit'}
      {$attr_new['type']  = 'submit'}
      {$attr_new['value'] = '_new'}
      {form_button($attr_new , '続けて新規登録' , 'class="btn btn-default"')}
    </div>
  </div>
  {else}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_new['value'] = '_submit'}
      {form_button($attr_sub , '登　　録' , 'class="btn btn-default"')}
    </div>
  </div>
  {/if}

{form_close()}
<!-- </form> -->
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
