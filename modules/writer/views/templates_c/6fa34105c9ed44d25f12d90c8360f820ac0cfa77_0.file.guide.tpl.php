<?php /* Smarty version 3.1.27, created on 2015-12-15 11:56:53
         compiled from "/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/top/guide.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:62271129566f8175ca30f7_34310016%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fa34105c9ed44d25f12d90c8360f820ac0cfa77' => 
    array (
      0 => '/home/cs/www/cs.com.dev/modules/writer/views/contents/writer/top/guide.tpl',
      1 => 1450141352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62271129566f8175ca30f7_34310016',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566f8175cd2ef8_09272174',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566f8175cd2ef8_09272174')) {
function content_566f8175cd2ef8_09272174 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '62271129566f8175ca30f7_34310016';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>


<!--Body content-->

	<div class="jumbotron">
	  <h3>ご利用ガイド</h3>
	</div>


    <!-- TwitterBootstrapのグリッドシステムclass="row"で終了 -->
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