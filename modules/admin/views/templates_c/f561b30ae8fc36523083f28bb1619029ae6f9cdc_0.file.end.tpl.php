<?php /* Smarty version 3.1.27, created on 2015-10-09 20:10:02
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/entryclient/end.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:11364864965617a08aa71933_42469376%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f561b30ae8fc36523083f28bb1619029ae6f9cdc' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/entryclient/end.tpl',
      1 => 1444388889,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11364864965617a08aa71933_42469376',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5617a08aaa0394_76270811',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5617a08aaa0394_76270811')) {
function content_5617a08aaa0394_76270811 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11364864965617a08aa71933_42469376';
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