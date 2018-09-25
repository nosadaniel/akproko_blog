$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
  	animateOut: 'slideOutDown',
    animateIn: 'flipInX',
  	autoplay:1000,
    loop:true,
    margin:30,
    stagePadding:30,
    smartSpeed:450,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:4,
            nav:false,
            loop:true,
        }
    }
})
 
});