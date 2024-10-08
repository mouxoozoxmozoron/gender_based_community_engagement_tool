@props(['groupdata'])
@props(['groupusers'])


<style>

</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-deleteuser').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.href;
                var name = this.getAttribute('data-name');

                Swal.fire({
                    title: `Do you want to delete ${name}?`,
                    text: "You won't be able to revert this action!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>

@if (@session('userdeletionsuccess'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "User deleted",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (@session('deletionerror'))
    <script>
        Swal.fire({
            icon: "warning",
            title: "Sorry...",
            text: "we could not process your request right now!",
            // footer: '<a href="#">Why do I have this issue?</a>'
        });
    </script>
@endif

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
    integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
{{-- <div class="container mt-3 mb-4"> --}}
    <div class="container-fluid mt-3 mb-4">


    {{-- <div class="col-lg-9 mt-4 mt-lg-0"> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                    <table class="table manage-candidates-top mb-0">
                        <thead class="tablehead">
                            <tr>
                                <th>Group members</th>
                                <th class="text-center">Status</th>
                                <th class="action text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            {{-- start of user data --}}
                            @if (!$groupusers)
                                <span>No group members</span>
                            @else
                                @foreach ($groupusers as $user)
                                    <tr class="candidates-list">
                                        <td class="title">
                                            <div class="thumb">
                                                <img class="img-fluid" src="{{ asset('storage/' . $user->photo) }}"
                                                    alt="">
                                            </div>
                                            <div class="candidate-list-details">
                                                <div class="candidate-list-info">
                                                    <div class="candidate-list-title">
                                                        <h5 class="mb-0"><a href="#">
                                                                {{ $user->first_name }}
                                                                {{ '' }}
                                                                {{ $user->last_name }}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="candidate-list-option">
                                                        <ul class="list-unstyled">
                                                            <li><i class="fas fa-envelope pr-1"></i>
                                                                {{ $user->email }}
                                                            </li>
                                                            <li><i class="fas fa-phone pr-1"></i>
                                                                {{ $user->phone }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="candidate-list-favourite-time text-center">
                                            <a class="candidate-list-favourite order-2 text-success" href="#"><i
                                                    class="fas fa-heart"></i></a>
                                            <span class="candidate-list-time order-1">Active</span>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                {{-- <li><a href="#" class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#userprofilemodel"><i
                                                            class="far fa-eye"></i></a>
                                                </li>
                                                <li><a href="#" class="text-info" data-toggle="tooltip"
                                                        title="" data-original-title="Edit"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </li> --}}
                                                <li><a href="{{ route('group_details.user.delete', ['id' => $user->id]) }}"
                                                        data-name="{{ $user->first_name }}"
                                                        class="text-danger btn-deleteuser" data-toggle="tooltip"
                                                        title="" data-original-title="Delete"><i
                                                            class="far fa-trash-alt"></i>

                                                    </a>
                                                </li>
                                            </ul>
                                        </td>

                                    </tr>
                                @endforeach
                                {{-- <x-models.user_details :user="$user" /> --}}

                            @endif
                            {{-- end of user data --}}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

{{-- </div> --}}
