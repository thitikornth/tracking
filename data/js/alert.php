<script src="sweetalert/jquery-3.5.1.min.js"></script>
<script src="sweetalert/sweetalert2.all.min.js"></script>

<script>
const href = "pub_form.php" ;
$(document).ready(function(){
Swal.fire({
  title: 'Do you want to save the changes?',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Save`,
  denyButtonText: `Don't save`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)  
if (result.isConfirmed) {
    window.location.href = href ;
  }

} else if (result.isDenied) {
    Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
})
if (result.isDenied) {
    window.location.href = href ;
  }
  }
})
})
     </script>
   