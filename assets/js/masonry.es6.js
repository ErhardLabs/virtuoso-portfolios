import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';

let grid = document.querySelector('.gallery_wrap.grid');
let msnry = new Masonry('.gallery_wrap.grid', {
  // OPTIONS
  itemSelector: '.grid-item',
  columnWidth: '.grid-sizer',
  percentPosition: true
});

new imagesLoaded( grid ).on( 'progress', function() {
  console.log('images loaded');
  // layout Masonry after each image loads
  msnry.layout();
});

