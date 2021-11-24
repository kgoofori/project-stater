//
// autosize.js
// Theme module
//

'use strict';

if(process.env.NODE_ENV == 'development'){
  window.autosize = require('autosize');
}

$(function() {
  
  //
  // Variables
  //

  var toggle = document.querySelectorAll('[data-toggle="autosize"]');

  //
  // Function
  //

  function init(el) {
    autosize(el);
  }


  //
  // Event
  //

  if (typeof autosize !== 'undefined' && toggle) {
    [].forEach.call(toggle, function(el) {
      init(el);
    });
  }

});