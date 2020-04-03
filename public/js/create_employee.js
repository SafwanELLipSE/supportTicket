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
            }
    }
	}
$( "#form" ).accWizard(options);


})(jQuery);

function verifyFirstSepts()
{
  if($(".department").val() == 0){
		notif({
			msg: "<b>error:</b> Department should be Selected",
			type: "error"
		});
			return false;
	}


	return true;
}


function verifySecondSepts()
{
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

  if(validateMobileNumber($(".mobile").val()) == false){
    notif({
      msg: "<b>error:</b> Please enter a valid mobile number",
      type: "error"
    });
    return false;
  }

	return true;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
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
