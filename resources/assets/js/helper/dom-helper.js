/**
 * Checks if an given element has scrollbars
 */
(function($) {
    $.fn.hasScrollBar = function() {
        var e = this.get(0);
        return {
            vertical: e.scrollHeight > e.clientHeight,
            horizontal: e.scrollWidth > e.clientWidth
        };
    }
})(jQuery);


/**
 * Checks if an given element exists
 */
(function($){
    $.fn.exists = function() {
        return this.length > 0;
    };
})(jQuery);


/**
 * Resize all elements of a given selector to the tallest height
 */
(function($){
    $.fn.equalHeight = function(){
        var container = this.get(0),
            currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            topPostion,
            $el;

        $(container).each(function() {
            $el = jQuery(this);
            $($el).height('auto')
            topPostion = $el.position().top;

            if (currentRowStart != topPostion) {
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }
})(jQuery);