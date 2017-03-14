// JavaScript Document

	   function userLogin(){
		    
			jQuery.post(baseUrl()+"ajaxhandler/ajaxhandler.php", {
                ajax_action: 'admin_login',
				email:$("#email").val(),
				password:$("#password").val(),
				},
            function (data) {
			   if(data!=''){
			    // loader(false);
			    //loader(true);
			   // alert('data is' + data);
			    //return false;
			     if(data==1){
					 redirect('dashboard.php');
					 return true;
					 
				  }else{
					alert('Invalid login credentials.');
					 return false;  
				  }  
				}
			   return false;
			});
		}
		
		
		
		// call loader 
		function loader(enableDisable){
		   
		   var enableDisable;
		   if(enableDisable){
		   		$(".overlay").show();
		   }else
		   	 	$(".overlay").hide();
		}
		
		
		// redirect
		
		function redirect(param){
		   var param;
		   if(param !=''){
			  window.location=baseUrl()+param;
			  return true;   
		   }
		   
		   	
		}
		
		//baseUrl 
		function baseUrl(){
		  var base_url = $(".admin_url").val();
		  return base_url;	
			
		}
		
		
		

$( document ).ready(function() {
    
	
	$(".login_btn").click(function(){
		loader(true);
		
		
		
				var password = $("#password").val();
				var email = $("#email").val();
				var result = true;
				
				if ($('#email').val().search(/^[0-9a-zA-Z]([\-.\w]*[0-9a-zA-Z]?)*@([0-9a-zA-Z][\-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,}$/) == -1){
					$("#email_field_wrap").addClass('has-error');
					$("#email_field_error").show();
					$("#email").focus();
					result  = false;
				}else{
				  $("#email_field_wrap").removeClass('has-error');
				  $("#email_field_error").hide();	
				}
				if (password =='' ||  password.length < 5){
					$("#password_field_wrap").addClass('has-error');
					$("#password_field_error").show();
					result  = false;
				}else{
				
				 $("#password_field_error").hide();
				 $("#password_field_wrap").removeClass('has-error');
				}
				if(result){
					userLogin();
				}
		     return false;	
		
		
	})
	
	
	 $('#driver_table span').on('click', 'a', function () {
		 if(confirm("Really want to delete ?")){
		 	deleteDriver($(this).attr('id'));
		 }
	})
	
	
});