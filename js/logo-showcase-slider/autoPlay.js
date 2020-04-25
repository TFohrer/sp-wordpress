export const autoPlay = (embla, interval) => {
    const state = { timer: 0 };

    const play = () => {
        stop();
        requestAnimationFrame(
            () => (state.timer = window.setTimeout(next, interval))
        );
    };

    const stop = () => {
        window.clearTimeout(state.timer);
        state.timer = 0;
    };

    const next = () => {
        if (embla.canScrollNext()) {
            embla.scrollNext();
        } else {
            embla.scrollTo(0);
        }
        play();
    };

    return { play, stop };
};
