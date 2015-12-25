{* ヘッダー部分　START *}
    {include file="../../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>
<script src="../../js/word_cnt.js"></script>







<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>仕事情報</h3>
</div>





<ul class="nav nav-tabs">
  {if $order_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/my_entrylist/detail00">仕事概要</a></li>
  {if $order_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/my_entrylist/detail01/">記事詳細１</a></li>
  {if $job_cnt == 2}
    {if $order_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/my_entrylist/detail02/">記事詳細２</a></li>
  {/if}
  {if $job_cnt == 3}
    {if $order_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/my_entrylist/detail02/">記事詳細２</a></li>
    {if $order_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/my_entrylist/detail03/">記事詳細３</a></li>
  {/if}
</ul>


<div class="jumbotron">

<label><font color=red>{$result_mess_ng}</font></label>
<label><font color=red>{$result_mess_ok}</font></label>

{if $order_no == '00'}
{form_open('my_entrylist/data_post/' , 'name="OrderForm" class="form-horizontal"')}

  {form_hidden('order_no', '00')}

  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">仕事 ID</label>
    <div class="col-sm-4">
      {$order_info.pj_id}
      {form_hidden('pj_id', $order_info.pj_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">ステータス</label>
    <div class="col-sm-4">
      {$options_workstatus[$order_info.wi_pj_work_status]}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_genre01" class="col-sm-3 control-label">ジャンル</label>
    <div class="col-sm-9">
      {$options_genre_list[$order_info.pj_genre01]}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_title" class="col-sm-3 control-label">タイトル</label>
    <div class="col-sm-9">
      {$order_info.pj_title}
      {form_hidden('pj_title', $order_info.pj_title)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_work" class="col-sm-3 control-label">概要</label>
    <div class="col-sm-9">
      {$order_info.pj_work|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_notice" class="col-sm-3 control-label">注意事項</label>
    <div class="col-sm-9">
      {$order_info.pj_notice|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_example" class="col-sm-3 control-label">例文</label>
    <div class="col-sm-9">
      {$order_info.pj_example|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_other" class="col-sm-3 control-label">その他</label>
    <div class="col-sm-9">
      {$order_info.pj_other|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_addwork" class="col-sm-3 control-label">追加内容</label>
    <div class="col-sm-9">
      {$order_info.pj_addwork|nl2br}
    </div>
  </div>

  <div class="form-group">
    <label for="wi_word_tanka" class="col-sm-3 control-label">文字単価</label>
    <div class="col-sm-4">
      {$order_info.wi_word_tanka} 円
    </div>
  </div>
  <div class="form-group">
    <label for="pj_taa_difficulty_id" class="col-sm-3 control-label">難易度</label>
    <div class="col-sm-4">
      {$options_wi_difficulty_id[$order_info.wi_difficulty_id]}
    </div>
  </div>

  <div class="form-group">
    <label for="wi_entry_date" class="col-sm-3 control-label">エントリー時間</label>
    <div class="col-sm-4">
      {$order_info.wi_entry_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_posting_limit_date" class="col-sm-3 control-label">制作〆切時間</label>
    <div class="col-sm-4">
      {$order_info.wi_posting_limit_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>

  <br /><br />
      {$js = 'class="btn btn-default" onClick="return orderSubmit()"'}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-2">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_cancel'}
      {form_button($attr_sub , 'エントリーキャンセル' , $js)}
    </div>
    <div class="col-sm-offset-1 col-sm-6">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_submit'}
      {form_button($attr_sub , '投稿する' , $js)}
    </div>
  </div>

{form_close()}

{/if}

{if $not_disp == TRUE}設定情報はありません。
{else}

{if $order_no != '00'}
{$num = $order_no}
{form_open('my_entrylist/data_save/' , 'name="OrderForm" class="form-horizontal"')}

  {form_hidden('order_no', $num)}

  <div class="form-group">
    <label for="pji_pj_id" class="col-sm-3 control-label">仕事 ID</label>
    <div class="col-sm-4">
          {$order_info.pji_pj_id}
          {form_hidden('pji_pj_id', $order_info.pji_pj_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="rep_title" class="col-sm-3 control-label">タイトル入力欄</label>
    <div class="col-sm-8">
      {form_input('rep_title' , set_value('rep_title', $order_info.rep_title) , 'id="rep_title" class="form-control" placeholder="タイトルを入力してください"')}
      {if form_error('rep_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_title')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="count1">0</span> 文字
    </div>
  </div>


  {section name=t_num start=1 loop=4}
      {$t_num       = $smarty.section.t_num.index}
      {$t_keywd_num = 'rep_t_keyword0'|cat:$smarty.section.t_num.index}
      {$t_count_min = 'rep_t_count_min0'|cat:$smarty.section.t_num.index}
      {$t_count_max = 'rep_t_count_max0'|cat:$smarty.section.t_num.index}
      {*$t_char_min = 'rep_t_char_min0'|cat:$smarty.section.t_num.index*}
      {*$t_char_max = 'rep_t_char_max0'|cat:$smarty.section.t_num.index*}

  <div class="form-group">
    <label for="rep_t_keyword0{$t_num}" class="col-sm-3 control-label">タイトル：必須ワード指定 {$t_num}</label>
    <div class="col-sm-9">
      {$order_info.$t_keywd_num}
    </div>
  </div>
  <div class="form-group">
    <label for="rep_t_count_min0{$t_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {$order_info.$t_count_min}
    </div>
    <label for="rep_t_count_max0{$t_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {$order_info.$t_count_max}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="rep_t_char_min" class="col-sm-3 control-label">最低 使用文字数</label>
    <div class="col-sm-3">
      <label id="t_char_min">{$order_info.rep_t_char_min}</label>
    </div>
    <label for="rep_t_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      <label id="t_char_max">{$order_info.rep_t_char_max}</label>
    </div>
  </div>


  <hr color="red">

  <div class="form-group">
    <label for="rep_text_body" class="col-sm-3 control-label">本文入力欄</label>
    <div class="col-sm-8">
      {$attr['name'] = 'rep_text_body'}
      {$attr['rows'] = 20}
      {form_textarea($attr , set_value('rep_text_body', $order_info.rep_text_body) , 'id="rep_text_body" class="form-control" placeholder="本文を入力してください"')}
      {if form_error('rep_text_body')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_text_body')}</font></label>{/if}
    </div>
    <div class="col-sm-1">
      <span class="count2 bold">0</span> 文字
    </div>
  </div>

  {section name=b_num start=1 loop=6}
    {$b_num       = $smarty.section.b_num.index}
    {$b_keywd_num = 'rep_b_word0'|cat:$smarty.section.b_num.index}
    {$b_count_min = 'rep_b_count_min0'|cat:$smarty.section.b_num.index}
    {$b_count_max = 'rep_b_count_max0'|cat:$smarty.section.b_num.index}
    {*$b_char_min = 'rep_b_char_min0'|cat:$smarty.section.b_num.index*}
    {*$b_char_max = 'rep_b_char_max0'|cat:$smarty.section.b_num.index*}

  <div class="form-group">
    <label for="rep_b_word0{$b_num}" class="col-sm-3 control-label">本文：必須ワード指定 {$b_num}</label>
    <div class="col-sm-9">
      {$order_info.$b_keywd_num}
    </div>
  </div>
  <div class="form-group">
    <label for="rep_b_count_min0{$b_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {$order_info.$b_count_min}
    </div>
    <label for="rep_b_count_max0{$b_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {$order_info.$b_count_max}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="rep_b_char_min" class="col-sm-3 control-label">最低 使用文字数</label>
    <div class="col-sm-3">
      <label id="b_char_min">{$order_info.rep_b_char_min}</label>
    </div>
    <label for="rep_b_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      <label id="b_char_max">{$order_info.rep_b_char_max}</label>
    </div>
  </div>


  <div class="form-group">
    <label for="pji_work" class="col-sm-3 control-label">内容詳細</label>
    <div class="col-sm-9">
      {$order_info.pji_work|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_notice" class="col-sm-3 control-label">注意事項</label>
    <div class="col-sm-9">
      {$order_info.pji_notice|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_example" class="col-sm-3 control-label">例文</label>
    <div class="col-sm-9">
      {$order_info.pji_example|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_other" class="col-sm-3 control-label">その他</label>
    <div class="col-sm-9">
      {$order_info.pji_other|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_addwork" class="col-sm-3 control-label">追加内容</label>
    <div class="col-sm-9">
      {$order_info.pji_addwork|nl2br}
    </div>
  </div>

  <br /><br />
      {$js = 'class="btn btn-default" onClick="return orderSubmit()"'}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_new['value'] = '_submit'}
      {form_button($attr_sub , '保存する' , $js)}
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

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
