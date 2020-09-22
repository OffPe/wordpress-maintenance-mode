jQuery(function ($) {
  /**
   * SOCIAL LINKS
   */
  var social_el = $(".social");

  if (social_el.length > 0) {
    var link_target = social_el.data("target");

    if (link_target == 1) {
      social_el.find("a").attr("target", "_blank");
    }
  }

  /**
   * CONTACT FORM
   */
  if ($(".contact").length > 0) {
    // show form
    $(".contact_us").click(function () {
      var open_contact = $(this).data("open"),
        close_contact = $(this).data("close");

      $(".contact").fadeIn(700);
      $("." + open_contact).addClass(close_contact);
    });

    // validate form
    var contact_form = $(".contact_form");

    contact_form.validate({
      submitHandler: function (form) {
        var contact_form_data =
          "action=wpmm_send_contact&" + contact_form.serialize();

        $.post(
          wpmm_vars.ajax_url,
          contact_form_data,
          function (response) {
            if (!response.success) {
              alert(response.data);
              return false;
            }

            contact_form
              .parent()
              .append('<div class="response">' + response.data + "</div>");
            contact_form.hide();

            setTimeout(function () {
              $(".contact").hide();
              contact_form.parent().find(".response").remove();
              contact_form.trigger("reset");
              contact_form.show();
            }, 2000);
          },
          "json"
        );

        return false;
      }
    });

    // hide form
    $(".close-contact_form").on("click", function (e) {
      $(".contact").fadeOut(200);
    });

    $("body").on("click", ".contact", function (e) {
      if ($(e.target).hasClass("contact")) {
        var close_contact = $(".contact_us").data("close");
        $(".form", $(this)).removeClass(close_contact);

        $(this).fadeOut(200);
      }
    });
  }
});
