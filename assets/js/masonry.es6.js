import Masonry from 'masonry-layout';

$ = jQuery;

$( document ).ready( function() {
  let msnry = new Masonry( '.gallery_wrap.grid', {

    // OPTIONS
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer'
  });
});
