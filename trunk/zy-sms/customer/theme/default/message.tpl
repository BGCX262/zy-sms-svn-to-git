
{include file="$admin_theme/include/top.tpl"}
	
{include file="$admin_theme/include/left.tpl"}
		
		<div id="main-content"> <!-- Main Content Section with everything -->			
			
			{include file="$admin_theme/include/pageheader.tpl"}
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
						<form action="message.php?method=add" name="form" method="post" onsubmit="return checkMessage()">
										
			
						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.SEND_MESSAGES}
							</div>
						</div>
					
							{if $error_message}
								<div class="notification error png_bg">
									<a href="#" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
									<div>
									{$error_message}
									</div>
								</div>
								{/if}
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>{$LANG.MESSAGE_CONTENT}</label>
									<textarea  name="message_content" id="message_content" cols="70" rows="12"  onkeyup="javascript:checkCharacters(this.value);"></textarea><br />
									<input type="text" class="text-input" id="count" value="0" readonly size="1" maxlength="4"/>/<span id="max">160</span> <span id="des">{$LANG.CHARACTERS_ALLOWED}  </span><span id="credit" style="margin-left:30px;">1</span> {$LANG.CREDIT} 
								</p>
								<p id="contact_list" style="display:none;">
									<label>{$LANG.CHOOSE_CONTACT_LIST}<span style="margin-left:150px;color:red;"><a href="javascript:show(2);">{$LANG.ORDINARY_MOBILE_LIST}</a></span></label>
									{section name=contact loop=$contact_list}
										{section name=contactlist loop=$contactList}
												{$checked=""}
												{if $contact_list[contact]->contact_list_id ==$contactList[contactlist]}
													{$checked="checked=\"checked\""}
													{break}
												{/if}
										{/section}
									<input type="checkbox" {$checked} name="contact_list_id[]" id="contact_list_id" value="{$contact_list[contact]->contact_list_id}"/>{$contact_list[contact]->contact_list_name}({$contact_list[contact]->contact_list_count})&nbsp;&nbsp;
									{/section}
								</p>
								<p id="ordinary_list" >
									<label>{$LANG.ORDINARY_MOBILE_LIST}<span style="margin-left:150px;"><a href="javascript:show(1);">{$LANG.CHOOSE_CONTACT_LIST}</a></span></label>
									<textarea cols="70" rows="12" name="mobile_list" id="mobile_list"></textarea>
									
								</p>
								<p>
									<label>{$LANG.SEND_MESSAGES_FROM}</label>
									<select name="userapi_id">
									{section name=api loop=$api_list}
											{if $api_list[api]->api_type==0}
											<option value="{$api_list[api]->userapi_id}" selected="selected">{$LANG.SYSTEM_DEFAULT}</option>
											{else if}
											<option value="{$api_list[api]->userapi_id}">{$api_list[api]->sender_name}</option>
											{/if}
									{/section}
									</select>
									
										
								</p>
								<p>
								<label>{$LANG.NO_REPEAT_PHONE_NUMBER}</label>
								<input type="checkbox" checked="checked" name="norepeat" id="norepeat" value="1"/>{$LANG.YES}
								</p>
								<p>
								<input class="button" name="isentry" id="isentry" type="hidden" />
									<input class="button" name="submit" id="submit" type="submit" value="{$LANG.SUBMIT}" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
			</div> <!-- End .content-box -->
		
			<div class="clear"></div>
			

			
{include file="$admin_theme/include/foot.tpl"}
<script type="text/javascript">
function show(i){
	$("#contact_list").slideToggle();
	$("#ordinary_list").slideToggle();
}

function checkCharacters(text){
	/*var reg=/^[0-9\,]+$/;*/
		
	var reg=/[\u4e00-\u9fa5]+/;
	var chareacter_type="en";
	if(reg.test(text)){
		chareacter_type="unicode";
	}
	countCharacters($("#message_content").val(),chareacter_type);
}
function countCharacters(text,chareacter_type){

	var i=text.length;
		if(chareacter_type=="unicode"){
		if(i<=70){
			$("#count").attr("value",text.length);
			$("#max").text(70);
			$("#credit").text(1);
		}else if(i>70&&i<=140){
			$("#count").attr("value",text.length);
			$("#max").text(140);
			$("#credit").text(2);
		}else if(i>140&&i<=210){
			$("#count").attr("value",text.length);
			$("#max").text(210); 
			$("#credit").text(3);
		}else if(i>210&&i<=280){
			$("#count").attr("value",text.length);
			$("#max").text(280);
			$("#credit").text(4); 
		}else if(i>280){
		$("#count").attr("value",text.length);
			$("#count").attr("content",$("#message_content").attr("value",text.substr(0,612)));
			$("#count").attr("value",612);
			alert("Too long to sent");
			return false;
		}
	}else if(chareacter_type=="en"){
		if(i<=160){
			$("#count").attr("value",text.length);
			$("#max").text(160);
			$("#credit").text(1);
		}else if(i>160&&i<=306){
			$("#count").attr("value",text.length);
			$("#max").text(306);
			$("#credit").text(2);
		}else if(i>306&&i<=459){
			$("#count").attr("value",text.length);
			$("#max").text(459); 
			$("#credit").text(3);
		}else if(i>459&&i<=612){
			$("#count").attr("value",text.length);
			$("#max").text(612);
			$("#credit").text(4); 
		}else if(i>612){
		$("#count").attr("value",text.length);
			$("#count").attr("content",$("#message_content").attr("value",text.substr(0,612)));
			$("#count").attr("value",612);
			alert("Too long to sent");
			return false;
		}
	}
	//alert(i);
}
$("#ordinary_list").onkeyup(function(){
	//alert("123");
});           
function checkMessage(){
	if($("#message_content").val()==""){
		alert("Please entry the message content");
		$("#message_content").focus();
		return false;
	}
	if(document.getElementById("contact_list").style.display!="none"){
		var i=0;
		$("[name='contact_list_id[]']").each(function(m){				
				if($(this).attr("checked")==true){	
					i=i+1;
				}
		});
		if(i==0){
			alert("Please choose the contact list!");
			return false;
		}
		$("#isentry").attr("value","no");
	}else if(document.getElementById("ordinary_list").style.display!="none"){
		var reg=/^[0-9\,]+$/;	
		if(!reg.test($("#mobile_list").val())){
		   alert("Sorry,you must entry validate number.");
		   $("#mobile_list").focus();
		   return false;
		}
		$("#isentry").attr("value","yes");
	}
	
	return true;
}                                                                    
</script>
