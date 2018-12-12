jQuery(function($) {


	$('#app-permission-form input[type="checkbox"]').click(function (){
		if(this.checked)
		{
			var m = this.id.match(/-readonly-/);
			
			if(m == '-readonly-')
			{
				var id = this.id.replace(/-readonly-/, '-readandwrite-');
			}
			else 
			{
				var id = this.id.replace(/-readandwrite-/, '-readonly-');
			}
			
			document.getElementById(id).checked = false;
		}	
	});



});