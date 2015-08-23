
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
								   <th>{$LANG.CONTACT_LIST_NAME}</th>
								 {* <th>{$LANG.ANGENT_ID}</th>*} 
								   <th>{$LANG.CONTACT_LIST_COUNT}</th>
								   {*<th>{$LANG.CONTACT_LIST_CREATE_TIME}</th>*}
								   <th>{$LANG.CONTACT_LIST_UPDATE_TIME}</th>
								   <th>{$LANG.CONTACT_LIST_remark}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
								
							</thead>
							<tbody>
							{section name=contact loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$item[contact]->contact_list_id}</td>
									<td>{$item[contact]->company_name}</td>
									<td>{$item[contact]->contact_list_name}</td>
									{*<td>{$item[contact]->angent_id}</td>*}
									<td>{$item[contact]->contact_list_count}</td>
									{*<td>{$item[contact]->contact_list_create_time}</td>*}
									<td>{$item[contact]->contact_list_update_time}</td>
									<td>{$item[contact]->contact_list_remark}</td>
									<td>
										<!-- Icons -->
										<a href="javascript:del('contact_list.php?method=delete&contact_list_id={$item[contact]->contact_list_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> 
										 <a href="contact_list.php?method=updateForward&contact_list_id={$item[contact]->contact_list_id}&company_id={$item[contact]->company_id}" title="{$LANG.UPDATE}">
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
					
						<form action="contact_list.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post">
										
							<fieldset><!--class="text-input medium-input datepicker"-->
							<input type="hidden" name="contact_list_id" value="{$contactObj->contact_list_id}">
									<p>
										<label>{$LANG.CONTACT_LIST_NAME}</label>
										<input class="text-input small-input"type="text" name="contact_list_name" id="contact_list_name" value="{$contactObj->contact_list_name}"/>
									</p>
									{*
									<p>
										<label>{$LANG.ANGENT_ID}</label>
										<input class="text-input small-input"type="text" name="angent_id" id="angent_id" value="{$contactObj->angent_id}"/>
									</p>
									
									<p>
										<label>{$LANG.CONTACT_LIST_CREATE_TIME}</label>
										{if $method=='update'}
										<input class="text-input small-input" type="text" readonly="true" name="contact_list_create_time" id="contact_list_create_time" value="{$contactObj->contact_list_create_time}"/>
										{else}
										<input class="text-input small-input"type="text" name="contact_list_create_time" id="contact_list_create_time" value="{$smarty.now|date_format:'%Y-%m-%d'}"/>
										{/if}
									</p>*}
									<p>
									<label>{$LANG.CONTACT_LIST_remark}</label>
									<textarea  name="contact_list_remark" id="contact_list_remark" cols="50" rows="10">{$contactObj->contact_list_remark}</textarea>
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
			

			
{include file="$admin_theme/include/foot.tpl"}
