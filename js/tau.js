jQuery(document).ready( function($){
  
   
  //fancybox
  $(".fancybox-thumb, article a[href$='.jpg'], article a[href$='.png'], article a[href$='.gif']").attr('rel', 'fancybox-thumb').addClass('fancybox-thumb').fancybox({
    
   beforeShow : function() {
        var alt = this.element.find('img').attr('alt');
        
        this.inner.find('img').attr('alt', alt);
        
        this.title = alt;
    },
        openEffect	: 'elastic',
    	closeEffect	: 'elastic',
		helpers	: {
			title	: {
				type: 'over'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});
  
  
  //gravity forms help
$('#user_login').attr( 'placeholder', 'Username' );
$('#user_pass').attr( 'placeholder', 'Password' );


//courses hover 
  $('.course-list .course a').each( function() { 
    $(this).hoverdir({
         hoverElem : '.overlay' });
                                          } );
});