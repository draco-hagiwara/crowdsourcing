{* ヘッダー部分　START *}
	{include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>ライター情報　　<span class="label label-danger">更新</span></h3>
</div>

{form_open('/writerlist/detail/' , 'name="writerDetailForm" class="form-horizontal"')}
  <div class="form-group">
    <label for="wr_id" class="col-sm-3 control-label">ライターID</label>
    <div class="col-sm-4">
      {$writer_info.wr_id}
      {form_hidden('wr_id', $writer_info.wr_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_status" class="col-sm-3 control-label">ステータス (状態)</label>
    <div class="col-sm-4">
	  {form_dropdown('wr_status', $options_wr_status02, {$writer_info.wr_status})}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mm_rank_id" class="col-sm-3 control-label">会員ランク</label>
    <div class="col-sm-4">
	  {form_dropdown('wr_mm_rank_id', $options_wr_mm_rank_id, {$writer_info.wr_mm_rank_id})}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_name" class="col-sm-3 control-label">お名前</label>
    <div class="col-sm-4">
      {$writer_info.wr_name01} {$writer_info.wr_name02}
      {form_hidden('wr_name01', $writer_info.wr_name01)}
      {form_hidden('wr_name02', $writer_info.wr_name02)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_namekana" class="col-sm-3 control-label">お名前カナ（全角）</label>
    <div class="col-sm-4">
      {$writer_info.wr_namekana01} {$writer_info.wr_namekana02}
      {form_hidden('wr_namekana01', $writer_info.wr_namekana01)}
      {form_hidden('wr_namekana02', $writer_info.wr_namekana02)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_nickname" class="col-sm-3 control-label">ニックネーム</label>
    <div class="col-sm-8">
      {$writer_info.wr_nickname}
      {form_hidden('wr_nickname', $writer_info.wr_nickname)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_zip" class="col-sm-3 control-label">郵便番号</label>
    <div class="col-sm-2">
      {$writer_info.wr_zip01} - {$writer_info.wr_zip02}
      {form_hidden('wr_zip01', $writer_info.wr_zip01)}
      {form_hidden('wr_zip02', $writer_info.wr_zip02)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_pref" class="col-sm-3 control-label">都道府県</label>
    <div class="col-sm-2 btn-lg">
      {$pref_name}
      {form_hidden('wr_pref', $writer_info.wr_pref)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr01" class="col-sm-3 control-label">市区町村</label>
    <div class="col-sm-8">
      {$writer_info.wr_addr01}
      {form_hidden('wr_addr01', $writer_info.wr_addr01)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_addr02" class="col-sm-3 control-label">町名・番地</label>
    <div class="col-sm-8">
      {$writer_info.wr_addr02}
      {form_hidden('wr_addr02', $writer_info.wr_addr02)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_buil" class="col-sm-3 control-label">ビル・マンション名など</label>
    <div class="col-sm-8">
      {$writer_info.wr_buil}
      {form_hidden('wr_buil', $writer_info.wr_buil)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email" class="col-sm-3 control-label">メールアドレス（代表）<br>＆　ログインID</label>
    <div class="col-sm-8">
      {$writer_info.wr_email}
      {form_hidden('wr_email', $writer_info.wr_email)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_email_mobile" class="col-sm-3 control-label">携帯メールアドレス</label>
    <div class="col-sm-8">
      {$writer_info.wr_email_mobile}
      {form_hidden('wr_email_mobile', $writer_info.wr_email_mobile)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_tel" class="col-sm-3 control-label">電話番号</label>
    <div class="col-sm-8">
      {$writer_info.wr_tel}
      {form_hidden('wr_tel', $writer_info.wr_tel)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mobile" class="col-sm-3 control-label">携帯番号</label>
    <div class="col-sm-8">
      {$writer_info.wr_mobile}
      {form_hidden('wr_mobile', $writer_info.wr_mobile)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mailmaga_flg" class="col-sm-3 control-label">メルマガ配信希望</label>
    <div class="col-sm-8">
      {if $mailmaga_flg == TRUE}希望する{else}希望しない{/if}
      {form_hidden('wr_mailmaga_flg', $writer_info.wr_mailmaga_flg)}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {$attr02['name'] = 'submit'}
      {$attr02['type'] = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr02 , '更　　新' , 'class="btn btn-default"')}
    </div>
  </div>

{form_close()}
<!-- </form> -->


{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
