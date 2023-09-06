<!DOCTYPE html>
<html class="loading" lang="id" data-textdirection="ltr">
<head>
    {include 'head.tpl'}
</head>
<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="click" data-menu="horizontal-menu" data-col="2-columns" style="background-image: url('{$basedir}images/bg/always-grey.png'); overflow-x: hidden;">
    {include 'menu.tpl'}
    <div class="row">
        <div style="padding: 5px; background-color: rgba(0, 135, 203, 1); color: white;" class="col-md-1 text-center"><b>News</b></div>
        <div style="padding: 5px; background-color: white;" class="col-md-11">
        	<marquee>
        	{foreach from=$berita item=r}
        	<i class="fa fa-circle"></i> <a href="{$r.link}">{$r.judul} </a> &nbsp;&nbsp;&nbsp;
        	{/foreach}
        	</marquee>
        </div>
    </div>
    {$content}
    {include 'foot.tpl'}
</body>
</html>