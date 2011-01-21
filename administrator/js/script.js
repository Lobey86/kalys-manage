$(function(){
    
    $('input:submit, input:reset').button();
    
    // Delete alert on link
    $('.delete').click(function(){
        
        var linkTo = $(this).attr('href');
        
        $("#delete-message").dialog('destroy');
        
        $("#delete-message").dialog({
            modal: true,
            dialogClass: 'alert',
            buttons: {
                No: function(){
                    $(this).dialog('close');
                },
                Yes: function(){
                    $(this).dialog('close');
                    window.location = linkTo;
                }
            }
        });
    return false;
    });
    
    // Delete alert on form
    $('input[name="delete"]').click(function(){
    	
    	var button = this;
        
        $("#delete-message").dialog('destroy');
        
        $("#delete-message").dialog({
            modal: true,
            dialogClass: 'alert',
            buttons: {
                No: function(){
                    $(this).dialog('close');
                },
                Yes: function(){
                	$(this).dialog('close');
                	
                	var formToSubmit = $(button).parentsUntil('form').parent().first();
                	var formArray = $(formToSubmit).formToArray();
                	// Temp form
                	var temp=document.createElement("form");
                	temp.action = $(formToSubmit).attr('action');
                	temp.method = $(formToSubmit).attr('method');
                	temp.style.display="none";
                	
                	$(formArray).each(function(index, element){
                		var opt = document.createElement("textarea");
                		opt.name = element.name;
                		opt.value = element.value;
                		temp.appendChild(opt);
                	});
                	
                	var opt = document.createElement("textarea");
                	opt.name = 'delete';
            		opt.value = 'true';
            		temp.appendChild(opt);
                	
                	document.body.appendChild(temp);
                	temp.submit();
                	return temp;
                }
            }
        });
    return false;
    });
	
	// Main navigation
	
	$(".main-nav li ul").hide(); // Hide all sub menus
	$(".main-nav li.active a").parent().find("ul").show();
	//$(".main-nav li.active a").parent().find("ul").slideToggle("slow"); // Slide down the current menu item's sub menu
		
	$(".main-nav > li > a").click( // When a top menu item is clicked...
		function () {
			$(this).parent().siblings().find("ul").slideUp("normal"); // Slide up all sub menus except the one clicked
			$(this).next().slideToggle("normal"); // Slide down the clicked sub menu
			return false;
		}
	);
		
	$(".main-nav li a").click( // When a menu item with no sub menu is clicked...
		function () {
			window.location.href=(this.href); // Just open the link instead of a sub menu
			return false;
		}
	); 

    // Sidebar Accordion Menu Hover Effect:
		
	$(".main-nav > li > a").hover(
		function () {
			$(this).stop().animate({ paddingRight: "25px" }, 200);
		}, 
		function () {
			$(this).stop().animate({ paddingRight: "15px" });
		}
	);
    
});

