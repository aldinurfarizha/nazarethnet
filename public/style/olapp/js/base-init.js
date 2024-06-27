var eduappgt = {};

(function ($) {
    
	"use strict";
	
	var $window = $(window),
	$document = $(document),
	$body = $('body'),
    $sidebar = $('.fixed-sidebar');

    jQuery('.back-to-top').on('click', function () {
        $('html,body').animate({
            scrollTop: 0
        }, 1200);
        return false;
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        if('#events' === target){
            $('.fc-state-active').click();
        }
    });

	$(".js-sidebar-open").on('click', function () {
		var mobileWidthApp = $('body').outerWidth();
		if(mobileWidthApp <= 560) {
			$(this).closest('body').find('.popup-chat-responsive').removeClass('open-chat');
		}
        $(this).toggleClass('active');
        $(this).closest($sidebar).toggleClass('open');
        return false;
    });

    $window.keydown(function (eventObject) {
        if (eventObject.which == 27 && $sidebar.is(':visible')) {
            $sidebar.removeClass('open');
        }
    });

    $document.on('click', function (event) {
        if (!$(event.target).closest($sidebar).length && $sidebar.is(':visible')) {
            $sidebar.removeClass('open');
        }
    });

    $('[data-toggle=tab]').on('click', function(){
        if ($(this).hasClass('active') && $(this).closest('ul').hasClass('mobile-app-tabs')){
            $($(this).attr("href")).toggleClass('active');
            $(this).removeClass('active');
            return false;
        }
    });

	$(".js-expanded-menu").on('click', function () {
		$('.header-menu').toggleClass('expanded-menu');
		return false
	});

	$(".js-chat-open").on('click', function () {
		$('.popup-chat-responsive').toggleClass('open-chat');
		return false
	});
    $(".js-chat-close").on('click', function () {
        $('.popup-chat-responsive').removeClass('open-chat');
        return false
    });

	$(".js-open-responsive-menu").on('click', function () {
		$('.header-menu').toggleClass('open');
		return false
	});

	$(".js-close-responsive-menu").on('click', function () {
		$('.header-menu').removeClass('open');
		return false
	});

	eduappgt.CallToActionAnimation = function () {
		var controller = new ScrollMagic.Controller();

		new ScrollMagic.Scene({triggerElement: ".call-to-action-animation"})
			.setVelocity(".first-img", {opacity: 1, bottom: "0", scale: "1"}, 1200)
			.triggerHook(1)
			.addTo(controller);

		new ScrollMagic.Scene({triggerElement: ".call-to-action-animation"})
			.setVelocity(".second-img", {opacity: 1, bottom: "50%", right: "40%"}, 1500)
			.triggerHook(1)
			.addTo(controller);
	};

	eduappgt.ImgScaleAnimation = function () {
		var controller = new ScrollMagic.Controller();

		new ScrollMagic.Scene({triggerElement: ".img-scale-animation"})
			.setVelocity(".main-img", {opacity: 1, scale: "1"}, 200)
			.triggerHook(0.3)
			.addTo(controller);

		new ScrollMagic.Scene({triggerElement: ".img-scale-animation"})
			.setVelocity(".first-img1", {opacity: 1, scale: "1"}, 1200)
			.triggerHook(0.8)
			.addTo(controller);

		new ScrollMagic.Scene({triggerElement: ".img-scale-animation"})
			.setVelocity(".second-img1", {opacity: 1, scale: "1"}, 1200)
			.triggerHook(1.1)
			.addTo(controller);

		new ScrollMagic.Scene({triggerElement: ".img-scale-animation"})
			.setVelocity(".third-img1", {opacity: 1, scale: "1"}, 1200)
			.triggerHook(1.4)
			.addTo(controller);
	};

	eduappgt.SubscribeAnimation = function () {
		var controller = new ScrollMagic.Controller();

		new ScrollMagic.Scene({triggerElement: ".subscribe-animation"})
			.setVelocity(".plane", {opacity: 1, bottom: "auto", top: "-20", left: "50%", scale: "1"}, 1200)
			.triggerHook(1)
			.addTo(controller);

	};

	eduappgt.PlanerAnimation = function () {
		var controller = new ScrollMagic.Controller();

		new ScrollMagic.Scene({triggerElement: ".planer-animation"})
			.setVelocity(".planer", {opacity: 1, left: "80%", scale: "1"}, 2000)
			.triggerHook(0.1)
			.addTo(controller);

	};

	eduappgt.ContactAnimationAnimation = function () {
		var controller = new ScrollMagic.Controller();

		new ScrollMagic.Scene({triggerElement: ".contact-form-animation"})
			.setVelocity(".crew", {opacity: 1, left: "77%", scale: "1"}, 1000)
			.triggerHook(0.1)
			.addTo(controller);
	};

	$document.ready(function () {
		if ($('.call-to-action-animation').length) {
			eduappgt.CallToActionAnimation();
		}

		if ($('.img-scale-animation').length) {
			eduappgt.ImgScaleAnimation()
		}

		if ($('.subscribe-animation').length) {
			eduappgt.SubscribeAnimation()
		}

		if ($('.planer-animation').length) {
			eduappgt.PlanerAnimation()
		}

		if ($('.contact-form-animation').length) {
			eduappgt.ContactAnimationAnimation()
		}

        if (typeof $.fn.gifplayer !== 'undefined'){
            $('.gif-play-image').gifplayer();
        }
        if (typeof $.fn.mediaelementplayer !== 'undefined'){
            $('#mediaplayer').mediaelementplayer({
                "features": ['prevtrack', 'playpause', 'nexttrack', 'loop', 'shuffle', 'current', 'progress', 'duration', 'volume']
            });
        }

        $('.mCustomScrollbar').perfectScrollbar({wheelPropagation:false});

	});
})(jQuery);

eduappgt.Materialize = function () {
	$.material.init();

	$('.checkbox > label').on('click', function () {
		$(this).closest('.checkbox').addClass('clicked');
	})
};

$(document).ready(function () {
	eduappgt.Materialize();
});

eduappgt.FormValidation = function () {
	$('.needs-validation').each(function () {
		var form = $(this)[0];
		form.addEventListener("submit", function (event) {
			if (form.checkValidity() == false) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add("was-validated");
		}, false);
	});
};

$(document).ready(function () {
	eduappgt.FormValidation();
});

eduappgt.Bootstrap = function () {
	$('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	$('.selectpicker').selectpicker();
};

$(document).ready(function () {
	eduappgt.Bootstrap();
});

eduappgt.IsotopeSort = function () {
	var $containerSort = $('.sorting-container');
	$containerSort.each(function () {
		var $current = $(this);
		var layout = ($current.data('layout').length) ? $current.data('layout') : 'masonry';
		$current.isotope({
			itemSelector: '.sorting-item',
			layoutMode: layout,
			percentPosition: true
		});

		$current.imagesLoaded().progress(function () {
			$current.isotope('layout');
		});

		var $sorting_buttons = $current.siblings('.sorting-menu').find('li');

		$sorting_buttons.on('click', function () {
			if ($(this).hasClass('active')) return false;
			$(this).parent().find('.active').removeClass('active');
			$(this).addClass('active');
			var filterValue = $(this).data('filter');
			if (typeof filterValue != "undefined") {
				$current.isotope({filter: filterValue});
				return false;
			}
		});
	});
};

$(document).ready(function () {
	eduappgt.IsotopeSort();
});

eduappgt.StickySidebar = function () {
	var $header = $('#site-header');

	$('.eduappgt-sticky-sidebar').each(function () {

	var sidebar = new StickySidebar (this, {
		topSpacing: $header.height(),
		bottomSpacing: 0,
		containerSelector: false,
		innerWrapperSelector: '.sidebar__inner',
		resizeSensor: true,
		stickyClass: 'is-affixed',
		minWidth: 0
		})
	});
};

$(document).ready(function () {
	eduappgt.StickySidebar();
});