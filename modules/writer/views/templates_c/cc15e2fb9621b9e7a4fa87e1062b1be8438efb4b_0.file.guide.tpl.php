<?php /* Smarty version 3.1.27, created on 2015-11-24 09:49:25
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/top/guide.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2737944205653b41530ffb7_61526121%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc15e2fb9621b9e7a4fa87e1062b1be8438efb4b' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/top/guide.tpl',
      1 => 1448326015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2737944205653b41530ffb7_61526121',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5653b41533a992_49397928',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5653b41533a992_49397928')) {
function content_5653b41533a992_49397928 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2737944205653b41530ffb7_61526121';
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