import Headroom from "headroom.js";

(function () {
  function initHeadroom() {
    const isHome = document.body.classList.contains("home");

    const header = document.querySelector(".masthead");
    // construct an instance of Headroom, passing the element
    const headroom = new Headroom(header, {
      onTop: function () {
        if (!isHome) {
          document.body.style.paddingTop = 0;
        }
      },
      onNotTop: function () {
        if (!isHome) {
          document.body.style.paddingTop = `${header.offsetHeight}px`;
        }
      },
    });
    // initialise
    headroom.init();
  }

  initHeadroom();
})();
