<div>
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
            // Function to show notification
            function showNotification(type, message) {
        var notificationHtml = `
            <div class="alert alert-${type} alert-dismissible">
                <span>${message}</span>
                <span class="close" onclick="$(this).parent().remove();">&times;</span>
            </div>`;

        // Append notification to the container
        $('#notificationContainer').append(notificationHtml);

        // Use transition to fade in the alert
        var alertBox = $('#notificationContainer .alert').last();
        alertBox.addClass('show').fadeIn(400); // Animate to show

        // Auto-remove after 4 seconds with fade out
        setTimeout(function() {
            alertBox.fadeOut(400, function() {
                $(this).remove();
            });
        }, 4000);
    }
    </script>
</div>
