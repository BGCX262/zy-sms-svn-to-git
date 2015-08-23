<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
		
		<meta http-equiv="Content-Type" content="text/html; charset={$CHARSET}" />
		
		<title>Welcome to {$LANG.WEBSITE_NAME}</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="{$admin_css}/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="{$admin_css}/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="{$admin_css}/invalid.css" type="text/css" media="screen" />	
		<link rel="stylesheet" href="{$admin_css}/smoothness/jquery-ui-1.8.16.custom.css" type="text/css" media="screen" />	
		<!--                       Javascripts                       -->
  
		<!-- jQuery -->
		<script type="text/javascript" src="{$admin_js}/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="{$admin_js}/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="{$admin_js}/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="{$admin_js}/jquery.wysiwyg.js"></script>
		
		<!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="{$admin_js}/jquery-ui-1.8.16.custom.min.js"></script>
		
		<!--[if IE]><script type="text/javascript" src="{$admin_js}/jquery.bgiframe.js"></script><![endif]-->

		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="{$admin_js}/DD_belatedPNG.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
		<script type="text/javascript" src="{$ROOT_URL}/include/ckeditor/ckeditor.js"></script>
		<script type="text/javascript">                                                                                     window.onload = function()
		　　      {
		　      　 CKEDITOR.replace('content');
		　　      };
		</script>
		{include file="$admin_theme/include/js.tpl"}
	</head>
  
	<body>
	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->