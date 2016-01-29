{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandcsvup.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>CSVデータ　アップロード</h3>
</div>

{form_open_multipart('/pay_csvup/cldetail_chk/' , 'name="datachkForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="cl_detail" class="col-sm-4 control-label">【クライアント：請求明細アップ】</label>
    <div class="col-sm-8">
      {form_upload('cl_detail', '')}
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
    ・クライアント[調整ポイント]/[領収(支払)金額]/[納品日]/[請求(支払)予定日]/[領収(支払)日]のみの更新としています。
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
      {$js = 'class="btn btn-default" onClick="return cnfmAndcsvup()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_cldetail'}
      {form_button($attr , 'CSV アップロード' , $js)}
      <br>{$up_mess01}
    </div>
  </div>

{form_close()}

<HR>

{form_open_multipart('/pay_csvup/cllist_chk/' , 'name="datachkForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="cl_list" class="col-sm-4 control-label">【クライアント：月次請求アップ】</label>
    <div class="col-sm-8">
      {form_upload('cl_list', '')}
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
    ・クライアント[支払情報ID]が""(空)の場合、新規データ作成。指定時はデータ更新。<br>
    ・金額欄は、"0"を入力してください。
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
      {$js = 'class="btn btn-default" onClick="return cnfmAndcsvup()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_cllist'}
      {form_button($attr , 'CSV アップロード' , $js)}
      <br>{$up_mess02}
    </div>
  </div>

{form_close()}

<HR>

{form_open_multipart('/pay_csvup/wrdetail_chk/' , 'name="datachkForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="cl_list" class="col-sm-4 control-label">【ライター：入金明細アップ】</label>
    <div class="col-sm-8">
      {form_upload('wr_detail', '')}
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
    ・ライター[入金状況]/[調整ポイント]/[入金金額]/[入金予定日]/[入金日]のみの更新としています。
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
      {$js = 'class="btn btn-default" onClick="return cnfmAndcsvup()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_wrdetail'}
      {form_button($attr , 'CSV アップロード' , $js)}
      <br>{$up_mess03}
    </div>
  </div>

{form_close()}

<HR>

{form_open_multipart('/pay_csvup/wrlist_chk/' , 'name="datachkForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="cl_list" class="col-sm-4 control-label">【ライター：締日入金アップ】</label>
    <div class="col-sm-8">
      {form_upload('wr_list', '')}
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
    ・ライター[支払情報ID]が""(空)の場合、新規データ作成。指定時はデータ更新。<br>
    ・金額欄は、"0"を入力してください。
    </div>
  </div>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-8">
      {$js = 'class="btn btn-default" onClick="return cnfmAndcsvup()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_wrlist'}
      {form_button($attr , 'CSV アップロード' , $js)}
      <br>{$up_mess04}
    </div>
  </div>

{form_close()}

<HR>

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
