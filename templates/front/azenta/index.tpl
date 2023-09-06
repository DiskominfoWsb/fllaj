<!DOCTYPE html>
<html lang="en">

<head>
    {include "head.tpl"}
    <style type="text/css">
    	.spad{
    		background-color: white;
    	}
    </style>
</head>

<body style="overflow-x: hidden; background-image: url('{$basedir}images/br3.jpg'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
    {include "menu.tpl"}
    {$content}
    {include "foot.tpl"}
</body>

</html>