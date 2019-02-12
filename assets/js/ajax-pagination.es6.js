$ = jQuery;

// import display from './category-selection.es6';

$( document ).ready( function() {

  $( '.category_selector .categories a' ).first().addClass( 'active' );
  let masonryLayout = parseInt( $( '#projects' ).attr( 'data-masonry' ) );

  if ( masonryLayout ) {
    fetchPortfolioGalleryItems();
  } else {
    fetchPortfolioItems();
  }

});

function initShowMoreBtn() {
  $( '.show_more' ).unbind().click( function( e ) {

    let index = $( '.show_more' ).attr( 'data-index' );
    let allowShowMore = false;
    index++;

    $( '.virtuoso_gallery .gallery_wrap .portfolio_group_wrap' ).each( function() {
      if ( $( this ).data( 'index' ) == index ) {
        $( this ).addClass( 'visible' );
        $( '.show_more' ).attr( 'data-index', index );
      }

      let futureIndex = index + 1;

      if ( $( this ).data( 'index' ) == futureIndex ) {
        allowShowMore = true;
      }

    });

    if ( ! allowShowMore ) {
      $( '.show_more' ).removeClass( 'visible' );
    }

  });
}

function fetchPortfolioGalleryItems() {

  let data = {};
  data.portfolioID = $( '.category_selector .categories a.active' ).attr( 'data-id' );
  data.offset = parseInt( $( '#projects' ).attr( 'data-offset' ) );
  data.action = 'virtuoso_portfolio_display_gallery_items';

  $.post( virtuoso_portfolio.ajaxurl, data, function( result ) {

    if ( result.success ) {

      // console.log( result.data );

      let output = '';
      let i = 0;

      result.data.forEach( imageData => {

        // if ( 0 === i ) {
        //   output += '<div class="grid-sizer">';
        // } else {
        //   output += '<div class="grid-item">';
        // }

        output += '<div class="grid-item">';
          output += '<img src="' + imageData.url + '"/>';
          output += '<span>' + imageData.caption + '</span>';
        output += '</div>';

      });

      $( '.gallery_wrap' ).append( output );
      $( '.gallery_wrap.grid .grid-item' ).addClass( 'visible' );

      $( '#projects' ).attr( 'data-offset', data.offset + 6 );

    } else {
      console.log( result.data );
    }

  });

}

function fetchPortfolioItems() {

  let data = {};
  data.taxonomy = $( '#projects' ).attr( 'data-taxonomy-slug' );
  data.action = 'virtuoso_portfolio_display_posts';

  $.post( virtuoso_portfolio.ajaxurl, data, function( result ) {

    // REMOVE TRAILING "0"
    let filteredResults = removeTrailingZero( result );

    // SHOW MORE BUTTON NEEDS TO APPEAR AND RESULTS NEED TO BE PARSED INTO GROUPS OF 6 PORTFOLIOS
    let i = 0;
    let x = 0;
    let groupedPortfolioItems = [];

    filteredResults.parsedArrayResult.forEach( portfolio => {

      // MAKE GROUPINGS OF 6 PORTFOLIO ITEMS
      if ( 0 === i % 6 ) {
        x++;
        groupedPortfolioItems[x] = [];
        groupedPortfolioItems[x].push( portfolio );
      } else {
        groupedPortfolioItems[x].push( portfolio );
      }

      i++;

    });


    groupedPortfolioItems.splice( 0, 1 );

    $( '.virtuoso_gallery .gallery_wrap .portfolio_group_wrap' ).fadeOut();
    $( '.virtuoso_gallery .gallery_wrap .portfolio_group_wrap' ).remove();

    i = 0;
    let groupHtml = [];
    groupedPortfolioItems.forEach( group => {
      groupHtml[i] = '<div class=\'portfolio_group_wrap\' data-index=\'' + i + '\'>';
      groupHtml[i] += group.join( '' );
      groupHtml[i] += '</div>';
      i++;
    });


    $( '.virtuoso_gallery .gallery_wrap' ).html( groupHtml.join( '' ) );

    if ( 1 < groupHtml.length ) {

      $( '.virtuoso_gallery .gallery_wrap .portfolio_group_wrap' ).each( function() {
        if ( 0 == $( this ).data( 'index' ) ) {
          $( this ).addClass( 'visible' );
          $( '.show_more' ).attr( 'data-index', 0 );
        } else {
          $( this ).removeClass( 'visible' );
        }
      });

      $( '.show_more' ).addClass( 'visible' );
      initShowMoreBtn();

    } else {

      // DON'T SHOW "SHOW MORE" BUTTON BECAUSE ALL RESULTS ARE LOADED
      $( '.virtuoso_gallery .gallery_wrap .portfolio_group_wrap' ).addClass( 'visible' );
      $( '.show_more' ).removeClass( 'visible' );

    }

    // display.togglePortfolios();


  });


}

function removeTrailingZero( result ) {
  let parsedArrayResult = result.split( '</li>' );
  parsedArrayResult.pop();
  let stringResult = parsedArrayResult.join( '' );

  let filteredResults = [];
  filteredResults.parsedArrayResult = parsedArrayResult;
  filteredResults.stringResult = stringResult;
  return filteredResults;
}

export default {fetchPortfolioItems, initShowMoreBtn, fetchPortfolioGalleryItems};
