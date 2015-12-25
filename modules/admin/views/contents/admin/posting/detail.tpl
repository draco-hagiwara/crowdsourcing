{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>投稿情報　　<span class="label label-success">投稿　確認＆審査＆納品</span></h3>
</div>





<ul class="nav nav-tabs">
  {if $entry_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/posting/detail00">投稿内容</a></li>
  {if $entry_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/posting/detail01/">投稿記事１</a></li>
  {if $entry_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/posting/detail02/">投稿記事２</a></li>
  {if $entry_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/posting/detail03/">投稿記事３</a></li>
</ul>


<div class="jumbotron">
{if $entry_no == '00'}
{form_open('posting/data_update/' , 'name="EntryorderForm" class="form-horizontal"')}

  {form_hidden('entry_no', '00')}

  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">案件 ID</label>
    <div class="col-sm-4">
        {$entry_info.pj_id}
        {form_hidden('pj_id', $entry_info.pj_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_status" class="col-sm-3 control-label">ステータス</label>
    <div class="col-sm-4">
      {if $entry_info.pj_entry_status == "1"}
        {$options_pj_status[$entry_info.pj_status]}
        {form_hidden('pj_status', $entry_info.pj_status)}
      {else}
        {form_dropdown('pj_status', $options_pj_status, {$entry_info.pj_status})}
      {/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_entry_status" class="col-sm-3 control-label">エントリー状態</label>
    <div class="col-sm-4">
        {if $entry_info.pj_entry_status == "1"}<font color="#ffffff" style="background-color:navy">エントリー</font>
        {else}<font color="#ffffff" style="background-color:hotpink">エントリーなし</font>
        {/if}
        {form_hidden('pj_entry_status', $entry_info.pj_entry_status)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_work_status" class="col-sm-3 control-label">ライター作業状態</label>
    <div class="col-sm-4">
      {$options_pj_work_status[$entry_info.pj_work_status]}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_deliver_flg" class="col-sm-3 control-label">納品有無</label>
    <div class="col-sm-4">
      {$options_pj_deliver_flg[$entry_info.pj_deliver_flg]}
    </div>
  </div>

  <div class="form-group">
    <label for="pj_title" class="col-sm-3 control-label">ライター投稿情報</label>
    <div class="col-sm-9">　▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽
    </div>
  </div>
  <div class="form-group">
    <label for="pj_wr_id" class="col-sm-3 control-label">ライターID</label>
    <div class="col-sm-4">
        {$entry_info.pj_wr_id} ：「{$entry_info.wr_nickname}」
        {form_hidden('pj_wr_id', $entry_info.pj_wr_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_rank_id" class="col-sm-3 control-label">ライターランク</label>
    <div class="col-sm-4">
        {if isset($entry_info.wi_rank_id)}{$options_memrank_list[$entry_info.wi_rank_id]}{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_rank_id" class="col-sm-3 control-label">エントリー回数</label>
    <div class="col-sm-4">
        {$entry_info.wr_entry_count}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_rank_id" class="col-sm-3 control-label">採用回数</label>
    <div class="col-sm-4">
        {$entry_info.wr_saiyo_count}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_word_tanka" class="col-sm-3 control-label">文字単価</label>
    <div class="col-sm-4">
        {$entry_info.wi_word_tanka}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_word_count" class="col-sm-3 control-label">今回文字数</label>
    <div class="col-sm-4">
        {$entry_info.wi_word_count}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_point" class="col-sm-3 control-label">今回獲得ポイント数</label>
    <div class="col-sm-4">
        {$entry_info.wi_point}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_entry_date" class="col-sm-3 control-label">エントリー日</label>
    <div class="col-sm-4">
        {$entry_info.wi_entry_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_posting_limit_date" class="col-sm-3 control-label">投稿〆切日</label>
    <div class="col-sm-4">
        {$entry_info.wi_posting_limit_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_posting_date" class="col-sm-3 control-label">投稿日</label>
    <div class="col-sm-4">
        {$entry_info.wi_posting_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_check_date" class="col-sm-3 control-label">審査完了日</label>
    <div class="col-sm-4">
        {$entry_info.wi_check_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_delivery_date" class="col-sm-3 control-label">原稿納品日</label>
    <div class="col-sm-4">
        {$entry_info.pj_delivery_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>

  <div class="form-group">
    <label for="pj_title" class="col-sm-3 control-label">案件情報</label>
    <div class="col-sm-9">　▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽
    </div>
  </div>
  <div class="form-group">
    <label for="pj_title" class="col-sm-3 control-label">タイトル（表示件名）</label>
    <div class="col-sm-9">
        {$entry_info.pj_title}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_genre01" class="col-sm-3 control-label">ジャンル</label>
    <div class="col-sm-9">
        {$options_genre_list[$entry_info.pj_genre01]}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_order_title" class="col-sm-3 control-label">案件：タイトル</label>
    <div class="col-sm-9">
        {$entry_info.pj_order_title}
        {form_hidden('pj_order_title', $entry_info.pj_order_title)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_work" class="col-sm-3 control-label">案件：概要</label>
    <div class="col-sm-9">
        {$entry_info.pj_work|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_notice" class="col-sm-3 control-label">案件：注意事項</label>
    <div class="col-sm-9">
        {$entry_info.pj_notice|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_example" class="col-sm-3 control-label">案件：例文</label>
    <div class="col-sm-9">
        {$entry_info.pj_example|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_other" class="col-sm-3 control-label">案件：その他</label>
    <div class="col-sm-9">
        {$entry_info.pj_other|nl2br}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_mm_rank_id" class="col-sm-3 control-label">会員ランク指定</label>
    <div class="col-sm-9">
        {$options_memrank_list[$entry_info.pj_mm_rank_id]} 以上
    </div>
  </div>
  <div class="form-group">
    <label for="pj_taa_difficulty_id" class="col-sm-3 control-label">難易度指定</label>
    <div class="col-sm-4">
        {$options_difficulty_id[$entry_info.pj_taa_difficulty_id]}　（加算単価={$options_tankaadd_list[$entry_info.pj_taa_difficulty_id]} 円）
    </div>
  </div>
  <div class="form-group">
    <label for="pj_word_tanka" class="col-sm-3 control-label">文字単価指定</label>
    <div class="col-sm-4">
        {$entry_info.pj_word_tanka} 円
    </div>
  </div>
  <div class="form-group">
    <label for="pj_delivery_time" class="col-sm-3 control-label">ライター投稿期限</label>
    <div class="col-sm-4">
        {$entry_info.pj_delivery_time}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_limit_time" class="col-sm-3 control-label">ライター投稿制限時間</label>
    <div class="col-sm-4">
        {$entry_info.pj_limit_time}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_start_time" class="col-sm-3 control-label">公開(募集)開始日時</label>
    <div class="col-sm-4">
        {$entry_info.pj_start_time}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_end_time" class="col-sm-3 control-label">公開(募集)終了日時</label>
    <div class="col-sm-4">
        {$entry_info.pj_end_time}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_en_id" class="col-sm-3 control-label">申請ID</label>
    <div class="col-sm-9">
        {$entry_info.pj_en_id}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_en_cl_id" class="col-sm-3 control-label">クライアントID</label>
    <div class="col-sm-9">
        {$entry_info.pj_en_cl_id}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_en_entry_date" class="col-sm-3 control-label">申請日</label>
    <div class="col-sm-9">
        {$entry_info.pj_en_entry_date}
    </div>
  </div>

  <div class="form-group">
    <label for="pj_addwork" class="col-sm-3 control-label">案件追加内容</label>
    <div class="col-sm-9">
      {if ($entry_info.pj_work_status <= 1) OR ($entry_info.pj_work_status >= 5)}
        {$attr['name'] = 'pj_addwork'}
        {$attr['rows'] = 5}
        {form_textarea($attr , set_value('pj_addwork', $entry_info.pj_addwork) , 'class="form-control" placeholder="追加内容を記入してください。"')}
        {if form_error('pj_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_addwork')}</font></label>{/if}
    {else}
        {$entry_info.pj_addwork|nl2br}
        {form_hidden('pj_addwork', $entry_info.pj_addwork)}
    {/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_comment" class="col-sm-3 control-label">メ　　モ</label>
    <div class="col-sm-9">
        {$attr['name'] = 'pj_comment'}
        {$attr['rows'] = 5}
        {form_textarea($attr , set_value('pj_comment', $entry_info.pj_comment) , 'class="form-control" placeholder=""')}
        {if form_error('pj_comment')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_comment')}</font></label>{/if}
    </div>
  </div>


  <br /><br />
  {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
  {if ($entry_info.pj_work_status <= 1) OR ($entry_info.pj_work_status >= 6)}
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-1">
            {$attr_sub['name']  = 'submit'}
            {$attr_sub['type']  = 'submit'}
            {$attr_sub['value'] = '_update'}
            {form_button($attr_sub , '更　　新' , $js)}
        </div>
      </div>
  {elseif ($entry_info.pj_work_status == 3)}
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-1">
            {$attr_sub['name']  = 'submit'}
            {$attr_sub['type']  = 'submit'}
            {$attr_sub['value'] = '_ok'}
            {form_button($attr_sub , '審査ＯＫ' , $js)}
        </div>
        <div class="col-sm-offset-1 col-sm-7">
            {$attr_sub['name']  = 'submit'}
            {$attr_sub['type']  = 'submit'}
            {$attr_sub['value'] = '_ng'}
            {form_button($attr_sub , '審査ＮＧ' , $js)}
        </div>
      </div>
  {elseif ($entry_info.pj_work_status == 4)}
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-1">
            {$attr_sub['name']  = 'submit'}
            {$attr_sub['type']  = 'submit'}
            {$attr_sub['value'] = '_deliver'}
            {form_button($attr_sub , '納　　品' , $js)}
        </div>
      </div>
  {/if}


{/if}




{if $not_disp == TRUE}設定情報はありません。
{else}

  {if $entry_no != '00'}
  {$num = $entry_no}
  {form_open('posting/data_entry/' , 'name="EntryorderForm" class="form-horizontal"')}
    <h3><span class="label label-primary">投稿記事　{$num}</span></h3>

    {form_hidden('entry_no', $num)}

    <div class="form-group">
      <label for="pji_pj_id" class="col-sm-3 control-label">案件 ID</label>
      <div class="col-sm-4">
            {$entry_info.pji_pj_id}
            {form_hidden('pji_pj_id', $entry_info.pji_pj_id)}
      </div>
    </div>

    <div class="form-group">
      <label for="pj_title" class="col-sm-3 control-label">投稿情報</label>
      <div class="col-sm-9">　▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽
      </div>
    </div>
    <div class="form-group">
      <label for="rep_title" class="col-sm-3 control-label">投稿記事：タイトル</label>
      <div class="col-sm-9">
      {if ($entry_info.pj_deliver_flg == 0) && ($entry_info.pj_work_status == 4)}
        {form_input('rep_title' , set_value('rep_title', $entry_info.rep_title) , 'class="form-control" placeholder="タイトルを入力してください"')}
        {if form_error('rep_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_title')}</font></label>{/if}
      {else}
        {$entry_info.rep_title|nl2br}
        {*form_hidden('rep_title', $entry_info.rep_title)*}
      {/if}
      </div>
    </div>
    <div class="form-group">
      <label for="rep_title_wordcount" class="col-sm-3 control-label">投稿記事：文字数</label>
      <div class="col-sm-9">
        {$entry_info.rep_title_wordcount}
        {*form_hidden('rep_title_wordcount', $entry_info.rep_title_wordcount)*}
      </div>
    </div>
    <div class="form-group">
      <label for="rep_text_body" class="col-sm-3 control-label">投稿記事：本文</label>
      <div class="col-sm-9">
      {if ($entry_info.pj_deliver_flg == 0) && ($entry_info.pj_work_status == 4)}
        {$attr['name'] = 'rep_text_body'}
        {$attr['rows'] = 10}
        {form_textarea($attr , set_value('rep_text_body', $entry_info.rep_text_body) , 'class="form-control" placeholder="本文を入力してください"')}
        {if form_error('rep_text_body')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_text_body')}</font></label>{/if}
      {else}
        {$entry_info.rep_text_body|nl2br}
        {*form_hidden('rep_text_body', $entry_info.rep_text_body)*}
      {/if}
      </div>
    </div>
    <div class="form-group">
      <label for="rep_body_wordcount" class="col-sm-3 control-label">投稿記事：文字数</label>
      <div class="col-sm-9">
        {$entry_info.rep_body_wordcount}
        {*form_hidden('rep_body_wordcount', $entry_info.rep_body_wordcount)*}
      </div>
    </div>

    <div class="form-group">
      <label for="pj_title" class="col-sm-3 control-label">案件情報</label>
      <div class="col-sm-9">　▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽
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
        {$entry_info.$t_keywd_num}
      </div>
    </div>
    <div class="form-group">
      <label for="rep_t_count_min0{$t_num}" class="col-sm-3 control-label">最低 使用回数</label>
      <div class="col-sm-3">
        {$entry_info.$t_count_min}
      </div>
      <label for="rep_t_count_max0{$t_num}" class="col-sm-3 control-label">最大 使用回数</label>
      <div class="col-sm-3">
        {$entry_info.$t_count_max}
      </div>
    </div>

    {/section}


    <div class="form-group">
      <label for="rep_t_char_min" class="col-sm-3 control-label">最低 使用文字数</label>
      <div class="col-sm-3">
        {$entry_info.rep_t_char_min}
      </div>
      <label for="rep_t_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
      <div class="col-sm-3">
        {$entry_info.rep_t_char_max}
      </div>
    </div>


    <hr color="red">

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
        {$entry_info.$b_keywd_num}
      </div>
    </div>
    <div class="form-group">
      <label for="rep_b_count_min0{$b_num}" class="col-sm-3 control-label">最低 使用回数</label>
      <div class="col-sm-3">
        {$entry_info.$b_count_min}
      </div>
      <label for="rep_b_count_max0{$b_num}" class="col-sm-3 control-label">最大 使用回数</label>
      <div class="col-sm-3">
        {$entry_info.$b_count_max}
      </div>
    </div>

    {/section}


    <div class="form-group">
      <label for="rep_b_char_min" class="col-sm-3 control-label">最低 使用文字数</label>
      <div class="col-sm-3">
        {$entry_info.rep_b_char_min}
      </div>
      <label for="rep_b_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
      <div class="col-sm-3">
        {$entry_info.rep_b_char_max}
      </div>
    </div>


    <div class="form-group">
      <label for="pji_work" class="col-sm-3 control-label">内容詳細</label>
      <div class="col-sm-9">
        {$entry_info.pji_work|nl2br}
      </div>
    </div>
    <div class="form-group">
      <label for="pji_notice" class="col-sm-3 control-label">注意事項</label>
      <div class="col-sm-9">
        {$entry_info.pji_notice|nl2br}
      </div>
    </div>
    <div class="form-group">
      <label for="pji_example" class="col-sm-3 control-label">例文</label>
      <div class="col-sm-9">
        {$entry_info.pji_example|nl2br}
      </div>
    </div>
    <div class="form-group">
      <label for="pji_other" class="col-sm-3 control-label">その他</label>
      <div class="col-sm-9">
        {$entry_info.pji_other|nl2br}
      </div>
    </div>

      <div class="form-group">
    <label for="pji_addwork" class="col-sm-3 control-label">案件追加内容</label>
    <div class="col-sm-9">
      {if ($entry_info.pj_work_status <= 1) OR ($entry_info.pj_work_status >= 5)}
        {$attr['name'] = 'pji_addwork'}
        {$attr['rows'] = 5}
        {form_textarea($attr , set_value('pji_addwork', $entry_info.pji_addwork) , 'class="form-control" placeholder="追加内容を記入してください。"')}
        {if form_error('pji_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pji_addwork')}</font></label>{/if}
    {else}
        {$entry_info.pji_addwork|nl2br}
        {form_hidden('pji_addwork', $entry_info.pji_addwork)}
    {/if}
    </div>
  </div>


  {if (($entry_info.pj_work_status <= 1) OR ($entry_info.pj_work_status == 4) OR ($entry_info.pj_work_status >= 6)) AND ($entry_info.pj_deliver_flg == 0)}
  <br /><br />
  {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-1">
        {$attr_sub['name']  = 'submit'}
        {$attr_sub['type']  = 'submit'}
        {$attr_sub['value'] = '_submit'}
        {form_button($attr_sub , '更　　新' , $js)}
    </div>
  </div>
  {/if}

  {/if}

  {form_close()}
  <!-- </form> -->

{/if}
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
