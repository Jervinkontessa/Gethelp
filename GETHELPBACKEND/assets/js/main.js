$('.causes_active').owlCarousel({
    loop:true,
    margin:30,
  // autoplay:true,
    navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
    nav:false,
    dots:false,
  // autoplayHoverPause: true,
  // autoplaySpeed: 800,
    responsive:{
        0:{
            items:1,
            nav:false
  
        },
        767:{
            items:2,
            nav:false
        },
        992:{
            items:3,
            nav:false
        },
        1200:{
            items:3,
        }
    }
  });