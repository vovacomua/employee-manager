<script>


	$(document).ready(function(){

		 function fetch_data(query, uri){

		 	$.ajax({
			   url:uri,
			   method:'GET',
			   data:query,
			   dataType:'json',
			   success:function(data)
				   {
				    console.log(data);
				    $('tbody').html(data);
				   },
			    error: function (data) {
			        var errors = $.parseJSON(data.responseText);
			        $.each(errors, function (key, value) {
			            $('tbody').html('<tr><td align="center" colspan="6"> <p class="text-danger">' + value + '</p></td></tr>');
			        });
			    }  
			  })

			 }


		 $('form.search').on('submit', function(event){

		 	var formData = $(this).serialize();
		 	var searchUri = '{{ route("search") }}';
		 	fetch_data(formData, searchUri); $("#parent-selector :input").attr("disabled", true);
		 	
		 	event.preventDefault();
		 });


		 $('.order').click(function(event) {

		    var anchorData = $(this).data('values');
		    var orderUri = '{{ route("order") }}';
		    fetch_data(anchorData, orderUri);

		    event.preventDefault();
		  });

	});


</script>