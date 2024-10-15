@php
    $usercompanies = session('usercompanies', collect());
@endphp

@include('components.utilis.app')

    @include('components.dashboard.side_nav_bar')

    <div id="layoutSidenav_content">

        <main>
{{-- vie goes here --}}




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

    <div class="container-fluid px-4">
        <h2 class="mt-6">Organisations</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('system_admindashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">organisations</li>
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
                    Organisations
                </div>

            </div>

        @include('screens.management.OrganisationAdmin.views.report_orgview')


</div>
</div>


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

    const organisationtable = document.getElementById('organisationtable');
    if (organisationtable) {
        new simpleDatatables.DataTable(organisationtable);
    }
});



    window.addEventListener('DOMContentLoaded', event => {
    const AdminsTable = document.getElementById('adminstable');
    if (AdminsTable) {
        new simpleDatatables.DataTable(AdminsTable);
    }
});




$(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();

    $('#saveorganisation').click(function(e) {
        e.preventDefault(); // Prevent default action

        let form = $('#newOrganisationForm')[0];
        let formData = new FormData(form);

        $('#saveorganisation').attr('disabled', true);

        $('#loadingBar').fadeIn().addClass('loading-active');

        // Send AJAX request
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
    // Handle Pending Badge click (Approve)
    $('.pending-badge').click(function(e) {
        e.preventDefault();
        let organisationId = $(this).data('id');
        if (confirm('Are you sure you want to approve this organisation?')) {
            // AJAX call to approve
            $.ajax({
                url: '/approve-organisation/' + organisationId,
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
        let organisationId = $(this).data('id');
        if (confirm('Are you sure you want to suspend this organisation?')) {
            // AJAX call to suspend
            $.ajax({
                url: '/suspend-organisation/' + organisationId,
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
    $('.delete-badge').click(function(e) {
        e.preventDefault();
        let organisationId = $(this).data('id');
        if (confirm('Are you sure you want to delete this organisation?')) {
            // AJAX call to suspend
            $.ajax({
                url: '/delete-organisation/' + organisationId,
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

    // Handle Deleted Badge click (Backup)
    $('.deleted-badge').click(function(e) {
        e.preventDefault();
        let organisationId = $(this).data('id');
        if (confirm('Are you sure you want to backup this organisation?')) {
            // AJAX call to backup
            $.ajax({
                url: '/backup-organisation/' + organisationId,
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


        // Freeze or remove admin from an organisation
        $('.freezeAdmin-badge').click(function(e) {
        e.preventDefault();
        let organisationId = $(this).data('id');
        if (confirm('Are you sure you want to remove admin from this group?')) {
            // AJAX call to backup
            $.ajax({
                url: '/freezeadmin-organisation/' + organisationId,
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







//asign admin to an organisation
$(document).ready(function() {
    let selectedOrganisationId = null;

    $('.asignadmin-badge').on('click', function() {
        selectedOrganisationId = $(this).data('id');
        $('#assignAdminModal').modal('show');
    });

    $('.assign-btn').on('click', function() {
        let selectedUserId = $(this).data('user-id');

        $.ajax({
            url: "{{ route('organisation.asignasistantadmin') }}",
            method: 'POST',
            data: {
                organisation_id: selectedOrganisationId,
                user_id: selectedUserId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 200) {
                    showFlashMessage('success', response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                    $('#assignAdminModal').modal('hide');
                }
                else if (response.status === 400) {
                    showFlashMessage('warning', response.message);
                }
                else if (response.status === 500) {
                    showFlashMessage('danger', response.message);
                }
                else {
                    showFlashMessage('warning', response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error assigning admin');
            }
        });
    });
});


</script>
