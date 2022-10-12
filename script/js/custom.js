

jQuery(function($) {
  "use strict";


	/* ----------------------------------------------------------- */
	/*  Fixed header
	/* -----------------------------------------------------------


	/* ----------------------------------------------------------- */
	/*  Mobile Menu
	/* ----------------------------------------------------------- */

	jQuery(".nav.navbar-nav li a").on("click", function() {
		jQuery(this).parent("li").find(".dropdown-menu").slideToggle();
		jQuery(this).find("li i").toggleClass("fa-angle-down fa-angle-up");
	});


	$('.nav-tabs[data-toggle="tab-hover"] > li > a').hover( function(){
    	$(this).tab('show');
	});


	/* ----------------------------------------------------------- */
  	/*  Site search
  	/* ----------------------------------------------------------- */



	 $('.nav-search').on('click', function () {
		 $('.search-block').fadeIn(350);
	});

	 $('.search-close').on('click', function(){
			  $('.search-block').fadeOut(350);
	 });



  	/* ----------------------------------------------------------- */
  	/*  Owl Carousel
  	/* ----------------------------------------------------------- */

  	//Trending slide

  	$(".trending-slide").owlCarousel({

			loop:true,
			animateIn: 'fadeIn',
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			nav:true,
			margin:30,
			dots:false,
			mouseDrag:false,
			slideSpeed:500,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			items : 1,
			responsive:{
			  0:{
					items:1
			  },
			  600:{
					items:1
			  }
			}

		});


  	//Featured slide

		$(".featured-slider").owlCarousel({

			loop:true,
			animateOut: 'fadeOut',
			autoplay:false,
			autoplayHoverPause:true,
			nav:true,
			margin:0,
			dots:false,
			mouseDrag:true,
			touchDrag:true,
			slideSpeed:500,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			items : 1,
			responsive:{
			  0:{
					items:1
			  },
			  600:{
					items:1
			  }
			}

		});

		//Latest news slide

		$(".latest-news-slide").owlCarousel({

			loop:false,
			animateIn: 'fadeInLeft',
			autoplay:false,
			autoplayHoverPause:true,
			nav:true,
			margin:30,
			dots:false,
			mouseDrag:false,
			slideSpeed:500,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			items : 3,
			responsive:{
			  0:{
					items:1
			  },
			  600:{
					items:3
			  }
			}

		});

		//Latest news slide


		//Latest news slide

		$(".more-news-slide").owlCarousel({

			loop:false,
			autoplay:false,
			autoplayHoverPause:true,
			nav:false,
			margin:30,
			dots:true,
			mouseDrag:false,
			slideSpeed:500,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			items : 1,
			responsive:{
			  0:{
					items:1
			  },
			  600:{
					items:1
			  }
			}

		});

		$(".post-slide").owlCarousel({

			loop:true,
			animateOut: 'fadeOut',
			autoplay:false,
			autoplayHoverPause:true,
			nav:true,
			margin:30,
			dots:false,
			mouseDrag:false,
			slideSpeed:500,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			items : 1,
			responsive:{
			  0:{
					items:1
			  },
			  600:{
					items:1
			  }
			}

		});



	/* ----------------------------------------------------------- */
	/*  Popup
	/* ----------------------------------------------------------- */
	  $(document).ready(function(){

			$(".gallery-popup").colorbox({rel:'gallery-popup', transition:"fade", innerHeight:"500"});

			$(".popup").colorbox({iframe:true, innerWidth:600, innerHeight:400});

	  });



	/* ----------------------------------------------------------- */
	/*  Back to top
	/* ----------------------------------------------------------- */

		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				 $('#back-to-top').fadeIn();
			} else {
				 $('#back-to-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-to-top').on('click', function () {
			 $('#back-to-top').tooltip('hide');
			 $('body,html').animate({
				  scrollTop: 0
			 }, 800);
			 return false;
		});

		$('#back-to-top').tooltip('hide');


});

$("#subscription").on("click", function(){
var email = document.getElementById('newsletter-form-email').value;

if (email == "") {
  alert("Error: Enter your email");
  return false;
}

var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
if(email.match(mailformat))
{

  document.getElementById("newsletter-form-email").disabled = true;
  document.getElementById("subscription").innerHTML = "<div id='loading'></div></div>";
  document.getElementById("subscription").disabled = true;

  $.ajax({
    type: 'POST',
    url: 'const/ajax/send-subscription.php',
    data: 'email=' + email,
    success: function (datab) {
    document.getElementById("newsletter-form-email").disabled = false;
    document.getElementById("newsletter-form-email").value = "";
    document.getElementById("subscription").innerHTML = "SUBSCRIBE";
    document.getElementById("subscription").disabled = false;
    alert(datab);
    }
  });

}
else
{
alert('Error: Invalid email address');
return false;
}


})
