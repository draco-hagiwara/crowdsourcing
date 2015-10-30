<?php /* Smarty version 3.1.27, created on 2015-10-30 15:57:07
         compiled from "/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/top/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:516488759563314c39453a7_76372814%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5d031db9480ef32bb9a0bd6d108624e6d074cc9' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/admin/views/contents/admin/top/index.tpl',
      1 => 1444835164,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '516488759563314c39453a7_76372814',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_563314c3e01eb0_11727359',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_563314c3e01eb0_11727359')) {
function content_563314c3e01eb0_11727359 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '516488759563314c39453a7_76372814';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<div class="jumbotron">
  <h3>ログイン TOP画面　　<span class="label label-danger">アドミン</span></h3>
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