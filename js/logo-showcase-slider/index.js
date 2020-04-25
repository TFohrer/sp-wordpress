import EmblaCarousel from "embla-carousel";
import { autoPlay } from './autoPlay';

(function () {

    function initSlider() {
        const slider = document.querySelector('.logo-showcase-slider')
        const options = {
            align: 'start',
            loop: true
        }
        const embla = EmblaCarousel(slider, options);
        const autoPlayer = autoPlay(embla, 3000);

        embla.on("init", () => {
            autoPlayer.play();
        });

        slider.addEventListener("mouseenter", autoPlayer.stop, false);
        slider.addEventListener("mouseleave", autoPlayer.play, false);
        slider.addEventListener("touchstart", autoPlayer.stop, false);
        slider.addEventListener("touchend", autoPlayer.play, false);
    }

    initSlider();

}());


