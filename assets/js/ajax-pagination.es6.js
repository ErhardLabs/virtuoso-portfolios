// /wp/v2/posts?page=2&per_page=6&&orderby=date&order=desc&type=portfolio
// fetch('/wp-json/wp/v2/posts/?filter[post_type]=portfolio')
$=jQuery;

$(document).ready(function() {
  init_show_more_btn();
});

function init_show_more_btn() {
  $('.show_more').unbind().click(function(e) {

    let currentOffset = parseInt($(this).attr('data-offset'));
    let numberOfPosts = parseInt($(this).attr('data-number-of-posts'));
    let newOffset = currentOffset+numberOfPosts;

    let data = {};
    data.offset = newOffset;
    data.taxonomy = $(this).attr('data-taxonomy-slug');
    data.numberOfPosts = numberOfPosts;
    data.action = 'virtuoso_portfolio_display_posts';

    $.post(virtuoso_portfolio.ajaxurl, data, function(result) {
      $('.virtuoso_gallery .gallery_wrap').append(result);
      $('.show_more').attr('data-offset', newOffset);
      $('.show_more').remove();
      init_show_more_btn();
    });
  });
}
// MIGHT USE THIS LATER
// fetch('/wp-json/wp/v2/portfolio?offset='+newOffset+'&orderby=date&order=desc')
//     .then(function(response) {
//       return response.json();
//     })
//     .then(function(myJson) {
//
//       // let portfolioData = JSON.stringify(myJson);
//     });