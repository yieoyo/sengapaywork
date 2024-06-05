<script>
$(".delete_record").click(function(){
	var dataUrl = $(this).attr("data-url");
	
	Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.value) {
		window.location.href	 =	dataUrl;
	  }
	})
})
</script>
