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
								   <th>{$LANG.PAGE_TITLE}</th>
								   <th>{$LANG.PAGE_CONTENT}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
								
							</thead>
							<tbody>
							{section name=page_arr loop=$page_arr}
								<tr>
									{*<td><input type="checkbox" /></td>c*}
									<td>{$page_arr[page_arr]->page_id}</td>
									<td>{$page_arr[page_arr]->page_title}</td>
									<td>{$page_arr[page_arr]->page_content}</td>
									<td>
										<!-- Icons -->
										 <a href="javascript:del('page.php?method=delete&page_id={$page_arr[page_arr]->page_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> 
										 <a href="page.php?method=updateForward&page_id={$page_arr[page_arr]->page_id}" title="{$LANG.UPDATE}">
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
						$("document").ready(function(){
							$("#submit").click(function(){
								<!--title-->
								if($("#page_title").val()==''){
									alert('Please enter the video title.');
									$("#page_title").focus();
									return false;
								}
								<!--content-->
								   var content=CKEDITOR.instances.content.getData()
								   if(content == ''){
								   		 alert('Please enter the content.');
								  	 return false;
								   }
							});
						});
					</script>
					<div class="tab-content" id="tab2">
					
						<form action="page.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post">
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.COMPANY_MANAGER_INFOMATION}
							</div>
						</div>	
								<p>
									<label>{$LANG.PAGE_TITLE}</label>
									<input class="text-input small-input" type="text" id="page_title" name="page_title"  value="{$pages->page_title}"/>
								</p>
								<p>
									<label>{$LANG.PAGE_CONTENT}</label>
									<textarea  name="content"  id="content" class="ckeditor" value="{$pages->page_content}">{$pages->page_content}</textarea>
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
