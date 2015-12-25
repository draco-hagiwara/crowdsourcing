{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}



<script src="{base_url()}../js/word_copy.js"></script>
<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>







<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>案件情報　　<span class="label label-success">確　認</span></h3>
</div>





<ul class="nav nav-tabs">
  {if $entry_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/orderlist/detail00">案件内容</a></li>
  {if $entry_info.pj_deliver_flg == TRUE}
    {if $entry_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/orderlist/detail01/">納品記事１</a></li>
    {if $job_cnt == 2}
      {if $entry_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/orderlist/detail02/">納品記事２</a></li>
    {/if}
    {if $job_cnt == 3}
      {if $entry_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/orderlist/detail02/">納品記事２</a></li>
      {if $entry_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/client/orderlist/detail03/">納品記事３</a></li>
    {/if}
  {/if}
</ul>


<div class="jumbotron">
{if $entry_no == '00'}
{form_open('orderlist/output_csv/' , 'name="datacsvForm" class="form-horizontal"')}

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
      {$options_pj_status[$entry_info.pj_status]}
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
    <label for="pj_addwork" class="col-sm-3 control-label">案件追加内容</label>
    <div class="col-sm-9">
        {$entry_info.pj_addwork|nl2br}
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
        {$options_difficulty_id[$entry_info.pj_taa_difficulty_id]}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_word_tanka" class="col-sm-3 control-label">文字単価指定</label>
    <div class="col-sm-4">
        {$entry_info.pj_word_tanka} 円
    </div>
  </div>
  <div class="form-group">
    <label for="pj_start_time" class="col-sm-3 control-label">公開(募集)開始日時</label>
    <div class="col-sm-4">
        {$entry_info.pj_start_time|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_end_time" class="col-sm-3 control-label">公開(募集)終了日時</label>
    <div class="col-sm-4">
        {$entry_info.pj_end_time|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_en_id" class="col-sm-3 control-label">申請ID</label>
    <div class="col-sm-9">
        {$entry_info.pj_en_id}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_en_entry_date" class="col-sm-3 control-label">申請日</label>
    <div class="col-sm-9">
        {$entry_info.pj_en_entry_date|date_format:"%Y年%m月%d日"}
    </div>
  </div>

  <div class="form-group">
    <label for="wi_word_tanka" class="col-sm-3 control-label">文字単価</label>
    <div class="col-sm-4">
        {$entry_info.wi_word_tanka}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_word_count" class="col-sm-3 control-label">文字数</label>
    <div class="col-sm-4">
        {$entry_info.wi_word_count}
    </div>
  </div>
  <div class="form-group">
    <label for="wi_point" class="col-sm-3 control-label">ポイント数</label>
    <div class="col-sm-4">
        {$entry_info.wi_point}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_delivery_date" class="col-sm-3 control-label">原稿納品日</label>
    <div class="col-sm-4">
        {$entry_info.pj_delivery_date|date_format:"%Y年%m月%d日 %H時%M分"}
    </div>
  </div>



  <br /><br />
  {$js = 'class="btn btn-default" onClick="return cnfmAndSubmit()"'}
  {if $entry_info.pj_deliver_flg == TRUE}
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-1">
            {$attr_sub['name']  = 'submit'}
            {$attr_sub['type']  = 'submit'}
            {$attr_sub['value'] = '_submit'}
            {form_button($attr_sub , 'CSV 出力' , $js)}
        </div>
      </div>
  {/if}


{/if}




{if $not_disp == TRUE}設定情報はありません。
{else}

  {if $entry_no != '00'}
  {$num = $entry_no}
  {form_open('orderlist/select_copy/' , 'name="EntryorderForm" class="form-horizontal"')}
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
        {form_input('rep_title' , set_value('rep_title', $entry_info.rep_title) , 'id="rep_title" class="form-control" placeholder="タイトルを入力してください", id="rep_title"')}
        {if form_error('rep_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_title')}</font></label>{/if}
        <br>{*<button class="cut btn01">カット</button>*}<button class="copy btn01">コピー</button>　※ブラウザによって動かないかも！
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
        {$attr['name'] = 'rep_text_body'}
        {$attr['rows'] = 10}
        {form_textarea($attr , set_value('rep_text_body', $entry_info.rep_text_body) , 'id="rep_text_body" class="form-control" placeholder="本文を入力してください"')}
        {if form_error('rep_text_body')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_text_body')}</font></label>{/if}
        <br>{*<button class="cut btn02">カット</button>*}<button class="copy btn02">コピー</button>　※ブラウザによって動かないかも！
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
        {$entry_info.pji_addwork}
        {form_hidden('pji_addwork', $entry_info.pji_addwork)}
    {/if}
    </div>
  </div>


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
