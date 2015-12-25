{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">新規案件申請登録</span></h3>
  ・一度の案件申請で記事を３つまで同時に登録申請できます。<br />
  ・「申請内容」「申請記事１」の登録は必須です。その他の「申請記事２」「申請記事３」は任意です。
</div>





<ul class="nav nav-tabs">
  {if $entry_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/">申請内容【必須】</a></li>
  {if $flashdata_peid}
    {if $entry_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/entry01/">申請記事１【必須】</a></li>
    {if $entry_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/entry02/">申請記事２【任意】</a></li>
    {if $entry_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/entryorder/entry03/">申請記事３【任意】</a></li>
  {/if}
</ul>


<div class="jumbotron">

<label><font color=red>{$result_mess}</font></label>

{if $entry_no == '00'}
{form_open('entryorder/data_entry/' , 'name="EntryorderForm" class="form-horizontal"')}

  {form_hidden('entry_no', '00')}

  {if $flashdata_peid}
  <div class="form-group">
    <label for="en_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
          {$flashdata_peid}
    </div>
  </div>
  {/if}
  <div class="form-group">
    <label for="en_status" class="col-sm-3 control-label">ステータス (状態)<font color=red>【必須】</font></label>
    <div class="col-sm-4">
          {$options_entry_status[$set_val.en_status]}
          {form_hidden('en_status', $set_val.en_status)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_entry_title" class="col-sm-3 control-label">タイトル（表示件名）<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {form_input('en_entry_title' , set_value('en_entry_title', $set_val.en_entry_title) , 'class="form-control" placeholder="タイトル（表示件名）を入力してください"')}
      {if form_error('en_entry_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_entry_title')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_genre01" class="col-sm-3 control-label">希望ジャンル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {form_dropdown('en_genre01', $options_genre_list, set_value('en_genre01', $set_val.en_genre01))}
      {if form_error('en_genre01')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_genre01')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_title" class="col-sm-3 control-label">案件申請：タイトル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {form_input('en_title' , set_value('en_title', $set_val.en_title) , 'class="form-control" placeholder="案件申請：タイトルを入力してください"')}
      {if form_error('en_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_title')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_work" class="col-sm-3 control-label">案件申請：概要<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {$attr['name'] = 'en_work'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('en_work', $set_val.en_work) , 'class="form-control" placeholder="案件申請：内容を入力してください"')}
      {if form_error('en_work')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_work')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_notice" class="col-sm-3 control-label">案件申請：注意事項</label>
    <div class="col-sm-9">
      {$attr['name'] = 'en_notice'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('en_notice', $set_val.en_notice) , 'class="form-control" placeholder="案件申請：注意事項を入力してください"')}
      {if form_error('en_notice')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_notice')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_example" class="col-sm-3 control-label">案件申請：例文</label>
    <div class="col-sm-9">
      {$attr['name'] = 'en_example'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('en_example', $set_val.en_example) , 'class="form-control" placeholder="案件申請：例文を入力してください"')}
      {if form_error('en_example')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_example')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_other" class="col-sm-3 control-label">案件申請：その他</label>
    <div class="col-sm-9">
      {$attr['name'] = 'en_other'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('en_other', $set_val.en_other) , 'class="form-control" placeholder="案件申請：その他を入力してください"')}
      {if form_error('en_other')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_other')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_addwork" class="col-sm-3 control-label">案件申請：追加内容</label>
    <div class="col-sm-9">
      {$attr['name'] = 'en_addwork'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('en_addwork', $set_val.en_addwork) , 'class="form-control" placeholder="案件申請：追加内容を入力してください"')}
      {if form_error('en_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_addwork')}</font></label>{/if}
    </div>
  </div>

  <div class="form-group">
    <label for="en_word_tanka" class="col-sm-3 control-label">個別文字単価指定</label>
    <div class="col-sm-4">
      {form_input('en_word_tanka' , set_value('en_word_tanka', $set_val.en_word_tanka) , 'class="form-control" placeholder="個別文字単価指定を入力してください"')}
      {if form_error('en_word_tanka')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_word_tanka')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_open_date" class="col-sm-3 control-label">案件希望公開日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('en_open_date' , set_value('en_open_date', $set_val.en_open_date) , 'class="form-control" placeholder="「20xx-xx-xx」の形式で入力してください"')}
      {if form_error('en_open_date')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_open_date')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_delivery_date" class="col-sm-3 control-label">案件希望納期日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('en_delivery_date' , set_value('en_delivery_date', $set_val.en_delivery_date) , 'class="form-control" placeholder="「20xx-xx-xx」の形式で入力してください"')}
      {if form_error('en_delivery_date')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_delivery_date')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="en_comment" class="col-sm-3 control-label">備考</label>
    <div class="col-sm-9">
      {$attr['name'] = 'en_comment'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('en_comment', $set_val.en_comment) , 'class="form-control"')}
      {if form_error('en_comment')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_comment')}</font></label>{/if}
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
    <label for="en_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
          {$flashdata_peid}
    </div>
  </div>
  {/if}

  {section name=t_num start=1 loop=4}
      {$t_num       = $smarty.section.t_num.index}
      {$t_keywd_num = 'ei_t_keyword0'|cat:$smarty.section.t_num.index}
      {$t_count_min = 'ei_t_count_min0'|cat:$smarty.section.t_num.index}
      {$t_count_max = 'ei_t_count_max0'|cat:$smarty.section.t_num.index}
      {*$t_char_min  = 'ei_t_char_min0'|cat:$smarty.section.t_num.index*}
      {*$t_char_max  = 'ei_t_char_max0'|cat:$smarty.section.t_num.index*}

  <div class="form-group">
    <label for="ei_t_keyword0{$t_num}" class="col-sm-3 control-label">タイトル：必須ワード指定 {$t_num}</label>
    <div class="col-sm-9">
      {form_input($t_keywd_num , set_value($t_keywd_num , $set_val.$t_keywd_num) , 'class="form-control" placeholder="タイトルに使用するキーワードを指定してください。100文字以内。"')}
      {if form_error($t_keywd_num)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_keywd_num)}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_t_count_min0{$t_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {form_input($t_count_min , set_value($t_count_min , $set_val.$t_count_min) , 'class="form-control" placeholder="最低 使用回数"')}
      {if form_error($t_count_min)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_count_min)}</font></label>{/if}
    </div>
    <label for="ei_t_count_max0{$t_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {form_input($t_count_max , set_value($t_count_max , $set_val.$t_count_max) , 'class="form-control" placeholder="最大 使用回数"')}
      {if form_error($t_count_max)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_count_max)}</font></label>{/if}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="ei_t_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('ei_t_char_min' , set_value('ei_t_char_min' , $set_val.ei_t_char_min) , 'class="form-control" placeholder="最低 使用文字数"')}
      {if form_error('ei_t_char_min')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_t_char_min')}</font></label>{/if}
    </div>
    <label for="ei_t_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('ei_t_char_max' , set_value('ei_t_char_max' , $set_val.ei_t_char_max) , 'class="form-control" placeholder="最大 使用文字数"')}
      {if form_error('ei_t_char_max')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_t_char_max')}</font></label>{/if}
    </div>
  </div>


  <hr color="red">

  {section name=b_num start=1 loop=6}
      {$b_num       = $smarty.section.b_num.index}
      {$b_keywd_num = 'ei_b_word0'|cat:$smarty.section.b_num.index}
      {$b_count_min = 'ei_b_count_min0'|cat:$smarty.section.b_num.index}
      {$b_count_max = 'ei_b_count_max0'|cat:$smarty.section.b_num.index}
      {*$b_char_min  = 'ei_b_char_min0'|cat:$smarty.section.b_num.index*}
      {*$b_char_max  = 'ei_b_char_max0'|cat:$smarty.section.b_num.index*}

  <div class="form-group">
    <label for="ei_b_word0{$b_num}" class="col-sm-3 control-label">本文：必須ワード指定 {$b_num}</label>
    <div class="col-sm-9">
      {form_input($b_keywd_num , set_value($b_keywd_num , $set_val.$b_keywd_num) , 'class="form-control" placeholder="本文に使用するキーワードを指定してください。100文字以内。"')}
      {if form_error($b_keywd_num)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_keywd_num)}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_b_count_min0{$b_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {form_input($b_count_min , set_value($b_count_min , $set_val.$b_count_min) , 'class="form-control" placeholder="最低 使用回数"')}
      {if form_error($b_count_min)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_count_min)}</font></label>{/if}
    </div>
    <label for="ei_b_count_max0{$b_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {form_input($b_count_max , set_value($b_count_max , $set_val.$b_count_max) , 'class="form-control" placeholder="最大 使用回数"')}
      {if form_error($b_count_max)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_count_max)}</font></label>{/if}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="ei_b_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('ei_b_char_min' , set_value('ei_b_char_min' , $set_val.ei_b_char_min) , 'class="form-control" placeholder="最低 使用文字数"')}
      {if form_error('ei_b_char_min')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_b_char_min')}</font></label>{/if}
    </div>
    <label for="ei_b_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('ei_b_char_max' , set_value('ei_b_char_max' , $set_val.ei_b_char_max) , 'class="form-control" placeholder="最大 使用文字数"')}
      {if form_error('ei_b_char_max')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_b_char_max')}</font></label>{/if}
    </div>
  </div>


  <div class="form-group">
    <label for="ei_work" class="col-sm-3 control-label">個別申請：内容詳細<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {$attr['name'] = 'ei_work'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('ei_work', $set_val.ei_work) , 'class="form-control" placeholder="個別申請：内容を入力してください"')}
      {if form_error('ei_work')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_work')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_notice" class="col-sm-3 control-label">個別申請：注意事項</label>
    <div class="col-sm-9">
      {$attr['name'] = 'ei_notice'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('ei_notice', $set_val.ei_notice) , 'class="form-control" placeholder="個別申請：注意事項を入力してください"')}
      {if form_error('ei_notice')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_notice')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_example" class="col-sm-3 control-label">個別申請：例文</label>
    <div class="col-sm-9">
      {$attr['name'] = 'ei_example'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('ei_example', $set_val.ei_example) , 'class="form-control" placeholder="個別申請：例文を入力してください"')}
      {if form_error('ei_example')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_example')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_other" class="col-sm-3 control-label">個別申請：その他</label>
    <div class="col-sm-9">
      {$attr['name'] = 'ei_other'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('ei_other', $set_val.ei_other) , 'class="form-control" placeholder="個別申請：その他を入力してください"')}
      {if form_error('ei_other')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_other')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_addwork" class="col-sm-3 control-label">個別申請：追加内容</label>
    <div class="col-sm-9">
      {$attr['name'] = 'ei_addwork'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('ei_addwork', $set_val.ei_addwork) , 'class="form-control" placeholder="個別申請：追加内容を入力してください"')}
      {if form_error('ei_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('ei_addwork')}</font></label>{/if}
    </div>
  </div>

{/if}

  <br /><br />
  {$js = 'class="btn btn-default" onClick="return orderSubmit()"'}
  {if $flashdata_peid}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-1">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_submit'}
      {form_button($attr_sub , '更　新' , $js)}
    </div>
  {if $entry_no == '00'}
    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-1">
        {$attr_sub['name']  = 'submit'}
        {$attr_sub['type']  = 'submit'}
        {$attr_sub['value'] = '_entry'}
        {form_button($attr_sub , '申請する' , $js)}
      </div>
    {/if}
    <div class="col-sm-offset-1 col-sm-1">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_new'}
      {form_button($attr_sub , '続けて新規登録' , $js)}
    </div>
  </div>
  {else}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_submit'}
      {form_button($attr_sub , '登　　録' , $js)}
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
