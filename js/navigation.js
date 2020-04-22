import Headroom from 'headroom.js';

(function(){

    function initHeadroom(){
        const header = document.querySelector(".masthead");
        // construct an instance of Headroom, passing the element
        const headroom  = new Headroom(header, {
            onTop: function(){
              document.body.style.paddingTop = 0;
            },
            onNotTop: function(){
                document.body.style.paddingTop = `${header.offsetHeight}px`;
            }
        });
        // initialise
        headroom.init();
    }

    initHeadroom();
})();
