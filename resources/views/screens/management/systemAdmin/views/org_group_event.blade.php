
<style>
    .img-responsive {
        width: 100%;
        max-width: 400px;  /* Default max-width */
        max-height: 300px; /* Default max-height */
        height: auto;      /* Keeps aspect ratio, respects max-height */
        display: block;
        object-fit: cover; /* Ensures the image fits inside the given dimensions without distortion */
    }

    /* Adjust image size for larger screens */
    @media (min-width: 768px) {
        .img-responsive {
            max-width: 500px;  /* Larger width for bigger screens */
            max-height: 400px; /* Larger height for bigger screens */
        }
    }

    /* Adjust image size for extra-large screens */
    @media (min-width: 1200px) {
        .img-responsive {
            max-width: 600px;  /* Even larger width */
            max-height: 450px; /* Even larger height */
        }
    }

    </style>
    <div class="card-body">
        <table id="groupPostTable">
            <thead>
                <tr>
                    <th>S/n</th>
                    <th>image</th>
                    <th>title</th>
                    <th>description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>LOcation</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>S/n</th>
                    <th>image</th>
                    <th>title</th>
                    <th>description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>LOcation</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>


                @php
                    $sn = 0;
                @endphp
                @if (!$events)
                <span>No Data found</span>
                    @else
                @foreach ($events as $event)

                @php
                            $sn ++;
                            // $postCount = \App\Models\Post::where('group_id', $group->id)->count();
                            // $eventCount = \App\Models\Event::where('group_id', $group->id)->count();
                            // $memberCount = \App\Models\Group_Member::where('group_id', $group->id)->count();
                            // $admin = \App\Models\User::where('id', $group->admin_id)->first();
                            // $creater = \App\Models\User::where('id', $group->admin_id)->first();
                            // $aprover = \App\Models\Organisation::where('id', $group->organisation_id)->first();
                @endphp
                <tr>
                    <td>{{$sn}}</td>
                    <td>
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-responsive">
                    </td>
                    <td>{{$event->title}}</td>
                    <td>{{$event->description}}</td>
                    <td>{{$event->date}}</td>
                    <td>{{$event->time}}</td>
                    <td>{{$event->location}}</td>
                    <td>{{$event->user->first_name}}{{$event->user->last_name}}</td>
                    <td>{{ $event->created_at->format('F j, Y') }}</td>
                    <td>
                    <!-- Deleted Badge -->
                     <span class="badge bg-danger delete-badge"
                        data-id="{{ $event->id }}"
                        data-bs-toggle="tooltip"
                        title="Click to delete">
                        Delete
                    </span>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
