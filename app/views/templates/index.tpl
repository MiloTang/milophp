<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<head>
    <meta charset="UTF-8">
    <title>MiloCore MVC Sample</title>
    <script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
    <script src="./app/static/js/code.js">
    </script>
</head>
<body>
{foreach from=$name key=k item=v}
    <li>{$v.id}{$v.name}</li>
{/foreach}
<label><img src="http://localhost/index/code" onclick="javascript:this.src='http://localhost/index/code/'+Math.random();" /></label>

</body>
</html>