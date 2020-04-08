$(document).ready(function(){
		 var i=1;
		 $('#add').click(function(){
					i++;
					$('#dynamic_field').append('<div class="row"><div class="col-sm-12"><div id="row'+i+'" class="d-flex my-1"><input type="text" name="category[]" placeholder="Enter your Category" class="form-control name_list" /><a type="button" name="remove" id="'+i+'" class=" btn_remove ml-1 my-2"><i class="fa fa-minus-circle text-danger button-style"></i></a></div></div></div>');
		 });
		 $(document).on('click', '.btn_remove', function(){
					var button_id = $(this).attr("id");
					$('#row'+button_id+'').remove();
		 });
});
