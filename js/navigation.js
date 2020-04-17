import Headroom from 'headroom.js';

(function(){

    function initHeadroom(){
        const header = document.querySelector("header");
        console.log(header);
        // construct an instance of Headroom, passing the element
        const headroom  = new Headroom(header);
        // initialise
        headroom.init();
    }

    initHeadroom();
})();
