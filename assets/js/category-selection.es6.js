$=jQuery;
$(document).ready(function() {

  $('.category_selector .categories a').unbind().click(function(e) {

    e.preventDefault();
    let taxonomy = $(this).attr('data-taxonomy-slug');
    $('.show_more').attr('data-taxonomy-slug', taxonomy);

    $('.virtuoso_gallery .slider_wrap li').each(function() {

      if (taxonomy === '') {
        $(this).fadeIn();
      } else {
        if ($(this).attr('data-taxonomy-slug') === taxonomy) {
          $(this).fadeIn();
        } else {
          $(this).fadeOut();
        }
      }

    });

  });

});
