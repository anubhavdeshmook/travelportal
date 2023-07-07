
$(document).ready(function() { 

  
  $('.owl-carousel.popular-travel-slider').owlCarousel({ 
    loop: true,
    autoplay:true,
      Nav:false,   
      responsive: {
        0: {
          items: 1,  
          margin: 0 
        }
      }
    });
    $('.owl-carousel.last-offer-slider').owlCarousel({
      loop: true,            
      autoplay:false,   
      responsive: {
        0: {
          items: 1,  
          margin: 0, 
          center:false 
        },
        768:{
          items: 2,
          center:false,   
          margin: 20 
        },
        1200:{
          items: 3,
          center:true,   
          margin: 30 
        }
      }
    });

  $('.owl-carousel.hot-month-slider').owlCarousel({
    loop: true,
    center:true,
    autoplay:true,  
    dots:false,             
    nav: true,  
    navText: ["<img src='images/hot-left.png'>","<img src='images/hot-right.png'>" ],
    responsive: {
      0: {
        items: 1, 
      }
    }
  });
  $('.owl-carousel.book-ticket-slider').owlCarousel({
    loop: true,
    center:true,
    autoplay:false,  
    dots:false, 
    nav:true,   
    navText: ["<img src='images/white-left.png'>","<img src='images/white-right.png'>" ],
    responsive: {
      0: {
        items: 1  
      }
    }
  });
  
  $('.owl-carousel.testimonial-slider').owlCarousel({
    loop: true,
    center:true,
    autoplay:false,             
    responsive: {
      0: {
        items: 1, 
      }
    }
  })
  
  
  // The slider being synced must be initialized first
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth:140,
    itemMargin: 6, 
    asNavFor: '#slider'
  });
  
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });


});

function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}



$('body').on('click',".show-reg", function(e){
  $('#log-form')[0].reset();
  $('#login-model').modal('hide');
  $('#reg-model').modal('show');
});


$('body').on('click',".show-forgot", function(e){
  
  $('#log-form')[0].reset();
  $('#login-model').modal('hide');
  $('#reset-pwd-model').modal('show');
});



$('body').on('click',".show-verification", function(e){
  
  $('#log-form')[0].reset();
  $('#login-model').modal('hide');
  $('#email-verification-model').modal('show');
});




$("#login-model").on("hidden.bs.modal", function () {
  var $alertas = $('#log-form');
  $alertas.validate().resetForm();
  $alertas.find('.error').removeClass('error');
});


$("#reg-model").on("hidden.bs.modal", function () {
  var $alertas = $('#reg-form');
  $alertas.validate().resetForm();
  $alertas.find('.error').removeClass('error');
});

setTimeout(function() {
  $('.hidesuccessmsg').fadeOut('fast');
}, 5000);


function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    
    var dropdowns = document.getElementsByClassName("dropdown-content-for-hotel-search");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function selectGuests() {
  document.getElementById("guestDropdown").classList.toggle("show_guest");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn_guests')) {
    
    var dropdowns = document.getElementsByClassName("dropdown-content-for-hotel-guests-search");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show_guest')) {
        openDropdown.classList.remove('show_guest');
      }
    }
  }
}



$(document).on("click",".dropbtn", function () {
  $(".dropdown-content-for-hotel-search").addClass('show');
  $(".dropdown-content-for-hotel-guests-search").removeClass('show_guest');
});

$(document).on("click",".dropbtn_guests", function () {
  $(".dropdown-content-for-hotel-search").removeClass('show');
  $(".dropdown-content-for-hotel-guests-search").addClass('show_guest');
});


$(document).on("click",".no_of_room", function () {
  var no_of_guests = $(this).text(); // or var clickedBtnID = this.id
  $(".dropbtn").val(no_of_guests);
  $(".dropdown-content-for-hotel-search").removeClass('show');
});


$(document).on("click",".no_of_guest", function () {
  var no_of_guests = $(this).text(); // or var clickedBtnID = this.id
  $(".dropbtn_guests").val(no_of_guests);
  $(".dropdown-content-for-hotel-guests-search").removeClass('show_guest');
});
