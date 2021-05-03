jQuery(document).ready(function ($) {
  var ajaxURL = woo_js.ajaxURL;

  $('#ajax-request').click(function () {
    var postdata = 'action=admin_add_ajax&param=first_ajax';

    $.post(ajaxURL, postdata, function (response) {
      console.log(response);
    });
  });
});
