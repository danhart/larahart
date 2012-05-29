/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                                         *
 *  Notonthehighstreet.com  Blog Scroll Anchors                            *
 *                                                                         *
 *  Copyright © 2006 - 2012 Notonthehighstreet Enterprises Limited         *
 *                                                                         *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Creating our namespace, if it doesn't exist already
if ((typeof BLOG == "undefined") || (null == BLOG)) {
    var BLOG = {};
}

BLOG.scroll_anchors = function() {

  var bindToAnchorClass = function() {
    $("a.anchorLink").anchorAnimate();
  }

/*  ------------------------------------------------------------------------
    ------------                PUBLIC FUNCTIONS                ------------
    ------------------------------------------------------------------------ */

  return {
    initialiseScrollAnchors: function() {
      bindToAnchorClass();
    }
  }
}();

jQuery.fn.anchorAnimate = function(settings) {

  settings = jQuery.extend({
    speed : 1100
  }, settings); 
  
  return this.each(function(){
    var caller = this
    $(caller).click(function (event) { 
      event.preventDefault()
      var locationHref = window.location.href
      var elementClick = $(caller).attr("href")
      
      var destination = $(elementClick).offset().top;
      $("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, settings.speed, function() {
        window.location.hash = elementClick
      });
        return false;
    })
  })
}
