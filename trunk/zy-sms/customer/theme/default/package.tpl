{include file="$admin_theme/include/top.tpl"}
	
{include file="$admin_theme/include/left.tpl"}
		
		<div id="main-content"> <!-- Main Content Section with everything -->			
			
			{include file="$admin_theme/include/pageheader.tpl"}
				
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
								   {*<th><input class="check-all" type="checkbox" /></th>*}
								    <th>{$LANG.ID}</th>
								   <th>{$LANG.VIDEO_PAGCKAGE_NAME}</th>
								   <th>{$LANG.VIDEO_PAGCKAGE_PRICE}</th>
								   <th>{$LANG.REMARK}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
							</thead>
							<tbody>
							{section name=package loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>*}
									<td>{$item[package]->package_id}</td>
									<td>{$item[package]->package_name}</td>
									<td>{$item[package]->package_price}</td>
									<td>{$item[package]->remark}</td>
									<td>
										<!-- Icons -->
										 <a href="javascript:del('package.php?method=delete&package_id={$item[package]->package_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> 
										 <a href="package.php?method=updateForward&package_id={$item[package]->package_id}" title="{$LANG.UPDATE}"">
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
					<script type="text/javascript">
						$(document).ready(function(){
							<!--视频包名-->
							$("#submit").click(function(){
								if($("#package_name").val()==''){
								alert('Please enter the package name.');
								$("#package_name").focus();
								return false;
								}
							<!--视频类别-->
								$count=$("input:checked").length;
								if($count == 0){
									alert('Please select video category name.');
									return false;
								}
								<!--视频价格-->
								if($("#package_price").val() == ''){
									alert('Please enter a video package price.');
									$("#package_price").focus();
									return false;
								}else if(isNaN($("#package_price").val())){
									alert('Please enter the number.');
									$("#package_price").focus();
									return false;
								}
								<!--视频备注-->
								if($("#package_remark").val() == ''){
									alert('Please enter a video package remark.');
									$("#package_remark").focus();
									return false;
								}
							});							
						});
					</script>
					<div class="tab-content" id="tab2">
					
						<form action="package.php?method={if $method!='update'}add{else}update{/if}" name="myform" method="post">
										
			
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.VIDEO_PACKAGE_INFOMATION}
							</div>
						</div>
						
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<input class="text-input medium-input" type="hidden" id="package_id" name="package_id" value="{$packageObj->package_id}"/><!-- Classes for input-notification: success, error, information, attention -->
								</p>
								<p>
									<label>{$LANG.VIDEO_PAGCKAGE_NAME}</label>
									<input class="text-input medium-input" type="text" id="package_name" name="package_name" value="{$packageObj->package_name}"/>
								</p>
								<p>
									<label>{$LANG.CATEGORY_NAME}</label>
									{section name=category loop=$category} 
										{section name=package_content loop=$package_content} 
											{$checked=""}
											{if {$category[category]->category_id}=={$package_content[package_content]->category_id}}
													{$checked="checked=\"checked\""}																
													{break}
											{/if}
										{/section}
										<input type="checkbox" id="package_category" name="package_category[]"  {$checked} value="{$category[category]->category_id}">{$category[category]->category_name}
									{/section}
								</p>
								<p>
									<label>{$LANG.VIDEO_PAGCKAGE_PRICE}</label>
									<input class="text-input medium-input"type="text" id="package_price" name="package_price" value="{$packageObj->package_price}"/>
								</p>
								<p>
									<label>{$LANG.REMARK}</label>
									<textarea  name="package_remark" id="package_remark" cols="59" rows="10">{$packageObj->remark}</textarea>
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
