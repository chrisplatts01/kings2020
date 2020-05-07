import $ from 'jquery';

window.$ = $;

$(function() {
  $('.wrapper').wrapInner('<div class="wrapper__inner"></div>');
});
