@if(session()->has(App\Utilities\Flash::MESSAGE))
    <script>
      swal({
        title: "{{ session(App\Utilities\Flash::MESSAGE.'.title') }}",
        text: "{{ session(App\Utilities\Flash::MESSAGE.'.message') }}",
        icon: "{{ session(App\Utilities\Flash::MESSAGE.'.type') }}",
        timer: 2000,
        button: false,
      })
    </script>
@endif

@if(session()->has(App\Utilities\Flash::OVERLAY))
    <script>
      swal({
        title: "{{ session(App\Utilities\Flash::OVERLAY.'.title') }}",
        text: "{{ session(App\Utilities\Flash::OVERLAY.'.message') }}",
        icon: "{{ session(App\Utilities\Flash::OVERLAY.'.type') }}",
        button: 'Okay',
      })
    </script>
@endif