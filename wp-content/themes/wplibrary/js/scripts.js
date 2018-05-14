jQuery(document).ready(function($){
    $(document.body).removeClass('no-js').addClass('js');

    // Toggle class on click
    $(document.body).on('click', '[data-toggle="class"][data-class]', function(event) {
        var $trigger = $(this);
        var $target = $($trigger.data('target') ? $trigger.data('target') : $trigger.attr('href'));

        if($target.length) {
            event.preventDefault();
            $target.toggleClass($trigger.data('class'));
            $trigger.toggleClass('classed');
        }
    });

	// Smooth anchor scrolling
	$('a[href*="#"]:not([data-toggle])').click(function(event) {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name="'+this.hash.slice(1)+'"]');
			if (target.length) {
                event.preventDefault();
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1000);
			}
		}
	});
    
    // polyfill for IE - startsWith
    if (!String.prototype.startsWith) {
      String.prototype.startsWith = function(searchString, position) {
        position = position || 0;
        return this.indexOf(searchString, position) === position;
      };
    }

	// Fix mobile 100vh change on address bar show/hide
    var lastHeight = $(window).height();
    var heightChangeTimeout = undefined;
    if(is_mobile()) {
        $('.vh').css('height', lastHeight);
    }
    (maybe_update_landing_height = function() {
        var winHeight = $(window).height();

        if(heightChangeTimeout !== undefined) {
            clearTimeout(heightChangeTimeout);
        }

        if(!is_mobile()) {
            $('.vh').css('height', '');
        }
        else if(Math.abs(winHeight - lastHeight) > 100) {
            heightChangeTimeout = setTimeout(function() {
                var winHeight = $(window).height();
                $('.vh').css('height', winHeight);
                lastHeight = winHeight;
            }, 50);
        }
    })();
    $(window).resize(maybe_update_landing_height);
});

function is_mobile() {
    return window.matchMedia('(max-width:767px)').matches;
}