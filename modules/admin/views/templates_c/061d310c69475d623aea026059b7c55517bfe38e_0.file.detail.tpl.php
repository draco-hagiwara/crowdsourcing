<?php /* Smarty version 3.1.27, created on 2015-10-30 13:41:13
         compiled from "/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/entrylist/detail.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:14259382435632f4e96ac248_43750326%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '061d310c69475d623aea026059b7c55517bfe38e' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/entrylist/detail.tpl',
      1 => 1446104853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14259382435632f4e96ac248_43750326',
  'variables' => 
  array (
    'entry_no' => 0,
    'entry_info' => 0,
    'attr' => 0,
    'attr_sub' => 0,
    'js' => 0,
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
  'unifunc' => 'content_5632f4e97cbf01_79825600',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5632f4e97cbf01_79825600')) {
function content_5632f4e97cbf01_79825600 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '14259382435632f4e96ac248_43750326';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<?php echo '<script'; ?>
 src="<?php echo base_url();?>
../js/my/cnfmandsubmit.js"><?php echo '</script'; ?>
>

<body>


<div class="jumbotron">
  <h3>案件申請情報　　<span class="label label-success">案件　更新＆申請</span></h3>
  ・一度の申請で案件を３つまで同時に登録申請できます。<br />
  ・「申請内容」「申請案件１」の登録は必須です。その他の「申請案件２」「申請案件３」は任意です。
</div>





<ul class="nav nav-tabs">
  <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '00') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/entrylist/detail00">申請内容【必須】</a></li>
  <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '01') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/entrylist/detail01/">申請案件１【必須】</a></li>
  <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '02') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/entrylist/detail02/">申請案件２【任意】</a></li>
  <?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '03') {?><li role="presentation" class="active"><?php } else { ?><li role="presentation"><?php }?><a href="/admin/entrylist/detail03/">申請案件３【任意】</a></li>
</ul>


<div class="jumbotron">
<?php if ($_smarty_tpl->tpl_vars['entry_no']->value == '00') {?>
<?php echo form_open('entrylist/data_entry/','name="EntryorderForm" class="form-horizontal"');?>


  <?php echo form_hidden('entry_no','00');?>


  <div class="form-group">
    <label for="pe_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_id'];?>

		  <?php echo form_hidden('pe_id',$_smarty_tpl->tpl_vars['entry_info']->value['pe_id']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_entry_title" class="col-sm-3 control-label">タイトル（表示件名）<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_entry_title'];?>

		  <?php echo form_hidden('pe_entry_title',$_smarty_tpl->tpl_vars['entry_info']->value['pe_entry_title']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_genre01" class="col-sm-3 control-label">希望ジャンル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['genre01_name'];?>

		  <?php echo form_hidden('pe_genre01',$_smarty_tpl->tpl_vars['entry_info']->value['pe_genre01']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_title" class="col-sm-3 control-label">案件申請：タイトル<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_title'];?>

		  <?php echo form_hidden('pe_title',$_smarty_tpl->tpl_vars['entry_info']->value['pe_title']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_work" class="col-sm-3 control-label">案件申請：概要<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_work'];?>

		  <?php echo form_hidden('pe_work',$_smarty_tpl->tpl_vars['entry_info']->value['pe_work']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_notice" class="col-sm-3 control-label">案件申請：注意事項</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_notice'];?>

		  <?php echo form_hidden('pe_notice',$_smarty_tpl->tpl_vars['entry_info']->value['pe_notice']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_example" class="col-sm-3 control-label">案件申請：例文</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_example'];?>

		  <?php echo form_hidden('pe_example',$_smarty_tpl->tpl_vars['entry_info']->value['pe_example']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_other" class="col-sm-3 control-label">案件申請：その他</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_other'];?>

		  <?php echo form_hidden('pe_other',$_smarty_tpl->tpl_vars['entry_info']->value['pe_other']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_addwork" class="col-sm-3 control-label">案件申請：追加内容</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_addwork'];?>

		  <?php echo form_hidden('pe_addwork',$_smarty_tpl->tpl_vars['entry_info']->value['pe_addwork']);?>

    </div>
  </div>

  <div class="form-group">
    <label for="pe_word_tanka" class="col-sm-3 control-label">個別文字単価指定</label>
    <div class="col-sm-4">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_word_tanka'];?>

		  <?php echo form_hidden('pe_word_tanka',$_smarty_tpl->tpl_vars['entry_info']->value['pe_word_tanka']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_open_date" class="col-sm-3 control-label">案件希望公開日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_open_date'];?>

		  <?php echo form_hidden('pe_open_date',$_smarty_tpl->tpl_vars['entry_info']->value['pe_open_date']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_delivery_date" class="col-sm-3 control-label">案件希望納期日<font color=red>【必須】</font></label>
    <div class="col-sm-4">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_delivery_date'];?>

		  <?php echo form_hidden('pe_delivery_date',$_smarty_tpl->tpl_vars['entry_info']->value['pe_delivery_date']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_comment" class="col-sm-3 control-label">備考</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pe_comment'];?>

		  <?php echo form_hidden('pe_comment',$_smarty_tpl->tpl_vars['entry_info']->value['pe_comment']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pe_reason" class="col-sm-3 control-label">非承認　理由</label>
    <div class="col-sm-9">
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['name'] = 'pe_reason';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr', null, 0);
$_smarty_tpl->tpl_vars['attr']->value['rows'] = 5;?>
      <?php echo form_textarea($_smarty_tpl->tpl_vars['attr']->value,set_value('pe_reason',$_smarty_tpl->tpl_vars['entry_info']->value['pe_reason']),'class="form-control" placeholder="非承認の場合、理由を記入してください。クライアント側に表示されます。"');?>

      <?php if (form_error('pe_reason')) {?><span class="label label-danger">Error : </span><label><font color=red><?php echo form_error('pe_reason');?>
</font></label><?php }?>
    </div>
  </div>


  <br /><br />
  <?php $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable('class="btn btn-default" onClick="return cnfmAndSubmit()"', null, 0);?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-1">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['value'] = '_accept';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'承　　認',$_smarty_tpl->tpl_vars['js']->value);?>

    </div>
    <div class="col-sm-offset-1 col-sm-7">
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['name'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['type'] = 'submit';?>
      <?php $_smarty_tpl->createLocalArrayVariable('attr_sub', null, 0);
$_smarty_tpl->tpl_vars['attr_sub']->value['value'] = '_refuse';?>
      <?php echo form_button($_smarty_tpl->tpl_vars['attr_sub']->value,'非 承 認',$_smarty_tpl->tpl_vars['js']->value);?>

    </div>
  </div>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['entry_no']->value != '00') {?>
<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable($_smarty_tpl->tpl_vars['entry_no']->value, null, 0);?>
<?php echo form_open('entrylist/data_entry/','name="EntryorderForm" class="form-horizontal"');?>

  <h3><span class="label label-primary">依頼案件　<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span></h3>

  <?php echo form_hidden('entry_no',$_smarty_tpl->tpl_vars['num']->value);?>


  <?php if (($_smarty_tpl->tpl_vars['entry_no']->value == '02') || ($_smarty_tpl->tpl_vars['entry_no']->value == '03')) {?>
  <div class="form-group">
    <label for="pei_status" class="col-sm-3 control-label">使用有無<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  <?php if ($_smarty_tpl->tpl_vars['entry_info']->value['pei_status'] == '1') {?>使用する<?php } else { ?>使用しない<?php }?>
		  <?php echo form_hidden('pei_status',$_smarty_tpl->tpl_vars['entry_info']->value['pei_status']);?>

    </div>
  </div>
  <?php }?>

  <div class="form-group">
    <label for="pei_pe_id" class="col-sm-3 control-label">申請 ID</label>
    <div class="col-sm-4">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_pe_id'];?>

		  <?php echo form_hidden('pei_pe_id',$_smarty_tpl->tpl_vars['entry_info']->value['pei_pe_id']);?>

    </div>
  </div>

  <?php if ($_smarty_tpl->tpl_vars['entry_info']->value['pei_status'] == '1') {?>

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
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value[$_smarty_tpl->tpl_vars['t_keywd_num']->value];?>

		  <?php echo form_hidden($_smarty_tpl->tpl_vars['t_keywd_num']->value,$_smarty_tpl->tpl_vars['t_keywd_num']->value);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pei_t_count_min0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value[$_smarty_tpl->tpl_vars['t_count_min']->value];?>

		  <?php echo form_hidden($_smarty_tpl->tpl_vars['t_count_min']->value,$_smarty_tpl->tpl_vars['t_count_min']->value);?>

    </div>
    <label for="pei_t_count_max0<?php echo $_smarty_tpl->tpl_vars['t_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value[$_smarty_tpl->tpl_vars['t_count_max']->value];?>

		  <?php echo form_hidden($_smarty_tpl->tpl_vars['t_count_max']->value,$_smarty_tpl->tpl_vars['t_count_max']->value);?>

    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="pei_t_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_t_char_min'];?>

		  <?php echo form_hidden('pei_t_char_min',$_smarty_tpl->tpl_vars['entry_info']->value['pei_t_char_min']);?>

    </div>
    <label for="pei_t_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_t_char_max'];?>

		  <?php echo form_hidden('pei_t_char_max',$_smarty_tpl->tpl_vars['entry_info']->value['pei_t_char_max']);?>

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
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value[$_smarty_tpl->tpl_vars['b_keywd_num']->value];?>

		  <?php echo form_hidden($_smarty_tpl->tpl_vars['b_keywd_num']->value,$_smarty_tpl->tpl_vars['b_keywd_num']->value);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pei_b_count_min0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最低 使用回数</label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value[$_smarty_tpl->tpl_vars['b_count_min']->value];?>

		  <?php echo form_hidden($_smarty_tpl->tpl_vars['b_count_min']->value,$_smarty_tpl->tpl_vars['b_count_min']->value);?>

    </div>
    <label for="pei_b_count_max0<?php echo $_smarty_tpl->tpl_vars['b_num']->value;?>
" class="col-sm-3 control-label">最大 使用回数</label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value[$_smarty_tpl->tpl_vars['b_count_max']->value];?>

		  <?php echo form_hidden($_smarty_tpl->tpl_vars['b_count_max']->value,$_smarty_tpl->tpl_vars['b_count_max']->value);?>

    </div>
  </div>

  <?php endfor; endif; ?>


  <div class="form-group">
    <label for="pei_b_char_min" class="col-sm-3 control-label">最低 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_b_char_min'];?>

		  <?php echo form_hidden('pei_b_char_min',$_smarty_tpl->tpl_vars['entry_info']->value['pei_b_char_min']);?>

    </div>
    <label for="pei_b_char_max" class="col-sm-3 control-label">最大 使用文字数<font color=red>【必須】</font></label>
    <div class="col-sm-3">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_b_char_max'];?>

		  <?php echo form_hidden('pei_b_char_max',$_smarty_tpl->tpl_vars['entry_info']->value['pei_b_char_max']);?>

    </div>
  </div>


  <div class="form-group">
    <label for="pei_work" class="col-sm-3 control-label">個別申請：内容詳細<font color=red>【必須】</font></label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_work'];?>

		  <?php echo form_hidden('pei_work',$_smarty_tpl->tpl_vars['entry_info']->value['pei_work']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pei_notice" class="col-sm-3 control-label">個別申請：注意事項</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_notice'];?>

		  <?php echo form_hidden('pei_notice',$_smarty_tpl->tpl_vars['entry_info']->value['pei_notice']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pei_example" class="col-sm-3 control-label">個別申請：例文</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_example'];?>

		  <?php echo form_hidden('pei_example',$_smarty_tpl->tpl_vars['entry_info']->value['pei_example']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pei_other" class="col-sm-3 control-label">個別申請：その他</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_other'];?>

		  <?php echo form_hidden('pei_other',$_smarty_tpl->tpl_vars['entry_info']->value['pei_other']);?>

    </div>
  </div>
  <div class="form-group">
    <label for="pei_addwork" class="col-sm-3 control-label">個別申請：追加内容</label>
    <div class="col-sm-9">
		  <?php echo $_smarty_tpl->tpl_vars['entry_info']->value['pei_addwork'];?>

		  <?php echo form_hidden('pei_addwork',$_smarty_tpl->tpl_vars['entry_info']->value['pei_addwork']);?>

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

<?php echo $_smarty_tpl->getSubTemplate ("../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



</body>
</html>
<?php }
}
?>