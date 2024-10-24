@php
    $usercompanies = session('usercompanies', collect());
@endphp

@include('components.utilis.app')

    @include('components.dashboard.side_nav_bar')

    <div id="layoutSidenav_content">

        <main>
{{-- vie goes here --}}
@include('screens.management.systemAdmin.views.members')
        </main>
        @include('components.footer')

    </div>
</div>

<x-models.profile_model />
<x-models.group_list />





<script>
    window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});




//bedges functionalties
$(document).ready(function() {
    // Handle Pending Badge click (Approve)
    $('.pending-badge').click(function(e) {
        e.preventDefault();
        let userid = $(this).data('id');
        if (confirm('Are you sure you want to approve this account?')) {
            // AJAX call to approve
            $.ajax({
                url: '/approve-account/' + userid,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 200) {
                        alert(response.message);
                        location.reload(); // Reload page if needed
                    } else {
                        alert('An error occurred: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    });

    // Handle Active Badge click (Suspend)
    $('.active-badge').click(function(e) {
        e.preventDefault();
        let userid = $(this).data('id');
        if (confirm('Are you sure you want to suspend this account?')) {
            // AJAX call to suspend
            $.ajax({
                url: '/suspend-account/' + userid,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 200) {
                        alert(response.message);
                        location.reload(); // Reload page if needed
                    } else {
                        alert('An error occurred: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    });
    });

</script>
