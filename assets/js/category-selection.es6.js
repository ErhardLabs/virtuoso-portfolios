$ = jQuery;
import ajax from './ajax-pagination.es6.js';

$( document ).ready( function() {

  $( '.category_selector .categories a' ).unbind().click( function( e ) {

    e.preventDefault();
    $( '.category_selector .categories a' ).removeClass('active');
    $( this ).addClass( 'active' );

    let taxonomy = $( this ).attr( 'data-taxonomy-slug' );
    $( '#projects' ).attr( 'data-taxonomy-slug', taxonomy );

    ajax.fetchPortfolioItems();

  });

});

// function togglePortfolios() {
//
//   let taxonomy = $( '#projects' ).attr( 'data-taxonomy-slug' );
//
//   // DISPLAY APPROPRIATE PORTFOLIO ITEMS
//   $( '.virtuoso_gallery .gallery_wrap .portfolio_group_wrap li' ).each( function() {
//
//     if ( 'undefined' === typeof taxonomy ) {
//       $( this ).fadeIn( 'slow' );
//     } else {
//       if ( $( this ).attr( 'data-taxonomy-slug' ) === taxonomy ) {
//         $( this ).fadeIn( 'slow' );
//       } else {
//         $( this ).fadeOut( 'fast' );
//       }
//     }
//
//   });
// }

// export default {togglePortfolios};
