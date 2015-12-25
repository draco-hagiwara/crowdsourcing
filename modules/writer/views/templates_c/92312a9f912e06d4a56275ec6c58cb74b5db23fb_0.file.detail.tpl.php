<?php /* Smarty version 3.1.27, created on 2015-12-10 17:11:53
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/search_list/detail.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1999589943566933c94cb4b5_04986817%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92312a9f912e06d4a56275ec6c58cb74b5db23fb' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/search_list/detail.tpl',
      1 => 1449735065,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1999589943566933c94cb4b5_04986817',
  'variables' => 
  array (
    'order_no' => 0,
    'job_cnt' => 0,
    'result_mess' => 0,
    'order_info' => 0,
    'options_genre_list' => 0,
    'writer_tanka' => 0,
    'options_pj_mm_rank_id' => 0,
    'tanka_info' => 0,
    'options_pj_taa_difficulty_id' => 0,
    'diff_tanka0' => 0,
    'diff_tanka1' => 0,
    'diff_tanka2' => 0,
    'attr_sub' => 0,
    'js' => 0,
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
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566933c95b1724_43186983',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566933c95b1724_43186983')) {
function content_566933c95b1724_43186983 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1999589943566933c94cb4b5_04986817';
?>

    <?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/my/cnfmandsubmit.js"><?php echo '</script'; ?>
>

<body>


<div class="jumbotron">
  <h3>仕事情報</h3>
</div>





<ul class="nav nav-tabs">
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '00') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/search_list/detail00">仕事概要</a></li>
  <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '01') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/search_list/detail01/">記事詳細１</a></li>
  <?php if ($_smarty_tpl->tpl_vars['job_cnt']->value == 2) {?>
    <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '02') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/search_list/detail02/">記事詳細２</a></li>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['job_cnt']->value == 3) {?>
    <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '02') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/search_list/detail02/">記事詳細２</a></li>
    <?php if ($_smarty_tpl->tpl_vars['order_no']->value == '03') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/search_list/detail03/">記事詳細３</a></li>
  <?php }?>
</ul>

<div class="jumbotron">
<?php if ($_smarty_tpl->tpl_vars['order_no']->value == '00') {?>
<?php echo form_open('search_list/data_entry/','name="OrderForm" class="form-horizontal"');?>


  <?php echo form_hidden('order_no','00');?>

  <label><font color=red><?php echo $_smarty_tpl->tpl_vars['result_mess']->value;?>
</font></label>

  <div class="form-group">
    <label for="pj_id" class="col-sm-3 control-label">仕事 ID</label>
    <div class="col-sm-4">
          <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pj_id'];?>

          <?php echo form_hidden('pj_id',$_smarty_tpl->tpl_vars['order_info']->value['pj_id']);?>

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
    <label for="wi_word_tanka" class="col-sm-3 control-label">文字単価</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['writer_tanka']->value;?>

      <?php echo form_hidden('wi_word_tanka',$_smarty_tpl->tpl_vars['writer_tanka']->value);?>

    </div>
  </div>


  <div class="form-group">
    <label for="pj_mm_rank_id" class="col-sm-3 control-label">【確認用表示→　　会員ランク指定</label>
    <div class="col-sm-9">
          <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_info']->value['pj_mm_rank_id'];
$_tmp1=ob_get_clean();
echo form_dropdown('pj_mm_rank_id',$_smarty_tpl->tpl_vars['options_pj_mm_rank_id']->value,$_tmp1);?>

          <br />指定ランク以上のライターが投稿対象となります。ブロンズ < シルバー < ゴールド。
          <br />現行設定値：：<?php echo $_smarty_tpl->tpl_vars['tanka_info']->value;?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_word_tanka" class="col-sm-3 control-label">文字単価指定　　】</label>
    <div class="col-sm-4">
      <?php echo form_input('pj_word_tanka',set_value('pj_word_tanka',$_smarty_tpl->tpl_vars['order_info']->value['pj_word_tanka']),'class="form-control" placeholder="個別文字単価指定を入力してください"');?>

      各ランク一律での報酬単価となります。
      <?php if (form_error('pj_word_tanka')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pj_word_tanka');?>
</font></label><?php }?>
    </div>
  </div>


  <div class="form-group">
    <label for="pj_taa_difficulty_id" class="col-sm-3 control-label">難易度</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['options_pj_taa_difficulty_id']->value[$_smarty_tpl->tpl_vars['order_info']->value['pj_taa_difficulty_id']];?>

      <?php echo form_hidden('pj_taa_difficulty_id',$_smarty_tpl->tpl_vars['order_info']->value['pj_taa_difficulty_id']);?>

      <br>【現行設定値：：<?php echo $_smarty_tpl->tpl_vars['diff_tanka0']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['diff_tanka1']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['diff_tanka2']->value;?>
】
    </div>
  </div>

  <div class="form-group">
    <label for="pj_limit_time" class="col-sm-3 control-label">原稿制作時間</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pj_limit_time'];?>

      <?php echo form_hidden('pj_limit_time',$_smarty_tpl->tpl_vars['order_info']->value['pj_limit_time']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_start_time" class="col-sm-3 control-label">公開(募集)開始日時</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pj_start_time'];?>

    </div>
  </div>
  <div class="form-group">
    <label for="pj_end_time" class="col-sm-3 control-label">公開(募集)終了日時</label>
    <div class="col-sm-4">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['pj_end_time'];?>

      <?php echo form_hidden('pj_end_time',$_smarty_tpl->tpl_vars['order_info']->value['pj_end_time']);?>

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

  <br /><br />
      <?php $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable('class="btn btn-default" onClick="return orderSubmit()"', null, 0);?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['value'] = '_submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'エントリーする',$_smarty_tpl->tpl_vars['js']->value);?>

    </div>
  </div>

<?php echo form_close();?>


<?php }?>

<?php if ($_smarty_tpl->tpl_vars['not_disp']->value == TRUE) {?>設定情報はありません。
<?php } else { ?>

<?php if ($_smarty_tpl->tpl_vars['order_no']->value != '00') {?>
<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable($_smarty_tpl->tpl_vars['order_no']->value, null, 0);?>
<?php echo form_open('search_list/data_order/','name="OrderForm" class="form-horizontal"');?>


  <?php echo form_hidden('order_no',$_smarty_tpl->tpl_vars['num']->value);?>


  <div class="form-group">
    <label for="pji_pj_id" class="col-sm-3 control-label">仕事 ID</label>
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
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_t_char_min'];?>

    </div>
    <label for="rep_t_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_t_char_max'];?>

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
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_b_char_min'];?>

    </div>
    <label for="rep_b_char_max" class="col-sm-3 control-label">最大 使用文字数</label>
    <div class="col-sm-3">
      <?php echo $_smarty_tpl->tpl_vars['order_info']->value['rep_b_char_max'];?>

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