<?php /* Smarty version 3.1.27, created on 2015-12-15 13:09:11
         compiled from "/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/login/reissue_end.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:885705307566f9267687813_89147486%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13d66887ab469786cec4086e478cb361a28a38cb' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/login/reissue_end.tpl',
      1 => 1450141352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '885705307566f9267687813_89147486',
  'variables' => 
  array (
    'reissue_status' => 0,
    'tmp_time' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566f92676c8444_19855662',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f92676c8444_19855662')) {
function content_566f92676c8444_19855662 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '885705307566f9267687813_89147486';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<?php if ($_smarty_tpl->tpl_vars['reissue_status']->value == 'temp') {?>
  <div class="jumbotron">
    <h3>メールが送信されました。</h3>
    <p class="redText"><small>送信されたメールの内容を確認し、<?php echo $_smarty_tpl->tpl_vars['tmp_time']->value;?>
分以内に手続きを完了させてください。</small></p>
  </div>
<?php } elseif ($_smarty_tpl->tpl_vars['reissue_status']->value == 'ok') {?>
  <div class="jumbotron">
    <h3>パスワードの変更が完了いたしました。</h3>
  </div>
<?php } else { ?>
  <div class="jumbotron">
    <h3>パスワードの変更に失敗しました。</h3>
  </div>
<?php }?>



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