$(document).ready(function() {
	document.title='Wernear';
	$('#example').DataTable(
		{	
			"dom": "lfrt",
			scrollx:        '100%',
			scrollY:        '57vh',
			"scrollCollapse": true,
			"paging":  false,
			"ordering": false, 
			"info": false, 
			"language": {
				"search": "",
				searchPlaceholder: "Search by category or product name"
			}
		});
});