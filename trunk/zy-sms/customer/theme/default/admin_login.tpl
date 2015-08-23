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
		{include file="$admin_theme/include/js.tpl"}
	</head>
  

	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>Simpla Admin</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="{$admin_image}/logo.png" alt="Simpla Admin logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="login.php?method=check" method="post">
						{if $login_name_error_message}
									<div class="notification error png_bg">
										<a href="#" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
										<div>
											{$login_name_error_message}
										</div>
									</div>
								
						{/if}
					<p>
						<label>Username</label>
						<input class="text-input" type="text" name="user_login_name" id="user_login_name"/>
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password" name="user_login_password" id="user_login_password"/>
					</p>
					<div class="clear"></div>
					<p id="remember-password">
						<input type="checkbox" />Remember me
					</p>
					<div class="clear"></div>
					<p>
						<input type="hidden" name="group" value="2"/>
						<input class="button" type="submit" value="Sign In" name="submit"/>
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
		
  </body>
  </html>
