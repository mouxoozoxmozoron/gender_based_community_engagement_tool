@php
    $usercompanies = session('usercompanies', collect());
@endphp

@include('components.utilis.app')


@include('components.dashboard.side_nav_bar', ['groupdata' => $groupdata])

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                    <div id="profileView"></div>

                </div>
            </main>

        </div>
    </main>


    @include('components.footer')

</div>
</div>

<x-models.profile_model />
<x-models.group_list />




<script>
    $(document).ready(function() {
        // Function to get view and populate it into #getuserView div
        function getView() {
            $.ajax({
                url: "{{ route('profileView') }}",
                type: "GET",
                success: function(response) {
                    // Populate the response into the #getuserView div
                    $('#profileView').html(response);
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
