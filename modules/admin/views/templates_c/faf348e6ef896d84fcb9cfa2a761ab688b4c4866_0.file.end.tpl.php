<?php /* Smarty version 3.1.27, created on 2015-10-09 20:04:12
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/contact/end.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:161965419356179f2ce70910_57394179%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'faf348e6ef896d84fcb9cfa2a761ab688b4c4866' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/contact/end.tpl',
      1 => 1444388632,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161965419356179f2ce70910_57394179',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56179f2cea5219_24168377',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56179f2cea5219_24168377')) {
function content_56179f2cea5219_24168377 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '161965419356179f2ce70910_57394179';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>



<h3>フォームは正しく送信されました!</h3>



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