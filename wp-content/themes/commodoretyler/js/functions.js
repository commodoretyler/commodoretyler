/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */
( function( $ ) {
	var body    = $( 'body' ),
		_window = $( window );


  $.fn.coverSizer = function(){
    var _this = $(this);
    function doResize(){
      windowHeight = $(window).height();
      $(".cover").each(function(i,v){
        $(this).css({
          'height' : windowHeight + 'px'
        });
     });
    }
    $(window).bind("resize", doResize);
    doResize();
  }
  $('#covers').coverSizer();




} )( jQuery );
