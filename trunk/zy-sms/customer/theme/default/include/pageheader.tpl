			<!-- Page Head -->
			<h2>{$LANG.WELCOME} {$user.customer->user_login_name},Credit {$balance}</h2>
			<p id="page-intro">{$LANG.WHAT_WOULD_YOU_LIKE_TO_DO}</p>
			
			<ul class="shortcut-buttons-set">
				
				<li><a class="shortcut-button" href="message.php"><span>
					<img src="{$admin_image}/icons/pencil_48.png" alt="icon" /><br />
					{$LANG.SEND_MESSAGE}
				</span></a></li>
				
				<li><a class="shortcut-button" href="contact.php"><span>
					<img src="{$admin_image}/icons/paper_content_pencil_48.png" alt="icon" /><br />
					{$LANG.MY_CONTACTS}
				</span></a></li>
				
				<li><a class="shortcut-button" href="buy.php"><span>
					<img src="{$admin_image}/icons/image_add_48.png" alt="icon" /><br />
					{$LANG.BUY}
				</span></a></li>
				
				<li><a class="shortcut-button" href="login.php?method=out"><span>
					<img src="{$admin_image}/icons/clock_48.png" alt="icon" /><br />
					{$LANG.SIGN_OUT}
				</span></a></li>
				
				<!--<li><a class="shortcut-button" href="#messages" rel="modal"><span>
					<img src="{$admin_image}/icons/comment_48.png" alt="icon" /><br />
					Open Modal
				</span></a></li>-->
				
			</ul><!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div> <!-- End .clear -->