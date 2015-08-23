
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
								   <th>{$LANG.DEPARTMENT_NAME}</th>
								   <th>{$LANG.DEPARTMENT_REMARK}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
								
							</thead>
							<tbody>
							{section name=department loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$item[department]->department_id}</td>
									<td>{$item[department]->department_name}</td>
									<td>{$item[department]->remark}</td>
									<td>
										<!-- Icons -->
										{if {$item[department]->department_name} != 'manager'}
										 <a href="javascript:del('department.php?method=delete&department_id={$item[department]->department_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a>
										 {/if} 
										 <a href="department.php?method=updateForward&department_id={$item[department]->department_id}" title="{$LANG.UPDATE}">
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
					
						<form action="department.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post">
										
			
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.COMPANY_INFOMATION}
							</div>
						</div>
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<label>Department Name</label>
									<input class="text-input medium-input" type="text" id="department_name" name="department_name" value="{$departmentObj->department_name}" />
								</p>
								<input type="hidden" name="department_parent_id" value="0"/>
									<p>
									<label>{$LANG.REMARK}</label>
									<textarea  name="remark" id="remark" cols="50" rows="10">{$departmentObj->remark}</textarea>
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
			if($("#department_name").val() == ""){
				alert("Please fill department name!");
				$("#department_name").focus();
				return false;
			}
		});
	});
</script>
