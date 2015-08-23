
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
								   <th>{$LANG.CONTACT_FIRST_NAME}</th>
								 {* <th>{$LANG.ANGENT_ID}</th>*} 
								   <th>{$LANG.CONTACT_SURNAME}</th>
								   <th>{$LANG.CONTACT_TITLE}</th>
								   <th>{$LANG.CONTACT_MOBILE}</th>
								   {*<th>{$LANG.CONTACT_CREATE_TIME}</th>*}
								   <th>{$LANG.CONTACT_UPDATE_TIME}</th>
								   {*<th>{$LANG.CONTACT_COUNTRY}</th>*}
								   <th>{$LANG.CONTACT_REMARK}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
							</thead>
							<tbody>
							{section name=contact loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$item[contact]->contact_id}</td>
									<td>{$item[contact]->contact_first_name}</td>
									<td>{$item[contact]->contact_surname}</td>
									<td>{$item[contact]->contact_title}</td>
									<td>{$item[contact]->contact_mobile}</td>
									{*<td>{$item[contact]->contact_create_time}</td>*}
									<td>{$item[contact]->contact_update_time}</td>
									{*<td>{$item[contact]->contact_country}</td>*}
									<td>{$item[contact]->contact_remark}</td>
									<td>
										<!-- Icons -->
										<a href="javascript:del('contact.php?method=delete&contact_id={$item[contact]->contact_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> 
										 <a href="contact.php?method=updateForward&contact_id={$item[contact]->contact_id}" title="{$LANG.UPDATE}">
										 <img src="{$admin_image}/icons/hammer_screwdriver.png" alt="{$LANG.UPDATE}" /></a>
									</td>
								</tr>
								
							{/section}
							</tbody>
								<script type="text/javascript">
								     function change(obj)
								     {
								     var selValue=(obj.options[obj.selectedIndex]).value;//获得选中值
								     button.href=selValue;
								   	 }
								</script>
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
										{*	<select name="dropdown"  onchange="change(this)">
												<option value="option1">Choose an action...</option>
												<option value="excelImport.php">Import</option>
												<option value="daochu.php">Export</option>
											</select>
											<a class="button" id="button" href="">Apply to selected</a>*}
										</div>
										<div class="pagination">{$nextpage}</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						</table>
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
						<form action="contact.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post">
										
							<fieldset><!--class="text-input medium-input datepicker"-->
							<input type="hidden" name="contact_id" value="{$contactObj->contact_id}">
							
								{*<p>
										<label>{$LANG.CONTACT_NAME}</label>
										<select class="text-input small-input"  name="contact_list_id" id="contact_list_id">
										{section name=contact loop=$contact_list}
											{$selected=""}
											{if $contact_list[contact]->contact_id == $contactObj->contact_id }
												{$selected="selected=\"selected\""}
											{/if}
											<option value="{$contact_list[contact]->contact_list_id}" {$selected}>{$contact_list[contact]->contact_list_name}</option>
										{/section}
										</select>
									</p>*}
									<p>
									<label>{$LANG.CONTACT_NAME}&nbsp;{$LANG.WARNINGADD}</label>
									{section name=contact loop=$contact_list}
										{section name=contactlist loop=$contactList}
												{$checked=""}
												{if $contact_list[contact]->contact_list_id ==$contactList[contactlist]}
													{$checked="checked=\"checked\""}
													{break}
												{/if}
										{/section}
									<input type="checkbox" {$checked} name="contact_list_id[]" id="contact_list_id" value="{$contact_list[contact]->contact_list_id}"/>{$contact_list[contact]->contact_list_name}&nbsp;
									{/section}
									</p>
									<p>
										<label>{$LANG.CONTACT_FIRST_NAME}</label>
										<input class="text-input small-input"type="text" name="contact_first_name" id="contact_first_name" value="{$contactObj->contact_first_name}"/>
									</p>
									<p>
										<label>{$LANG.CONTACT_SURNAME}</label>
										<input class="text-input small-input"type="text" name="contact_surname" id="contact_surname" value="{$contactObj->contact_surname}"/>
									</p>
									<p>
										<label>{$LANG.CONTACT_TITLE}</label>
										{*<input class="text-input small-input"type="text" name="contact_title" id="contact_title" value="{$contactObj->contact_title}"/>*}
										<select name="contact_title" id="contact_title" class="text-input small-input" >
										{if $contactObj->contact_title == 'Mr.'}
											<option value="Mr." selected="seklected">Mr.</option>
										{else}
											<option value="Mr.">Mr.</option>
										{/if}
										{if $contactObj->contact_title == 'Miss.'}
											<option value="Miss." selected="seklected">Miss.</option>
										{else}
											<option value="Miss.">Miss.</option>
										{/if}
										{if $contactObj->contact_title == 'Mrs.'}
											<option value="Mrs." selected="seklected">Mrs.</option>
										{else}
											<option value="Mrs.">Mrs.</option>
										{/if}
										</select>
									</p>
									<p>
										<label>{$LANG.CONTACT_EMAIL}</label>
										<input class="text-input small-input"type="text" name="contact_email" id="contact_email" value="{$contactObj->contact_email}"/>
									</p>
									<p>
										<label>{$LANG.CONTACT_MOBILE}</label>
										<input class="text-input small-input"type="text" name="contact_mobile" id="contact_mobile" value="{$contactObj->contact_mobile}"/>
									</p>
								{*	<p>
										<label>{$LANG.CONTACT_PHONE}</label>
										<input class="text-input small-input"type="hidden" name="contact_phone" id="contact_phone" value="0"/>
									</p>
									<p>
										<label>{$LANG.CONTACT_COUNTRY}</label>
										<input class="text-input small-input"type="hidden" name="contact_country" id="contact_country" value="0"/>
									</p>
									<p>
										<label>{$LANG.CONTACT_STATE}</label>
										<input class="text-input small-input"type="hidden" name="contact_state" id="contact_state" value="{$contactObj->contact_state}"/>
									</p>
									<p>
										<label>{$LANG.CONTACT_CITY}</label>
										<input class="text-input small-input"type="hidden" name="contact_city" id="contact_city" value="{$contactObj->contact_city}"/>
									</p>
									*}
									<p>
										<label>{$LANG.CONTACT_BIRTH_DATE}</label>
										{if $method=='update'}
										<input class="text-input small-input" type="text" name="contact_birth_date" id="contact_birth_date" value="{$contactObj->contact_birth_date}"/>
										{else}
										<input class="text-input small-input" type="text" name="contact_birth_date" id="contact_birth_date" value="{$smarty.now|date_format:'%Y-%m-%d'}"/>
										{/if}
									</p>
									<p>
										<label>{$LANG.CONTACT_ADDRESS}</label>
										<input class="text-input small-input"type="text" name="contact_address" id="contact_address" value="{$contactObj->contact_address}"/>
									</p>
									{*<p>
										<label>{$LANG.CONTACT_CREATE_TIME}</label>
										{if $method=='update'}
										<input class="text-input small-input" type="text" readonly="true" name="contact_create_time" id="contact_create_time" value="{$contactObj->contact_create_time}"/>
										{else}
										<input class="text-input small-input"type="text" name="contact_create_time" id="contact_create_time" value="{$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}"/>
										{/if}
									</p>*}
									<p>
									<label>{$LANG.CONTACT_REMARK}</label>
									<textarea  name="contact_remark" id="contact_remark" cols="50" rows="10">{$contactObj->contact_remark}</textarea>
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
<script type="text/javascript">
	$(document).ready(function(){
	
		$("#submit").click(function(){
			
			if($("#contact_mobile").val() == ""){
				alert("Please fill contact mobile!");
				$("#contact_mobile").focus();
				return false;
			}else{
				var regx=/^[0-9-+]+$/;
				 if(!regx.test($("#contact_mobile").val())){
					alert('Please enter a valid mobile');
					$("#contact_mobile").focus();
					return false;
					}
			}
			
			if($("#contact_first_name").val() == ""){
				alert("Please fill contact first name!");
				$("#contact_first_name").focus();
				return false;
			}
			
			if($("#contact_surname").val() == ""){
				alert("Please fill contact surname!");
				$("#contact_surname").focus();
				return false;
			}
			
		});
	});
</script>
