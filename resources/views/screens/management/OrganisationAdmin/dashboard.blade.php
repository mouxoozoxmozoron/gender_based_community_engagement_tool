<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Organisation Admin Dashboard</li>
        </ol>
        <div id="dashboardVIew"></div>

    </div>
</main>



<script>



    $(document).ready(function() {
        // Function to get view and populate it into #getuserView div
        function getView() {
            $.ajax({
                url: "{{ route('organisation.adminview') }}",
                type: "GET",
                success: function(response) {
                    // Populate the response into the #getuserView div
                    $('#dashboardVIew').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred: " + status + " - " + error);
                }
            });
        }

        // Call the function when the page loads
        getView();
    });
</script>
