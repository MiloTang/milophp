<?php
/* Smarty version 3.1.30, created on 2016-11-06 04:34:15
  from "E:\xampp\htdocs\app\views\templates\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_581ea4b709fbb9_71395333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5d411d0ea399cb40fee76925d39faa6db182530' => 
    array (
      0 => 'E:\\xampp\\htdocs\\app\\views\\templates\\index.html',
      1 => 1478403254,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_581ea4b709fbb9_71395333 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <title>完整demo</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="../../../ueditor/ueditor.config.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="../../../ueditor/ueditor.all.min.js"> <?php echo '</script'; ?>
>


</head>
<body>
<div>
    <div class=""
    <h1><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</h1>

    <div id="editor" style="align-content: center;width: 20rem;height: 20rem"></div>
</div>
<div id="btns">
    <div>

        <button onclick="getContent()">获得内容</button>


    </div>

<?php echo '<script'; ?>
 type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
