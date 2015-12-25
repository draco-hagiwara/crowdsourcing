<?php /* Smarty version 3.1.27, created on 2015-11-05 13:18:41
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/end.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:412212293563ad8a12b3062_80944574%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa2efb7f011259419d42f4efcb231788e1b8c37b' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/entrywriter/end.tpl',
      1 => 1444369118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '412212293563ad8a12b3062_80944574',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_563ad8a1310bc5_78962235',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_563ad8a1310bc5_78962235')) {
function content_563ad8a1310bc5_78962235 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '412212293563ad8a12b3062_80944574';
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