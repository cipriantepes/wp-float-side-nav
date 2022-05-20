// if window width is smaller than 1400 then set the side float to negative right
(function () {
    "use strict";
    var menu               = document.getElementById('menu-floating-menu');
    var menuItems          = menu.childNodes;
    var menuClass          = menu.className;
    var winSize            = 1400;
    var visibleButtonWidth = 40;
    var visibleButton;
    //console.log(menu);

    var adjustFloatButtons = function () {
        if (window.innerWidth < winSize) {
            menu.className = menuClass + ' peek-nav';
            //menu.style.width = menu.offsetWidth + 'px';
        } else {
            menu.className = menuClass;
            menu.removeAttribute('style');
        }
        setTimeout(function () {
            // menu.removeAttribute('style');
        }, 4000);
        menuItemHover();

        // Make the float side buttons slide to right on page load
        /*setTimeout(
         function () {
         $(slideMenu).find('a').animate({
         right: '-=120'
         }, 1000);
         },
         4000
         );*/

    };

    var menuItemHover = function (el) {
        for (var key in menuItems) {
            if (menuItems[key].nodeType == 1) {
                visibleButton = 0;
                if (menu.className.match(/peek-nav/i)) {
                    visibleButton = -menuItems[key].children[0].clientWidth + visibleButtonWidth + 'px';
                }

                menuItems[key].children[0].style.marginRight = visibleButton;
            }
        }
    };


    window.addEventListener('resize', adjustFloatButtons);
    window.addEventListener('load', adjustFloatButtons);

})();