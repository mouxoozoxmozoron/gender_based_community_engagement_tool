
<style>
.profile-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    transition: transform 0.3s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-img:hover {
    transform: scale(1.5);
    z-index: 10;
}

@media screen and (max-width: 768px) {
    .profile-img {
        width: 80px;
        height: 80px;
    }
}

@media screen and (max-width: 480px) {
    .profile-img {
        width: 60px;
        height: 60px;
    }
}

    </style>
    <div class="card-body">
        <table id="groupPostTable">
            <thead>
                <tr>
                    <th>S/n</th>
                    <th></th>
                    <th>Name</th>
                    <th>email</th>
                    <th>phone Number</th>
                    <th>Joined On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>S/n</th>
                    <th></th>
                    <th>Name</th>
                    <th>email</th>
                    <th>phone Number</th>
                    <th>Joined On</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>


                @php
                    $sn = 0;
                @endphp
                @if (!$members)
                <span>No Data found</span>
                    @else
                @foreach ($members as $member)

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
                        <img src="{{ asset('storage/' . $member->users->photo) }}" alt="Profile Image" class="profile-img">
                    </td>
                    <td>{{$member->users->first_name}} {{$member->users->last_name}}</td>
                    <td>{{$member->users->email}}</td>
                    <td>{{$member->users->phone}}</td>
                    <td>{{ $member->created_at->format('F j, Y') }}</td>
                    <td>

                        @if ($member->status == 1)
                        {{-- suspend --}}
                        <span class="badge bg-success suspend-badge"
                            data-id="{{ $member->id }}"
                            data-bs-toggle="tooltip"
                            title="Click to suspend">
                            suspend
                        </span>
                        @elseif ($member->status == 0)
                        {{-- suspend --}}
                        <span class="badge bg-warning activate-badge"
                            data-id="{{ $member->id }}"
                            data-bs-toggle="tooltip"
                            title="Click to Activate">
                            activate
                        </span>
                        @endif

                    <!-- Delete Badge -->
                     <span class="badge bg-danger delete-badge"
                        data-id="{{ $member->id }}"
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
