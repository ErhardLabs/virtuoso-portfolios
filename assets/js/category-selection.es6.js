$=jQuery;
$(document).ready(function() {

  $('.category_selector .categories a').unbind().click(function(e) {

    e.preventDefault();
    let taxonomy = $(this).data('slug');

    $('.virtuoso_gallery .slider_wrap li').each(function() {

      if (taxonomy === '') {
        $(this).fadeIn();
      } else {
        if ($(this).data('tax') === taxonomy) {
          $(this).fadeIn();
        } else {
          $(this).fadeOut();
        }
      }

    });

  });

});
