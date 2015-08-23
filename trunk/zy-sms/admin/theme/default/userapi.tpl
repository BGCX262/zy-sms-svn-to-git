
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
								 {*  <th>{$LANG.API_USERNAME}</th>
								   <th>{$LANG.API_PASSWORD}</th>*}
								   <th>{$LANG.API_ID}</th>
								   <th>{$LANG.API_STATUS}</th>
								   <th>{$LANG.SENDER_NAME}</th>
								   <th>{$LANG.SENDER_STATUS}</th>
								    <th>{$LANG.MOTIVATION}</td>
								  {* <th>{$LANG.USERAPI_REMARK}</th>*}
								   <th>{$LANG.OPERATE}</th>
								</tr>
								
							</thead>
							<tbody>
							{section name=company loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$item[company]->userapi_id}</td>
									{*<td>{$item[company]->api_username}</td>
									<td>{$item[company]->api_password}</td>*}
									<td>{$item[company]->api_id}</td>
									<td>
									{if $item[company]->api_status==2}
										{$LANG.ENABLE}								
									{/if}
									{if $item[company]->api_status==1}
										{$LANG.DISABLE}								
									{/if}
									</td>
									<td>{if $item[company]->api_type==1}
									{$item[company]->sender_name}
									{/if}
									 {if $item[company]->api_type==0}
									{$LANG.SYSTEM_DEFAULT}
									{/if}</td>
									<td>
									{if $item[company]->sender_status==1}
										{$LANG.DISABLE}								
									{/if}
									{if $item[company]->sender_status==2}
										{$LANG.ENABLE}								
									{/if}
									{if $item[company]->sender_status==3}
										{$LANG.DELETE}								
									{/if}
									{if $item[company]->sender_status==4}
										{$LANG.SUBJECT_TO_AUDIT}								
									{/if}
									</td>
									<td width="300" style="text-overflow:ellipsis">{$item[company]->sender_motivation}</td>
									{*<td>{$item[company]->userapi_remark}</td>*}
									<td>
										<!-- Icons -->
										<a href="javascript:del('company.php?method=deleteApi&userapi_id={$item[company]->userapi_id}&company_id={$item[company]->company_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> 
										 <a href="company.php?method=updateAPIForward&userapi_id={$item[company]->userapi_id}" title="{$LANG.UPDATE}">
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
					
						<form action="company.php?method={if $method!='update'}addUserAPI{else}updateUserAPI{/if}" name="form" method="post">
										
			
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.USERAPI_INFOMATION}
							</div>
						</div>
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>{$LANG.API_USERNAME}</label>
									<input class="text-input medium-input" type="text" id="api_username" name="api_username" value="{$companyObj->api_username}" />
								</p>
								
								
								<p>
									<label>{$LANG.API_PASSWORD}</label>
									<input class="text-input medium-input datepicker" type="text" id="api_password" name="api_password"  value="{$companyObj->api_password}"/>
								</p>
								
								<p>
									<label>{$LANG.API_ID}</label>
									<input class="text-input small-input" type="text" id="api_id" name="api_id" value="{$companyObj->api_id}"/>
								</p>
								<p>
									<label>{$LANG.SENDER_NAME}</label>
									<input class="text-input small-input" type="text" id="sender_name" name="sender_name" value="{$companyObj->sender_name}"/>
								</p>
									<p>
									<label>{$LANG.MOTIVATION}</label>
								<textarea  name="sender_motivation" id="sender_motivation" cols="50" rows="10">{$companyObj->sender_motivation}</textarea>
								</p>
								<p>
									<label>{$LANG.SENDER_STATUS}</label>
									<select id="sender_status" name="sender_status">
									<option>{$LANG.PLEASE_SELECT}</option>
									<option value="1"  {if $companyObj->sender_status==1}selected="selected"{/if}>{$LANG.DISABLE}</option>
									<option value="2"  {if $companyObj->sender_status==2}selected="selected"{/if}>{$LANG.ENABLE}</option>
									<option value="3"  {if $companyObj->sender_status==3}selected="selected"{/if}>{$LANG.DELETE}</option>
									<option value="4"  {if $companyObj->sender_status==4}selected="selected"{/if}>{$LANG.SUBJECT_TO_AUDIT}</option>
									</select>
								</p>
								<p>
									<label>{$LANG.API_STATUS}</label>
									<select id="api_status" name="api_status">
									<option>{$LANG.PLEASE_SELECT}</option>
									<option value="2"  {if $companyObj->api_status==2}selected="selected"{/if}>{$LANG.ENABLE}</option>
									<option value="1"  {if $companyObj->api_status==1}selected="selected"{/if}>{$LANG.DISABLE}</option>
									</select>
								</p>
									<p>
									<label>{$LANG.USERAPI_REMARK}</label>
									<textarea  name="userapi_remark" id="userapi_remark" cols="50" rows="10">{$companyObj->userapi_remark}</textarea>
								</p>
								<p>
								<input type="hidden" id="company_id" name="company_id" value="{$companyObj->company_id}" />
								<input type="hidden" id="userapi_id" name="userapi_id" value="{$companyObj->userapi_id}" />
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
			

			
{include file="$admin_theme/include/foot.tpl"}
