{include file="$admin_theme/include/top.tpl"}
	
{include file="$admin_theme/include/left.tpl"}
		
		<div id="main-content"> <!-- Main Content Section with everything -->			
			
			{include file="$admin_theme/include/pageheader.tpl"}
			<script type="text/javascript">
				<!--jQuery 验证-->
				$(document).ready(function(){
				<!--当点击submit时触发以下事件-->
				$("#submit").click(function(){
					<!--视频标题-->
					if($("#video_title").val() == ''){
						alert('Please fill in the name of the title.');
						$("#video_title").focus();
						return false;
					}
					<!--视频类别-->
					if($("#category").val() =='Please select'){
						alert('Please select the category name.');
						$("#category").focus();
						return false;
					}
					<!--content-->
						var content=CKEDITOR.instances.content.getData()
						if(content == ''){
							alert('Please enter the content.');
							return false;
						}
					<!--视频标签-->
					if($("#video_tags").val()==''){
						alert('Please fill out the video tag.');
						$("#video_tags").focus();
						return false;
					}
					<!--视频上传时间-->
					if($("#video_date").val()==''){
						alert('Please fill out the video upload time.');
						$("#video_date").focus();
						return false;
					}
					<!--视频上传文件-->
					if($("#video_file").val()==''){
						alert('Please fill out the video upload file.');
						$("#video_file").focus();
						return false;
					}
					<!--图片上传文件-->
					if($("#video_imagefile").val()==''){
						alert('Please fill out the video upload image file.');
						$("#video_imagefile").focus();
						return false;
					}
					<!--视频备注-->
					if($("#video_remark").val()==''){
						alert('Please fill out the video upload image file.');
						$("#video_remark").focus();
						return false;
					}
				});	
				});
				
			</script>
				{if $method=='add' || $method=='update'}
					{literal}
						<script language="JavaScript">							
							  $(document).ready(function () { 
		       					 $(".tab").click(); 
		   						 }); 			
						</script>
					{/literal}
					{/if}
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
								   <th>{$LANG.VIDEO_TITLE}</th>
								   <th>{$LANG.VIDEO_CONTENT}</th>
								   <th>{$LANG.VIDEO_DATE}</th>
								   <th>{$LANG.VIDEO_REMARK}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
							</thead>
							<tbody>
							{section name=video loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>*}
									<td>{$item[video]->video_id}</td>
									<td>{$item[video]->video_title}</td>
									<td>{$item[video]->video_content}</td>
									<td>{$item[video]->video_date}</td>
									<td>{$item[video]->remark}</td>
									<td>
										<!-- Icons -->
										 <a href="javascript:del('video_manager.php?method=delete&video_id={$item[video]->video_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a> 
										 <a href="video_manager.php?method=updateForward&video_id={$item[video]->video_id}" title="{$LANG.UPDATE}"">
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
					<!--{literal}
						<script type="text/javascript">	
							 $(document).ready(function(){
							 	$("#video_date").daterangepicker({arrows:true});
							 });
						</script>
					{/literal}-->
					<div class="tab-content" id="tab2">
					
						<form action="video_manager.php?method={if $method!='update'}add{else}update{/if}" name="upForm" method="post" enctype="multipart/form-data">
						
                        {if $ERROR_VIDEO_MESSAGE}
									<div class="notification error png_bg">
										<a href="#" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
										<div>
											{$ERROR_VIDEO_MESSAGE}
										</div>
									</div>
								{else}
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.VIDEO_VIDEO_INFOMATION}
							</div>
						</div>
						{/if}
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<input class="text-input medium-input" type="hidden" id="video_id" name="video_id" value="{$videoObj->video_id}"/>
								</p>
								<p>
									<label>{$LANG.VIDEO_TITLE}</label>
									<input class="text-input medium-input" type="text" id="video_title" name="video_title" value="{$videoObj->video_title}"/>
								</p>
								<p>
									<label>{$LANG.VIDEO_CATEGORIES}</label>
									<select id="category" name="category">
									<option>Please select</option>
									{section name=category loop=$category}
										{if {$category[category]->category_id}=={$videoObj->category_id} }
											<option value="{$category[category]->category_id}"  selected="selected">{$category[category]->category_name}</option>
										{else}
											<option value="{$category[category]->category_id}">{$category[category]->category_name}</option>
										{/if}
									{/section}
									</select>
								</p>
								<p>
									<label>{$LANG.VIDEO_CONTENT}</label>
									<textarea name="content" id="content" class="ckeditor">{$videoObj->video_content}</textarea>
									<!--<label>{$LANG.VIDEO_COUNT}</label>-->
									<input class="text-input medium-input" type="hidden" id="video_count" name="video_count" value="{$videoObj->video_count}"/>
								</p>
								<p>
									<label>{$LANG.VIDEO_TAGS}</label>
									<input class="text-input medium-input" type="text" id="video_tags" name="video_tags" value="{$videoObj->video_tags}"/>
								</p>
								<p>
									<label>{$LANG.VIDEO_DATE}</label>
									<input class="text-input medium-input" type="text" id="video_date" name="video_date" value="{$videoObj->video_date}"/>
								</p>
								<p>
									<label>{$LANG.UPLOAD_VIDEO}</label>
									<input class ="text-input medium-input" type="file" id ="video_file" name="video_file" size="48" value="{$videoObj->video_urlpath}">
								</p>
								<p>
									<label>{$LANG.UPLOAD_IMAGE}</label>
									<input class ="text-input medium-input" type="file" id ="video_imagefile" name="video_imagefile" size="48" value="{$videoObj->video_urlpath}">
								</p>
								<p>
									<label>{$LANG.REMARK}</label>
									<textarea  id="video_remark" name="video_remark" cols="59" rows="10">{$videoObj->remark}</textarea>
								</p>
								<p>
									<input class="button" name="submit" type="submit" id="submit" value="{$LANG.SUBMIT}" />
								</p>
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
						</form>
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
		
			<div class="clear"></div>
{include file="$admin_theme/include/foot.tpl"}
