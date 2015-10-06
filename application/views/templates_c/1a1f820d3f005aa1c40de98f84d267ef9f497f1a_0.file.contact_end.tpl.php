<?php /* Smarty version 3.1.27, created on 2015-09-30 14:14:54
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/contact_end.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1889339000560b6fce340be5_68858213%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a1f820d3f005aa1c40de98f84d267ef9f497f1a' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/contact_end.tpl',
      1 => 1443431763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1889339000560b6fce340be5_68858213',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560b6fce4b7075_99271679',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560b6fce4b7075_99271679')) {
function content_560b6fce4b7075_99271679 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1889339000560b6fce340be5_68858213';
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