"use strict";
var sp = sp || {};


/**
 * @param $ jquery
 */
sp.buttons = function ($) {

    function rippleEffect(btn) {
        var self, ripple, size, rippleX, rippleY, eWidth, eHeight;

        btn = btn.not('[disabled], .disabled');

        btn.on('mouseenter', function(e) {
            self = $(this);

            // Disable right click
            if(e.button === 2) {
                return false;
            }

            if(self.find('.ripple').length === 0) {
                self.prepend('<span class="ripple"></span>');
            }
            ripple = self.find('.ripple');
            ripple.removeClass('animated');

            eWidth = self.outerWidth();
            eHeight = self.outerHeight();
            size = Math.max(eWidth, eHeight);
            ripple.css({'width': size, 'height': size});

            rippleX = parseInt(e.pageX - self.offset().left) - (size / 2);
            rippleY = parseInt(e.pageY - self.offset().top) - (size / 2);

            ripple.css({ 'top': rippleY +'px', 'left': rippleX +'px' }).addClass('animated');

            /*e.stopPropagation();

            var href = $(this).attr('href');

            if(href != '' && href != '#'){
                //delay page redirect to see full animation
                setTimeout(function() {window.location = href}, 800);
                return false;
            }*/


            /*setTimeout(function() {
                ripple.remove();
            }, 800);*/

        });

    }

    /**
     *
     */
    function init() {
        rippleEffect($('.x-btn'));
    }


    return {
        init: init
    }

};