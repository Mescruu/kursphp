
/**
 * Scroll management
 */
$(document).ready(function () {

    // Define the menu we are working with
    var menu = $('.editor');

    // Get the menus current offset
    var origOffsetY = menu.offset().top;

    /**
     * scroll
     * Perform our menu mod
     */
    function scroll() {

        // Check the menus offset.
        if ($(window).scrollTop() >= origOffsetY) {

            //If it is indeed beyond the offset, affix it to the top.
            $(menu).addClass('editor-fixed-top');

        } else {

            // Otherwise, un affix it.
            $(menu).removeClass('editor-fixed-top');

        }
    }

    // Anytime the document is scrolled act on it
    document.onscroll = scroll;

});