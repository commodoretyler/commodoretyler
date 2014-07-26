/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */
( function( $ ) {
  var body    = $( 'body' ), _window = $( window );

  $.fn.coverSizer = function(){
    var _this = $(this);
    function doResize(){
      windowHeight = $(window).height();
      $(_this).css({ 'height' : windowHeight + 'px' });
    }
    $(window).bind("resize", doResize);
    doResize();
  }
  //$('.tyler-moore').coverSizer();
  
  // Jump to section
  $('a[href*=#]').each(function() {
    if (navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i)){
      $('a').on('click', function() {
        var link = $(this).attr('href');
        window.open(link,'_self'); // opens in new window as requested

        return false; // prevent anchor click
      });
    }
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname && this.hash.replace(/#/,'') ) {
      var $targetId = $(this.hash), $targetAnchor = $('[name=' + this.hash.slice(1) +']');
      var $target = $targetId.length ? $targetId : $targetAnchor.length ? $targetAnchor : false;
      if ($target) {
        //var targetOffset = $target.offset().top;
        //var targetOffset = $('#' + $targetId).attr('data-offset');
        var dh = $(window).height();
        $(this).click(function() {
          var targetOffset = $target.offset();
          $('html, body').animate({scrollTop: targetOffset.top}, 200);
          return false;
        });
      }
    }
  });

  // Fade in the header
  $.fn.fadeInBackground = function() {
    _this = $(this);

    function getScrollTop() {
      return $(window).scrollTop();
    }

    function fader() {
      var scrollTop = getScrollTop();
      var max = 488;
      var perc = scrollTop / max;

      if (perc > 1) {
        perc = 1;
      }
      if (perc < .3) {
        perc = .3;
      }
      _this.css({
        'backgroundColor' : 'rgba(0, 0, 0, ' + perc + ')'
      });
    }

    $(window).bind('scroll', fader);
    fader();
  }
  $('.site-header').fadeInBackground();



} )( jQuery );
