
<style>
    #actionButton {
        padding: 4px 8px;
        font-size: 12px;
    }

    .card-header {
        background-color: #f8f9fa; /* Light grey background */
        border-radius: 8px; /* Rounded corners */
    }
    </style>

@php
    $usercompanies = session('usercompanies', collect());
@endphp

@include('components.utilis.app')

    @include('components.dashboard.side_nav_bar')

    <div id="layoutSidenav_content">

        <main>
{{-- vie goes here --}}


    <div class="container-fluid px-4">
        <h2 class="mt-6">Organisations</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('organisation.organisation_admindashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">organisation Groups</li>
        </ol>

        <div class="card mb-4">
            {{-- <div>
                <div class="card-header">
                    <i class="fas fa-users me-1" style="font-size: 24px; color: blue;"></i>
                    Organisations
                </div>
            </div> --}}

            <div class="card-header d-flex justify-content-between align-items-center" style="padding: 10px;">
                <div>
                    <i class="fas fa-users me-1" style="font-size: 24px; color: blue;"></i>
                    Organisation Group Events
                </div>
                {{-- <button class="btn btn-success" id="actionButton" data-bs-toggle="modal" data-bs-target="#createAccountModal">
                    New Organisation
                </button> --}}
            </div>

        @include('screens.management.OrganisationAdmin.views.org_event_view')
</div>
</div>


        </main>
        @include('components.footer')

    </div>
</div>

<x-models.profile_model />
<x-models.group_list />








<script>
//     window.addEventListener('DOMContentLoaded', event => {

//     const organisationtable = document.getElementById('organisationtable');

//     if (organisationtable) {
//         new simpleDatatables.DataTable(organisationtable);
//     }
// });


//TABLE WITH DOWNLOAD OPTIONS
$(document).ready(function() {
    $('#groupPostTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});


// this is not working for now
$(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();

    $('#saveorganisation').click(function(e) {
        e.preventDefault();

        let form = $('#newOrganisationForm')[0];
        let formData = new FormData(form);

        $('#saveorganisation').attr('disabled', true);

        $('#loadingBar').fadeIn().addClass('loading-active');


        $.ajax({
            url: '{{ route("saveneworganisation") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 200) {
                    showFlashMessage('success', response.message);
                    $('#newOrganisationForm')[0].reset();
                    $('#createAccountModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 4000);
                }
                else if (response.status === 422) {
                    showFlashMessage('danger', response.message);
                }
                else if (response.status === 500) {
                    showFlashMessage('danger', response.message);
                }
                else {
                    showFlashMessage('warning', response.message);
                }
            },
            error: function(xhr, status, error) {
                showFlashMessage('danger', 'An error occurred: ' + error);
            },
            complete: function() {
                // Stop the loading animation and hide the loading bar
                $('#loadingBar').fadeOut().removeClass('loading-active');

                // Re-enable the submit button after the request is done
                $('#saveorganisation').attr('disabled', false);
            }
        });
    });
});




//bedges functionalties
$(document).ready(function() {
    $('.pending-badge').click(function(e) {
        e.preventDefault();
        let groupid = $(this).data('id');
        if (confirm('Are you sure you want to approve this group?')) {

            $.ajax({
                url: '/approve-group/' + groupid,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 200) {
                        alert(response.message);
                        location.reload();
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
        let groupid = $(this).data('id');
        if (confirm('Are you sure you want to suspend this group?')) {

            $.ajax({
                url: '/suspend-group/' + groupid,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 200) {
                        alert(response.message);
                        location.reload();
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
    $('.delete-badge').click(function(e) {
        e.preventDefault();
        let groupid = $(this).data('id');
        if (confirm('Are you sure you want to delete this event?')) {

            $.ajax({
                url: '/delete-event/' + groupid,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 200) {
                        alert(response.message);
                        location.reload();
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


    //this is not working for now
    // Handle Deleted Badge click (Backup)
    $('.deleted-badge').click(function(e) {
        e.preventDefault();
        let groupid = $(this).data('id');
        if (confirm('Are you sure you want to backup this group?')) {

            $.ajax({
                url: '/backup-organisation/' + groupid,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 200) {
                        alert(response.message);
                        location.reload();
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
