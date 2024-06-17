<div class="content_spacing">
    <div class="modal fade" id="loginmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Remove existing alert
            $('#loginFailureMessage').remove();

            // Serialize the form data
            var formData = $(this).serialize();

            // Submit the form using AJAX
            $.ajax({
                url: '{{ route('login_check') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // If login is successful, redirect to the intended page
                        window.location.href = response.redirect;
                    } else {
                        // If login fails, display the error message
                        var alertHtml = '<div class="alert alert-danger" id="loginFailureMessage">' + response.message + '</div>';
                        $('.modal-body').prepend(alertHtml);
                    }
                },
                error: function(xhr) {
                    // Handle errors (e.g., validation errors)
                    var alertHtml = '<div class="alert alert-danger" id="loginFailureMessage">An error occurred. Please try again.</div>';
                    $('.modal-body').prepend(alertHtml);
                }
            });
        });

        // Show modal if there's a failure message on initial load
        @if (session('login_failure'))
            $('#loginmodel').modal('show');
            alert('{{ session('login_failure') }}');
        @endif
    });
</script>
