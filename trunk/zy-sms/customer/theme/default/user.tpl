
{include file="$admin_theme/include/top.tpl"}
	
{include file="$admin_theme/include/left.tpl"}
		
		<div id="main-content"> <!-- Main Content Section with everything -->			
			
			{include file="$admin_theme/include/pageheader.tpl"}
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">{$LANG.LIST}</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2" class="tab">{$lang_method}</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
						<table>
							<thead>
								<tr>
								  {* <th><input class="check-all" type="checkbox" /></th>*}
								    <th>{$LANG.ID}</th>
								   <th>{$LANG.USER_LOGIN_NAME}</th>
								   <th>{$LANG.USER_REAL_NAME}</th>
								   <th>{$LANG.USER_EMAIL}</th>
								   <th>{$LANG.USER_PHONE}</th>
								   <th>{$LANG.USER_MOBILE}</th>
								   <th>{$LANG.REMARK}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
								
							</thead>
							<tbody>
							{section name=user loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$item[user]->user_id}</td>
									<td>{$item[user]->user_login_name}</td>
									<td>{$item[user]->user_real_name}</td>
									<td>{$item[user]->user_email}</td>
									<td>{$item[user]->user_phone}</td>
									<td>{$item[user]->user_mobile}</td>
									<td>{$item[user]->user_remark}</td>
									<td>
										<!-- Icons -->
										{if {$item[department]->department_name} != 'manager'}
										 <a href="javascript:del('user.php?method=delete&user_id={$item[user]->user_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a>
										 {/if} 
										 <a href="user.php?method=updateForward&user_id={$item[user]->user_id}" title="{$LANG.UPDATE}">
										 <img src="{$admin_image}/icons/hammer_screwdriver.png" alt="{$LANG.UPDATE}" /></a>
									</td>
								</tr>
								
							{/section}
							</tbody>
							
							<tfoot>
								<tr>
									<td colspan="6">
										{*
										<div class="bulk-actions align-left">
											<select name="dropdown">
												<option value="option1">Choose an action...</option>
												<option value="option2">Edit</option>
												<option value="option3">Delete</option>
											</select>
											<a class="button" href="#">Apply to selected</a>
										</div>
										*}
										
										<div class="pagination">{$nextpage}</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						</table>
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
					
						<form action="user.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post">
										
			
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.COMPANY_MANAGER_INFOMATION}
							</div>
						</div>
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							<input type="hidden" name="user_id" value="{$userObj->user_id}"/>
							<p>
									<label>{$LANG.SELECT_DEPARTMEN}</label>
									<select class="text-input small-input" name="department_id" id="department_id">
									{section  name=user loop=$department}
										{$selected=""}
										{if $department[user]->department_id == $userObj->department_id}
											{$selected="selected=\"selected\""}
										{/if}
										<option value="{$department[user]->department_id}" {$selected}>{$department[user]->department_name}</option>
									{/section}
								</select>
								</p>
							<p>
									<label>{$LANG.USER_LOGIN_NAME}</label>
									{if $method=='update'}
									<input class="text-input small-input" type="text" readOnly="false" id="user_login_name" name="user_login_name" value="{$userObj->user_login_name}" />
									{else}
									<input class="text-input small-input" type="text" id="user_login_name" name="user_login_name" value="{$userObj->user_login_name}" />
									{/if}
								</p>
								<p>
									<label>{$LANG.USER_LOGIN_PASSWORD}</label>
									<input class="text-input small-input" type="password" id="user_login_password" name="user_login_password" value="{$userObj->user_login_password}"/>
								</p>
								<p>
									<label>{$LANG.USER_LOGIN_PASSWORD_CONFIRM}</label>
									<input class="text-input small-input" type="password" id="user_repeat_password" name="user_repeat_password" value="{$userObj->user_login_password}"/>
								</p>
								<p>
									<label>{$LANG.USER_REAL_NAME}</label>
									<input class="text-input small-input" type="text" id="user_real_name" name="user_real_name" value="{$userObj->user_real_name}"/>
								</p>
								
								<p>
									<label>{$LANG.USER_EMAIL}</label>
									<input class="text-input small-input" type="text" id="user_email" name="user_email" value="{$userObj->user_email}"/>
								</p>
								
								<p>
									<label>USER PHONE</label>
									<input class="text-input small-input" type="text" id="user_phone" name="user_phone" value="{$userObj->user_phone}"/>
								</p>
								<p>
									<label>USER MOBILE</label>
									<input class="text-input small-input" type="text" id="user_mobile" name="user_mobile" value="{$userObj->user_mobile}"/>
								</p>
									<p>
									<label>{$LANG.REMARK}</label>
									<textarea  name="user_remark" id="user_remark" cols="50" rows="10">{$userObj->user_remark}</textarea>
								</p>
								<p>
									{if $method=='update'}
									<input class="button" name="button" id="button" type="button" value="Go Back" onclick="javascript:history.go(-1);"/>
								{/if}
									<input class="button" name="submit" id="submit" type="submit" value="{$LANG.SUBMIT}" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
		
			<div class="clear"></div>
			
{include file="$admin_theme/include/foot.tpl"}
<script type="text/javascript">
	$(document).ready(function(){
		$("#submit").click(function(){
			if($("#department_id").val() == ""){
				alert("Please choose department name!");
				$("#department_id").focus();
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
			
			if($("#user_login_password").val() != $("#user_repeat_password").val()){
				alert("Two password input does not match, please re-enter!");
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
