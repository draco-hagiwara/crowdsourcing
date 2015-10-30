<?php /* Smarty version 3.1.27, created on 2015-10-30 09:51:48
         compiled from "/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/orderlist/detail.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:13048823655632bf24597971_58972921%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd7a7745173b9c471a7d498e02cbcae9099d74be' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/orderlist/detail.tpl',
      1 => 1446166298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13048823655632bf24597971_58972921',
  'variables' => 
  array (
    'order_no' => 0,
    'order_info' => 0,
    'options_pj_status' => 0,
    'options_genre_list' => 0,
    'attr' => 0,
    'options_pj_mm_rank_id' => 0,
    'tanka_info' => 0,
    'options_pj_taa_difficulty_id' => 0,
    'options_pj_event_id' => 0,
    'not_disp' => 0,
    'num' => 0,
    't_num' => 0,
    't_keywd_num' => 0,
    't_count_min' => 0,
    't_count_max' => 0,
    'b_num' => 0,
    'b_keywd_num' => 0,
    'b_count_min' => 0,
    'b_count_max' => 0,
    'attr_sub' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5632bf247538e0_59307939',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5632bf247538e0_59307939')) {
function content_5632bf247538e0_59307939 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '13048823655632bf24597971_58972921';
?>

    <?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/my/cnfmandsubmit.js"><?php echo '</script'; ?>
>

<body>


<div class="jumbotron">
  <h3>案件情報　　<span class="label label-success">案件　更新＆登録</span></h3>
</div>





<ul class="nav nav-tabs">
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '00') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/orderlist/detail00">案件内容【必須】</a></li>
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '01') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/orderlist/detail01/">案件詳細１</a></li>
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '02') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/orderlist/detail02/">案件詳細２</a></li>
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '03') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/orderlist/detail03/">案件詳細３</a></li>
</ul>


<div class="jumbotron">
<?php if ($_smarty_tpl->tpl_vars['order_no']->value == '00') {?>
<?php echo form_open('orderlist/data_order/','name="OrderForm" class="form-horizontal"');?>


  <?php echo form_hidden('order_no','00');?>


  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">案件 ID</label>
    <div class="col-sm-4">
          <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pj_id'];?>

          <?php echo form_hidden('pj_id',$_smarty_tpl->tpl_vars['order_info']->value['pj_id']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_status" class="col-sm-3 control-label">ステータス (状態)<font color=red>【必須】</font></label>
    <div class="col-sm-4">
          <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_info']->value['pj_status'];
$_tmp1=ob_get_clean();
echo form_dropdown('pj_status',$_smarty_tpl->tpl_vars['options_pj_status']->value,$_tmp1);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_order_title" class="col-sm-3 control-label">タイトル（表示件名）<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php echo form_input('pj_order_title',set_value('pj_order_title',$_smarty_tpl->tpl_vars['order_info']->value['pj_order_title']),'class="form-control" placeholder="タイトル（表示件名）を入力してください"');?>

      <?php if (form_error('pj_order_title')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_order_title');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_genre01" class="col-sm-3 control-label">希望ジャンル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
          <?php echo form_dropdown('pj_genre01',$_smarty_tpl->tpl_vars['options_genre_list']->value,set_value('pj_genre01',$_smarty_tpl->tpl_vars['order_info']->value['pj_genre01']));?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_title" class="col-sm-3 control-label">案件：タイトル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php echo form_input('pj_title',set_value('pj_title',$_smarty_tpl->tpl_vars['order_info']->value['pj_title']),'class="form-control" placeholder="案件申請：タイトルを入力してください"');?>

      <?php if (form_error('pj_title')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_title');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_work" class="col-sm-3 control-label">案件：概要<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pj_work';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pj_work',$_smarty_tpl->tpl_vars['order_info']->value['pj_work']),'class="form-control" placeholder="案件申請：内容を入力してください"');?>

      <?php if (form_error('pj_work')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_work');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_notice" class="col-sm-3 control-label">案件：注意事項</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pj_notice';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pj_notice',$_smarty_tpl->tpl_vars['order_info']->value['pj_notice']),'class="form-control" placeholder="案件申請：注意事項を入力してください"');?>

      <?php if (form_error('pj_notice')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_notice');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_example" class="col-sm-3 control-label">案件：例文</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pj_example';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pj_example',$_smarty_tpl->tpl_vars['order_info']->value['pj_example']),'class="form-control" placeholder="案件申請：例文を入力してください"');?>

      <?php if (form_error('pj_example')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_example');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_other" class="col-sm-3 control-label">案件：その他</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pj_other';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pj_other',$_smarty_tpl->tpl_vars['order_info']->value['pj_other']),'class="form-control" placeholder="案件申請：その他を入力してください"');?>

      <?php if (form_error('pj_other')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_other');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_addwork" class="col-sm-3 control-label">案件：追加内容</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pj_addwork';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pj_addwork',$_smarty_tpl->tpl_vars['order_info']->value['pj_addwork']),'class="form-control" placeholder="「日付」+「追加内容」で分かりやすく入力してください"');?>

      <?php if (form_error('pj_addwork')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_addwork');?>
</font></label><?php }?>
    </div>
  </div>

  <div class="form-group">
    <label for="pj_mm_rank_id" class="col-sm-3 control-label">会員ランク指定</label>
    <div class="col-sm-9">
          <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_info']->value['pj_mm_rank_id'];
$_tmp2=ob_get_clean();
echo form_dropdown('pj_mm_rank_id',$_smarty_tpl->tpl_vars['options_pj_mm_rank_id']->value,$_tmp2);?>

          <br />指定ランク以上のライターが投稿対象となります。ブロンズ < シルバー < ゴールド。
          <br />現行設定値：：<?php echo $_smarty_tpl->tpl_vars['tanka_info']->value;?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_word_tanka" class="col-sm-3 control-label">文字単価指定</label>
    <div class="col-sm-4">
      <?php echo form_input('pj_word_tanka',set_value('pj_word_tanka',$_smarty_tpl->tpl_vars['order_info']->value['pj_word_tanka']),'class="form-control" placeholder="個別文字単価指定を入力してください"');?>

      各ランク一律での報酬単価となります。
      <?php if (form_error('pj_word_tanka')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_word_tanka');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_taa_difficulty_id" class="col-sm-3 control-label">難易度(単価加算)指定</label>
    <div class="col-sm-4">
          <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_info']->value['pj_taa_difficulty_id'];
$_tmp3=ob_get_clean();
echo form_dropdown('pj_taa_difficulty_id',$_smarty_tpl->tpl_vars['options_pj_taa_difficulty_id']->value,$_tmp3);?>

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
          <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_info']->value['pj_event_id'];
$_tmp4=ob_get_clean();
echo form_dropdown('pj_event_id',$_smarty_tpl->tpl_vars['options_pj_event_id']->value,$_tmp4);?>

    </div>
  </div>

  <div class="form-group">
    <label for="pj_delivery_time" class="col-sm-3 control-label">ライター投稿納期<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('pj_delivery_time',set_value('pj_delivery_time',$_smarty_tpl->tpl_vars['order_info']->value['pj_delivery_time']),'class="form-control" placeholder="「20xx-xx-xx HH:MM」の形式で入力してください"');?>

      「20xx-xx-xx HH:MM」の形式。<br>
      <?php if (form_error('pj_delivery_time')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_delivery_time');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_limit_time" class="col-sm-3 control-label">ライター投稿制限時間<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('pj_limit_time',set_value('pj_limit_time',$_smarty_tpl->tpl_vars['order_info']->value['pj_limit_time']),'class="form-control" placeholder="「MM」(分)の形式で入力してください"');?>

      「分」指定。<br>
      <?php if (form_error('pj_limit_time')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_limit_time');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_start_time" class="col-sm-3 control-label">公開(募集)開始日時<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('pj_start_time',set_value('pj_start_time',$_smarty_tpl->tpl_vars['order_info']->value['pj_start_time']),'class="form-control" placeholder="「20xx-xx-xx HH:MM」の形式で入力してください"');?>

      「20xx-xx-xx HH:MM」の形式。<br>
      <?php if (form_error('pj_start_time')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_start_time');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_end_time" class="col-sm-3 control-label">公開(募集)終了日時<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('pj_end_time',set_value('pj_end_time',$_smarty_tpl->tpl_vars['order_info']->value['pj_end_time']),'class="form-control" placeholder="「20xx-xx-xx HH:MM」の形式で入力してください"');?>

      「20xx-xx-xx HH:MM」の形式。<br>
      <?php if (form_error('pj_end_time')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_end_time');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pj_comment" class="col-sm-3 control-label">備考</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pj_comment';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pj_comment',$_smarty_tpl->tpl_vars['order_info']->value['pj_comment']),'class="form-control"');?>

      <?php if (form_error('pj_comment')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_comment');?>
</font></label><?php }?>
    </div>
  </div>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['not_disp']->value == TRUE) {?>設定情報はありません。
<?php } else { ?>

<?php if ($_smarty_tpl->tpl_vars['order_no']->value != '00') {?>
<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable($_smarty_tpl->tpl_vars['order_no']->value, null, 0);?>
<?php echo form_open('orderlist/data_order/','name="OrderForm" class="form-horizontal"');?>

  <h3><span class="label label-primary">案件設定　<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span></h3>

  <?php echo form_hidden('order_no',$_smarty_tpl->tpl_vars['num']->value);?>


  <div class="form-group">
    <label for="pji_pj_id" class="col-sm-3 control-label">案件 ID</label>
    <div class="col-sm-4">
          <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pji_pj_id'];?>

          <?php echo form_hidden('pji_pj_id',$_smarty_tpl->tpl_vars['order_info']->value['pji_pj_id']);?>

    </div>
  </div>

  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['name'] = 't_num';
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start'] = (int) 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['t_num']['total']);
?>
      <?php $_smarty_tpl->tpl_vars['t_num'] = new Smarty_Variable($_smarty_tpl->getVariable('smarty')->value['section']['t_num']['index'], null, 0);?>
      <?php $_smarty_tpl->tpl_vars['t_keywd_num'] = new Smarty_Variable(('rep_t_keyword0').($_smarty_tpl->getVariable('smarty')->value['section']['t_num']['index']), null, 0);?>
      <?php $_smarty_tpl->tpl_vars['t_count_min'] = new Smarty_Variable(('rep_t_count_min0').($_smarty_tpl->getVariable('smarty')->value['section']['t_num']['index']), null, 0);?>
      <?php $_smarty_tpl->tpl_vars['t_count_max'] = new Smarty_Variable(('rep_t_count_max0').($_smarty_tpl->getVariable('smarty')->value['section']['t_num']['index']), null, 0);?>
      
      

  <div class="form-group">
    <label for="rep_t_keyword0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">タイトル：必須ワード指定 <?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
</label>
    <div class="col-sm-9">
      <?php echo form_input($_smarty_tpl->tpl_vars['t_keywd_num']->value,set_value($_smarty_tpl->tpl_vars['t_keywd_num']->value,$_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['t_keywd_num']->value]),'class="form-control" placeholder="タイトルに使用するキーワードを指定してください。100文字以内。"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['t_keywd_num']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['t_keywd_num']->value);?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="rep_t_count_min0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['t_count_min']->value,set_value($_smarty_tpl->tpl_vars['t_count_min']->value,$_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['t_count_min']->value]),'class="form-control" placeholder="最低 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['t_count_min']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['t_count_min']->value);?>
</font></label><?php }?>
    </div>
    <label for="rep_t_count_max0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['t_count_max']->value,set_value($_smarty_tpl->tpl_vars['t_count_max']->value,$_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['t_count_max']->value]),'class="form-control" placeholder="最大 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['t_count_max']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['t_count_max']->value);?>
</font></label><?php }?>
    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="rep_t_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('rep_t_char_min',set_value('rep_t_char_min',$_smarty_tpl->tpl_vars['order_info']->value['rep_t_char_min']),'class="form-control" placeholder="最低 使用文字数"');?>

      <?php if (form_error('rep_t_char_min')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('rep_t_char_min');?>
</font></label><?php }?>
    </div>
    <label for="rep_t_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('rep_t_char_max',set_value('rep_t_char_max',$_smarty_tpl->tpl_vars['order_info']->value['rep_t_char_max']),'class="form-control" placeholder="最大 使用文字数"');?>

      <?php if (form_error('rep_t_char_max')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('rep_t_char_max');?>
</font></label><?php }?>
    </div>
  </div>


  <hr color="red">

  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['name'] = 'b_num';
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start'] = (int) 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['b_num']['total']);
?>
    <?php $_smarty_tpl->tpl_vars['b_num'] = new Smarty_Variable($_smarty_tpl->getVariable('smarty')->value['section']['b_num']['index'], null, 0);?>
    <?php $_smarty_tpl->tpl_vars['b_keywd_num'] = new Smarty_Variable(('rep_b_word0').($_smarty_tpl->getVariable('smarty')->value['section']['b_num']['index']), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['b_count_min'] = new Smarty_Variable(('rep_b_count_min0').($_smarty_tpl->getVariable('smarty')->value['section']['b_num']['index']), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['b_count_max'] = new Smarty_Variable(('rep_b_count_max0').($_smarty_tpl->getVariable('smarty')->value['section']['b_num']['index']), null, 0);?>
    
    

  <div class="form-group">
    <label for="rep_b_word0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">本文：必須ワード指定 <?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
</label>
    <div class="col-sm-9">
      <?php echo form_input($_smarty_tpl->tpl_vars['b_keywd_num']->value,set_value($_smarty_tpl->tpl_vars['b_keywd_num']->value,$_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['b_keywd_num']->value]),'class="form-control" placeholder="本文に使用するキーワードを指定してください。100文字以内。"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['b_keywd_num']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['b_keywd_num']->value);?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="rep_b_count_min0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['b_count_min']->value,set_value($_smarty_tpl->tpl_vars['b_count_min']->value,$_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['b_count_min']->value]),'class="form-control" placeholder="最低 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['b_count_min']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['b_count_min']->value);?>
</font></label><?php }?>
    </div>
    <label for="rep_b_count_max0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['b_count_max']->value,set_value($_smarty_tpl->tpl_vars['b_count_max']->value,$_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['b_count_max']->value]),'class="form-control" placeholder="最大 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['b_count_max']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['b_count_max']->value);?>
</font></label><?php }?>
    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="rep_b_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('rep_b_char_min',set_value('rep_b_char_min',$_smarty_tpl->tpl_vars['order_info']->value['rep_b_char_min']),'class="form-control" placeholder="最低 使用文字数"');?>

      <?php if (form_error('rep_b_char_min')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('rep_b_char_min');?>
</font></label><?php }?>
    </div>
    <label for="rep_b_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('rep_b_char_max',set_value('rep_b_char_max',$_smarty_tpl->tpl_vars['order_info']->value['rep_b_char_max']),'class="form-control" placeholder="最大 使用文字数"');?>

      <?php if (form_error('rep_b_char_max')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('rep_b_char_max');?>
</font></label><?php }?>
    </div>
  </div>


  <div class="form-group">
    <label for="pji_work" class="col-sm-3 control-label">個別案件：内容詳細<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pji_work';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pji_work',$_smarty_tpl->tpl_vars['order_info']->value['pji_work']),'class="form-control" placeholder="個別案件：内容を入力してください"');?>

      <?php if (form_error('pji_work')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pji_work');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pji_notice" class="col-sm-3 control-label">個別案件：注意事項</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pji_notice';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pji_notice',$_smarty_tpl->tpl_vars['order_info']->value['pji_notice']),'class="form-control" placeholder="個別案件：注意事項を入力してください"');?>

      <?php if (form_error('pji_notice')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pji_notice');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pji_example" class="col-sm-3 control-label">個別案件：例文</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pji_example';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pji_example',$_smarty_tpl->tpl_vars['order_info']->value['pji_example']),'class="form-control" placeholder="個別案件：例文を入力してください"');?>

      <?php if (form_error('pji_example')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pji_example');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pji_other" class="col-sm-3 control-label">個別案件：その他</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pji_other';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pji_other',$_smarty_tpl->tpl_vars['order_info']->value['pji_other']),'class="form-control" placeholder="個別案件：その他を入力してください"');?>

      <?php if (form_error('pji_other')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pji_other');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pji_addwork" class="col-sm-3 control-label">個別案件：追加内容</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pji_addwork';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pji_addwork',$_smarty_tpl->tpl_vars['order_info']->value['pji_addwork']),'class="form-control" placeholder="個別案件：追加内容を入力してください"');?>

      <?php if (form_error('pji_addwork')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pji_addwork');?>
</font></label><?php }?>
    </div>
  </div>

<?php }?>

  <br /><br />
      <?php $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable('class="btn btn-default" onClick="return orderSubmit()"', null, 0);?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_new', null, 0);
$_smarty_tpl->tpl_vars['attr_new']->value['value'] = '_submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'更　　新',$_smarty_tpl->tpl_vars['js']->value);?>

    </div>
  </div>

<?php }?>
<?php echo form_close();?>

<!-- </form> -->
</div>









    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



</body>
</html>
<?php }
}
?>