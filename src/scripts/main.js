import _    from 'lodash';
import $    from '../../node_modules/jquery/dist/jquery.js';
import isotope from '../../node_modules/isotope-layout/dist/isotope.pkgd.js'

$(function() {

  // Add wrapper and wrapper__inner classes for responsive layout
  $('.post-grid__heading, .rt-tpg-isotope-buttons, .rt-tpg-isotope').wrap('<div class="wrapper"></div>');
  $('.wrapper').wrapInner('<div class="wrapper__inner"></div>');

  // Smooth scroll #contactForm link
  var scrollToForm = ( function () {
    var $link = $('[href^="#"]');

    $link.on('click', function () {
      var $this = $(this);
      var href = $this.attr('href');
      var correction = $('#stickyHeader').height();
      var $target = $(href);

      $('html,body').animate({scrollTop: $target.offset().top - correction},'slow');

      return false;
    });
  })();

  // Fix home/ventures page post gallery layout
  // - 'The Post Grid' plugin isotope layout not optimal,
  // - so here the width classes are overwritten
  var fixIsotopeLayout = (function () {
    var $item = $('.isotope-item');
    var prefix = 'rt-col-';
    var sizes = ['xs-', 'sm-', 'md-', 'lg-'];
    var cols = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '24'];
    // var newClasses = 'rt-col-xs-12 rt-col-sm-6 rt-col-md-4 rt-col-lg-3 rt-col-xl-24';

    sizes.forEach(function (size) {
      cols.forEach(function (col) {
        $item.removeClass(prefix + size + col);
      });
    });
    // $item.addClass(newClasses);
  })();

  // Fix menu highlight
  var path = window.location.href;
  if (path.search('/ventures/') !== -1) {
    $('#navMain').find('.menu').find('.menu-item').first().addClass('current-menu-item');
  }

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
