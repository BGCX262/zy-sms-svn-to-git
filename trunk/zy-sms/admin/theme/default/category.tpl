{include file="$admin_theme/include/top.tpl"}
	
{include file="$admin_theme/include/left.tpl"}
		
		<div id="main-content"> <!-- Main Content Section with everything -->			
			
			{include file="$admin_theme/include/pageheader.tpl"}
			<script type="text/javascript">
				$(document).ready(function(){
				$("#submit").click(function(){
					if($("#category_name").val() == ''){
						alert('Please fill out the category name');
						$("#category_name").focus();
   						return false;
					}
					if($("#category_remark")== ''){
						alert('Please fill out the Remarks');
						  $("#category_remark").focus();
   						return false;
					}
					return true;
				});
				});
			</script>
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					{if $method=='add' || $method=='update'}
					{literal}
						<script language="JavaScript">							
							  $(document).ready(function () { 
		       					 $(".tab").click(); 
		   						 }); 			
						</script>
					{/literal}
					{/if}
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
								   <th>{$LANG.CATEGORY_NAME}</th>
								   <th>{$LANG.VIDEO_SORT}</th>
								   <th>{$LANG.REMARK}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
							</thead>
							<tbody>
							{section name=category loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>*}
									<td>{$item[category]->category_id}</td>
									<td>{$item[category]->category_name}</td>
									<td>{$item[category]->category_sort}</td>
									<td>{$item[category]->remark}</td>
									<td>
										<!-- Icons -->
										 <a href="javascript:del('category.php?method=delete&category_id={$item[category]->category_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> 
										 <a href="category.php?method=updateForward&category_id={$item[category]->category_id}" title="{$LANG.UPDATE}"">
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
					
						<form action="category.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post">
										
			
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.VIDEO_CATEGORY_INFOMATION}
							</div>
						</div>
						
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<input class="text-input medium-input" type="hidden" id="category_id" name="category_id" value="{$categoryObj->category_id}"/><!-- Classes for input-notification: success, error, information, attention -->
								</p>
								<p>
									<label>{$LANG.CATEGORY_NAME}</label>
									<input class="text-input medium-input" type="text" id="category_name" name="category_name" value="{$categoryObj->category_name}"/><!-- Classes for input-notification: success, error, information, attention -->
								</p>
								<p>
									<label>{$LANG.REMARK}</label>
									<textarea id="category_remark" name="category_remark" cols="59" rows="10">{$categoryObj->remark}</textarea>
								</p>
						
								<p>
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
