<div class="content_spacing">
    <div class="modal fade" id="registrationmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Open account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="regform" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" name="first_name" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="col-form-label">Gender:</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="phone-number" class="col-form-label">Phone number</label>
                            <input type="tel" name="phone" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="form-group">
                            <input type="file" name="profile_image" id="profileImage" class="form-control" accept="image/*" required />
                            <label class="form-label" for="profileImage">Profile Image</label>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#regform').on('submit', function(event) {
        event.preventDefault();

        $('#registrationFailureMessage').remove();

        var formData = new FormData(this); // Use FormData to include file input

        // Submit the form using AJAX
        $.ajax({
            url: '{{ route('registration_check') }}',
            method: 'POST',
            data: formData,
            processData: false, // Important to set this to false for FormData
            contentType: false, // Important to set this to false for FormData
            success: function(response) {
                if (response.success) {
                    // If registration is successful, redirect to the intended page
                    window.location.href = response.redirect;
                } else {
                    // If registration fails, display the error message
                    var alertHtml = '<div class="alert alert-danger" id="registrationFailureMessage">' + response.message + '</div>';
                    $('.modal-body').prepend(alertHtml);
                }
            },
            error: function(xhr) {
                // Handle errors and display the actual error message
                var alertHtml = '<div class="alert alert-danger" id="registrationFailureMessage">Error: ' + xhr.responseJSON.error + '</div>';
                $('.modal-body').prepend(alertHtml);
            }
        });
    });

    // Show modal if there's a failure message on initial load
    @if (session('registration_failure'))
        $('#registrationmodel').modal('show');
        alert('{{ session('registration_failure') }}');
    @endif
});
</script>
