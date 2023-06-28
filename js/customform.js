(function ($, Drupal,drupalSettings) {

    $.fn.datacheck = function() {
        // alert("working");
        $("#custom-user-details-form").submit();
        // $(document).ready(function(){
        //     $(".form-text").blur(function(){
        //       alert("This input field has lost its focus.");
        //     });
        //   });



        $(document).ready(function() {

            // $(".form-text").blur(function(){
            //           alert("This input field has lost its focus.");
            //         });
            //blur for temporary address.
            // $('#edit-temporary-address').blur(function(){
            //     alert("This input field has lost its focus.");
            //   });
            alert();
                // Get references to the checkbox and permanent address fields
                var checkbox = $('#edit-same-address');
                var permanentAddressFields = $('.form-item-permanent-address');

                // Hide permanent address fields on page load if checkbox is checked
                if (checkbox.is(':checked')) {
                  permanentAddressFields.hide();
                }

                // Attach a change event listener to the checkbox
                checkbox.on('change', function() {
                  // If checkbox is checked, hide the permanent address fields
                  if ($(this).is(':checked')) {
                    permanentAddressFields.hide();
                  } else {
                    // If checkbox is unchecked, show the permanent address fields
                    permanentAddressFields.show();
                  }
                });
              });

    };
    Drupal.behaviors.MyModuleBehavior = {
            attach: function(context, settings) {
                // get color_body value with "drupalSettings.mymodule.color_body"
                var color_body = drupalSettings.preethy_exercise.color_test;
                alert(color_body)
                $('body').css('background', color_body);
            }
        };

}(jQuery, Drupal,drupalSettings));




