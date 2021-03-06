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


    video_with_image_overlay();
    
});

function is_mobile() {
    return window.matchMedia('(max-width:767px)').matches;
}


function video_with_image_overlay(){

    var player;
    var iframe;

    iframe = jQuery('.video-container iframe')[0];
    player = new Vimeo.Player(iframe);

    jQuery('.video-container .video-overlay img').click(function(){
        jQuery(this).parent().fadeOut();
        player.play();
    });
}


// global variable for the player
var player;

// this function gets called when API is ready to use
function onYouTubePlayerAPIReady() {
  // create the global player from the specific iframe (#video)
  player = new YT.Player('embed-video', {
    events: {
      // call this function when player is ready to use
      'onReady': onPlayerReady
    }
  });
}

function onPlayerReady(event) {
  
  // bind events
  var playButton = jQuery("#play-button");
//   playButton.addEventListener("click", function() {
//     player.playVideo();
//     playButton.parent().fadeOut();
//   });
  
  playButton.click(function(){
    playButton.parent().fadeOut();
    player.playVideo();
});


//   var pauseButton = document.getElementById("pause-button");
//   pauseButton.addEventListener("click", function() {
//     player.pauseVideo();
//   });
  
}

// Inject YouTube API script
var tag = document.createElement('script');
tag.src = "//www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);