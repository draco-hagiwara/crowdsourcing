{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>案件申請情報　　<span class="label label-success">案件　更新＆申請</span></h3>
  ・一度の案件申請で記事を３つまで同時に登録申請できます。<br />
  ・「申請内容」「申請記事１」の登録は必須です。その他の「申請記事２」「申請記事３」は任意です。
</div>





<ul class="nav nav-tabs">
  {if $entry_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/entrylist/detail00">申請内容【必須】</a></li>
  {if $entry_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/entrylist/detail01/">申請記事１【必須】</a></li>
  {if $entry_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/entrylist/detail02/">申請記事２【任意】</a></li>
  {if $entry_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/entrylist/detail03/">申請記事３【任意】</a></li>
</ul>


<div class="jumbotron">
{if $entry_no == '00'}
{form_open('entrylist/data_entry/' , 'name="EntryorderForm" class="form-horizontal"')}

  {form_hidden('entry_no', '00')}

  <div class="form-group">
    <label for="en_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
          {$entry_info.en_id}
          {form_hidden('en_id', $entry_info.en_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_entry_title" class="col-sm-3 control-label">タイトル（表示件名）<font color=red>【必須】</font></label>
    <div class="col-sm-9">
          {$entry_info.en_entry_title}
          {form_hidden('en_entry_title', $entry_info.en_entry_title)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_genre01" class="col-sm-3 control-label">希望ジャンル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
          {$entry_info.genre01_name}
          {form_hidden('en_genre01', $entry_info.en_genre01)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_title" class="col-sm-3 control-label">案件申請：タイトル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
          {$entry_info.en_title}
          {form_hidden('en_title', $entry_info.en_title)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_work" class="col-sm-3 control-label">案件申請：概要<font color=red>【必須】</font></label>
    <div class="col-sm-9">
          {$entry_info.en_work|nl2br}
          {form_hidden('en_work', $entry_info.en_work)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_notice" class="col-sm-3 control-label">案件申請：注意事項</label>
    <div class="col-sm-9">
          {$entry_info.en_notice|nl2br}
          {form_hidden('en_notice', $entry_info.en_notice)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_example" class="col-sm-3 control-label">案件申請：例文</label>
    <div class="col-sm-9">
          {$entry_info.en_example|nl2br}
          {form_hidden('en_example', $entry_info.en_example)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_other" class="col-sm-3 control-label">案件申請：その他</label>
    <div class="col-sm-9">
          {$entry_info.en_other|nl2br}
          {form_hidden('en_other', $entry_info.en_other)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_addwork" class="col-sm-3 control-label">案件申請：追加内容</label>
    <div class="col-sm-9">
          {$entry_info.en_addwork|nl2br}
          {form_hidden('en_addwork', $entry_info.en_addwork)}
    </div>
  </div>

  <div class="form-group">
    <label for="en_word_tanka" class="col-sm-3 control-label">個別文字単価指定</label>
    <div class="col-sm-4">
          {$entry_info.en_word_tanka}
          {form_hidden('en_word_tanka', $entry_info.en_word_tanka)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_open_date" class="col-sm-3 control-label">案件希望公開日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
          {$entry_info.en_open_date}
          {form_hidden('en_open_date', $entry_info.en_open_date)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_delivery_date" class="col-sm-3 control-label">案件希望納期日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
          {$entry_info.en_delivery_date}
          {form_hidden('en_delivery_date', $entry_info.en_delivery_date)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_comment" class="col-sm-3 control-label">備考</label>
    <div class="col-sm-9">
          {$entry_info.en_comment|nl2br}
          {form_hidden('en_comment', $entry_info.en_comment)}
    </div>
  </div>
  <div class="form-group">
    <label for="en_reason" class="col-sm-3 control-label">非承認　理由</label>
    <div class="col-sm-9">
      {$attr['name'] = 'en_reason'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('en_reason', $entry_info.en_reason) , 'class="form-control" placeholder="非承認の場合、理由を記入してください。クライアント側に表示されます。"')}
      {if form_error('en_reason')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('en_reason')}</font></label>{/if}
    </div>
  </div>


  <br /><br />
  {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-1">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_accept'}
      {form_button($attr_sub , '承　　認' , $js)}
    </div>
    <div class="col-sm-offset-1 col-sm-7">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_refuse'}
      {form_button($attr_sub , '非 承 認' , $js)}
    </div>
  </div>

{/if}

{if $entry_no != '00'}
{$num = $entry_no}
{form_open('entrylist/data_entry/' , 'name="EntryorderForm" class="form-horizontal"')}
  <h3><span class="label label-primary">依頼案件　{$num}</span></h3>

  {form_hidden('entry_no', $num)}

  {if ($entry_no == '02') OR ($entry_no == '03')}
  <div class="form-group">
    <label for="ei_status" class="col-sm-3 control-label">使用有無</label>
    <div class="col-sm-9">
          {if  $entry_info.ei_status == '1'}使用する{else}使用しない{/if}
          {form_hidden('ei_status', $entry_info.ei_status)}
    </div>
  </div>
  {/if}

  <div class="form-group">
    <label for="ei_en_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
          {$entry_info.ei_en_id}
          {form_hidden('ei_en_id', $entry_info.ei_en_id)}
    </div>
  </div>

  {if  $entry_info.ei_status == '1'}

  {section name=t_num start=1 loop=4}
      {$t_num       = $smarty.section.t_num.index}
      {$t_keywd_num = 'ei_t_keyword0'|cat:$smarty.section.t_num.index}
      {$t_count_min = 'ei_t_count_min0'|cat:$smarty.section.t_num.index}
      {$t_count_max = 'ei_t_count_max0'|cat:$smarty.section.t_num.index}
      {*$t_char_min = 'ei_t_char_min0'|cat:$smarty.section.t_num.index*}
      {*$t_char_max = 'ei_t_char_max0'|cat:$smarty.section.t_num.index*}

  <div class="form-group">
    <label for="ei_t_keyword0{$t_num}" class="col-sm-3 control-label">タイトル：必須ワード指定 {$t_num}</label>
    <div class="col-sm-9">
          {$entry_info.$t_keywd_num}
          {form_hidden($t_keywd_num, $t_keywd_num)}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_t_count_min0{$t_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
          {$entry_info.$t_count_min}
          {form_hidden($t_count_min, $t_count_min)}
    </div>
    <label for="ei_t_count_max0{$t_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
          {$entry_info.$t_count_max}
          {form_hidden($t_count_max, $t_count_max)}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="ei_t_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
          {$entry_info.ei_t_char_min}
          {form_hidden('ei_t_char_min', $entry_info.ei_t_char_min)}
    </div>
    <label for="ei_t_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
          {$entry_info.ei_t_char_max}
          {form_hidden('ei_t_char_max', $entry_info.ei_t_char_max)}
    </div>
  </div>


  <hr color="red">

  {section name=b_num start=1 loop=6}
      {$b_num       = $smarty.section.b_num.index}
      {$b_keywd_num = 'ei_b_word0'|cat:$smarty.section.b_num.index}
      {$b_count_min = 'ei_b_count_min0'|cat:$smarty.section.b_num.index}
      {$b_count_max = 'ei_b_count_max0'|cat:$smarty.section.b_num.index}
      {*$b_char_min = 'ei_b_char_min0'|cat:$smarty.section.b_num.index*}
      {*$b_char_max = 'ei_b_char_max0'|cat:$smarty.section.b_num.index*}

  <div class="form-group">
    <label for="ei_b_word0{$b_num}" class="col-sm-3 control-label">本文：必須ワード指定 {$b_num}</label>
    <div class="col-sm-9">
          {$entry_info.$b_keywd_num}
          {form_hidden($b_keywd_num, $b_keywd_num)}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_b_count_min0{$b_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
          {$entry_info.$b_count_min}
          {form_hidden($b_count_min, $b_count_min)}
    </div>
    <label for="ei_b_count_max0{$b_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
          {$entry_info.$b_count_max}
          {form_hidden($b_count_max, $b_count_max)}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="ei_b_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
          {$entry_info.ei_b_char_min}
          {form_hidden('ei_b_char_min', $entry_info.ei_b_char_min)}
    </div>
    <label for="ei_b_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
          {$entry_info.ei_b_char_max}
          {form_hidden('ei_b_char_max', $entry_info.ei_b_char_max)}
    </div>
  </div>


  <div class="form-group">
    <label for="ei_work" class="col-sm-3 control-label">個別申請：内容詳細<font color=red>【必須】</font></label>
    <div class="col-sm-9">
          {$entry_info.ei_work|nl2br}
          {form_hidden('ei_work', $entry_info.ei_work)}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_notice" class="col-sm-3 control-label">個別申請：注意事項</label>
    <div class="col-sm-9">
          {$entry_info.ei_notice|nl2br}
          {form_hidden('ei_notice', $entry_info.ei_notice)}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_example" class="col-sm-3 control-label">個別申請：例文</label>
    <div class="col-sm-9">
          {$entry_info.ei_example|nl2br}
          {form_hidden('ei_example', $entry_info.ei_example)}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_other" class="col-sm-3 control-label">個別申請：その他</label>
    <div class="col-sm-9">
          {$entry_info.ei_other|nl2br}
          {form_hidden('ei_other', $entry_info.ei_other)}
    </div>
  </div>
  <div class="form-group">
    <label for="ei_addwork" class="col-sm-3 control-label">個別申請：追加内容</label>
    <div class="col-sm-9">
          {$entry_info.ei_addwork|nl2br}
          {form_hidden('ei_addwork', $entry_info.ei_addwork)}
    </div>
  </div>

  {/if}

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
