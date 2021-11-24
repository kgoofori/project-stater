//global select
require('./libs/select2');

//global autosize
require('./libs/autosize');

// flat picker date picker
require('./libs/flatpickr');

//chart.js
require('./libs/charts')

require('./libs/tooltip')

if(!Array.prototype.last){
    Array.prototype.last = function(){
        return this[this.length -1]
    }
}

$(document).ready(() => {
    let links = document.querySelectorAll(`[href="${window.location.origin}${window.location.pathname}"]`)

    links.forEach((link) => { link.classList.add('active') })

    //closest 
    let closestNavs = $(links).closest('.collapse');

    if (closestNavs.length > 0) {
        document.querySelector(`[aria-controls="${closestNavs[0].id}"]`).setAttribute('aria-expanded', "true");
        closestNavs.addClass('show')
    }
})



// dropzone
// require('./libs/dropzone')