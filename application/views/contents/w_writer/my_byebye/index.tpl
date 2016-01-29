{* ヘッダー部分　START *}
{include file="../../header.tpl" head_index="1"}

<script src="{base_url()}../js/my/cnfmandsubmit.js"></script>

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>会員登録解除　　<span class="label label-success">退　会</span></h3>
</div>

{form_open('my_byebye/complete/' , 'name="EntrywriterForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="wr_id" class="col-sm-2 control-label">ライターID</label>
    <div class="col-sm-2">
      {$writer_info.wr_id}
      {form_hidden('wr_id', $writer_info.wr_id)}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_status" class="col-sm-2 control-label">ステータス (状態)</label>
    <div class="col-sm-2">
      {$options_wr_status02[$writer_info.wr_status]}
    </div>
  </div>
  <div class="form-group">
    <label for="wr_mm_rank_id" class="col-sm-2 control-label">会員ランク</label>
    <div class="col-sm-2">
      {$options_wr_mm_rank_id[$writer_info.wr_mm_rank_id]}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <p>登録を解除すると確定前のポイントおよび付与されていないポイントは無効になります。</p>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {$js = 'class="btn btn-default" onClick="return orderSubmit()"'}
      {$attr['name'] = 'submit'}
      {$attr['type'] = 'submit'}
      {$attr['value'] = '_submit'}
      {form_button($attr , '上記確認し、登録を解除する' , $js)}
    </div>
  </div>

{form_close()}
<!-- </form> -->


{* フッター部分　START *}
    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

{include file="../../footer.tpl"}
{* フッター部分　END *}

</body>
</html>
