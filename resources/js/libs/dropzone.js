//
// dropzone.js
// Theme module
//

'use strict';

Dropzone.autoDiscover = false;

if(process.env.NODE_ENV == 'development'){
  window.Dropzone = require('dropzone');
} 

$(function() {

  //
  // Variables
  //

  var toggle = document.querySelectorAll('[data-toggle="dropzone"]');

  //
  // Functions
  //

  function globalOptions() {
    Dropzone.autoDiscover = false;
    Dropzone.thumbnailWidth = null;
    Dropzone.thumbnailHeight = null;
  }

  function init(el) {
    var currentFile = undefined;

    var elementOptions = el.dataset.options;
    elementOptions = elementOptions ? JSON.parse(elementOptions) : {};

    var defaultOptions = {
      previewsContainer: el.querySelector('.dz-preview'),
      previewTemplate: el.querySelector('.dz-preview').innerHTML,
      init: function() {
        this.on('addedfile', function(file) {
          var maxFiles = elementOptions.maxFiles;
          if (maxFiles == 1 && currentFile) {
            this.removeFile(currentFile);
          }
          currentFile = file;
        });
      }
    }
    var options = Object.assign(defaultOptions, elementOptions);

    // Clear preview
    el.querySelector('.dz-preview').innerHTML = '';

    // Init dropzone
    new Dropzone(el, options);
  }

  //
  // Events
  //

  if (typeof Dropzone !== 'undefined' && toggle) {
    globalOptions();

    [].forEach.call(toggle, function(el) {
      init(el);
    });
  }

});
