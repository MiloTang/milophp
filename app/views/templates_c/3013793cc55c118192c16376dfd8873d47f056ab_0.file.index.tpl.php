<?php
/* Smarty version 3.1.30, created on 2016-11-07 07:19:52
  from "C:\MILO\code\xampp\htdocs.\app\views\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58201d088b6795_19090413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3013793cc55c118192c16376dfd8873d47f056ab' => 
    array (
      0 => 'C:\\MILO\\code\\xampp\\htdocs.\\app\\views\\templates\\index.tpl',
      1 => 1478488962,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58201d088b6795_19090413 (Smarty_Internal_Template $_smarty_tpl) {
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

Hello, <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
!
<label><img src="http://localhost/index/code" onclick="javascript:this.src='http://localhost/index/code/'+Math.random();" /></label>

</body>
</html><?php }
}
