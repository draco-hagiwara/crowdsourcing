<?php /* Smarty version 3.1.27, created on 2015-10-13 14:49:12
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/login/reissue_end.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2019577375561c9b58a82744_00614301%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d94eca4f1314bb9a6ad77ba1706070ac778920c' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/login/reissue_end.tpl',
      1 => 1444713215,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2019577375561c9b58a82744_00614301',
  'variables' => 
  array (
    'reissue_status' => 0,
    'tmp_time' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_561c9b58ab5696_01952798',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_561c9b58ab5696_01952798')) {
function content_561c9b58ab5696_01952798 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2019577375561c9b58a82744_00614301';
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