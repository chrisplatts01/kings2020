import _       from 'lodash';
import $       from '../../node_modules/jquery/dist/jquery.js';
// import isotope from '../../node_modules/isotope-layout/dist/isotope.pkgd.js'

var Isotope = require('../../node_modules/isotope-layout/dist/isotope.pkgd.js');

$(function() {

  /**
   * Add wrapper and wrapper__inner classes for responsive layout
   */
  $('.post-grid__heading, .rt-tpg-isotope-buttons, .rt-tpg-isotope').wrap('<div class="wrapper"></div>');
  $('.wrapper').wrapInner('<div class="wrapper__inner"></div>');

  /**
   * Smooth scroll #contactForm link
   */
  // var scrollToForm = (function () {
  //   var $link = $('[href^="#"]');

  //   $link.on('click', function () {
  //     var $this = $(this);
  //     var href = $this.attr('href');
  //     var correction = $('#stickyHeader').height();
  //     var $target = $(href);

  //     $('html,body').animate({scrollTop: $target.offset().top - correction},'slow');

  //     return false;
  //   });
  // })();

  // Fix menu highlight
  // var path = window.location.href;
  // if (path.search('/ventures/') !== -1) {
  //   $('#navMain').find('.menu').find('.menu-item').first().addClass('current-menu-item');
  // }

  /**
   * Make page header sticky on scroll
   */
  var stickyHeader = (function () {
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

  var iso = new Isotope( '#isotope', {
    itemSelector: '.isotope_item',
    layoutMode: 'masonry'
  });

  var filterFns = {
    // show if number is greater than 50
    // numberGreaterThan50: function() {
    //   var number = $(this).find('.number').text();
    //   return parseInt( number, 10 ) > 50;
    // },
    // // show if name ends with -ium
    // ium: function() {
    //   var name = $(this).find('.name').text();
    //   return name.match( /ium$/ );
    // }
  };

  $('.filter-group').children('button').on( 'click', function() {
    var $thisButton = $(this);
    var $allButtons = $('.filter-group').children('button');
    var filterValue = $thisButton.attr('data-filter');

    console.log(filterValue);

    $allButtons.removeClass('selected');
    $thisButton.addClass('selected');

    filterValue = filterFns[ filterValue ] || filterValue;
    iso.arrange({ filter: filterValue });
  });

  /**
   * Show/hide tag clouds
   */
  (function () {
    var $tagsHeading = $('#tagsHeading');
    var $tagsWrapper = $('#tagsWrapper');

    $tagsWrapper.hide();

    $tagsHeading.on('click', function () {
      $tagsWrapper.slideToggle('slow');
      $tagsHeading.toggleClass('is-visible');
    });
  })();
});
