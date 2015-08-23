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
								  {* <th><input class="check-all" type="checkbox" /></th>*}
								    <th>{$LANG.ID}</th>
								   <th>{$LANG.CREDIT_NAME}</th>
								   <th>{$LANG.CREDIT_VOLUME}</th>
								   <th>{$LANG.CREDIT_PRICE}</th>
								   <th>{$LANG.CREDIT_CURRENCY}</th>
								    <th>{$LANG.CREDIT_STATUS}</th>
								   <th>{$LANG.CREDIT_SORT}</th>
								   <th>{$LANG.OPERATE}</th>
								</tr>
							</thead>
							<tbody>
							{section name=credit loop=$item}
								<tr>
									{*<td><input type="checkbox" /></td>*}
									<td>{$item[credit]->credit_id}</td>
									<td>{$item[credit]->credit_name}</td>
									<td>{$item[credit]->credit_volume}</td>
									<td>{$item[credit]->credit_price}</td>
									<td>{$item[credit]->credit_currency}</td>
									<td>
									{if $item[credit]->credit_status==2}
										{$LANG.ENABLE}								
									{/if}
									{if $item[credit]->credit_status==1}
										{$LANG.DISABLE}								
									{/if}
									</td>
									<td>{$item[credit]->credit_sort}</td>
									<td>
										<!-- Icons -->
										 <a href="javascript:del('credit.php?method=delete&credit_id={$item[credit]->credit_id}')" title="{$LANG.DELETE}">
										 <img src="{$admin_image}/icons/cross.png" alt="{$LANG.DELETE}" /></a>
										 <a href="credit.php?method=updateForward&credit_id={$item[credit]->credit_id}" title="{$LANG.UPDATE}"">
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
						$("#submit").click(function(){
							/*<!--username-->
							if($("#admin_login_name").val()==''){
								alert('Please enter the user name');
								$("#admin_login_name").focus();
								return false;
							}
							<!--password-->
							 if($("#admin_login_password1").val().length <'6' || $("#admin_login_password1").val().length >'16'){
								alert('Please enter your password length between 6-16.');
								$("#admin_login_password1").focus();
								return false;
							}
							<!--password-->
							if($("#admin_login_password2").val().length <'6' || $("#admin_login_password2").val().length >'16'){
								alert('Please enter your password length between 6-16.');
								$("#admin_login_password2").focus();
								return false;
							}
							if($("#admin_login_password1").val() != $("#admin_login_password2").val()){
								alert('Requires the same password twice');
								$("#admin_login_password1").focus();
								return false;
							}
							<!--remark-->
							if($("#admin_remark").val()==''){
								alert('Please enter the remark');
								$("#admin_remark").focus();
								return false;
							}
							});*/
						});
					</script>
					<div class="tab-content" id="tab2">

						<form action="credit.php?method={if $method!='update'}add{else}update{/if}" name="form" method="post" onsubmit="return CheckLogin()">

						<div class="notification information png_bg">
							<a href="javascirpt:void(0);" class="close"><img src="{$admin_image}/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							{$LANG.CREDIT_INFOMATION}						
							</div>
						</div>

							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<label>{$LANG.CREDIT_NAME}</label>
									<input class="text-input medium-input" type="text"  id="credit_name" name="credit_name" value="{$obj->credit_name}"/>
								</p>
								<p>
									<label>{$LANG.CREDIT_VOLUME}</label>
									<input class="text-input medium-input" type="text" id="credit_volume" name="credit_volume" value="{$obj->credit_volume}"/>
								</p>
								<p>
									<label>{$LANG.CREDIT_PRICE}</label>
									<input class="text-input small-input" type="text" id="credit_price" name="credit_price" value="{$obj->credit_price}"/>
								</p>
								<p>
									<label>{$LANG.CREDIT_CURRENCY}</label>
									<input class="text-input small-input" type="text" id="credit_currency" name="credit_currency" value="{$obj->credit_currency}"/>
								</p>
								<p>
									<label>{$LANG.CREDIT_STATUS}</label>								
									<select id="credit_status" name="credit_status">
									<option>{$LANG.PLEASE_SELECT}</option>
									<option value="2"  {if $obj->credit_status==2}selected="selected"{/if}>{$LANG.ENABLE}</option>
									<option value="1"  {if $obj->credit_status==1}selected="selected"{/if}>{$LANG.DISABLE}</option>
									</select>
								</p>
									<p>
									<label>{$LANG.CREDIT_SORT}</label>
									<input class="text-input small-input" type="text" id="credit_sort" name="credit_sort" value="{$obj->credit_sort}"/>
								</p>
								<p>
									<label>{$LANG.REMARK}</label>
									<textarea  name="credit_remark" id="credit_remark" cols="59" rows="10">{$obj->credit_remark}</textarea>
								</p>
								<p>
									<input type="hidden" name="credit_id" value="{$obj->credit_id}" />
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
 {literal}
<SCRIPT language="javascript">
function CheckLogin(){
var form=document.form;
if(((form.login_password1.value.length<3)||(form.login_password1.value.length>8))&&(form.login_password1.value!=""))
                  {
                  alert("密码必须是3-8位的字母或数字！");
                  form.login_password1.focus();
  return   false;
  }
  else   if(form.login_password1.value!=form.login_password2.value)
  {
  alert("两次输入的密码不同！");
  form.login_password2.focus();
  return   false;
  }
  else   if(form.login_password.value=="")
  {
  alert("登录密码不能为空！");
  form.login_password1.focus();
  return   false;
      }
  else   return   true;
}
</SCRIPT>
 {/literal}
