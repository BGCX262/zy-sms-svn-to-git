
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
								   <th>{$LANG.COMPANY_NAME}</th>
								   <th>{$LANG.COMPANY_ADDRESS}</th>
								   <th>{$LANG.COMPANY_PHONE}</th>
								   <th>{$LANG.BALANCE}</th>
								   <th>{$LANG.REMARK}</th>
								   
								   <th>{$LANG.OPERATE}</th>
								</tr>
								
							</thead>
							<tbody>
							{section name=company loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$item[company]->company_id}</td>
									<td>{$item[company]->company_name}</td>
									<td>{$item[company]->company_address}</td>
									<td>{$item[company]->company_phone}</td>
									<td>{$item[company]->balance}</td>
									<td>{$item[company]->company_remark}</td>
									<td>
										<!-- Icons -->
										{* <a href="javascript:del('company.php?method=delete&company_id={$item[company]->company_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> *}
										 <a href="company.php?method=updateForward&company_id={$item[company]->company_id}&user_id={$item[company]->user_id}" title="{$LANG.UPDATE}">
										 <img src="{$admin_image}/icons/hammer_screwdriver.png" alt="{$LANG.UPDATE}" /></a>
										 <a href="company.php?method=setApi&company_id={$item[company]->company_id}&user_id={$item[company]->user_id}" title="{$LANG.SET_API}">
										 <img src="{$admin_image}/icons/setting.png" alt="{$LANG.SET_API}" /></a>
										 <a href="../customer/login.php?group=2&login_by_params=1&method=check&company_id={$item[company]->company_id}" target="_blank" title="{$LANG.LOGIN_AS_CUSTOMER}">
										 <img src="{$admin_image}/icons/customer_login.png" alt="{$LANG.LOGIN_AS_CUSTOMER}" /></a>
										  <a href="javascript:tofill({$item[company]->company_id});"  title="{$LANG.FILL}" id="tofill">
										 <img src="{$admin_image}/icons/symbol_addition.png" alt="{$LANG.FILL}" /></a>
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
					
						<form action="company.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post">
										
			
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
								{*<p>
									<label>{$LANG.VIDEO_PAGCKAGE_NAME}</label>
									{section name=package loop=$package} 
										{section name=package_content loop=$package_content}
											{$checked=""}
											{if $package[package]->package_id==$package_content[$smarty.section.package_content.iteration-1]}
													{$checked="checked=\"checked\""}																
													{break}
											{/if}
										{/section}
										<input type="checkbox" id="package" name="package[]"  {$checked} value="{$package[package]->package_id}">{$package[package]->package_name}
									{/section}
								</p>*}
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
									{if $method=='update'}
									<input class="text-input small-input" type="text" readOnly="false" id="user_login_name" name="user_login_name" value="{$companyObj->user_login_name}" />
									{else}
									<input class="text-input small-input" type="text" id="user_login_name" name="user_login_name" value="{$companyObj->user_login_name}" />
									{/if}
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
									{if $method=='update'}
										<input class="button" name="return" id="return" type="button" value="{$LANG.RETURN}" onclick="javascript:history.go(-1);"/>
									{/if}
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
		
			<div class="clear"></div>
			
	<div id="fillbox" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->

				<h3>Fill</h3>

				<form action="company.php?method=fill" method="post">
				
					<fieldset>
							<h4>Please Entry the credits:</h4>
							<input class="text-input small-input" type="text" id="bulance" name="bulance"/>
					</fieldset>
					
					<fieldset>
							<h4>Please choose the credit card types:</h4>
							<select name="cc_type" id="cc_type" class="text-input small-input" >
							<option value="1">VISA</option>
							<option value="2">Master Card</option>
							</select>
					</fieldset>
					<fieldset>
							<h4>Credit card account:</h4>
							<input class="text-input small-input" type="text" id="cc_number" name="cc_number"/>
					</fieldset>
					<fieldset>
							<h4>Name of Cardholder:</h4>
							<input class="text-input small-input" type="text" id="cc_name" name="cc_name"/>
					</fieldset>
					<fieldset>
							<h4>Validity:</h4>
							<input class="text-input small-input" type="text" id="cc_expirydate" name="cc_expirydate"/>
					</fieldset>
					<fieldset>
							<h4>Bank account:</h4>
							<input class="text-input small-input" type="text" id="dd_bsbnumber" name="dd_bsbnumber"/>
					</fieldset>
					<fieldset>
							<h4>Bank card number:</h4>
							<input class="text-input small-input" type="text" id="dd_accountnumber" name="dd_accountnumber"/>
					</fieldset>
					<fieldset>
							<h4>The name of the bank card:</h4>
							<input class="text-input small-input" type="text" id="dd_accountname" name="dd_accountname"/>
					</fieldset>
					<fieldset>
							<h4>Payment:</h4>
							<select name="defaultpay" id="defaultpay" class="text-input small-input" >
							<option value="1">Bank Tracnsfer</option>
							<option value="2">Credit Card</option>
							<option value="3">Derect Debit</option>
							</select>
					</fieldset>
					

					<fieldset>
						<input class="button" type="hidden" id="s_company_id" name="company_id" value="1" />
						<input class="button" type="submit" name="submit" id="submit" value="Add" />
					</fieldset>

				</form>

				

			</div> <!-- End #messages -->

			
{include file="$admin_theme/include/foot.tpl"}
<script type="text/javascript">
function tofill(company_id){
jQuery("#s_company_id").attr("value",company_id);
jQuery.facebox({ div: '#fillbox' });
}
</script>
