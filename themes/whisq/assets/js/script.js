(function($) {

$(document).ready(function(){  
  //cart quantity
  var count = 0;
  $('.qty').keyup(function() {
    var $th = $(this).attr('max');
    var $val = $(this).val();
    if($val > $th) {
      count = count + 1;
      $(this).css('border-color','red');
      $(this).val($th);
      if(count == 1) {
        $(this).after('<span class="qty-error">Max '+ $th +' product available.</span>');
      }
    } else {
      $(this).css('border-color','#000');
    }
  });

  //free shipping
  if($("#shipping_method_0_free_shipping2").length) {
    $('#shipping_method_0_flat_rate1').removeAttr("checked");
   $("#shipping_method_0_free_shipping2").attr("checked","checked"); 
   $("#shipping_method_0_free_shipping2").trigger("click").delay(500);

  if($("#shipping_method_0_free_shipping2").attr('checked') == 'checked'){
    $('#shipping_method_0_flat_rate1').parent().hide();
   }
  }

  $('.common-nav > li > a').css('pointer-events','none');

  if($('#active').hasClass('hide-next')){
    $('.hide-next').next().css('pointer-events','none');
  }

  if($('#pagination li:nth-child(2)').attr("id") == "active"){
    $('#pagination li:nth-child(1)').css('pointer-events','none');
  }

  $('.atcb-link').click(function(){
    if($('.atcb-list').hasClass('calendor')) {
      $('.atcb-list').removeClass('calendor');
    }
    else {
      $('.atcb-list').addClass('calendor');
    }
  });

$(window).on("load", function(){
	$('.test33').each(function() {
	label = $(this).find('label');
	labi = $(this).find('i');
	
	console.log(label);
	$(this).find('span').addClass('form-group');
$(this).find('span').find("input").attr("required","required");	
	$(this).find('span').append(label);
	$(this).find('span').append(labi);	
});
});
	 
//setting owl crousal
    $('#carousel01').owlCarousel({
    loop:false,
    margin:15,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        768:{
            items:3
        },
        980:{
            items:4
        }
    }
});

$('#carousel02').owlCarousel({
    loop: true,
    margin:0,
    nav:false,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:false,
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

$('#carousel03').owlCarousel({
    loop: true,
    margin:10,
    nav:false,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
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

  //adding class for add to card
  $('.product_type_simple').addClass('feature-btn');

  var $feture_height = $('.feature-item').height();
  var f = $feture_height + 45;
   
   $('.accessoriesused').click(function(){

   });
   
   
   
  //js for mobile navigation
  $('.menu-item-has-children').click(function(){
   $(this).children('.sub-menu').toggle();
  });

  //setting height for carousal
  if(window.innerWidth < 768 ){
    jQuery('#myCarousel').css('height','auto');
  }

  $("a[href='#top']").click(function() {
     $("html, body").animate({ scrollTop: 0 }, "slow");
     return false;
  });

  $(window).scroll(function() {    
    var scroll = $(window).scrollTop();    
    if (scroll <= 400) {
        $("#backtop").removeClass("back-top").addClass("remove-top");
    }
    else {
      $("#backtop").addClass("back-top").removeClass("remove-top");
    }

    if (scroll > 10) {
      $("header").addClass("sticky");
    }
    else {
      $("header").removeClass("sticky");
    }

    if (scroll > 1) {
      $('.user-profile').removeClass('profile-open');
      $('.user-profile').addClass('profile-close');
    }
});
  
  //js for opening menu
  $('.hamburger').click(function(){
  if($('.menu-main').hasClass('menu-open')){
    $('.filter').show();
    $('.cross').show();
    $('.menu-main').removeClass('menu-open');
    $('.menu-main').addClass('menu-close');
    $('body').css('position','static');
  } else {
    $('.filter').hide();
    $('.cross').hide();
    $('.menu-main').removeClass('menu-close');
    $('.menu-main').addClass('menu-open'); 
    $('body').css('position','fixed');
  }
  
  //js for hamburger
  if($(this).hasClass('hamb-open')){
    $(this).removeClass('hamb-open');
    $(this).addClass('hamb-close');
  } else {
    $(this).removeClass('hamb-close');
    $(this).addClass('hamb-open'); 
  }

});
  
//js for opening user profile
$('.user-btn').click(function(){
  $('.woocommerce-MyAccount-navigation').removeClass('open-menu');
    if($('.user-profile').hasClass('profile-open')){
    $('.user-profile').removeClass('profile-open');
    $('.user-profile').addClass('profile-close');
  } else {
    $('.user-profile').removeClass('profile-close');
    $('.user-profile').addClass('profile-open'); 
  }
});

//js for opening search 
$('.search-btn').click(function(e){
  e.stopPropagation();
    $('.sub-menu').removeClass('menu-open');
    if($('.dgwt-wcas-search-wrapp').hasClass('search-open')){
    $('.dgwt-wcas-search-wrapp').removeClass('search-open');
    $('.dgwt-wcas-search-wrapp').addClass('search-close');
    $('.fa-times').addClass('close-serach');
    $('.fa-search').removeClass('close-serach');
  } else {
    $('.dgwt-wcas-search-wrapp').removeClass('search-close');
    $('.dgwt-wcas-search-wrapp').addClass('search-open'); 
        $('.fa-times').removeClass('close-serach');
    $('.fa-search').addClass('close-serach');
  }
});

$('.dgwt-wcas-search-wrapp').click(function(e){
  e.stopPropagation();
});

$("html").on("click", function(){
  if($(".dgwt-wcas-search-wrapp").hasClass('search-open')) {
     $("dgwt-wcas-search-wrapp").addClass('search-close');
     $(".dgwt-wcas-search-wrapp").removeClass('search-open');
     $('.fa-times').addClass('close-serach');
     $('.fa-search').removeClass('close-serach');
    }
  });

$('html').click(function(){
  $('.sort-cat').hide();
});

$('.filter').click(function(e){
  e.stopPropagation();
})

  //js for foodhall locate
  $(".addwrap").fadeOut();
  
  $(".locate-list").on("click", function(){
	  $(".locate-list").css("box-shadow", "none");
	  $(".locate-list").css("background-color", "rgba(223, 223, 223, 0.05)");
	  $(this).css("box-shadow", " 0 0 15px rgba(0, 0, 0, 0.12)");
	  $(this).css("background-color", "#ffffff");
	  var id = $(this).attr("id");
    console.log(id);
    var $final_id = id.replace(" ", "");
    console.log($final_id);
	  if(id == 'all'){
		  $(".all").fadeIn();
		  $(".addwrap").fadeOut();
	  }
	  else{		  
		  $(".all").hide();
		  $(".addwrap").fadeOut();
		  $("."+$final_id+'-address').fadeIn();
	  }
  });
  
  $( ".cities" ).change(function() {
	  
  var changecity = $('#cities :selected').val();
	if(changecity=="city"){
	$(".citywrap").hide();
	$(".citywrap").fadeIn();	
	}
	else {
   $(".citywrap").hide();
   $("."+changecity).fadeIn();
   }
});

  //product listing
  $('#product_cats li').click(function(){
    $value = $(this).text();
    document.cookie = "cat name="+$value;
    document.cookie = "whisq_offset=0"; 
    location.reload();
  });

  $('.product').click(function(){
    document.cookie = "cat name = all";
  });

  $('.sub-menu li').click(function(e){
    $value = $(this).text();
	  e.stopPropagation();
    document.cookie = "cat name="+$value; 
  });

  //product listing pagination
    $('#pagination li').click(function(){
    $offset_value = $(this).val();
    document.cookie = "whisq_offset ="+$offset_value;
    $('html, body').scrollTop(0);
    location.reload();
  });
  
 $('#pagination #next').click(function(){
   $offset_value = $('#pagination #active').val();
   $final = $offset_value + 9;
   document.cookie = "whisq_offset ="+$final;
   $('html, body').scrollTop(0);
   location.reload();
 });  

 $('#pagination #prev').click(function(){
   $offset_value = $('#pagination #active').val();
   if($offset_value > 0) {
   $final = $offset_value - 9;
   document.cookie = "whisq_offset ="+$final;
   $('html, body').scrollTop(0);
   location.reload();
   }
 });

//short by
$('.sort-cat li').click(function(){
    $value = $(this).attr("value");
    document.cookie = "short_cat="+$value;
    document.cookie = "whisq_offset ="+"0";
    $('html, body').scrollTop(0);
    location.reload().delay(3000);
});

  //category
  $('.category li').click(function(){
    $value = $(this).text();
    document.cookie = "category name="+$value;
    $('html, body').scrollTop(0);
    location.reload();
  });

$('html').click(function(){
  if($('a').hasClass('.continue-shopping')) {
    location.reload();
  }
});

//zoom error creating problem for media query
$(document).keydown(function(event) {
if (event.ctrlKey==true && (event.which == '61' || event.which == '107' || event.which == '173' || event.which == '109'  || event.which == '187'  || event.which == '189'  ) ) {
        event.preventDefault();
     }
});

$(window).bind('mousewheel DOMMouseScroll', function (event) {
       if (event.ctrlKey == true) {
       event.preventDefault();
       }
});
 //zoom error closed
 
	$("#all").trigger("click");
	
	
	
	if(window.innerWidth <= 1024 ){
	
	$(".left-side-bar h4").click(function(){
        $(".sort-cat").hide(500);
        $("#product_cats").slideToggle(500);		
		$(".left-side-bar h4").toggleClass('caticorotate');
		
    });
	
	$(".short-by h4").click(function(){
		$("#product_cats").hide(500);
        $(".sort-cat").slideToggle(500);
		$(".left-side-bar h4").removeClass('caticorotate');
    });
	
	
	}
	
	
	if(window.innerWidth > 1024 ){
	$(".short-by h4").click(function(){
        $(".sort-cat").slideToggle();
		$(this).toggleClass('addinline');
    });
		}
	
  $(".single-recipes .recipe").addClass('recipelisthide');	
  $(".single-recipes .related-accesories").removeClass('recipelisthide');
	$(".youmaylike").click(function(){		
		$(".single-recipes .recipe").addClass('recipelisthide');
        $(".single-recipes .related-accesories").removeClass('recipelisthide');
    });
	
	$(".accessoriesused").click(function(){
        $(".single-recipes .related-accesories").addClass('recipelisthide');
		$(".single-recipes .recipe").removeClass('recipelisthide');
    });
		
		
	if(window.innerWidth < 1025 ){
	$(".recipe-sidebar .category ul").hide();
	$(".recipe-sidebar .category h3").click(function(){
        $(".recipe-sidebar .category ul").slideToggle();
		$(".recipe-sidebar .category h3").toggleClass('caticorotate');
		$(this).toggleClass('addinline');
    });
	
	}		
	
			if(window.innerWidth > 1024 ){
   var maxHeight = -1;

   $('.recipes-page-list p').each(function() {
     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
   });

   $('.recipes-page-list p:nth-child(3)').each(function() {
     $(this).height(maxHeight);	 
   });
   
		}
		
	if(window.innerWidth > 768 ){
   var maxHeight = -1;

   $('.feature-recipes-list p').each(function() {
     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
   });

   $('.feature-recipes-list p:nth-child(3)').each(function() {
     $(this).height(maxHeight);
   });
		}
		
if(window.innerWidth > 768 ){
   var maxHeight = -1;

   $('.event-excerpt p').each(function() {
     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
   });

   $('.event-excerpt p:first-child').each(function() {
     $(this).height(maxHeight);
   });
		}		

		if(window.innerWidth > 768 ){
   var maxHeight = -1;

   $('.thumbContent address').each(function() {
     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
   });

   $('.thumbContent address').each(function() {
     $(this).height(maxHeight);
   });
		}
		
	$(".select-extra li").click(function () {
    $(".select-extra li").removeClass("active");
    $(this).addClass("active");   
});

if(window.innerWidth > 768 ){
   var maxHeight = -1;

   $('.thumbContent h3').each(function() {
     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
   });

   $('.thumbContent h3').each(function() {
     $(this).height(maxHeight);
   });
		}
		
	$(".select-extra h3").click(function () {
    $(".select-extra h3").removeClass("active");
    $(this).addClass("active");   
});

 //share icon
$('.share-icon').css('display','none');
$('.shareact').click(function(){	 
	 $(this).next().toggle('slow');
   // $(this).children('.share-icon').toggle('slow');

 });   
 
 //event page scripts
 $('.atcb-link').addClass('btn');
 

 $('.event-cat li').click(function(){
    $value = $(this).attr("value");
    document.cookie = "event_cat="+$value;
    location.reload();
});  

 
 $(".eventsort-by h4").click(function(){
        $(".event-cat").slideToggle();
		$(this).toggleClass('addinline');
    });


var node = $(".media-date").contents().filter(function () { return this.nodeType == 3 }).first(),
        text = node.text(),
        first = text.slice(0, text.indexOf(" "));
        var $month = first.trim()
        console.log($month);

        if($month == 'September') {
          $(this).addClass('remove');
        }
    
     $(".media-short h4").click(function(){
        $(".event-catagory").slideToggle();
    });

    $(".media-short-year h4").click(function(){
        $(".event-catagory-year").slideToggle();
    });

    $(".event-catagory li").on("click", function(){
      var x = $(this).attr("value");
      $(".media-short h4").text(x);
      document.cookie = "media_month="+x;
      var $year = $.cookie('media_year');
      $(".media-list").hide();
      if($(".media-list").hasClass(x) && $(".media-list").hasClass($year)) {
        $("."+ x+"."+$year).fadeIn();
        $('.no-media').hide();
        } 
        else {
        $('.no-media').show();
      }
      $(".event-catagory").css('display','none');
    });

    $(".event-catagory-year li").on("click", function(){
      var x = $(this).attr("value");
      document.cookie = "media_year="+x;
      var $month = $.cookie('media_month');
      console.log(x +' and '+ $month);
       $(".media-short-year h4").text(x);
      $(".media-list").hide();
      if($(".media-list").hasClass(x) && $(".media-list").hasClass($month)) {
        $("."+ x+"."+$month).fadeIn();
        $('.no-media').hide();
      } else {
        $('.no-media').show();
      }
      $(".event-catagory-year").css('display','none');
    });
    
    if($("#shipping_method_0_free_shipping2").attr('checked') == 'checked'){
      $('#shipping_method_0_flat_rate1').parent().hide();
    }

$(".cross").on("click", function(){
     $(".woocommerce-MyAccount-navigation").toggleClass('open-menu');
     $('.woocommerce-MyAccount-content').toggleClass('back-index');
     $('.user-profile').removeClass('profile-open');
     $('.user-profile').addClass('profile-close');
   });

   $(window).on("scroll", function(){
     var windowscroll = $(window).scrollTop();
     if(windowscroll > 10){
       $(".woocommerce-MyAccount-navigation").addClass('position-adjust');
     }
     else{
       $(".woocommerce-MyAccount-navigation").removeClass('position-adjust');
     }
   });

//cart page
$('.update-cart').click(function(){
  location.reload();
});

$('.page-template-my-cart .product-remove a').click(function(){
  location.reload();
  $('html, body').css('overflow', 'hidden');
  setTimeout(function(){$('html, body').css('overflow', 'visible');}, 1000);
});

$('.continue-shopping').removeAttr('href');
$('.continue-shopping').click(function(){
    location.reload();
});

//pop up script
   $('.pop-up').click(function(e){
    e.stopPropagation();
    $(this).addClass('pop-up-open');
    $('.pop-up-close').show();
    $('body').css('position','fixed');
    var $im = $('.pop-up-open').children('a').height();
    var $wh = $(window).height();
    console.log($im + ' and ' + $wh);
    if($im > 600 ) {
      $('.pop-up-open').addClass('pop-up-over');
    }
   });

   $('.pop-up-close').click(function(){
    $('.pop-up').removeClass('pop-up-open');
     $('.pop-up').removeClass('pop-up-over');
    $('.pop-up-close').hide();
    $('body').css('position','static');
   });

  $('.pop-up-open').click(function(){
    console.log("nmdcn,snd,jsandjsand");
    $('.pop-up').removeClass('pop-up-open');
    $('.pop-up-close').hide();
   });

  // $('.media-content').click(function(){
  //   $(this).next().addClass('pop-up-open');
  //   $(this).next().show();
  //   $('.pop-up-close').show();
  //   $('body').css('position','fixed');
  // });

  $('.media-wrap .pop-up-close').click(function(){
    $('.media-content-popup').removeClass('pop-up-open');
    $('.media-content-popup').hide();
    $('.pop-up-close').hide();
    $('body').css('position','static');
  });

  $('#menu-item-284 a').on('click', function(event) {
      event.preventDefault(); 
      var $loc = $(this).attr('href');
      document.cookie = "whisq_offset=0"; 
      setTimeout(redirect, 500);
        function redirect(){
          window.location = $loc;
        }
   });

    $('h1 a, nav li a, .footer-section li a, .recipe-page-img a').on('click', function(event) {
      event.preventDefault(); 
      var $loc = $(this).attr('href');
      document.cookie = "whisq_offset=0"; 
      document.cookie = "category name="+""; 
      setTimeout(redirect, 500);
        function redirect(){
          window.location = $loc;
        }
   });

    $('.res-category').on('click', function(event) {
      event.preventDefault(); 
      document.cookie = "whisq_offset=0";  
      setTimeout(redirect, 500);
        function redirect(){
          location.reload();
        }
   });

  $('#menu-item-675 a').on('click', function(event) {
      event.preventDefault(); 
      var $loc = $(this).attr('href');
      document.cookie = "whisq_offset=0";  
      setTimeout(redirect, 500);
        function redirect(){
          window.location = $loc;
        }
   });

   });

$(document).ready(function(){
    $(".question").on("click", function(){
      $(this).parent().hasClass("active")
      if($(this).parent().hasClass("active")){
        $(".qa-body").removeClass("active");
        $(this).parent().removeClass("active");
      }
      else{
        $(".qa-body").removeClass("active");
        $(this).parent().addClass("active");
      }
    });
  });

})(jQuery);


