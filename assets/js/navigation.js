import Headroom from "headroom.js";

(function () {
  const minWidth = 1020;
  const mqL = window.matchMedia(`(min-width: ${minWidth}px)`);

  function initHeadroom() {
    const isHome = document.body.classList.contains("home");

    const header = document.querySelector(".masthead");
    // construct an instance of Headroom, passing the element
    const headroom = new Headroom(header, {
      onTop: function () {
        if (!isHome && mqL.matches) {
          document.body.style.paddingTop = 0;
        }
      },
      onNotTop: function () {
        if (!isHome && mqL.matches) {
          document.body.style.paddingTop = `${header.offsetHeight}px`;
        }
      },
    });
    // initialise
    headroom.init();
  }

  initHeadroom();
})();
