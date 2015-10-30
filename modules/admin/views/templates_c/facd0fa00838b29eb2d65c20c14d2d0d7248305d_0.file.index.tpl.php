<?php /* Smarty version 3.1.27, created on 2015-10-23 15:55:22
         compiled from "/home/cs/www/cs.com.dev/modules/client/views/contents/client/entryorder/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:7752967385629d9daee9150_46371268%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'facd0fa00838b29eb2d65c20c14d2d0d7248305d' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/client/views/contents/client/entryorder/index.tpl',
      1 => 1445505852,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7752967385629d9daee9150_46371268',
  'variables' => 
  array (
    'entry_no' => 0,
    'flashdata_peid' => 0,
    'options_entry_status' => 0,
    'client_info' => 0,
    'set_val' => 0,
    'options_genre_list' => 0,
    'attr' => 0,
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
    'attr_new' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5629d9db151620_35206738',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5629d9db151620_35206738')) {
function content_5629d9db151620_35206738 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '7752967385629d9daee9150_46371268';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>クライアント情報　　<span class="label label-success">新規案件申請登録</span></h3>
  ・一度の申請で案件を３つまで同時に登録申請できます。<br />
  ・「申請内容」「申請案件１」の登録は必須です。その他の「申請案件２」「申請案件３」は任意です。
</div>





<ul class="nav nav-tabs">
  <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '00') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/client/entryorder/">申請内容【必須】</a></li>
  <?php if ($_smarty_tpl->tpl_vars['flashdata_peid']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '01') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/client/entryorder/entry01/">申請案件１【必須】</a></li>
    <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '02') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/client/entryorder/entry02/">申請案件２【任意】</a></li>
    <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '03') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/client/entryorder/entry03/">申請案件３【任意】</a></li>
  <?php }?>
</ul>


<div class="jumbotron">
<?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '00') {?>
<?php echo form_open('entryorder/data_entry/','name="EntryorderForm" class="form-horizontal"');?>


  <?php echo form_hidden('entry_no','00');?>


  <?php if ($_smarty_tpl->tpl_vars['flashdata_peid']->value) {?>
  <div class="form-group">
    <label for="pe_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
		  <?php echo $_smarty_tpl->tpl_vars['flashdata_peid']->value;?>

    </div>
  </div>
  <?php }?>
  <div class="form-group">
    <label for="pe_status" class="col-sm-3 control-label">ステータス (状態)<font color=red>【必須】</font></label>
    <div class="col-sm-4">
		  <?php ob_start();
echo $_smarty_tpl->tpl_vars['client_info']->value['pe_status'];
$_tmp1=ob_get_clean();
echo form_dropdown('pe_status',$_smarty_tpl->tpl_vars['options_entry_status']->value,$_tmp1);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_entry_title" class="col-sm-3 control-label">タイトル（表示件名）<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php echo form_input('pe_entry_title',set_value('pe_entry_title',$_smarty_tpl->tpl_vars['set_val']->value['pe_entry_title']),'class="form-control" placeholder="タイトル（表示件名）を入力してください"');?>

      <?php if (form_error('pe_entry_title')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_entry_title');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_genre01" class="col-sm-3 control-label">希望ジャンル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  <?php echo form_dropdown('pe_genre01',$_smarty_tpl->tpl_vars['options_genre_list']->value,set_value('pe_genre01',''));?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_title" class="col-sm-3 control-label">案件申請：タイトル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php echo form_input('pe_title',set_value('pe_title',$_smarty_tpl->tpl_vars['set_val']->value['pe_title']),'class="form-control" placeholder="案件申請：タイトルを入力してください"');?>

      <?php if (form_error('pe_title')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_title');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_work" class="col-sm-3 control-label">案件申請：概要<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pe_work';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pe_work',$_smarty_tpl->tpl_vars['set_val']->value['pe_work']),'class="form-control" placeholder="案件申請：内容を入力してください"');?>

      <?php if (form_error('pe_work')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_work');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_notice" class="col-sm-3 control-label">案件申請：注意事項</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pe_notice';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pe_notice',$_smarty_tpl->tpl_vars['set_val']->value['pe_notice']),'class="form-control" placeholder="案件申請：注意事項を入力してください"');?>

      <?php if (form_error('pe_notice')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_notice');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_example" class="col-sm-3 control-label">案件申請：例文</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pe_example';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pe_example',$_smarty_tpl->tpl_vars['set_val']->value['pe_example']),'class="form-control" placeholder="案件申請：例文を入力してください"');?>

      <?php if (form_error('pe_example')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_example');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_other" class="col-sm-3 control-label">案件申請：その他</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pe_other';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pe_other',$_smarty_tpl->tpl_vars['set_val']->value['pe_other']),'class="form-control" placeholder="案件申請：その他を入力してください"');?>

      <?php if (form_error('pe_other')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_other');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_addwork" class="col-sm-3 control-label">案件申請：追加内容</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pe_addwork';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pe_addwork',$_smarty_tpl->tpl_vars['set_val']->value['pe_addwork']),'class="form-control" placeholder="案件申請：追加内容を入力してください"');?>

      <?php if (form_error('pe_addwork')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_addwork');?>
</font></label><?php }?>
    </div>
  </div>

  <div class="form-group">
    <label for="pe_word_tanka" class="col-sm-3 control-label">個別文字単価指定</label>
    <div class="col-sm-4">
      <?php echo form_input('pe_word_tanka',set_value('pe_word_tanka',$_smarty_tpl->tpl_vars['set_val']->value['pe_word_tanka']),'class="form-control" placeholder="個別文字単価指定を入力してください"');?>

      <?php if (form_error('pe_word_tanka')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_word_tanka');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_open_date" class="col-sm-3 control-label">案件希望公開日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('pe_open_date',set_value('pe_open_date',$_smarty_tpl->tpl_vars['set_val']->value['pe_open_date']),'class="form-control" placeholder="「20xx-xx-xx」の形式で入力してください"');?>

      <?php if (form_error('pe_open_date')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_open_date');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_delivery_date" class="col-sm-3 control-label">案件希望納期日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
      <?php echo form_input('pe_delivery_date',set_value('pe_delivery_date',$_smarty_tpl->tpl_vars['set_val']->value['pe_delivery_date']),'class="form-control" placeholder="「20xx-xx-xx」の形式で入力してください"');?>

      <?php if (form_error('pe_delivery_date')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_delivery_date');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pe_comment" class="col-sm-3 control-label">備考</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pe_comment';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pe_comment',$_smarty_tpl->tpl_vars['set_val']->value['pe_comment']),'class="form-control"');?>

      <?php if (form_error('pe_comment')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_comment');?>
</font></label><?php }?>
    </div>
  </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['entry_no']->value != '00') {?>
<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable($_smarty_tpl->tpl_vars['entry_no']->value, null, 0);?>
<?php echo form_open('entryorder/data_entry/','name="EntryorderForm" class="form-horizontal"');?>

  <h3><span class="label label-primary">依頼案件　<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span></h3>

  <?php echo form_hidden('entry_no',$_smarty_tpl->tpl_vars['num']->value);?>


  <?php if ($_smarty_tpl->tpl_vars['flashdata_peid']->value) {?>
  <div class="form-group">
    <label for="pe_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
		  <?php echo $_smarty_tpl->tpl_vars['flashdata_peid']->value;?>

    </div>
  </div>
  <?php }?>

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
  	<?php $_smarty_tpl->tpl_vars['t_keywd_num'] = new Smarty_Variable(('pei_t_keyword0').($_smarty_tpl->getVariable('smarty')->value['section']['t_num']['index']), null, 0);?>
  	<?php $_smarty_tpl->tpl_vars['t_count_min'] = new Smarty_Variable(('pei_t_count_min0').($_smarty_tpl->getVariable('smarty')->value['section']['t_num']['index']), null, 0);?>
  	<?php $_smarty_tpl->tpl_vars['t_count_max'] = new Smarty_Variable(('pei_t_count_max0').($_smarty_tpl->getVariable('smarty')->value['section']['t_num']['index']), null, 0);?>
  	
  	

  <div class="form-group">
    <label for="pei_t_keyword0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">タイトル：必須ワード指定 <?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
</label>
    <div class="col-sm-9">
      <?php echo form_input($_smarty_tpl->tpl_vars['t_keywd_num']->value,set_value($_smarty_tpl->tpl_vars['t_keywd_num']->value,$_smarty_tpl->tpl_vars['set_val']->value[$_smarty_tpl->tpl_vars['t_keywd_num']->value]),'class="form-control" placeholder="タイトルに使用するキーワードを指定してください。100文字以内。"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['t_keywd_num']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['t_keywd_num']->value);?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pei_t_count_min0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['t_count_min']->value,set_value($_smarty_tpl->tpl_vars['t_count_min']->value,$_smarty_tpl->tpl_vars['set_val']->value[$_smarty_tpl->tpl_vars['t_count_min']->value]),'class="form-control" placeholder="最低 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['t_count_min']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['t_count_min']->value);?>
</font></label><?php }?>
    </div>
    <label for="pei_t_count_max0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['t_count_max']->value,set_value($_smarty_tpl->tpl_vars['t_count_max']->value,$_smarty_tpl->tpl_vars['set_val']->value[$_smarty_tpl->tpl_vars['t_count_max']->value]),'class="form-control" placeholder="最大 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['t_count_max']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['t_count_max']->value);?>
</font></label><?php }?>
    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="pei_t_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('pei_t_char_min',set_value('pei_t_char_min',$_smarty_tpl->tpl_vars['set_val']->value['pei_t_char_min']),'class="form-control" placeholder="最低 使用文字数"');?>

      <?php if (form_error('pei_t_char_min')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_t_char_min');?>
</font></label><?php }?>
    </div>
    <label for="pei_t_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('pei_t_char_max',set_value('pei_t_char_max',$_smarty_tpl->tpl_vars['set_val']->value['pei_t_char_max']),'class="form-control" placeholder="最大 使用文字数"');?>

      <?php if (form_error('pei_t_char_max')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_t_char_max');?>
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
  	<?php $_smarty_tpl->tpl_vars['b_keywd_num'] = new Smarty_Variable(('pei_b_word0').($_smarty_tpl->getVariable('smarty')->value['section']['b_num']['index']), null, 0);?>
  	<?php $_smarty_tpl->tpl_vars['b_count_min'] = new Smarty_Variable(('pei_b_count_min0').($_smarty_tpl->getVariable('smarty')->value['section']['b_num']['index']), null, 0);?>
  	<?php $_smarty_tpl->tpl_vars['b_count_max'] = new Smarty_Variable(('pei_b_count_max0').($_smarty_tpl->getVariable('smarty')->value['section']['b_num']['index']), null, 0);?>
  	
  	

  <div class="form-group">
    <label for="pei_b_word0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">本文：必須ワード指定 <?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
</label>
    <div class="col-sm-9">
      <?php echo form_input($_smarty_tpl->tpl_vars['b_keywd_num']->value,set_value($_smarty_tpl->tpl_vars['b_keywd_num']->value,$_smarty_tpl->tpl_vars['set_val']->value[$_smarty_tpl->tpl_vars['b_keywd_num']->value]),'class="form-control" placeholder="本文に使用するキーワードを指定してください。100文字以内。"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['b_keywd_num']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['b_keywd_num']->value);?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pei_b_count_min0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['b_count_min']->value,set_value($_smarty_tpl->tpl_vars['b_count_min']->value,$_smarty_tpl->tpl_vars['set_val']->value[$_smarty_tpl->tpl_vars['b_count_min']->value]),'class="form-control" placeholder="最低 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['b_count_min']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['b_count_min']->value);?>
</font></label><?php }?>
    </div>
    <label for="pei_b_count_max0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
      <?php echo form_input($_smarty_tpl->tpl_vars['b_count_max']->value,set_value($_smarty_tpl->tpl_vars['b_count_max']->value,$_smarty_tpl->tpl_vars['set_val']->value[$_smarty_tpl->tpl_vars['b_count_max']->value]),'class="form-control" placeholder="最大 使用回数"');?>

      <?php if (form_error($_smarty_tpl->tpl_vars['b_count_max']->value)) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error($_smarty_tpl->tpl_vars['b_count_max']->value);?>
</font></label><?php }?>
    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="pei_b_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('pei_b_char_min',set_value('pei_b_char_min',$_smarty_tpl->tpl_vars['set_val']->value['pei_b_char_min']),'class="form-control" placeholder="最低 使用文字数"');?>

      <?php if (form_error('pei_b_char_min')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_b_char_min');?>
</font></label><?php }?>
    </div>
    <label for="pei_b_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
      <?php echo form_input('pei_b_char_max',set_value('pei_b_char_max',$_smarty_tpl->tpl_vars['set_val']->value['pei_b_char_max']),'class="form-control" placeholder="最大 使用文字数"');?>

      <?php if (form_error('pei_b_char_max')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_b_char_max');?>
</font></label><?php }?>
    </div>
  </div>


  <div class="form-group">
    <label for="pei_work" class="col-sm-3 control-label">個別申請：内容詳細<font color=red>【必須】</font></label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pei_work';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pei_work',$_smarty_tpl->tpl_vars['set_val']->value['pei_work']),'class="form-control" placeholder="個別申請：内容を入力してください"');?>

      <?php if (form_error('pei_work')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_work');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pei_notice" class="col-sm-3 control-label">個別申請：注意事項</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pei_notice';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pei_notice',$_smarty_tpl->tpl_vars['set_val']->value['pei_notice']),'class="form-control" placeholder="個別申請：注意事項を入力してください"');?>

      <?php if (form_error('pei_notice')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_notice');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pei_example" class="col-sm-3 control-label">個別申請：例文</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pei_example';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pei_example',$_smarty_tpl->tpl_vars['set_val']->value['pei_example']),'class="form-control" placeholder="個別申請：例文を入力してください"');?>

      <?php if (form_error('pei_example')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_example');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pei_other" class="col-sm-3 control-label">個別申請：その他</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pei_other';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pei_other',$_smarty_tpl->tpl_vars['set_val']->value['pei_other']),'class="form-control" placeholder="個別申請：その他を入力してください"');?>

      <?php if (form_error('pei_other')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_other');?>
</font></label><?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="pei_addwork" class="col-sm-3 control-label">個別申請：追加内容</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pei_addwork';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pei_addwork',$_smarty_tpl->tpl_vars['set_val']->value['pei_addwork']),'class="form-control" placeholder="個別申請：追加内容を入力してください"');?>

      <?php if (form_error('pei_addwork')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pei_addwork');?>
</font></label><?php }?>
    </div>
  </div>

<?php }?>

  <br /><br />
  <?php if ($_smarty_tpl->tpl_vars['flashdata_peid']->value) {?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-1">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_new', null, 0);
$_smarty_tpl->tpl_vars['attr_new']->value['value'] = '_submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'更　新','class="btn btn-default"');?>

    </div>
    <div class="col-sm-offset-1 col-sm-1">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_new', null, 0);
$_smarty_tpl->tpl_vars['attr_new']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_new', null, 0);
$_smarty_tpl->tpl_vars['attr_new']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_new', null, 0);
$_smarty_tpl->tpl_vars['attr_new']->value['value'] = '_new';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_new']->value,'続けて新規登録','class="btn btn-default"');?>

    </div>
  </div>
  <?php } else { ?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_new', null, 0);
$_smarty_tpl->tpl_vars['attr_new']->value['value'] = '_submit';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'登　　録','class="btn btn-default"');?>

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