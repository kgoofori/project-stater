//
// tooltip.js
// Theme module
//

'use strict';

$(function() {

  //
  // Variables
  //

  var toggle = document.querySelectorAll('[data-toggle="tooltip"]');


  //
  // Functions
  //

  function init(toggle) {
    $(toggle).tooltip();
  }


  //
  // Events
  //

  [].forEach.call(toggle, function(el) {
    init(el);
  });
  
});