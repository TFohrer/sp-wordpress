



"use strict";
var sp = sp || {};


/**
 * @param $ jquery
 */
sp.contentBox = function ($) {

    var $mainButton = $(".main-button"),
        //$buttonWrapper = $(".button-wrapper"),
        $ripple = $(".ripple"),
        //$layer = $(".layered-content"),
        $closeButton = $('.close-button'),
        $container = $('.content-box'),
        timeoutId,
        hoverTimeout = 1250,
        hoverLayerDelay = 1000;


    function hoverIn(){

        var $hoverButtonWrapper = $(this).find(".button-wrapper"),
                    $hoverLayer = $(this).find(".layered-content");

        if(!$hoverButtonWrapper.hasClass("clicked")){

            if (!timeoutId) {
                timeoutId = window.setTimeout(function() {
                    timeoutId = null; // EDIT: added this line
                    $hoverButtonWrapper.addClass("clicked");

                    setTimeout(function(){
                        layerAddClass($hoverLayer);
                    },hoverLayerDelay)
                }, hoverTimeout);
            }

        }
    }

    function clearHoverTimeout(){
        window.clearTimeout(timeoutId);
        timeoutId = null;
    }

    function hoverOut(){
        clearHoverTimeout();
        /*var $buttonWrapper = $(this).find(".button-wrapper"),
            $layer = $(this).find(".layered-content");*/

        /*$buttonWrapper.removeClass("clicked");
        $layer.removeClass("active");*/
    }

    function layerAddClass(layer){
        layer.addClass('active');
        $(this).dequeue();
    }


    function addEventListeners(){
        $container.mouseenter(hoverIn);
        $container.mouseleave(hoverOut);

        $mainButton.on("click", function(){
            var $buttonWrapper = $(this).closest(".content-box").find('.button-wrapper'),
                $layer = $(this).closest(".content-box").find(".layered-content");
            //$layer.addClass("active");
            if(!$buttonWrapper.hasClass("clicked")){
                clearHoverTimeout();
                $buttonWrapper.addClass("clicked");

                setTimeout(function(){
                    layerAddClass($layer);
                },hoverLayerDelay)
            }
        });


        $closeButton.on("click",function(){
            var $buttonWrapper = $(this).closest(".content-box").find('.button-wrapper'),
                $layer = $(this).parent();

            $buttonWrapper.removeClass("clicked");
            //$layer.removeClass("active");
            $layer.toggleClass("active");
        });

    }

    /**
     *
     */
    function init() {
        addEventListeners();
    }


    return {
        init: init
    }

};
