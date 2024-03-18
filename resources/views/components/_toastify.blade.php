@if (session('success'))
<script>
  Toastify({
    text: "{{ session('success') }}",
    duration: 2000,
    close: true,
    gravity: "top", // `top` or `bottom`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: '#47c363' ,
    },
  }).showToast();
</script>
@endif
@if (session('danger'))
<script>
  Toastify({
    text: "{{ session('danger') }}",
    duration: 2000,
    close: true,
    gravity: "top", // `top` or `bottom`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: '#ff4d4d' ,
    },
  }).showToast();
</script>
@endif
@if (session('warning'))
<script>
  Toastify({
    text: "{{ session('warning') }}",
    duration: 2000,
    close: true,
    gravity: "top", // `top` or `bottom`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: '#ffcc00' ,
    },
  }).showToast();
</script>
@endif
@if (session('info'))
<script>
  Toastify({
    text: "{{ session('info') }}",
    duration: 2000,
    close: true,
    gravity: "top", // `top` or `bottom`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: '#33b5e5' ,
    },
  }).showToast();
</script>
@endif
