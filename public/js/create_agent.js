(function($) {
	"use strict";

	//accordion-wizard
	var options = {
		mode: 'wizard',
		autoButtonsNextClass: 'btn btn-primary float-right',
		autoButtonsPrevClass: 'btn btn-info',
		stepNumberClass: 'badge badge-pill badge-primary mr-1',

    beforeNextStep: function(currentStep){
      //console.log(currentStep);
			switch (currentStep) {
            case 1 :
                return verifyFirstSepts();
            case 2   :
                return verifySecondSepts();
						case 3   :
                return verifyThirdSepts();
            }
    }
	}
	$( "#form" ).accWizard(options);


})(jQuery);

function verifyFirstSepts()
{
	//console.log($(".name").val().length);
	if($(".name").val().length < 3){
		notif({
			msg: "<b>error:</b> Name should have minimum characters",
			type: "error"
		});
			return false;
	}

	if(validateEmail($(".email").val()) == false){
		notif({
			msg: "<b>error:</b> Please enter a valid email address",
			type: "error"
		});
		return false
	}

	return true;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function verifySecondSepts()
{
	if(validateMobileNumber($(".mobile").val()) == false){
		notif({
			msg: "<b>error:</b> Please enter a valid mobile number",
			type: "error"
		});
		return false;
	}
	if($(".address").val() == ""){
		notif({
			msg: "<b>error:</b> Address is required",
			type: "error"
		});
		return false;
	}
	return true;
}

function validateMobileNumber(mobileNumber)
{

	var phoneno = /^(88)?0?1[3456789][0-9]{8}\b/g;
  if(mobileNumber.match(phoneno))
     {
	   return true
	 }
   else
     {

	  	return false;
     }
}

function verifyThirdSepts()
{
	if($(".password").val().length < 5){
		notif({
			msg: "<b>error:</b> Your password must be at least 5 characters long",
			type: "error"
		});
			return false;
	}
	if($(".password").val() != $(".confirm_password").val()){
		notif({
			msg: "<b>error:</b> password and confirm password does not match",
			type: "error"
		});
			return false;
	}
	return true;
}
