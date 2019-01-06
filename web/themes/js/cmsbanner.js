jQuery(function($) {
	$(".toggle").click(function (){		
		var id = $(this).attr('rel');
		
		$(".tableChild").each(function (){
			if($(this).css('display') == 'block')
			{
				var activeID = parseInt($(this).attr('id').replace(/childOf/, ''));
				
				if(activeID == id) return;
				
				$(this).slideUp();
 				$('.toggle[rel="' + activeID + '"]').removeClass('active');
			}
			
		});
		
		$("#childOf" + id).slideToggle(100);
		if($(this).hasClass('active'))
		{
			$(this).removeClass('active');
		}
		else
		{
			$(this).addClass('active');
		}
	});
	
	var parentID = parseInt(window.location.hash.replace(/#/, ''));
	if(parentID>0)
	{
		$("#childOf" + parentID).slideDown(100, function(){
			$('.toggle[rel="'+ parentID +'"]').addClass('active');
		});
	}
});