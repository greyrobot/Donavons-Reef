jQuery.fn.hint = function () { 
  return this.each(function (){
    // get jQuery version of 'this'
    var t = jQuery(this); 
    // get it once since it won't change
    var title = t.attr('title');
    // only apply logic if the element has the attribute
    if (title) { 
      // on blur, set value to title attr if text is blank
      t.blur(function (){
        if (t.val() == '') {
          t.val(title);
          t.addClass('blur');
        }
      });
      // on focus, set value to blank if current value 
      // matches title attr
      t.focus(function (){
        if (t.val() == title) {
          t.val('');
          t.removeClass('blur');
        }
      });

      // clear the pre-defined text when form is submitted
	 //originally began with t.parents('form:first()').submit(function(){ 
	 //but was causing an 'exception thrown but not caught' error in IE
	 //the following change fixed it, form:first() changed to form:first
      t.parents('form:first').submit(function(){
          if (t.val() == title) {
              t.val('');
              t.removeClass('blur');
          }
      });

      // now change all inputs to title
      t.blur();
    }
  });
}
