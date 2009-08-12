	var SuperObject = function(){
		var baseUrl = Settings.baseUrl;
		var total_items = Settings.total_items || null;
	};
							  
	SuperObject.prototype = {
		_common : function(){
			//initialize the tooltips mouseover feature on any links with a class of 'tooltip'
			tooltip();
			
			$("input.txt").hint();
			
			//initialize lightbox
			$('#gallery4x4 a, a.product_thumb').lightBox();
			
			//secret admin link, suppress status message
			$(".nada").facebox();
			
			//nav button rollover, must be named *-over.png
			$(".rollover").hover(function(){
				var over = $(this).attr('src').replace('.png','-over.png');
				$(this).attr('src', over);								  
			}, function(){
				var norm = $(this).attr('src').replace('-over.png','.png');
				$(this).attr('src', norm);
			});	
			
			$("input", ".form_div").focus(function(){
			 $(this).css({ border: "2px solid #1d8dab" }, 1);
		    });
			$("input", ".form_div").blur(function(){
			 $(this).css({ border: "2px solid #333" }, 1);
		    });		
		},
		home_page : function(){
			this._common();
			
			//form focus anims
			$("#name, #email", "#sign_up_form_div").focus(function(){
				$(this).animate({ fontSize: "18px", border: "2px solid #1d8dab" }, 300);
			});
			$("#name, #email", "#sign_up_form_div").blur(function(){
				$(this).animate({ fontSize: "14px", border: "0px solid #1d8dab" }, 300);
			});	
			
			$("#subscribe").click(function(){
				//validation
				var error = '';
				
				var name = $("#name").val();
				if (!name || name.length < 2 || name == '') {
					error += "Please enter your name<br />";
					$("#name").focus();
				}
				
				var email = $("#email").val();
				if (!email || email.length < 5) {
					error += "Please enter a valid email";	
					$("#email").focus();
				}
				
				if (error.length > 1) {
					alert(error);
					return false;
				}
				
				$("#sign_up_form_div").fadeOut();
				$("#processing").fadeIn();
				
				$.post(this.baseUrl+'mailing/subscribe', 
					   { 'name' : name, 'email' : email }, 
					   function(data){
							$("#processing img").fadeOut(300, function(){
								$("#processing").html("<span>Thanks for subscribing!</span>");	
								$("#processing span").css({ fontSize: '.1em' });
								$("#processing span").animate({ fontSize: '1.1em' });
							});
				});
				return false;							   
			}); //end click subscribe
		},
		about_page : function(){
			this._common();
		},
		contact_page : function(){
			this._common();
		},
		shop_page : function(){
			this._common();
			
			$(".quantity_changer").change(function(){
				//append the quantity to the end of the buy now link url, so that the new quantity 
				//is passed to the cart controller when the buy now link is clicked
				var $this = $(this);
				var parent = $this.parent();
				var parent_prev_prev = parent.prev().prev();
				
				var quantity = parseFloat($this.val());
				var over_stock = false;
				var stock = parseFloat($this.next().next().val());
				//validation
				if (isNaN(quantity) && quantity != null) {
					alert("Please enter a valid number");
					$this.val('');
					$this.focus();
				}		
				if (quantity > stock) {
					alert("Sorry, right now there isn't that many in stock");
					$this.val(stock);
					over_stock = true;
				}	
				
				//get the current url from the adjacent buy now link
				var href = $this.parent_prev_prev.attr('href');
				href += '/' + quantity;
				
				$(".item_check input", parent.parent().parent().parent().parent()).click();
				
				$this.next().val(quantity);//set the hidden quantity[] field
				$this.parent_prev_prev.attr({ 'href' : href }); //set the new url to the buy now link
				parent.parent_prev_prev.children().attr({ 'href' : href.replace('/buy_now', '') }); //set the new url to the price link
			}); //END $(".quantity_changer").change()
			
			$("input.buy_selected").click(function(){
				if (!$(".item_check input").is(":checked")) {
					alert("Select a product!");
					return false;
				}
			});
			
			//when an item is checked add a new hidden input with the quantity from the quantity text field as the value
			$(".item_check input").click(function(){
				var $this = $(this);
				var parent = $this.parent().parent();
				
				if ($this.is(":checked")) {
					var previous_value = parent.children(".product_extra_info_list")
										  .children(".quantity_container")
										  .children(".quantity_text_container")
										  .children().val();
					
					if (previous_value == '') {
						parent.children(".product_extra_info_list")
							 .children(".quantity_container")
							 .children(".quantity_field_container")
							 .children().val(1);
						
						parent.children(".product_extra_info_list")
							 .children(".quantity_container")
							 .children(".quantity_text_container")
							 .children().val(1);
					}
					
					var quantity = parent.children(".product_extra_info_list")
									 .children(".quantity_container")
									 .children(".quantity_text_container")
									 .children().val();
					
					var new_input = "<input class='quantity_field' name='quantity[]' value='"+quantity+"' type='hidden'>";
					
					parent.children(".product_extra_info_list")
						 .children(".quantity_container")
						 .children(".quantity_field_container").html(new_input);
				} else {
					parent.children(".product_extra_info_list")
						 .children(".quantity_container")
						 .children(".quantity_field_container").html('');
					
					parent.children(".product_extra_info_list")
						 .children(".quantity_container")
						 .children(".quantity_text_container")
						 .children().val('');
				}
			}); //END $(".item_check input").click()
		},
		cart_page : function(){
			this._common();
			
			//set initial value for order total
			updateTotalPrice();
			alert(this.baseUrl);
			//check all when the check all checkbox is checked
			$("#check_all").click(function(){
				if ($(this).is(":checked")) $(".check").attr({ 'checked' : 'checked' });
				else $(".check").attr({ 'checked' : '' });
			});
			
			//delete button rollover
			$("#delete").hover(function(){
				$(this).attr({ 'src' : this.baseUrl+'images/trash_icon-over.png' });
			}, function(){
				$(this).attr({ 'src' : this.baseUrl+'images/trash_icon.png' });
			});
			
			//delete button action, uses ajax to delete item from PHP sessions
			$("#delete").mousedown(function(){
				$(this).attr({ 'src' : this.baseUrl+'images/trash_icon.png' });		
			}).mouseup(function(){
				$(this).attr({ 'src' : this.baseUrl+'images/trash_icon-over.png' });	
				
				if (!$(".check").is(":checked") || $(".product_listing").length == 0) return false;
				$("#loading").fadeIn();
				
				var items = new Array(); 
				var row_id = new Array();
				
				//if something was checked, delete it
				var i = 0;
				$.each($(":input.check"), function(){
					if ($(this).is(":checked")) {
						row_id[i] = $(this).attr('id').replace('check_', 'row_');
						items[i] = $(this).val();
						i++;
					}
				});
				
				//ajax delete function
				var form_data = $("#update_form").serialize();
				$.post(this.baseUrl+"cart/ajax_delete_item", form_data, function(obj){
					//convert json encoded response from the server into an object so we can access each property
					//var obj = eval('('+data+')');
					
					$("#loading").fadeOut();
					
					//update the new sub_total and item quantities after deleting
					$("#sub_total").children().text(obj.sub_total);
					$("#quantity").text(obj.quantity);
					$("#sub_total").children().text(obj.total_price);
					
					for (var j=0; j < row_id.length; j++) {
						$("#"+row_id[j]+"").remove();
					}
					
					if ($(".product_listing").length == 0) {
						$("#cart_container").children().fadeOut(600);
						$("#cart_container").html("<div id=\"cart_empty\">You have nothing in your cart. </div><div id=\"items\"></div>");
						$("#items").load(this.baseUrl+"views/featured_items.php");
						$("#cart_empty").hide().fadeIn(400);
						$("#items").hide().fadeIn(900);
					}
				},'json');
			}); //END $("#delete").mousedown().mouseup()
				
			//when a quantity field is changed for a particular item
			$("input.update").change(function(){
				//validation
				if (isNaN($(this).val()) ) {
					alert("Quantity must be a number");
					return false;
				}
				
				var stock = parseFloat($(this).next().next().val());
				if (parseFloat($(this).val()) > stock) {
					alert("Sorry, right now there isn't that many in stock");
					$(this).val(stock);
					return false;
				}		
				//END validation
				
				updateTotalItems(); //change total items display
				updateSubTotal();
				updateShipping();
				updateTotalPrice();
				
				//change this item's total price
				var price = $(this).next().val();
				var quantity = $(this).val();
				var new_price = price * quantity;
				$(this).next().next().next().text(new_price);
			}); //END $("input.update").change()
			
			//if shipping in florida is checked, add the tax field value
			$("#fl").change(function(){
				//change the text for the tax field to display the %6.5 tax if when the FL checkbox is checked
				if ($(this).is(":checked")) $("#tax").children().text('6.5');
				else $("#tax").children().text('0');
		
				updateSubTotal();
				updateShipping();
				updateTotalPrice();
			});
			
			//update shipping on change
			$("select#shipping_options").change(function(){
				updateShipping();
				updateTotalPrice();
			});
		},
		checkout_page : function(){
			this._common();	
			
			$(".facebox").facebox();
	
			//when user click on 'signup for quick checkout', slide open a password field, close it if clicked on again
			$("#signup_info_div", ".form_div").data('closed', true); //initial state
			$("#signup", "#cart_info").click(function(){
				var s = $("#signup_info_div", ".form_div");
				
				if (s.data('closed')) {
					s.data('closed', false);
					
					$("#signup", "#cart_info").text("Cancel Sign Up").removeClass("btn_link");
					$("h3.ship_hdr", ".form_div").prepend("<i>Then </i>");
					
					var html = "<label for='name'>Enter a Password</label>";
						html += "<div><input type='password' name='new_pwd' id='new_pwd' size='20' /></div>";
						html += "<div class='notice'>Your email address will be your login</div>";
						
						s.prepend(html).hide().slideDown();
				} else {
					s.slideUp(300, function(){
						$("#signup", "#cart_info").text("Sign up for Quick Checkout").addClass("btn_link");
						$("h3.ship_hdr i", ".form_div").remove();
						$(this).children().remove();						
					});
					s.data('closed', true);
				}
				return false;
			}); //END $("#signup", "#cart_info").click()
		},
		admin_pages : {
			_common : function(){
				this._common();
				$(".text_edit").wysiwyg();				
			},
			manage_home : function(){
				this.admin_pages._common();
				
				$(".saveFIX_THIS").click(function(){
					//validation		
					var new_text = $(".text_edit", $(this).parent().parent()).val();
					if (new_text == '') return false;	
					//END validation
					
					//fade in ajax loader gif
					$(this).next().fadeIn();
					$(".success").fadeOut();
					
					//gather other variables to include in post data
					var page = $("input[name=page]", $(this).parent().parent()).val();
					var section = $("input[name=section]", $(this).parent().parent()).val();
					var visible = $("input[name=visible]:checked", $(this).parent().parent()).val();
					
					//post isnt working, idky
					$.post(this.baseUrl+'admin/edit_content/', 
						{}, 
						function(r){
							alert(r);
					});
					return false;
				});	//END $(".saveFIX_THIS").click()
			},
			manage_about : function(){
				this.admin_pages._common();
			},
			manage_contact : function(){
				this.admin_pages._common();
			},
			manage_products : function(){
				this.admin_pages._common();
				
				//disable the 'add watermark' checkbox if the file input is empty
				$(":checkbox.w_check").attr('disabled', 'disabled');
				$(":input.f_input").change(function(){
					if (this.value.length > 1) $(":checkbox.w_check").attr('disabled', '');	
					else $(":checkbox.w_check").attr('disabled', 'disabled');
				});
				
				//confirm when delete button is clicked on a product	
				$("#delete_btn", "#products_control").click(function(){
					var product = $("#edit_title").val();
					var msg = 'Delete ' + product + '?';
					return confirm(msg);
				});
				
				var populateProductFields = function(id) {
					$("#product_loading").fadeIn();
					//get the info
					$.post(this.baseUrl+'admin/get_product/'+id, {}, function(itm){
						//image source
						var img_src = this.baseUrl + 'images/products/thumbs/';
						img_src += (itm.image == 'placeholder.gif') ? 'placeholder.gif' : itm.id + '_thumb.jpg';
						
						var ref = this.baseUrl + 'images/products/' + itm.image;
						//populate form fields with item's data
						$("#product_loading").fadeOut(10, function(){
							$("#edit_type").val(itm.type);
							$("#edit_title").val(itm.title);
							$("#edit_id").val(itm.id);
							$("#edit_description").val(itm.description);
							$("#edit_quantity").val(itm.quantity);
							$("#edit_price").val(itm.price);	
							$("#p_image").attr({ 'src': img_src });
							$(".e_image a.product_thumb").attr({ 'href': ref });
							$(".e_image a.product_thumb").attr({ 'title': itm.title });
							$("#id").val(id);
							$(":checkbox.f_check").attr('checked', (itm.featured == 'y' ? true : false));
						});
					},'json');	
				}
				
				$("a.product_link").click(function(){
					//get the id from the link
					var id = $(this).attr('href').replace(this.baseUrl+'admin/manage_products/', '');
					populateProductFields(id);
					return false; //dont follow the link
				});
				$(".product_li").css('cursor', 'pointer');
				$(".product_li").click(function(){ //load product info into the form fields
					var id = $(this).children().attr('href').replace(this.baseUrl+'admin/manage_products/', '');
					populateProductFields(id);
					return false;
				});
				
				//upload new product
				$("#new_type").autocomplete(Settings.types);
				
				$(".save-btn").click(function(){ //fade in loading gif when upload or add product buttons are clicked
					$(this).next().fadeIn();	 
				});
				
				$("#upload_new_product").click(function(){ //upload new product
					$("span.err").remove();
					var error = false;
					//validation
					var p_type = $("#new_type").val();
					if (p_type == '' || !p_type) {
						error = true;
						$("#new_type").parent().append("<span class='err'>Products must have a category!</span>");
					}
					var p_title = $("#new_title").val();
					if (p_title == '' || !p_title) {
						error = true;
						$("#new_title").parent().append("<span class='err'>You have to name your product!</span>");
					}
					var p_desc = $("#new_description").val();
					if (p_desc == '' || !p_desc) {
						error = true;
						$("#new_description").parent().append("<span class='err'>Describe it!</span>");
					}
					if (error) {
						$(".loader").fadeOut(150);
						return false;
					}
					//END validation
					return true;
				});
			},
			manage_orders : function(){
				this.admin_pages._common();
				
				//table scroll div
				$("#table_scroll").data('full_open', true).css({ 'height': '40em', 'overflow': 'auto' });
				
				//table styles
				$(".row:even").css('background-color', '#91ceee');
				$(".row:even").hover(function(){
					$(this).css('background-color', '#ffCCFF');				  
				}, function(){
					$(this).css('background-color', '#91ceee');		
				});
				
				$(".row").data('selected', false); //initial state
				$(".row").click(function(){
					if ($(this).data('selected')) return false; //do nothing if already selected
					$(".row").data('selected', false); //deselect all rows
					$(this).data('selected', true); //set this row to selected
					
					if ($("#table_scroll").data('full_open')) $("#table_scroll").data('full_open', false).animate({ 'height': '20em' });
					
					//get the hidden data of the item row user has clicked
					var form = this.id.replace('row_', 'form_');
							
					//get order info
					var order_date = $("input[name=order_date]", "#"+form+"").val();
					var ship_date = $("input[name=ship_date]", "#"+form+"").val();
					var isMember = $("input[name=user_id]", "#"+form+"").val() != '0' ? true : false;
					//get shipping info
					var name = $("input[name=customer_name]", "#"+form+"").val();
					var email = $("input[name=email]", "#"+form+"").val();
					var phone = $("input[name=s_phone]", "#"+form+"").val();
					var street = $("input[name=street]", "#"+form+"").val();
					var city = $("input[name=city]", "#"+form+"").val();
					var state = $("input[name=state]", "#"+form+"").val();
					var zip = $("input[name=zip]", "#"+form+"").val();
					
					$("#left_div").html("<h4>Items</h4><div class='scroll'></div>");
					$("#middle_div").html("<h4>Details</h4>");
					$("#right_div").html("<h4>Shipping</h4>");
					
					$("#left_div, #middle_div, #right_div").slideUp().data('open', false);
					
					//populate the detail area with the hidden form values
					$("#middle_div").append("<p><em>Order Date:</em> "+order_date+"</p><p><em>Ship Date:</em> "+ship_date+"</p><p><em>Member?</em> "+(isMember ? 'Yes' : 'No')+"<p>");
					
					$("#right_div").append("<p><em>Name:</em> "+name+"</p><p><em>Email:</em> <a href='mailto:"+email+"'>"+email+"</a></p><p><em>Phone:</em> "+phone+"</p><p><em>Address:</em><br /><code>"+street+"<br />"+city+", "+state+" "+zip+"</code><p>");
					
					//get product info from server for each id in product_ids
					var items = $("input[name=products]", "#"+form+"").val().split(',');
					var quantities = $("input[name=quantities]", "#"+form+"").val().split(', ');
					
					//loop over the ids and get the product info and fill in the detail divs
					$(".scroll", "#left_div").html("<ol></ol>");
					for (var i = 0, len = items.length; i < len; i++) {
						$(".scroll ol", "#left_div").append("<li>"+items[i]+"<span class='multiplier'> X </span>"+quantities[i]+"</li>");
						//slide in the shipping detail divs
						if (i == (items.length-1)) {
							$(".scroll ol", "#left_div")
								.parent() //go to the scroll div
								.parent() //go up to the left_div
								.parent() //go to its container
								.children() //get all the divs (left_div, middle_div, right_div
								.data('open', true) //set their state to open
								.slideDown() //open them
								.children() //get the children elements
								.hide() //initial state
								.fadeIn(900); //fade them in
						}
					}		
				});
			},
			manage_banners : function(){
				this.admin_pages._common();
				
				//disable when not filling in a form
				$("div.b_vis :input[name=visible]", "#site_links_control").attr('disabled', 'disabled');
				
				$(":input[name=delete]").click(function(){
					var banner = $(this).parent().parent().parent().next().text();
					var msg = 'Delete ' + banner + '?';
					return confirm(msg);
				});
				
				$(":input[name=add]").click(function(){	//open the add banner div
					$("#add_div").slideToggle(300);
				});
				
				$("input#title", "#add_div").change(function(){ //activate the visible checkbox in the add banner div when they type in a title
					if ($(this).val() != '') $("input#visible", "#add_div").attr('disabled', '');	
					else $("input#visible", "#add_div").attr('disabled', 'disabled');
				});
				
				$(".edit-btn").click(function(){ //make input fields appear in the form where they clicked the edit button
					var $this = $(this);
					var parent = $this.parent().parent().parent().parent();
					var val = $this.val();
					
					if (val == 'Edit') {	
						$this.val('Cancel').addClass('cancel_btn');
						//first get the text that is in the div to use as the value for the input field that will replace that text
						var title = $("div.b_title", parent).text();
						$("div.b_title", parent)
							.html("<input class='title_input' type='text' size='30' name='title' value='"+title+"' />");
						
						var url = $("div.b_link a", parent).text();
						$("div.b_link", parent)
							.html("<input type='text' size='40' name='link' value='"+url+"' />");
						
						var img = $("div.b_img img", parent).attr('src');
						var width = $("div.b_img img", parent).width();
						
						$("div.b_img", parent)
							.children('img').attr('width', (width/2)).end()
							.append("<div>Old Image: <span><a href='"+img+"'>"+img+"</a></span></div><div><label for='edit_img'>New Image: </label><input type='file' id='edit_img' size='35' name='image' value='' /><div>");
							
						$("div.b_vis :input[name=visible]", parent).attr('disabled', '');
						
						$("div.submit_edit", parent).show();
						
					} else if (val == 'Cancel') {
						$this.val('Edit').removeClass('cancel_btn');
						
						var title = $("div.b_title input", parent).val();
						$("div.b_title", parent).html(title);
						
						var url = $("div.b_link input", parent).val();
						$("div.b_link", parent).html("<a href='"+url+"'>"+url+"</a>");
						
						var img = $("div.b_img div span a", parent).text();
						$("div.b_img", parent).html("<img src='"+img+"' alt='' />");
						
						$("div.b_vis :input[name=visible]", parent).attr('disabled', 'disabled');
						
						$("div.submit_edit", parent).hide();
					}
				});
			}
		} //END admin_pages
	} //END SuperObject.prototype