@props(['groupdata'])


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-deleteevent').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.href;

                Swal.fire({
                    title: `Do you want to delete this event`,
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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-deletefeedbac').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.href;

                Swal.fire({
                    title: `Do you want to delete this feedback?`,
                    text: "The document will permanently be deleted!",
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

@if (@session('eventdeletionsuccess'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "event deleted",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (@session('feedbacdeletionsuccess'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Feedback deleted",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (@session('feedbacdeletionerror'))
    <script>
        Swal.fire({
            icon: "warning",
            title: "Sorry...",
            text: "we could not process your request right now!",
        });
    </script>
@endif
@if (@session('eventdeletionerror'))
    <script>
        Swal.fire({
            icon: "warning",
            title: "Sorry...",
            text: "we could not process your request right now!",
        });
    </script>
@endif


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
    integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-lg-12 mt-4 mt-lg-0">
            <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                <table class="table table-hover manage-candidates-top mb-0">

                    <thead>
                        <tr>
                            <th>Group Events</th>
                            <th class="text-center">Attendee</th>
                            <th class="action text-right">Feedbacks</th>
                            <th class="action text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($groupdata->events as $groupevent)
                            {{-- start of user data --}}
                            <tr class="candidates-list">
                                <td class="title">
                                    <div class="col-md-2 img-content">
                                        <img class="img-fluid" src="{{ asset('storage/' . $groupevent->image) }}"
                                            alt="...">
                                    </div>
                                    <div class="candidate-list-details">
                                        <div class="candidate-list-info">
                                            <div class="candidate-list-title">
                                                <h5 class="mb-0"><a href="#" class="title_link">
                                                        {{ $groupevent->title }}
                                                    </a></h5>
                                            </div>
                                            <div class="candidate-list-option event_sub_details">
                                                <ul class="list-unstyled">
                                                    <li><i
                                                            class="fas fa-file-alt fa-lg pr-1 text-secondary"></i>{{ $groupevent->description }}
                                                    </li> <br>

                                                </ul>
                                            </div>


                                            <div class="candidate-list-option event_sub_details">
                                                <ul class="list-unstyled">
                                                    {{ ' ' }}
                                                    <li><i class="fas fa-calendar-alt fa-lg pr-1 text-warning"></i></i>
                                                        {{ $groupevent->date }}
                                                    </li> {{ '' }}
                                                    <li><i class="fas fa-clock fa-lg pr-1 text-info"></i></i></i>
                                                        {{ $groupevent->time }}
                                                    </li> {{ '' }}
                                                    <li><i class="fas fa-map-marker-alt fa-lg pr-1 text-danger"></i>
                                                        {{ $groupevent->location }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                {{-- ['id' => $groupdata->id --}}

                                <td class="candidate-list-favourite-time text-center">
                                    <a class="candidate-list-favourite order-2 text-success"
                                    {{-- href="{{ route('group_details.events.viewevent', ['id' => $groupevent->id]) }}" --}}
                                    href="{{ route('group_details.events.viewevent', ['group' => $groupdata->id, 'event' => $groupevent->id]) }}"

                                    >

                                    <i
                                            class="fas fa-users"></i></a>
                                    <span class="candidate-list-time order-1">
                                        @if ($groupevent->bookings)
                                            {{ $groupevent->bookings->count() }}
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </span>
                                </td>



                                <td>
                                    <div class="scrollable-content feebacholder">
                                        @if ($groupevent->feedbacs)
                                            @foreach ($groupevent->feedbacs as $feedbac)
                                                <ul
                                                    class="list-unstyled mb-0 d-flex align-items-center justify-content-evenly">
                                                    <li class="feedbacuser mr-3">
                                                        <div class="user-info d-flex align-items-center">
                                                            <img src="{{ asset('storage/' . $feedbac->user->photo) }}"
                                                                alt="Avatar" class="avatar mr-2">
                                                            <span class="username">
                                                                {{ $feedbac->user->first_name }}
                                                                {{ $feedbac->user->last_name }}
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li class="mr-2">
                                                        <a href="{{ $feedbac->report }}" type="button"
                                                            class="btn btn-primary" data-toggle="tooltip"
                                                            title="View">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('group_details.event.feedback.delete', ['id' => $feedbac->id]) }}"
                                                            type="button" class="btn btn-danger btn-deletefeedbac"
                                                            data-toggle="tooltip" title="Delete">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <ul class="list-unstyled mb-0 d-flex justify-content-end">

                                        <li><a href="{{ route('group_details.event.delete', ['id' => $groupevent->id]) }}"
                                                class="text-danger btn-deleteevent" data-toggle="tooltip" title=""
                                                data-original-title="Delete"><i class="far fa-trash-alt"></i>

                                            </a>
                                        </li>
                                    </ul>
                                </td>

                            </tr>
                        @endforeach
                        {{-- end of user data --}}



                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

