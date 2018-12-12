jQuery(function($) {alert('ss');
$(".toggle").click(function (){
	
	var row = $(this).closest('tr');	
	
	if($(this).hasClass('active'))
	{	
		row.next().slideToggle(0,'linear');
		$(this).removeClass('active');
		return;
	}	
	
	$(".collapseSection").css('display','none');
	$(".toggle").removeClass('active');	
	$(this).toggleClass('active');
	row.next().slideToggle(0,'linear');
});

var parentID = parseInt(window.location.hash.replace(/#/, ''));
if(parentID>0)
{	
	$('.toggle[rel="'+ parentID +'"]').click();	
}
});