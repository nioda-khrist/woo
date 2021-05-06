jQuery(document).ready(function ($) {
  var ajaxURL = woo_js.ajaxURL;

  // send ajax request by click
  $('#ajax-request').click(function () {
    var postdata = 'action=admin_add_ajax&param=first_ajax';

    $.post(ajaxURL, postdata, function (response) {
      console.log(response);
    });
  });

  // send all form data to php after submit
  $('#personal-data').submit(function (event) {
    event.preventDefault();

    var alldata = $(this).serialize();
    alldata += '&action=admin_add_ajax&param=second_ajax';

    $.post(ajaxURL, alldata, function (response) {
      console.log(response);
    });
  });
});
