$(document).ready(function () {
  function updateCategories() {

          var departmentSelect = $('#department');
          var el = $('#category');
          var selectedDepartmentOption = departmentSelect.find(":selected");
          var departmentId = selectedDepartmentOption.attr('data-department');

            $.each(el.children(), function (index, element) {
                element = $(element);
                if (element.attr('data-department') !== departmentId) {
                  if(element.attr('data-department') != 0)
                  {
                    element.hide();
                  }

                } else
                {
                    element.show();
                }
            });
            $("#category").val(0);
        }


  $(document).on('change', '#department', function (e) {
    updateCategories();
  });

  updateCategories();
})
