/*js icon menu bar*/
function myFunction(x) {
    x.classList.toggle("change");
}

// ?jquery mobile
 (function($) {
          var $main_nav = $('#main-nav');
          var $toggle = $('.toggle');

          var defaultData = {
            maxWidth: false,
            customToggle: $toggle,
            // navTitle: 'All Categories',
            levelTitles: true,
            pushContent: '#container'
          };

          // add new items to original nav
          $main_nav.find('li.add').children('a').on('click', function() {
            var $this = $(this);
            var $li = $this.parent();
            var items = eval('(' + $this.attr('data-add') + ')');

            $li.before('<li class="new"><a>'+items[0]+'</a></li>');

            items.shift();

            if (!items.length) {
              $li.remove();
            }
            else {
              $this.attr('data-add', JSON.stringify(items));
            }

            Nav.update(true);
          });

          // call our plugin
          var Nav = $main_nav.hcOffcanvasNav(defaultData);

          // demo settings update

          const update = (settings) => {
            if (Nav.isOpen()) {
              Nav.on('close.once', function() {
                Nav.update(settings);
                Nav.open();
              });

              Nav.close();
            }
            else {
              Nav.update(settings);
            }
          };

          $('.actions').find('a').on('click', function(e) {
            e.preventDefault();

            var $this = $(this).addClass('active');
            var $siblings = $this.parent().siblings().children('a').removeClass('active');
            var settings = eval('(' + $this.data('demo') + ')');

            update(settings);
          });

          $('.actions').find('input').on('change', function() {
            var $this = $(this);
            var settings = eval('(' + $this.data('demo') + ')');

            if ($this.is(':checked')) {
              update(settings);
            }
            else {
              var removeData = {};
              $.each(settings, function(index, value) {
                removeData[index] = false;
              });

              update(removeData);
            }
          });
        })(jQuery);


        // end mobile
   $(".click-search").click(function (e) {
        e.preventDefault();
        $(this).parent().find('.nav-search').toggleClass('open');
     });

  
/*js home slider banner*/
$('#slider-home').owlCarousel({
    loop:true,
    margin:0,
    dots:true,
    nav:true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplaySpeed:1500,
      navText: ['<img src="images/prev.png" alt="">', '<img src="images/next.png" alt="">'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
$('.slider-team ').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    dots:true,
        autoplay:true,
    autoplayTimeout:2000,
    autoplaySpeed:1000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});
  $('.slider-large').owlCarousel({
        items:1,
        loop:false,
        center:false,
        margin:10,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        nav:true,
       
    });
   $('.slider-small').owlCarousel({
        items:5,
        loop:true,
        center:true,
        margin:37,
        URLhashListener:true,
        autoplayHoverPause:true,
        startPosition: 'URLHash',
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        nav:true,
         responsive:{
        0:{
            items:2,
            margin:10,
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
    });

 $('#ba-desktop').carousel({
     fullWidth: false,
      slidesPerScroll: 5,
      frontWidth: 260,
      frontHeight: 260,
      carouselWidth: 315,
      carouselHeight: 400,
      hMargin: 1.05,
      vMargin:1.05,
      autoplay: false,
      directionNav: true,
      reflection: false,
      shadow: false,
      autoplayTimeout: 5000,
      mouse: false,

      buttonNav: 'none'
      });
 $('.slider-img').owlCarousel({
    loop:true,
    margin:10,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
 $('.slider-kh').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
 $('.slider-video-sb').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp;<span class="gach">|</span>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
 $('.slider-mobile').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})