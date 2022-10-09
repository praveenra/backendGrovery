$(document).ready(function(){	
	$('.mblnav').click(function(){	
	var chimg = $('#menucls').attr('src');
	if(chimg=='http://localhost/Grovery/public/web/images/mblnav.png'){
		$('#menu').slideDown();
		$('.profileview, .cartview').slideUp();
		$('#menucls').attr('src','http://localhost/Grovery/public/web/images/menucls.jpg');		
	}
	else{
		$('#menu').slideUp();
		$('#menucls').attr('src','http://localhost/Grovery/public/web/images/mblnav.png');	
	}
	});
	$('.profile').click(function(){
		$('.profileview').slideToggle();
		$('#menu, .cartview').slideUp();
		$('#menucls').attr('src','http://localhost/Grovery/public/web/images/mblnav.png');
	})
	$('.cart').click(function(){
		$('.cartview').slideDown();
		$('#menu, .profileview').slideUp();
		$('#menucls').attr('src','http://localhost/Grovery/public/web/images/mblnav.png');
	})
	$('.cls').click(function(){
		$('.cartview').slideUp();
	})
	$('.sidemenu').click(function(){
		$('.cate-menu').slideDown();		
	});
	$('#clsmenu').click(function(){
		$('.cate-menu').slideUp();		
	});
	$('.accsec').click(function(e){
		e.preventDefault();
		/* var accod=$('.accpara').hide();
		accod.slideUp();
		$(this).next().slideToggle();	 */
		 var $this = $(this);
  
    if ($this.next().hasClass('show')) {
        $this.next().removeClass('show');
        $this.next().slideUp(350);
    } else {
        $this.parent().find('.accpara').removeClass('show');
        $this.parent().find('.accpara').slideUp(350);
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);
    }
	});
	$('.adlst').click(function(){
		$('.overlay').slideDown();		
	});
	$('.addcls').click(function(){
		$('.overlay').slideUp();		
	});
	 $('.inforeview').click(function(){
		$('.filtermenu').slideToggle();		
	}) 
	/*$(window).scroll(function() {
    if ($(this).scrollTop()>900)
     {
        $('.filterbg').hide(1000);
     }
    else
     {
      $('.filterbg').show(1000);
     }
 });*/
 $(':radio').change(function() {
  console.log('New star rating: ' + this.value);
});
$('.sidenav').click(function(){
		$('.empleft').slideToggle();
	})
	$('.loupe').click(function(){
		$('.formsearch').slideDown();
	})
	$('.container .formsearch .formcls').click(function(){
		$('.formsearch').slideUp();
	})
	
	window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("header");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
});




