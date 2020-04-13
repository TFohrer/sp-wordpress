"use strict";
var sp = sp || {};


/**
 * @param $ jquery
 */
sp.forms = function ($) {


    /**
     *
     */
    function init() {

        $('form').find('.textfield,.textareafield').each(function() {
            var targetItem = $(this).parent();
            if ($(this).val()) {
                $(targetItem).parent().find('label').css({
                    'top': '10px',
                    'fontSize': '14px'
                });
            }
        });

        $('form').find('.textfield, .textareafield')
            .focus(function() {
                $(this).parent('.wpuf-fields').addClass('focus');

                $(this).parent().parent().find('label').animate({
                    'top': '10px',
                    'fontSize': '14px'
                }, 300);
            })
            .blur(function() {
                if ($(this).val().length == 0) {
                    $(this).parent('.wpuf-fields').removeClass('focus');
                    $(this).parent().parent().find('label').animate({
                        'top': '27px',
                        'fontSize': '100%'
                    }, 300);
                }
        });


        $('body').on('click','.show-form-button',function(e){
            e.preventDefault();
            var form = $(this).next('form');
            if(form){
                form.addClass('show-form');
            }
            $(this).hide();
        });
    }

    return {
        init: init
    }

};