<head>
<meta type="text/html" charset="utf-8">

<style type="text/css">
*{literal}{margin:0;padding:0}{/literal}
body {literal}{color:#333;font-family:"微软雅黑";font-size:14px;}{/literal}
a {literal}{text-decoration:none;}{/literal}

header {literal}{height:48px;background:#666;position:fixed;top:0;left:0;width:100%;}{/literal}
header div {literal}{height:48px;width:1000px;margin:0 auto;position:relative;}{/literal}
header p {literal}{float:right;height:48px;line-height:48px;margin-top:0;color:white;}{/literal}
.h-logo {literal}{float:left;font-size:32px;font-weight:bold;font-family:"华文彩云";}{/literal}
.h-title {literal}{position:absolute;left:50%;margin-left:-126px;font-size:28px;}{/literal}
.h-man {literal}{margin-right:120px;font-size:18px;}{/literal}
header a {literal}{color:white;text-decoration:none;}{/literal}
header a:hover {literal}{color:red;}{/literal}
</style>
</head>

<header>
	<div>
		<p class="h-logo">园趣</p>
		<p class="h-title">园趣网后台管理界面</p>
 		<p class="h-logout"><a href="{$smarty.const.__MODULE__}/Index/logout">退出</a></p>
		<p class="h-man"><a href="{$smarty.const.__MODULE__}/Manage/manage">
			{$smarty.session.admin_name}&nbsp;管理中心</a></p>
	</div>
</header> 