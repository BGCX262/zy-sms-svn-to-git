
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
								   <th>{$LANG.SEND_TIME}</th>
								   <th>{$LANG.SUCCESS_COUNT}</th>
								    <th>{$LANG.FAIL_COUNT}</th>
								</tr>
								
							</thead>
							<tbody>
							{section name=history loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$item[history]->sms_record_id}</td>
									<td>{$item[history]->sms_record_time}</td>
									<td>{$item[history]->sms_success_count}</td>
									<td>{$item[history]->sms_fail_count}</td>
									
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
					      
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
		
			<div class="clear"></div>
			

			
{include file="$admin_theme/include/foot.tpl"}
