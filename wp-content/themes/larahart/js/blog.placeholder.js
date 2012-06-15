/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                                         *
 *  Notonthehighstreet.com  Blog Placeholder HTML5 Attribute Fix For       *
 *  Non-supporting Browsers                                                *
 *                                                                         *
 *  Copyright © 2006 - 2012 Notonthehighstreet Enterprises Limited         *
 *                                                                         *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Creating our namespace, if it doesn't exist already
if ((typeof BLOG == "undefined") || (null == BLOG)) {
  var BLOG = {};
}

BLOG.placeholder = function() {

  var bindPlaceholderAttribute = function() {
    $('[placeholder]').focus(function() {
      var input = $(this);
      if (input.val() == input.attr('placeholder')) {
        input.val('');
        input.removeClass('placeholder');
      }
    }).blur(function() {
      var input = $(this);
      if (input.val() == '' || input.val() == input.attr('placeholder')) {
        input.addClass('placeholder');
        input.val(input.attr('placeholder'));
      }
    }).blur();

    $('[placeholder]').parents('form').submit(function() {
      $(this).find('[placeholder]').each(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
          input.val('');
        }
      })
    });
  }

  /*  ------------------------------------------------------------------------
      ------------                PUBLIC FUNCTIONS                ------------
      ------------------------------------------------------------------------ */

  return {
    initialisePlaceholder: function() {
      bindPlaceholderAttribute();
    }
  }
}();
