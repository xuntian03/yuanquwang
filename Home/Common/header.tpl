<head>
<meta type="text/html" charset="utf-8">

<style type="text/css">
*{literal}{margin:0;padding:0}{/literal}
body {literal}{color:#333;font-family:"微软雅黑";font-size:14px;}{/literal}
a {literal}{text-decoration:none;}{/literal}

header {literal}{width:100%;height:48px;background:#0768CA;position:fixed;left:0;top:0;z-index:10}{/literal}
header a {literal}{color:white;}{/literal}
header a:hover {literal}{color:#F0EDED;}{/literal}
.h-cons {literal}{width:1000px;margin:0 auto;height:48px;line-height:48px;}{/literal}
.h-cons p {literal}{float:left;font-size:32px;font-weight:bold;color:white;font-family:"华文彩云"}{/literal}
.h-cons input {literal}{float:left;width:330px;height:28px;margin:8px 0 10px 10px;border-radius:4px;
		color:#333;font-family:"微软雅黑";font-size:14px;}{/literal}
.h-cons img {literal}{float:left;margin-top:9px;}{/literal}
.h-cons ul {literal}{float:left;margin-left:10px;}{/literal}
.h-cons ul li {literal}{list-style:none;float:left;margin-left:20px;}{/literal}
.h-cons button {literal}{float:left;margin:9px 0 0 50px;height:30px;line-height:30px;background:#0F7AEC;
		color:white;font-family:"微软雅黑";border:none;border-radius:4px;width:60px;cursor:pointer;}{/literal}
.h-cons-state {literal}{float:right;}{/literal}
.h-cons-state a {literal}{margin-left:5px;}{/literal}
.h-cons-state .logout:hover {literal}{color:red;}{/literal}

</style>
</head>


<header>
	<div class="h-cons">
		<p class="h-cons-name">园趣</p>
		<input type="text" name="text1" class="h-cons-sou" placeholder="输入关键字，搜索活动标题">	
		<a href="javascript:void(0)">
		<img src="{$smarty.const.IMG_URL}/hold/h-cons-sou.jpg" id="img-sou" /></a>
		<ul class="h-cons-list">
			<li><a href="{$smarty.const.__MODULE__}/Index/main">首页</a></li>
			<li><a href="{$smarty.const.__MODULE__}/College/college">园趣校园</a></li>
			<li><a href="{$smarty.const.__MODULE__}/Dynamic/dynamic">关注动态</a></li>
			<li><a href="{$smarty.const.__MODULE__}/Space/space">我的空间</a></li>
		</ul>
		<a href='{$smarty.const.__MODULE__}/Index/play'><button type="button">发起活动</button></a>
		<div class="h-cons-state">
			<a href='{$smarty.const.__MODULE__}/Space/space'>{$smarty.session.username}&nbsp;&nbsp;|</a>
			<a href='{$smarty.const.__MODULE__}/User/logout' class="logout">登出</a>
		</div>
	</div>
</header> 