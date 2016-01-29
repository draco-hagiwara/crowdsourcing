{* ヘッダー部分　START *}
    {include file="../header.tpl" head_index="1"}

<body>
{* ヘッダー部分　END *}

<div class="jumbotron">
  <h3>契 約 情 報</span></h3>
</div>

{form_open('cl_contract/complete/' , 'name="infoForm" class="form-horizontal"')}

  <div class="form-group">
    <label for="cl_id" class="col-sm-2 control-label">お客様ID</label>
    <div class="col-sm-2">
      {$client_info.ci_cl_id}
    </div>
    <div class="col-sm-offset-8"></div>
  </div>
  <div class="form-group">
    <label for="ci_contract_id" class="col-sm-2 control-label">ご契約形態</label>
    <div class="col-sm-2">
      {$options_contractid[$client_info.ci_contract_id]}
    </div>
    <div class="col-sm-offset-8"></div>
  </div>
  <div class="form-group">
    <label for="ci_contract_fix" class="col-sm-2 control-label">月額固定料金</label>
    <div class="col-sm-2">
      {$client_info.ci_contract_fix|number_format} 円
    </div>
    <div class="col-sm-offset-8"></div>
  </div>
  <div class="form-group">
    <label for="ci_contract_result" class="col-sm-2 control-label">成果報酬手数料率</label>
    <div class="col-sm-2">
      {$client_info.ci_contract_result}
    </div>
    <div class="col-sm-offset-8"></div>
  </div>
  <div class="form-group">
    <label for="ci_contract_adjust" class="col-sm-2 control-label">調整金額</label>
    <div class="col-sm-2">
      {$client_info.ci_contract_adjust|number_format} 円
    </div>
    <div class="col-sm-offset-8"></div>
  </div>
  <div class="form-group">
    <label for="ci_contract_st" class="col-sm-2 control-label">契約開始年月日</label>
    <div class="col-sm-2">
      {$client_info.ci_contract_st|date_format:"%Y年%m月%d日"}
    </div>
    <div class="col-sm-offset-8"></div>
  </div>
  <div class="form-group">
    <label for="ci_contract_end" class="col-sm-2 control-label">契約終了年月日</label>
    <div class="col-sm-2">
      {$client_info.ci_contract_end|date_format:"%Y年%m月%d日"}
    </div>
    <div class="col-sm-offset-8"></div>
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
