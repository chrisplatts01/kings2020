import './styles/main.scss';
import $ from 'jquery';

window.$ = $;

// var jquery = require("jquery");
// window.$ = window.jQuery = jquery;


$(function() {
  $('.wrapper').wrapInner('<div class="wrapper__inner"></div>');
});
