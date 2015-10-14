<?php /* Smarty version 3.1.27, created on 2015-10-06 14:36:53
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/entryclient_end.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:5737802956135df533d3c6_62907951%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d85ff25e42af33d1225104a742d7c842031be84' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/entryclient_end.tpl',
      1 => 1443431763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5737802956135df533d3c6_62907951',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56135df536c003_07906411',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56135df536c003_07906411')) {
function content_56135df536c003_07906411 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '5737802956135df533d3c6_62907951';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>



<h3>フォームは正しく送信されました!</h3>



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