<?php /* Smarty version 3.1.27, created on 2015-10-14 18:56:49
         compiled from "/home/cs/www/cs.com.dev/modules/client/views/contents/client/top/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:204297557561e26e1e45b64_89831760%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b948858200306d81c42b3ad7d99bb0db89869aa' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/client/views/contents/client/top/index.tpl',
      1 => 1444813706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204297557561e26e1e45b64_89831760',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_561e26e1e71a33_62702737',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_561e26e1e71a33_62702737')) {
function content_561e26e1e71a33_62702737 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '204297557561e26e1e45b64_89831760';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>ログイン TOP画面　　<span class="label label-info">クライアント</span></h3>
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