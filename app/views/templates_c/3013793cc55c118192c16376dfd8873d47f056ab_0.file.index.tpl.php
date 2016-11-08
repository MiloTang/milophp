<?php
/* Smarty version 3.1.30, created on 2016-11-08 11:34:08
  from "C:\MILO\code\xampp\htdocs.\app\views\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5821aa20b400c9_53557410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3013793cc55c118192c16376dfd8873d47f056ab' => 
    array (
      0 => 'C:\\MILO\\code\\xampp\\htdocs.\\app\\views\\templates\\index.tpl',
      1 => 1478601247,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5821aa20b400c9_53557410 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<head>
    <meta charset="UTF-8">
    <title>MiloCore MVC Sample</title>
    <?php echo '<script'; ?>
 src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./app/static/js/code.js">
    <?php echo '</script'; ?>
>
</head>
<body>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['name']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
    <li><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];
echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</li>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<label><img src="http://localhost/index/code" onclick="javascript:this.src='http://localhost/index/code/'+Math.random();" /></label>

</body>
</html><?php }
}
