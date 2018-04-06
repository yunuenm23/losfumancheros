window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("scrollingmenu").style.height = "80px";
        document.getElementById("scrollingmenu").style.background = "#000000";
    } else {
        document.getElementById("scrollingmenu").style.height = "100px";
        document.getElementById("scrollingmenu").style.background = "rgba(0,0,0,.5)";
    }
}

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

function scrollBtn() {
    document.body.scrollTop = 0; 
    document.documentElement.scrollTop = 0; 
} 



$(document).ready(function(){
	$("#theTarget").skippr({

	    transition: 'slide',
	    speed: 2000,
	    easing: 'easeOutQuart',
	    navType: 'block',
	    childrenElementType: 'div',
	    arrows: false,
	    autoPlay: true,
	    autoPlayDuration: 5000,
	    keyboardOnAlways: true,
	    hidePrevious: false

	});

}); 

$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    items:6,
    lazyLoad:true,
    loop:true,
    dots: true,
    autoplay: true,
	autoplayTimeout: 3000,
	autoplayHoverPause: true,

	stagePadding: 50,
	    loop:true,
	    margin:10,
	    nav:false,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:4
	        }
	    }

	});
});

function may(obj, id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}