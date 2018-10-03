/* Theme Name: The Project - Responsive Website Template
 * Author:HtmlCoder
 * Author URI:http://www.htmlcoder.me
 * Author e-mail:htmlcoder.me@gmail.com
 * Version:1.4.0
 * Created:March 2015
 * License URI:http://support.wrapbootstrap.com/
 * File Description: Place here your custom scripts
 */

(function($){
	$(document).ready(function(){

		// Notify Plugin - The below code (until line 42) is used for demonstration purposes only
		//-----------------------------------------------
		if (($(".main-navigation.onclick").length>0) && !Modernizr.touch ){
			$.notify({
				// options
				message: 'The Dropdowns of the Main Menu, are now open with click on Parent Items. Click "Home" to checkout this behavior.'
			},{
				// settings
				type: 'info',
				delay: 10000,
				offset : {
					y: 150,
					x: 20
				}
			});
		};
		if (!($(".main-navigation.animated").length>0) && !Modernizr.touch && $(".main-navigation").length>0){
			$.notify({
				// options
				message: 'The animations of main menu are disabled.'
			},{
				// settings
				type: 'info',
				delay: 10000,
				offset : {
					y: 150,
					x: 20
				}
			}); // End Notify Plugin - The above code (from line 14) is used for demonstration purposes only

		};
	}); // End document ready

})(this.jQuery);



		$(document).ready(function(){
  $('#search').on("click",(function(e){
  $(".form-group").addClass("sb-search-open");
    e.stopPropagation()
  }));
   $(document).on("click", function(e) {
    if ($(e.target).is("#search") === false && $(".form-control").val().length == 0) {
      $(".form-group").removeClass("sb-search-open");
    }
  });
    $(".form-control-submit").click(function(e){
      $(".form-control").each(function(){
        if($(".form-control").val().length == 0){
          e.preventDefault();
          $(this).css('border', '2px solid red');
        }
    })
  })
})







