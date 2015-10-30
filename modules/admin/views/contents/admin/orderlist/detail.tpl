{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>案件情報　　<span class="label label-success">案件　更新＆登録</span></h3>
</div>





<ul class="nav nav-tabs">
  {if $order_no == '00'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/orderlist/detail00">案件内容【必須】</a></li>
  {if $order_no == '01'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/orderlist/detail01/">案件詳細１</a></li>
  {if $order_no == '02'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/orderlist/detail02/">案件詳細２</a></li>
  {if $order_no == '03'}<li role="presentation" class="active">{else}<li role="presentation">{/if}<a href="/admin/orderlist/detail03/">案件詳細３</a></li>
</ul>


<div class="jumbotron">
{if $order_no == '00'}
{form_open('orderlist/data_order/' , 'name="OrderForm" class="form-horizontal"')}

  {form_hidden('order_no', '00')}

  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">案件 ID</label>
    <div class="col-sm-4">
          {$order_info.pj_id}
          {form_hidden('pj_id', $order_info.pj_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_status" class="col-sm-3 control-label">ステータス (状態)<font color=red>【必須】</font></label>
    <div class="col-sm-4">
          {form_dropdown('pj_status', $options_pj_status, {$order_info.pj_status})}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_order_title" class="col-sm-3 control-label">タイトル（表示件名）<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {form_input('pj_order_title' , set_value('pj_order_title', $order_info.pj_order_title) , 'class="form-control" placeholder="タイトル（表示件名）を入力してください"')}
      {if form_error('pj_order_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_order_title')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_genre01" class="col-sm-3 control-label">希望ジャンル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
          {form_dropdown('pj_genre01', $options_genre_list, set_value('pj_genre01', $order_info.pj_genre01))}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_title" class="col-sm-3 control-label">案件：タイトル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {form_input('pj_title' , set_value('pj_title', $order_info.pj_title) , 'class="form-control" placeholder="案件申請：タイトルを入力してください"')}
      {if form_error('pj_title')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_title')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_work" class="col-sm-3 control-label">案件：概要<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {$attr['name'] = 'pj_work'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pj_work', $order_info.pj_work) , 'class="form-control" placeholder="案件申請：内容を入力してください"')}
      {if form_error('pj_work')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_work')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_notice" class="col-sm-3 control-label">案件：注意事項</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pj_notice'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pj_notice', $order_info.pj_notice) , 'class="form-control" placeholder="案件申請：注意事項を入力してください"')}
      {if form_error('pj_notice')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_notice')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_example" class="col-sm-3 control-label">案件：例文</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pj_example'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pj_example', $order_info.pj_example) , 'class="form-control" placeholder="案件申請：例文を入力してください"')}
      {if form_error('pj_example')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_example')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_other" class="col-sm-3 control-label">案件：その他</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pj_other'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pj_other', $order_info.pj_other) , 'class="form-control" placeholder="案件申請：その他を入力してください"')}
      {if form_error('pj_other')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_other')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_addwork" class="col-sm-3 control-label">案件：追加内容</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pj_addwork'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pj_addwork', $order_info.pj_addwork) , 'class="form-control" placeholder="「日付」+「追加内容」で分かりやすく入力してください"')}
      {if form_error('pj_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_addwork')}</font></label>{/if}
    </div>
  </div>

  <div class="form-group">
    <label for="pj_mm_rank_id" class="col-sm-3 control-label">会員ランク指定</label>
    <div class="col-sm-9">
          {form_dropdown('pj_mm_rank_id', $options_pj_mm_rank_id, {$order_info.pj_mm_rank_id})}
          <br />指定ランク以上のライターが投稿対象となります。ブロンズ < シルバー < ゴールド。
          <br />現行設定値：：{$tanka_info}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_word_tanka" class="col-sm-3 control-label">文字単価指定</label>
    <div class="col-sm-4">
      {form_input('pj_word_tanka' , set_value('pj_word_tanka', $order_info.pj_word_tanka) , 'class="form-control" placeholder="個別文字単価指定を入力してください"')}
      各ランク一律での報酬単価となります。
      {if form_error('pj_word_tanka')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_word_tanka')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_taa_difficulty_id" class="col-sm-3 control-label">難易度(単価加算)指定</label>
    <div class="col-sm-4">
          {form_dropdown('pj_taa_difficulty_id', $options_pj_taa_difficulty_id, {$order_info.pj_taa_difficulty_id})}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_wr_measure" class="col-sm-3 control-label">会員評価指定</label>
    <div class="col-sm-4">未実装
    </div>
  </div>
  <div class="form-group">
    <label for="pj_people_count" class="col-sm-3 control-label">募集人数</label>
    <div class="col-sm-4">未実装
    </div>
  </div>
  <div class="form-group">
    <label for="pj_wr_id" class="col-sm-3 control-label">ライター指名</label>
    <div class="col-sm-4">未実装
    </div>
  </div>
  <div class="form-group">
    <label for="pj_working_flg" class="col-sm-3 control-label">在宅有無</label>
    <div class="col-sm-4">未実装
    </div>
  </div>
  <div class="form-group">
    <label for="pj_event_id" class="col-sm-3 control-label">イベント指定</label>
    <div class="col-sm-4">
          {form_dropdown('pj_event_id', $options_pj_event_id, {$order_info.pj_event_id})}
    </div>
  </div>

  <div class="form-group">
    <label for="pj_delivery_time" class="col-sm-3 control-label">ライター投稿納期<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('pj_delivery_time' , set_value('pj_delivery_time', $order_info.pj_delivery_time) , 'class="form-control" placeholder="「20xx-xx-xx HH:MM」の形式で入力してください"')}
      「20xx-xx-xx HH:MM」の形式。<br>
      {if form_error('pj_delivery_time')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_delivery_time')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_limit_time" class="col-sm-3 control-label">ライター投稿制限時間<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('pj_limit_time' , set_value('pj_limit_time', $order_info.pj_limit_time) , 'class="form-control" placeholder="「MM」(分)の形式で入力してください"')}
      「分」指定。<br>
      {if form_error('pj_limit_time')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_limit_time')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_start_time" class="col-sm-3 control-label">公開(募集)開始日時<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('pj_start_time' , set_value('pj_start_time', $order_info.pj_start_time) , 'class="form-control" placeholder="「20xx-xx-xx HH:MM」の形式で入力してください"')}
      「20xx-xx-xx HH:MM」の形式。<br>
      {if form_error('pj_start_time')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_start_time')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_end_time" class="col-sm-3 control-label">公開(募集)終了日時<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      {form_input('pj_end_time' , set_value('pj_end_time', $order_info.pj_end_time) , 'class="form-control" placeholder="「20xx-xx-xx HH:MM」の形式で入力してください"')}
      「20xx-xx-xx HH:MM」の形式。<br>
      {if form_error('pj_end_time')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_end_time')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pj_comment" class="col-sm-3 control-label">備考</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pj_comment'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pj_comment', $order_info.pj_comment) , 'class="form-control"')}
      {if form_error('pj_comment')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pj_comment')}</font></label>{/if}
    </div>
  </div>

{/if}

{if $not_disp == TRUE}設定情報はありません。
{else}

{if $order_no != '00'}
{$num = $order_no}
{form_open('orderlist/data_order/' , 'name="OrderForm" class="form-horizontal"')}
  <h3><span class="label label-primary">案件設定　{$num}</span></h3>

  {form_hidden('order_no', $num)}

  <div class="form-group">
    <label for="pji_pj_id" class="col-sm-3 control-label">案件 ID</label>
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
      {form_input($t_keywd_num , set_value($t_keywd_num , $order_info.$t_keywd_num) , 'class="form-control" placeholder="タイトルに使用するキーワードを指定してください。100文字以内。"')}
      {if form_error($t_keywd_num)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_keywd_num)}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="rep_t_count_min0{$t_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {form_input($t_count_min , set_value($t_count_min , $order_info.$t_count_min) , 'class="form-control" placeholder="最低 使用回数"')}
      {if form_error($t_count_min)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_count_min)}</font></label>{/if}
    </div>
    <label for="rep_t_count_max0{$t_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {form_input($t_count_max , set_value($t_count_max , $order_info.$t_count_max) , 'class="form-control" placeholder="最大 使用回数"')}
      {if form_error($t_count_max)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($t_count_max)}</font></label>{/if}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="rep_t_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('rep_t_char_min' , set_value('rep_t_char_min' , $order_info.rep_t_char_min) , 'class="form-control" placeholder="最低 使用文字数"')}
      {if form_error('rep_t_char_min')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_t_char_min')}</font></label>{/if}
    </div>
    <label for="rep_t_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('rep_t_char_max' , set_value('rep_t_char_max' , $order_info.rep_t_char_max) , 'class="form-control" placeholder="最大 使用文字数"')}
      {if form_error('rep_t_char_max')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_t_char_max')}</font></label>{/if}
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
      {form_input($b_keywd_num , set_value($b_keywd_num , $order_info.$b_keywd_num) , 'class="form-control" placeholder="本文に使用するキーワードを指定してください。100文字以内。"')}
      {if form_error($b_keywd_num)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_keywd_num)}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="rep_b_count_min0{$b_num}" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      {form_input($b_count_min , set_value($b_count_min , $order_info.$b_count_min) , 'class="form-control" placeholder="最低 使用回数"')}
      {if form_error($b_count_min)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_count_min)}</font></label>{/if}
    </div>
    <label for="rep_b_count_max0{$b_num}" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      {form_input($b_count_max , set_value($b_count_max , $order_info.$b_count_max) , 'class="form-control" placeholder="最大 使用回数"')}
      {if form_error($b_count_max)}<span class="label label-danger">Error : </span><label><font color=red>{form_error($b_count_max)}</font></label>{/if}
    </div>
  </div>

  {/section}


  <div class="form-group">
    <label for="rep_b_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('rep_b_char_min' , set_value('rep_b_char_min' , $order_info.rep_b_char_min) , 'class="form-control" placeholder="最低 使用文字数"')}
      {if form_error('rep_b_char_min')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_b_char_min')}</font></label>{/if}
    </div>
    <label for="rep_b_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      {form_input('rep_b_char_max' , set_value('rep_b_char_max' , $order_info.rep_b_char_max) , 'class="form-control" placeholder="最大 使用文字数"')}
      {if form_error('rep_b_char_max')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('rep_b_char_max')}</font></label>{/if}
    </div>
  </div>


  <div class="form-group">
    <label for="pji_work" class="col-sm-3 control-label">個別案件：内容詳細<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      {$attr['name'] = 'pji_work'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pji_work', $order_info.pji_work) , 'class="form-control" placeholder="個別案件：内容を入力してください"')}
      {if form_error('pji_work')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pji_work')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_notice" class="col-sm-3 control-label">個別案件：注意事項</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pji_notice'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pji_notice', $order_info.pji_notice) , 'class="form-control" placeholder="個別案件：注意事項を入力してください"')}
      {if form_error('pji_notice')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pji_notice')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_example" class="col-sm-3 control-label">個別案件：例文</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pji_example'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pji_example', $order_info.pji_example) , 'class="form-control" placeholder="個別案件：例文を入力してください"')}
      {if form_error('pji_example')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pji_example')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_other" class="col-sm-3 control-label">個別案件：その他</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pji_other'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pji_other', $order_info.pji_other) , 'class="form-control" placeholder="個別案件：その他を入力してください"')}
      {if form_error('pji_other')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pji_other')}</font></label>{/if}
    </div>
  </div>
  <div class="form-group">
    <label for="pji_addwork" class="col-sm-3 control-label">個別案件：追加内容</label>
    <div class="col-sm-9">
      {$attr['name'] = 'pji_addwork'}
      {$attr['rows'] = 5}
      {form_textarea($attr , set_value('pji_addwork', $order_info.pji_addwork) , 'class="form-control" placeholder="個別案件：追加内容を入力してください"')}
      {if form_error('pji_addwork')}<span class="label label-danger">Error : </span><label><font color=red>{form_error('pji_addwork')}</font></label>{/if}
    </div>
  </div>

{/if}

  <br /><br />
      {$js = 'class="btn btn-default" onClick="return orderSubmit()"'}
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      {$attr_sub['name']  = 'submit'}
      {$attr_sub['type']  = 'submit'}
      {$attr_new['value'] = '_submit'}
      {form_button($attr_sub , '更　　新' , $js)}
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
