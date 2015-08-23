
{include file="$admin_theme/include/top.tpl"}
	
{include file="$admin_theme/include/left.tpl"}
		
		<div id="main-content"> <!-- Main Content Section with everything -->			
			
			{include file="$admin_theme/include/pageheader.tpl"}
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					<form method="POST" enctype="multipart/form-data" id="method" action="excelImport.php">
					
					<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.IMPORT_EXPORT}
							</div>
						</div>
						<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								    
								<p>
									<label>{$LANG.CHOOSE_CONTACT_LIST}</label>
									{section name=contact loop=$contact_list}
									<input type="checkbox" {$checked} name="contact_list_id[]" id="contact_list_id" value="{$contact_list[contact]->contact_list_id}" />{$contact_list[contact]->contact_list_name}({$contact_list[contact]->contact_list_count})&nbsp;&nbsp;
									{/section}
								</p>
								<p>
								<label>{$LANG.IMPORT_FILE}&nbsp;{$LANG.WARNING}</label>
									<input type="file" name="file" id="file" class="text-input small-input">
									</p>
									<input type="submit" class="button" name="Submit" value="Import" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="button" class="button" name="Submit" onclick="down();" value="Download The Template" />
							</fieldset>
							<div class="clear"></div><!-- End .clear -->
					</form><p>
						<form method="POST"  action="exportCsv.php">
							<div class="notification information png_bg">
								<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
								<div>
								Export
								</div>
							</div>
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								    
								<p>
									<label>{$LANG.CHOOSE_CONTACT_LIST}&nbsp;{$LANG.WARNING}</label>
									{section name=contact loop=$contact_list}
									<input type="checkbox" {$checked} name="contact_list_id[]" id="contact_list_id" value="{$contact_list[contact]->contact_list_id}" />{$contact_list[contact]->contact_list_name}({$contact_list[contact]->contact_list_count})&nbsp;&nbsp;
									{/section}
								</p>
							</fieldset>
							{section name=contact loop=$contact_list}
								<input type="checkbox" name="contact_list_id[]" id="contact_list_id" value="{$contact_list[contact]->contact_list_id}" style= "display:none "/>
							{/section}
							<input type="submit" class="button" id="submit" name="submit" value="Export" />
									{*<a class="button" href="exportCSV.php">Export</a>*}
					</form>
					
					</div> <!-- End #tab2 -->        
					
			</div> <!-- End .content-box -->
		
			<div class="clear"></div>
			

			
{include file="$admin_theme/include/foot.tpl"}
<script type="text/javascript">
	function down(){
		window.location.href="downloadcsv.php?id=contact";
	}
</script>
