/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work? 
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function($) {

var $event = $.event,
	$special,
	resizeTimeout;

$special = $event.special.debouncedresize = {
	setup: function() {
		$( this ).on( "resize", $special.handler );
	},
	teardown: function() {
		$( this ).off( "resize", $special.handler );
	},
	handler: function( event, execAsap ) {
		// Save the context
		var context = this,
			args = arguments,
			dispatch = function() {
				// set correct event type
				event.type = "debouncedresize";
				$event.dispatch.apply( context, args );
			};

		if ( resizeTimeout ) {
			clearTimeout( resizeTimeout );
		}

		execAsap ?
			dispatch() :
			resizeTimeout = setTimeout( dispatch, $special.threshold );
	},
	threshold: 150
};

})(jQuery);
 
 /*!
 * jQuery Cookie Plugin v1.3.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd && define.amd.jQuery) {
		// AMD. Register as anonymous module.
		define(['jquery'], factory);
	} else {
		// Browser globals.
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function raw(s) {
		return s;
	}

	function decoded(s) {
		return decodeURIComponent(s.replace(pluses, ' '));
	}

	function converted(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}
		try {
			return config.json ? JSON.parse(s) : s;
		} catch(er) {}
	}

	var config = $.cookie = function (key, value, options) {

		// write
		if (value !== undefined) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			value = config.json ? JSON.stringify(value) : String(value);

			return (document.cookie = [
				encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// read
		var decode = config.raw ? raw : decoded;
		var cookies = document.cookie.split('; ');
		var result = key ? undefined : {};
		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = decode(parts.join('='));

			if (key && key === name) {
				result = converted(cookie);
				break;
			}

			if (!key) {
				result[name] = converted(cookie);
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) !== undefined) {
			$.cookie(key, '', $.extend(options, { expires: -1 }));
			return true;
		}
		return false;
	};

}));


	$(document).ready(function(){
		
/*******************    EVENT HANDLERS  ***********************************/
	$(document).on('click', '.thumb', function(){
			makeLightBox(this);
		});
		
	//$(document).on('click', '.cover', function(){
	//	console.log('clicked');
	//		hideLightBox();
	//	});
	
		$(document).on('click', '#fullDisplay', function(){
			hideLightBox();
		});
				
		$(window).on("debouncedresize", function( event ) {
			setClientState();
		});


/*******************    EVENT HANDLERS  ***********************************/
		
	function makeLightBox(self){
			var imgName = $(self).find('img').attr('src');
			var fullName = imgName.replace('thumbs','full');
			console.log(imgName+' - '+fullName);
			
			// version 2:
			//ajax to method with checks if file exists for this clientState, produces it if nec and returns true
			// at which point the ajax can put the image into #fullDisplay
			
			
			$('#cover').show(500);
			$('#fullDisplay').show(500).html('<img src="'+fullName+'"/>');
			
	}
	
	function hideLightBox(){
	
		$('#cover').hide(500);
		$('#fullDisplay').hide(500);
	}
	// set the clientState
	 // how big is the display?
		//howBig();
		

		
	function setClientState(){
// the csfr data is essential if sessions is turned on
		var token = $.cookie("csrf_cookie_name");
		var data = {width: $('body').innerWidth(), csrf_SY_TEST: token };
// or this one, but it relies on the js being embedded on each page		
// http://blog.biernacki.ca/2011/12/enabling-csrf-protection-in-codeigniter-for-ajax-calls/
		//var data = {width: $('body').innerWidth(), <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' };
	
	
		$.ajax({
			url: '/ysgallery/setEnv',
			data: data,
			type: 'POST',
			success: function(stuff){
				$('#clientState').html('Client State: '+stuff);
			}
		});
	} // end howBig
	
	
	
	});