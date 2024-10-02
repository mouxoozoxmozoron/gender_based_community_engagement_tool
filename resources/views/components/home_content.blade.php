
    @props(['usercount', 'groupcount', 'eventcount', 'postcount'])

    @if (session('insightsaved'))
        <script>
            alert('Thank you for your insight');
        </script>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="loginFailureMessage">
            {{ session('error') }}
        </div>
    @endif



    <style>
   #notificationContainer {
    position: fixed;
    top: 20px; /* Distance from the top of the viewport */
    left: 50%; /* Align the container in the center */
    transform: translateX(-50%); /* Adjust for centering */
    z-index: 9999; /* Ensure it's on top of other elements */
    display: flex;
    flex-direction: column;
    align-items: center;
    width: auto; /* Adjust width as needed */
}

#notificationContainer .alert {
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 0px;
    min-width: 250px;
    max-width: 400px; /* Set maximum width */
    word-wrap: break-word; /* Prevent overflow */
    opacity: 0; /* Set initial opacity for transition */
    transform: translateY(-20px); /* Move up slightly for animation */
    transition: all 0.4s ease-in-out; /* Smooth transition */
}

#notificationContainer .alert-success {
    background-color: #28a745;
    color: white;
}

#notificationContainer .alert-warning {
    background-color: #ffc107;
    color: white;
}

#notificationContainer .alert-dismissible .close {
    position: absolute;
    top: 0;
    right: 10px;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

/* Fade-in animation for showing alerts */
#notificationContainer .alert.show {
    opacity: 1; /* Full visibility */
    transform: translateY(0); /* Move to original position */
}

    </style>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Bridging gaps, building understanding: Advancing gender inclusion together</h1>
                    <h2>
                        Collaborative solutions for inclusive growth: Bridging the gap between advocates and
                        communitiesConnecting voices and fostering understanding: Together, we champion gender equality
                        in community development. By bridging the gap between advocacy groups and local communities, we
                        create spaces for meaningful dialogue. Join us in empowering every gender to contribute to a
                        more inclusive and equitable future
                    </h2>

                    @if (!@session('user_id'))
                        <div>
                            <button id="insightsbmtbtn" type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#loginmodel" data-bs-whatever="@mdo">Get started
                            </button>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets/img/equality.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">



        <!-- ======= Counts Section ======= -->
        <section id="achievement" class="counts">
            {{-- src="{{ asset('gbce_logo.png') }} --}}
            <div class="container">

                <div class="text-center title">
                    <h3>What we have achieved so far</h3>
                    <p>
                        Our effort propagated so far by reaching targeted end audience, the community and adress a
                        number of problems.
                    </p>
                </div>

                <div class="row counters position-relative">

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $usercount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Audiences</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $groupcount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Groups</p>
                    </div>

                    {{-- @props(['usercount', 'groupcount', 'eventcount', 'postcount']) --}}

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $eventcount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Events</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $postcount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Posts</p>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->




        {{-- <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container">

                <div class="row no-gutters clients-wrap clearfix wow fadeInUp">

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/arulogo.jpg" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="assets/img/clients/client-8.png" class="img-fluid" alt="">
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Clients Section --> --}}





        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Services</h2>
                    <p>
                        In adreesing the existing barrier between gender advocacy group, gbce collaborate with the
                        community by providing various servicess aiding inclussive development as well equality over
                        society
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-people" style="color: #6c757d;"></i> </div>
                            <h4 class="title"><a href="#">Group creation and management</a></h4>
                            <p class="description">
                                Advocacy groups can create and manage their own groups within the system, fostering
                                community and collaboration.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-calendar-event" style="color: #007bff;"></i> </div>
                            <h4 class="title"><a href="#">Event organisation</a></h4>
                            <p class="description">
                                Enable advocacy groups to create and manage events, promoting engagement and awareness
                                within their community.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-wow-delay="0.1s">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-chat-dots" style="color: #28a745;"></i> </div>
                            <h4 class="title"><a href="#">Interactive Community Posts</a></h4>
                            <p class="description">
                                Users can create, share, like, comment, and reply to posts, facilitating open dialogue
                                and inclusive participation.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-wow-delay="0.1s">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-journal-bookmark" style="color: #17a2b8;"></i>
                            </div>
                            <h4 class="title"><a href="#">Information Sharing
                                </a></h4>
                            <p class="description">
                                Facilitate the sharing of information among advocacy groups and community
                                members, promoting knowledge exchange.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-people-fill" style="color: #ffc107;"></i> </div>
                            <h4 class="title"><a href="#">Community Engagement Tools</a></h4>
                            <p class="description">
                                Provide tools for advocacy groups to engage with the community effectively, fostering
                                inclusivity and breaking down barriers.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-bar-chart-line" style="color: #6f42c1;"></i> </div>
                            <h4 class="title"><a href="#">Analytics & Insights </a></h4>
                            <p class="description">
                                Offer analytics and insights into community engagement and interaction, empowering
                                advocacy groups to refine their strategies.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Services Section -->

        {{-- <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Team</h2>
                    <p>
                        Dedicated to fostering equality, our team bridges the gap between advocacy groups and
                        communities. We believe in the power of collaboration and dialogue to drive inclusive
                        development. Every voice matters in our mission to create a more equitable future, free from
                        barriers and discrimination.
                    </p>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member">
                            <div class="member-img">
                                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>team member 1</h4>
                                <span>Chief Executive Officer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member">
                            <div class="member-img">
                                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Mokii Moux</h4>
                                <span>Communication Manager</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member">
                            <div class="member-img">
                                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Team member3</h4>
                                <span>Assistant Chief Excecutive officer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member">
                            <div class="member-img">
                                <img src="assets/img/team/gbcdeveloper.png" class="img-fluid team_member_image"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Mussa B Aron</h4>
                                <span>Developer</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Team Section --> --}}

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>
                        We're here to help bridge the gap and foster inclusive dialogue. Whether you have questions,
                        need support, or want to get involved, reach out to us. Together, we can advance gender equality
                        and build stronger, more united communities. Your voice and participation are vital to our
                        mission.
                    </p>
                </div>

                <div>
                    <iframe style="border:0; width: 100%; height: 270px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15475.089297143133!2d39.207741940250145!3d-6.7668458698203375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4f22f71db3a5%3A0xc573e73be2750f51!2sArdhi%20University!5e1!3m2!1sen!2stz!4v1718549468465!5m2!1sen!2stz"
                        frameborder="0" allowfullscreen></iframe>
                </div>

                <div class="row mt-5">

                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Kinondoni MC Makongo Mlalakuwa Dar es Salaam Region</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>muaron@proton.me</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>+255 745450431/713074067</p>
                            </div>

                        </div>

                    </div>

                    {{-- <div class="col-lg-8 mt-5 mt-lg-0">


                        <form id="insightform" class="" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="text-center"><button id="insightsbmtbtn" class="btn btn-info"
                                    type="submit">Send Message</button></div>
                        </form>


                    </div> --}}


                    <div class="col-lg-8 mt-5 mt-lg-0">
                        {{-- insight from users --}}
                        <form id="insightform" class="" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="text-center">
                                <button id="insightsbmtbtn" class="btn btn-info" type="submit">
                                    <span id="submitText">Send Message</span>
                                    <span id="submitLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                        {{-- end of insights from users --}}
                    </div>

                    <!-- Notification Area -->
                    <div id="notificationContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>


                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>






    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     // Set up CSRF token for all AJAX requests
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $('#insightform').on('submit', function(event) {
        //         event.preventDefault(); // Prevent the default form submission

        //         // Remove existing alert
        //         $('#loginFailureMessage').remove();
        //         $('#loginSuccessMessage').remove();

        //         // Serialize the form data
        //         var formData = $(this).serialize();

        //         // Submit the form using AJAX
        //         $.ajax({
        //             url: '{{ route('insight_check') }}',
        //             method: 'POST',
        //             data: formData,
        //             success: function(response) {
        //                 // If form submission is successful, reload the page
        //                 location.reload();
        //             },
        //             error: function(xhr) {
        //                 // Handle errors (e.g., validation errors)
        //                 var alertHtml =
        //                     '<div class="alert alert-danger" id="loginFailureMessage">An error occurred. Please try again.</div>';
        //                 $('.modal-body').prepend(alertHtml);
        //             }
        //         });
        //     });
        // });


        $(document).ready(function() {
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#insightform').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Show the loading spinner and disable the submit button
        $('#submitText').addClass('d-none');
        $('#submitLoader').removeClass('d-none');
        $('#insightsbmtbtn').prop('disabled', true);

        // Serialize the form data
        var formData = $(this).serialize();

        // Submit the form using AJAX
        $.ajax({
            url: '{{ route('insight_check') }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                // Show success notification
                showNotification('success', 'Your message has been sent successfully!');

                // Clear the form inputs
                $('#insightform')[0].reset();
            },
            error: function(xhr) {
                // Show error notification
                showNotification('warning', 'An error occurred. Please try again.');
            },
            complete: function() {
                // Reset the submit button and hide the loader
                $('#submitText').removeClass('d-none');
                $('#submitLoader').addClass('d-none');
                $('#insightsbmtbtn').prop('disabled', false);
            }
        });
    });


});

    </script>
