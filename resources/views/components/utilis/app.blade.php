<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>gbce</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('./styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css"
        integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    {{-- <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    {{-- <script src="js/datatables-simple-demo.js"></script> --}}
   {{-- ajx cdn links --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>





   <div id="loadingBar">
   <div class="progress"></div>
   </div>


   <style>
       /* Flash Message Styles */
#flash-message {
   position: fixed;
   top: 20px; /* Distance from the top */
   left: 50%; /* Align to center */
   transform: translateX(-50%); /* Center the element horizontally */
   width: 50%; /* Set the width to 50% */
   z-index: 10000; /* Ensure it's on top of other elements */
   padding: 15px 20px;
   border-radius: 5px;
   display: none; /* Hidden by default */
   text-align: center;
   font-weight: bold;
}

#flash-message.success {
   background-color: #28a745; /* Green for success */
   color: #fff;
}

#flash-message.warning {
   background-color: #ffc107; /* Yellow for warning */
   color: #000;
}

#flash-message.danger {
   background-color: #dc3545; /* Red for danger */
   color: #fff;
}






/* The loading bar container */
#loadingBar {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 4px;
   z-index: 9999;
   display: none; /* Hidden by default */
}

/* The animated loading bar */
#loadingBar .progress {
   height: 100%;
   background-color: blue; /* Color of the loading bar */
   width: 0; /* Start at 0 */
   transition: width 0.4s ease; /* Smooth animation */
}

/* To simulate a continuous movement */
@keyframes progressBarAnimation {
   0% { width: 0%; }
   50% { width: 60%; }
   100% { width: 100%; }
}

/* This class will be added during loading to start the animation */
.loading-active .progress {
   animation: progressBarAnimation 4s ease-in-out infinite; /* Infinite loop for smoothness */
}

   </style>



   {{-- custoom flas message --}}
<script>
 function showFlashMessage(type, message) {
   if ($('#flash-message').length === 0) {
       $('body').append('<div id="flash-message"></div>');
   }

   $('#flash-message').html(message)
                      .removeClass('success warning danger') // Remove old classes
                      .addClass(type) // Add new class based on type
                      .fadeIn(); // Show the message

   setTimeout(function () {
       $('#flash-message').fadeOut();
   }, 4000); // 4000ms = 4 seconds
}

</script>
