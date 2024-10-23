<!-- Tooltip styling -->
<style>
    .tooltip {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.75);
        color: white;
        padding: 5px;
        border-radius: 3px;
        font-size: 12px;
        z-index: 1000;
    }

    .card {
        opacity: 0;
        transform: translateY(-30px);
        /* Start above */
        transition: opacity 0.5s ease, transform 0.5s ease;
        animation: bounceIn 0.5s forwards;
        /* Use animation for the bounce effect */
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: translateY(-30px);
            /* Start position */
        }

        60% {
            opacity: 1;
            transform: translateY(10px);
            /* Move down slightly */
        }

        80% {
            transform: translateY(-5px);
            /* Move up slightly */
        }

        100% {
            transform: translateY(0);
            /* End at original position */
        }
    }

    .card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* body {
        padding-top: 30px;
    } */



    /* profile section */
    .edit-mode {
        display: block;
    }

    .profile-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
    }

    .profile-img {
        border-radius: 6px;
        border: 4px solid #ddd;
        width: 100%;
    }

    h4 {
        margin-top: 0;
    }

    button {
        margin-top: 10px;
    }

    .button-group {
        margin-top: 10px;
    }

    #profile-image {
        width: 100%;
        /* Cover the image area */
        max-width: 380px;
        height: auto;
    }
</style>




<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-users me-3" style="font-size: 40px; color: white;"></i>
                <div>
                    <h5 class="card-title">Organisation</h5>
                    <h3 class="card-text" id="groupOfPeopleCount">{{$userorganiCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-users me-3" style="font-size: 40px; color: white;"></i> <!-- Changed icon to 'users' -->
                <div>
                    <h5 class="card-title">Groups</h5>
                    <h3 class="card-text" id="organizationCount">{{$usergroupCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-user-friends me-3" style="font-size: 40px; color: white;"></i> <!-- Changed icon to 'user-friends' -->
                <div>
                    <h5 class="card-title">Membership</h5>
                    <h3 class="card-text" id="groupsCount">{{$usermembershipCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-calendar-alt me-3" style="font-size: 40px; color: white;"></i> <!-- Changed icon to 'calendar-alt' -->
                <div>
                    <h5 class="card-title">Events</h5>
                    <h3 class="card-text" id="insightsCount">{{$usereventCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-pencil-alt me-3" style="font-size: 40px; color: white;"></i> <!-- Changed icon to 'pencil-alt' -->
                <div>
                    <h5 class="card-title">Posts</h5>
                    <h3 class="card-text" id="insightsCount">{{$userpostCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-user-check me-3" style="font-size: 40px; color: white;"></i> <!-- Changed icon to 'user-check' -->
                <div>
                    <h5 class="card-title">Event Participation</h5>
                    <h3 class="card-text" id="insightsCount">{{$userattendeventcount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-comments me-3" style="font-size: 40px; color: white;"></i> <!-- Using 'comments' icon -->
                <div>
                    <h5 class="card-title">Feedbacks Participation</h5>
                    <h3 class="card-text" id="feedbacksCount">{{$userfeedbackCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-chart-line me-3" style="font-size: 40px; color: white;"></i> <!-- Using 'chart-line' icon -->
                <div>
                    <h5 class="card-title">Insights</h5>
                    <h3 class="card-text" id="insightsCount">{{$userinsightCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>




</div>


<div class="col-xl-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="container-fluid">
                <form id="profile-form" method="POST" action="/update-profile" enctype="multipart/form-data">
                    @csrf <!-- Add CSRF protection -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="well well-sm profile-card">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <!-- Profile Image -->
                                        <img id="profile-image"
                                            src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                                            alt="Profile Image" class="img-rounded img-responsive profile-img" />

                                        <!-- Upload new image -->
                                        <input type="file" class="form-control" id="profile-image-upload"
                                            name="profile_image" accept="image/*" style="margin-top:10px;">

                                        <!-- Cancel Image button (hidden initially) -->
                                        <button type="button" class="btn btn-danger" id="cancel-image-btn"
                                            style="display:none; margin-top:10px;">Cancel Image</button>
                                    </div>

                                    <div class="col-sm-6 col-md-8">
                                        <h4>
                                            <!-- First Name -->
                                            <input type="text" class="form-control" id="edit-first-name"
                                                name="first_name" value="{{ $user->first_name }}"
                                                placeholder="First Name" />
                                        </h4>
                                        <h4>
                                            <!-- Last Name -->
                                            <input type="text" class="form-control" id="edit-last-name"
                                                name="last_name" value="{{ $user->last_name }}"
                                                placeholder="Last Name" />
                                        </h4>

                                        <p>
                                            <!-- Email -->
                                            <i class="glyphicon glyphicon-envelope"></i>
                                            <input type="email" class="form-control" id="edit-email" name="email"
                                                value="{{ $user->email }}" placeholder="Email" />
                                            <br />

                                            <!-- Phone -->
                                            <i class="glyphicon glyphicon-phone"></i>
                                            <input type="text" class="form-control" id="edit-phone" name="phone"
                                                value="{{ $user->phone }}" placeholder="Phone Number" />
                                            <br />

                                            <!-- Gender -->
                                            <i class="glyphicon glyphicon-user"></i>
                                            <select class="form-control" id="edit-gender" name="gender">
                                                <option value="male"
                                                    {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female"
                                                    {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                            <br />
                                        </p>

                                        <!-- Update button -->
                                        <div class="button-group">
                                            <button type="submit" class="btn btn-success"
                                                id="update-btn">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>








<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>


<link href="//netdna.bootstrapcdn.com/bootstrap/.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
{{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> --}}
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });


        $('#groupstable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });


        // Add visible class to cards for animation
        document.querySelectorAll('.card').forEach(card => {
            card.classList.add('visible');
        });


    });




    //profile view logics
    $(document).ready(function() {
        $('#profile-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            const formData = new FormData(this); // Use the form element directly

            // Disable update button and show loading state
            $('#update-btn').prop('disabled', true).text('Updating...');

            $.ajax({
                url: '/update-profile', // Your update profile route
                method: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    if (response.status === 200) {
                        // Show success notification with the returned message
                        showFlashMessage('success', response
                            .message); // Use the returned message

                        // const profileImageUrl = "{{ asset('" + response.user.photo + "') }}"; // Wrap the image URL with asset syntax
                        // $('#profile-image').attr('src', profileImageUrl); // Update profile image

                        // $('#edit-first-name').val(response.user.first_name); // Update first name
                        // $('#edit-last-name').val(response.user.last_name); // Update last name
                        // $('#edit-email').val(response.user.email); // Update email
                        // $('#edit-phone').val(response.user.phone); // Update phone
                        // $('#edit-gender').val(response.user.gender); // Update gender
                        setTimeout(function() {
                            location.reload();
                        }, 4000);
                        // Reset the form
                        $('#profile-form')[0].reset();
                        $('#update-btn').prop('disabled', false).text('update');
                    }
                },
                error: function(err) {
                    showFlashMessage('warning', response
                        .message); // Use the returned message
                    // alert('An error occurred while updating your profile.');
                    console.error('Error updating profile:', err);
                },
                complete: function() {
                    $('#update-btn').prop('disabled', false).text(
                        'Update'); // Re-enable button on completion
                    // Stop any loading indicator if present (e.g., hide loader)
                    $('#submitLoader').addClass('d-none'); // Example loader element
                }
            });
        });




        // Preview the uploaded profile image
        $('#profile-image-upload').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-image').attr('src', e.target.result); // Update the image preview
                    $('#cancel-image-btn').show(); // Show cancel button
                }
                reader.readAsDataURL(file);
            }
        });

        // Handle cancel image
        $('#cancel-image-btn').on('click', function() {
            $('#profile-image').attr('src', 'http://placehold.it/380x500'); // Reset to placeholder
            $('#profile-image-upload').val(''); // Clear the file input
            $(this).hide(); // Hide cancel button
        });

        // Disable submit button after form submission
        $('#profile-form').on('submit', function() {
            $('#update-btn').prop('disabled', true).text('Updating...');
        });
    });
</script>
