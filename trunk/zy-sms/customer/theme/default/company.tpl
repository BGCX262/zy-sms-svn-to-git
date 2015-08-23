
{include file="$admin_theme/include/top.tpl"}
	
{include file="$admin_theme/include/left.tpl"}
		
		<div id="main-content"> <!-- Main Content Section with everything -->			
			
			{include file="$admin_theme/include/pageheader.tpl"}
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
						<form action="company.php?method=update" name="form" method="post">
										
			
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.COMPANY_INFOMATION}
							</div>
						</div>
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>{$LANG.COMPANY_NAME}</label>
									<input class="text-input medium-input" type="text" id="company_name" name="company_name" value="{$companyObj->company_name}" />
								</p>
								<input class="text-input medium-input" type="hidden" id="company_id" name="company_id" value="{$companyObj->company_id}" />
								<p>
									<label>{$LANG.COMPANY_ADDRESS}</label>
									<input class="text-input medium-input datepicker" type="text" id="company_address" name="company_address"  value="{$companyObj->company_address}"/>
								</p>
								
								<p>
									<label>{$LANG.COMPANY_PHONE}</label>
									<input class="text-input small-input" type="text" id="company_phone" name="company_phone" value="{$companyObj->company_phone}"/>
								</p>
									<p>
									<label>{$LANG.REMARK}</label>
									<textarea  name="company_remark" id="company_remark" cols="50" rows="10">{$companyObj->company_remark}</textarea>
								</p>
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.COMPANY_MANAGER_INFOMATION}
							</div>
						</div>	
									<input type="hidden" id="user_id" name="user_id" value="{$companyObj->user_id}">
								<p>
									<label>{$LANG.USER_LOGIN_NAME}</label>
									<input class="text-input small-input" type="text" readonly="false" id="user_login_name" name="user_login_name" value="{$companyObj->user_login_name}" />
								</p>
								<p>
									<label>{$LANG.USER_LOGIN_PASSWORD}</label>
									<input class="text-input small-input" type="password" id="user_login_password" name="user_login_password" value="{$companyObj->user_login_password}"/>
								</p>
								<p>
									<label>{$LANG.USER_LOGIN_PASSWORD_CONFIRM}</label>
									<input class="text-input small-input" type="password" id="user_repeat_password" name="user_repeat_password" value="{$companyObj->user_login_password}"/>
								</p>
								<p>
									<label>{$LANG.USER_REAL_NAME}</label>
									<input class="text-input small-input" type="text" id="user_real_name" name="user_real_name" value="{$companyObj->user_real_name}"/>
								</p>
								
								<p>
									<label>{$LANG.USER_EMAIL}</label>
									<input class="text-input small-input" type="text" id="user_email" name="user_email" value="{$companyObj->user_email}"/>
								</p>
								
								<p>
									<label>USER PHONE</label>
									<input class="text-input small-input" type="text" id="user_phone" name="user_phone" value="{$companyObj->user_phone}"/>
								</p>
								<p>
									<label>USER MOBILE</label>
									<input class="text-input small-input" type="text" id="user_mobile" name="user_mobile" value="{$companyObj->user_mobile}"/>
								</p>
									<p>
									<label>{$LANG.REMARK}</label>
									<textarea  name="user_remark" id="user_remark" cols="50" rows="10">{$companyObj->user_remark}</textarea>
								</p>
								<p>
									<input class="button" name="submit" id="submit" type="submit" value="{$LANG.SUBMIT}" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
			</div> <!-- End .content-box -->
		
			<div class="clear"></div>
{include file="$admin_theme/include/foot.tpl"}
<script type="text/javascript">
	$(document).ready(function(){
	
		$("#submit").click(function(){
		
			if($("#company_name").val() == ""){
				alert("Please fill company name!");
				$("#company_name").focus();
				return false;
			}
			
			if($("#company_address").val() == ""){
				alert("Please fill company address!");
				$("#company_address").focus();
				return false;
			}
			
			if($("#company_phone").val() == ""){
				alert("Please fill company phone!");
				$("#company_phone").focus();
				return false;
			}
			
			if($("#user_login_name").val() == ""){
				alert("Please fill your login name!");
				$("#user_login_name").focus();
				return false;
			}
			
			if($("#user_login_password").val() == ""){
				alert("Please fill your login password!");
				$("#user_login_password").focus();
				return false;
			}
			
			if($("#user_repeat_password").val() == ""){
				alert("Please fill your repeat password!");
				$("#user_repeat_password").focus();
				return false;
			}
			
			if($("#user_real_name").val() == ""){
				alert("Please fill your real name!");
				$("#user_real_name").focus();
				return false;
			}
			
			if($("#user_email").val() == ""){
				alert("Please fill your email!");
				$("#user_email").focus();
				return false;
			}else{
				var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
				 if(!reg.test($("#user_email").val())){
					alert('Please enter a valid E-mail');
					$("#user_email").focus();
					return false;
					}
			}
			
			if($("#user_phone").val() == ""){
				alert("Please fill your phone!");
				$("#user_phone").focus();
				return false;
			}else{
				var regx=/^[0-9-+]+$/;
				 if(!regx.test($("#user_phone").val())){
					alert('Please enter a valid phone');
					$("#user_phone").focus();
					return false;
					}
			}
			
			if($("#user_mobile").val() == ""){
				alert("Please fill your mobile!");
				$("#user_mobile").focus();
				return false;
			}else{
				var regx=/^[0-9-+]+$/;
				 if(!regx.test($("#user_mobile").val())){
					alert('Please enter a valid mobile');
					$("#user_mobile").focus();
					return false;
					}
			}
		});
	});
</script>
