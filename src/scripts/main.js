import _    from 'lodash';
import $    from '../../node_modules/jquery/dist/jquery.js';
import isotope from '../../node_modules/isotope-layout/dist/isotope.pkgd.js'

$(function() {

  // Fix wrapper and wrapper__inner classes for responsive layout
  $('.gallery__heading, .rt-tpg-isotope-buttons, .rt-tpg-isotope').wrap('<div class="wrapper"></div>');
  $('.wrapper').wrapInner('<div class="wrapper__inner"></div>');

  // Make page header sticky on scroll
  var stickyHeader = (function() {
    var $header = $('#pageHeader');
    var $window = $(window);
    var $stickyHeader = $('<div id="stickyHeader" class="sticky-header"></div>').prependTo('body');

    $header.clone().appendTo($stickyHeader);
    $stickyHeader.find('#pageHeader').removeAttr('id');

    $(window).on('scroll resize', function () {
      var headerHeight = $header.height();
      var pageScroll   = $window.scrollTop();

      if (pageScroll > headerHeight) {
        $stickyHeader.slideDown();
      } else {
        $stickyHeader.hide();
      }
    });
  })();
});
