{* ヘッダー部分　START *}
    {include file="../../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>仕事情報</h3>
</div>





<ul class="nav nav-tabs">
  {if $order_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/search_list/detail00">仕事概要</a></li>
  {if $order_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/search_list/detail01/">記事詳細１</a></li>
  {if $job_cnt == 2}
    {if $order_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/search_list/detail02/">記事詳細２</a></li>
  {/if}
  {if $job_cnt == 3}
    {if $order_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/search_list/detail02/">記事詳細２</a></li>
    {if $order_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/writer/search_list/detail03/">記事詳細３</a></li>
  {/if}
</ul>

<div class="jumbotron">
{if $order_no == '00'}
{form_open('search_list/data_entry/' , 'name="SearchlistForm" class="form-horizontal"')}

  {form_hidden('order_no', '00')}
  <label><font color=red>{$result_mess}</font></label>

  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">仕事 ID</label>
    <div class="col-sm-4">
          {$order_info.pj_id}
          {form_hidden('pj_id', $order_info.pj_id)}
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
    <label for="wi_word_tanka" class="col-sm-3 control-label">文字単価</label>
    <div class="col-sm-4">
      {$writer_tanka}
      {form_hidden('wi_word_tanka', $writer_tanka)}
    </div>
  </div>


  <div class="form-group">
    <label for="pj_mm_rank_id" class="col-sm-3 control-label">【確認用表示→　　会員ランク指定</label>
    <div class="col-sm-9">
          {form_dropdown('pj_mm_rank_id', $options_pj_mm_rank_id, {$order_info.pj_mm_rank_id})}
          <br />指定ランク以上のライターが投稿対象となります。ブロンズ < シルバー < ゴールド。
          <br />現行設定値：：{$tanka_info}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_word_tanka" class="col-sm-3 control-label">文字単価指定　　】</label>
    <div class="col-sm-4">
      {form_input('pj_word_tanka' , set_value('pj_word_tanka', $order_info.pj_word_tanka) , 'class="form-control" placeholder="個別文字単価指定を入力してください"')}
      各ランク一律での報酬単価となります。
      {if form_error('pj_word_tanka')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_word_tanka')}</font></label>{/if}
    </div>
  </div>


      {form_hidden('pj_mm_rank_id', $order_info.pj_mm_rank_id)}
      {form_hidden('pj_char_cnt', $order_info.pj_char_cnt)}

  <div class="form-group">
    <label for="pj_taa_difficulty_id" class="col-sm-3 control-label">難易度</label>
    <div class="col-sm-4">
      {$options_pj_taa_difficulty_id[$order_info.pj_taa_difficulty_id]}
      {form_hidden('pj_taa_difficulty_id', $order_info.pj_taa_difficulty_id)}
      <br>【現行設定値：：{$diff_tanka0} / {$diff_tanka1} / {$diff_tanka2}】
    </div>
  </div>

  <div class="form-group">
    <label for="pj_limit_time" class="col-sm-3 control-label">原稿制作時間</label>
    <div class="col-sm-4">
      {$order_info.pj_limit_time}
      {form_hidden('pj_limit_time', $order_info.pj_limit_time)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_start_time" class="col-sm-3 control-label">公開(募集)開始日時</label>
    <div class="col-sm-4">
      {$order_info.pj_start_time}
      {form_hidden('pj_start_time', $order_info.pj_start_time)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_end_time" class="col-sm-3 control-label">公開(募集)終了日時</label>
    <div class="col-sm-4">
      {$order_info.pj_end_time}
      {form_hidden('pj_end_time', $order_info.pj_end_time)}
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

  <br /><br />
      {$js = 'class="btn btn-default" onClick="return orderSubmit()"'}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-2">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_submit'}
      {form_button($attr_sub , 'エントリーする' , $js)}
    </div>
    <div class="col-sm-offset-1 col-sm-6">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_sub['value'] = '_fav'}
      {form_button($attr_sub , '「気になるリスト」へ追加する' , $js)}
    </div>
  </div>

{form_close()}

{/if}

{if $not_disp == TRUE}設定情報はありません。
{else}

{if $order_no != '00'}
{$num = $order_no}
{form_open('search_list/data_order/' , 'name="OrderForm" class="form-horizontal"')}

  {form_hidden('order_no', $num)}

  <div class="form-group">
    <label for="pji_pj_id" class="col-sm-3 control-label">仕事 ID</label>
    <div class="col-sm-4">
          {$order_info.pji_pj_id}
          {form_hidden('pji_pj_id', $order_info.pji_pj_id)}
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
      {$order_info.rep_t_char_min}
    </div>
    <label for="rep_t_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      {$order_info.rep_t_char_max}
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
      {$order_info.rep_b_char_min}
    </div>
    <label for="rep_b_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      {$order_info.rep_b_char_max}
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
