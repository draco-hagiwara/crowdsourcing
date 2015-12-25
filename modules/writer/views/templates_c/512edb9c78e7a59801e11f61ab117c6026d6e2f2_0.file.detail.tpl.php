<?php /* Smarty version 3.1.27, created on 2015-12-10 17:04:26
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/my_entrylist/detail.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:14455284875669320a993a69_13472529%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '512edb9c78e7a59801e11f61ab117c6026d6e2f2' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/my_entrylist/detail.tpl',
      1 => 1449734663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14455284875669320a993a69_13472529',
  'variables' => 
  array (
    'order_no' => 0,
    'job_cnt' => 0,
    'result_mess_ng' => 0,
    'result_mess_ok' => 0,
    'order_info' => 0,
    'options_workstatus' => 0,
    'options_genre_list' => 0,
    'options_wi_difficulty_id' => 0,
    'attr_sub' => 0,
    'js' => 0,
    'not_disp' => 0,
    'num' => 0,
    't_num' => 0,
    't_keywd_num' => 0,
    't_count_min' => 0,
    't_count_max' => 0,
    'attr' => 0,
    'b_num' => 0,
    'b_keywd_num' => 0,
    'b_count_min' => 0,
    'b_count_max' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5669320aa90078_06356896',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5669320aa90078_06356896')) {
function content_5669320aa90078_06356896 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/cs/www/cs.com.dev/application/third_party/smarty/libraries/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '14455284875669320a993a69_13472529';
?>

    <?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/my/cnfmandsubmit.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../js/word_cnt.js"><?php echo '</script'; ?>
>







<body>


<div class="jumbotron">
  <h3>仕事情報</h3>
</div>





<ul class="nav nav-tabs">
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '00') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/my_entrylist/detail00">仕事概要</a></li>
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '01') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/my_entrylist/detail01/">記事詳細１</a></li>
  <?php if ($_smarty_tpl->tpl_vars['job_cnt']->value == 2) {?>
    <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '02') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/my_entrylist/detail02/">記事詳細２</a></li>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['job_cnt']->value == 3) {?>
    <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '02') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/my_entrylist/detail02/">記事詳細２</a></li>
    <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '03') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/my_entrylist/detail03/">記事詳細３</a></li>
  <?php }?>
</ul>


<div class="jumbotron">

<label><font color=red><?php echo $_smarty_tpl->tpl_vars['result_mess_ng']->value;?>
</font></label>
<label><font color=red><?php echo $_smarty_tpl->tpl_vars['result_mess_ok']->value;?>
</font></label>

<?php if ($_smarty_tpl->tpl_vars['order_no']->value == '00') {?>
<?php echo form_open('my_entrylist/data_post/','name="OrderForm" class="form-horizontal"');?>


  <?php echo form_hidden('order_no','00');?>


  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">仕事 ID</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pj_id'];?>

      <?php echo form_hidden('pj_id',$_smarty_tpl->tpl_vars['order_info']->value['pj_id']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">ステータス</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['options_workstatus']->value[$_smarty_tpl->tpl_vars['order_info']->value['wi_pj_work_status']];?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_genre01" class="col-sm-3 control-label">ジャンル</label>
    <div class="col-sm-9">
      <?php echo $_smarty_tpl->tpl_vars['options_genre_list']->value[$_smarty_tpl->tpl_vars['order_info']->value['pj_genre01']];?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_title" class="col-sm-3 control-label">タイトル</label>
    <div class="col-sm-9">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pj_title'];?>

      <?php echo form_hidden('pj_title',$_smarty_tpl->tpl_vars['order_info']->value['pj_title']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_work" class="col-sm-3 control-label">概要</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pj_work']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_notice" class="col-sm-3 control-label">注意事項</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pj_notice']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_example" class="col-sm-3 control-label">例文</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pj_example']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_other" class="col-sm-3 control-label">その他</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pj_other']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_addwork" class="col-sm-3 control-label">追加内容</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pj_addwork']);?>

    </div>
  </div>

  <div class="form-group">
    <label for="wi_word_tanka" class="col-sm-3 control-label">文字単価</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['wi_word_tanka'];?>
 円
    </div>
  </div>
  <div class="form-group">
    <label for="pj_taa_difficulty_id" class="col-sm-3 control-label">難易度</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['options_wi_difficulty_id']->value[$_smarty_tpl->tpl_vars['order_info']->value['wi_difficulty_id']];?>

    </div>
  </div>

  <div class="form-group">
    <label for="wi_entry_date" class="col-sm-3 control-label">エントリー時間</label>
    <div class="col-sm-4">
      <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order_info']->value['wi_entry_date'],"%Y年%m月%d日 %H時%M分");?>

    </div>
  </div>
  <div class="form-group">
    <label for="wi_posting_limit_date" class="col-sm-3 control-label">制作〆切時間</label>
    <div class="col-sm-4">
      <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order_info']->value['wi_posting_limit_date'],"%Y年%m月%d日 %H時%M分");?>

    </div>
  </div>

  <br /><br />
      <?php $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable('class="btn btn-default" onClick="return orderSubmit()"', null, 0);?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-2">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['value'] = '_cancel';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'エントリーキャンセル',$_smarty_tpl->tpl_vars['js']->value);?>

    </div>
    <div class="col-sm-offset-1 col-sm-6">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['value'] = '_submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'投稿する',$_smarty_tpl->tpl_vars['js']->value);?>

    </div>
  </div>

<?php echo form_close();?>


<?php }?>

<?php if ($_smarty_tpl->tpl_vars['not_disp']->value == TRUE) {?>設定情報はありません。
<?php } else { ?>

<?php if ($_smarty_tpl->tpl_vars['order_no']->value != '00') {?>
<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable($_smarty_tpl->tpl_vars['order_no']->value, null, 0);?>
<?php echo form_open('my_entrylist/data_save/','name="OrderForm" class="form-horizontal"');?>


  <?php echo form_hidden('order_no',$_smarty_tpl->tpl_vars['num']->value);?>


  <div class="form-group">
    <label for="pji_pj_id" class="col-sm-3 control-label">仕事 ID</label>
    <div class="col-sm-4">
          <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pji_pj_id'];?>

          <?php echo form_hidden('pji_pj_id',$_smarty_tpl->tpl_vars['order_info']->value['pji_pj_id']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="rep_title" class="col-sm-3 control-label">タイトル入力欄</label>
    <div class="col-sm-8">
      <?php echo form_input('rep_title',set_value('rep_title',$_smarty_tpl->tpl_vars['order_info']->value['rep_title']),'id="rep_title" class="form-control" placeholder="タイトルを入力してください"');?>

      <?php if (form_error('rep_title')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('rep_title');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="count1">0</span> 文字
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
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['t_keywd_num']->value];?>

    </div>
  </div>
  <div class="form-group">
    <label for="rep_t_count_min0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['t_count_min']->value];?>

    </div>
    <label for="rep_t_count_max0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['t_count_max']->value];?>

    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="rep_t_char_min" class="col-sm-3 control-label">最低 使用文字数</label>
    <div class="col-sm-3">
      <label id="t_char_min"><?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_t_char_min'];?>
</label>
    </div>
    <label for="rep_t_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      <label id="t_char_max"><?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_t_char_max'];?>
</label>
    </div>
  </div>


  <hr color="red">

  <div class="form-group">
    <label for="rep_text_body" class="col-sm-3 control-label">本文入力欄</label>
    <div class="col-sm-8">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'rep_text_body';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 20;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('rep_text_body',$_smarty_tpl->tpl_vars['order_info']->value['rep_text_body']),'id="rep_text_body" class="form-control" placeholder="本文を入力してください"');?>

      <?php if (form_error('rep_text_body')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('rep_text_body');?>
</font></label><?php }?>
    </div>
    <div class="col-sm-1">
      <span class="count2 bold">0</span> 文字
    </div>
  </div>

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
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['b_keywd_num']->value];?>

    </div>
  </div>
  <div class="form-group">
    <label for="rep_b_count_min0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['b_count_min']->value];?>

    </div>
    <label for="rep_b_count_max0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value[$_smarty_tpl->tpl_vars['b_count_max']->value];?>

    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="rep_b_char_min" class="col-sm-3 control-label">最低 使用文字数</label>
    <div class="col-sm-3">
      <label id="b_char_min"><?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_b_char_min'];?>
</label>
    </div>
    <label for="rep_b_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      <label id="b_char_max"><?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_b_char_max'];?>
</label>
    </div>
  </div>


  <div class="form-group">
    <label for="pji_work" class="col-sm-3 control-label">内容詳細</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pji_work']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pji_notice" class="col-sm-3 control-label">注意事項</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pji_notice']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pji_example" class="col-sm-3 control-label">例文</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pji_example']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pji_other" class="col-sm-3 control-label">その他</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pji_other']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pji_addwork" class="col-sm-3 control-label">追加内容</label>
    <div class="col-sm-9">
      <?php echo nl2br($_smarty_tpl->tpl_vars['order_info']->value['pji_addwork']);?>

    </div>
  </div>

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
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'保存する',$_smarty_tpl->tpl_vars['js']->value);?>

    </div>
  </div>

<?php }?>

<?php }?>
<?php echo form_close();?>

<!-- </form> -->
</div>









    <!-- Bootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("../../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



</body>
</html>
<?php }
}
?>