<script type="text/javascript">
{if $method=='add' || $method=='update'}
$(document).ready(function () { 
$(".tab").click(); 
}); 			
{/if}

$(document).ready(function () { 
	$("#contact_birth_date").datepicker({
		dateFormat:'yy-mm-dd',	
	});
}); 	
function del(url){
	if(!confirm("{$LANG.DELETE_THIS_RECORD}")){
		return;
	}else{				
		window.location=url;
	}
}
</script>