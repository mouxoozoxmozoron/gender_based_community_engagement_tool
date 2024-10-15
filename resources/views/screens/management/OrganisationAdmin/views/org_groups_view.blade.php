
<div class="card-body">
    <table id="organisationtable">
        <thead>
            <tr>
                <th>S/n</th>
                <th>Group Mame</th>
                <th>Admin</th>
                <th>Created By</th>
                <th>Aproved By</th>
                <th>Created At</th>
                <th>Posts</th>
                <th>Events</th>
                <th>Members</th>
                <th>Legal Docs</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>S/n</th>
                <th>Group Mame</th>
                <th>Admin</th>
                <th>Created By</th>
                <th>Aproved By</th>
                <th>Created At</th>
                <th>Posts</th>
                <th>Events</th>
                <th>Members</th>
                <th>Legal Docs</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            @php
                $sn = 0;
            @endphp
            @if (!$groups)
            <span>No Data found</span>
                @else
            @foreach ($groups as $group)

            @php
                        $sn ++;
                        $postCount = \App\Models\Post::where('group_id', $group->id)->count();
                        $eventCount = \App\Models\Event::where('group_id', $group->id)->count();
                        $memberCount = \App\Models\Group_Member::where('group_id', $group->id)->count();
                        $admin = \App\Models\User::where('id', $group->admin_id)->first();
                        $creater = \App\Models\User::where('id', $group->admin_id)->first();
                        $aprover = \App\Models\Organisation::where('id', $group->organisation_id)->first();
            @endphp
            <tr>
                <td>{{$sn}}</td>
                <td>{{$group->name}}</td>
                <td>{{$admin->first_name}} {{$admin->last_name}}</td>
                <td>{{$creater->first_name}} {{$creater->last_name}}</td>
                <td>{{$aprover->organisation_name ?? 'Pending...'}}</td>
                <td>{{ $group->created_at->format('F j, Y') }}</td>
                <td>
                    <a href="{{ route('organisation.orggroupposts', ['id' => $group->id]) }}">
                        {{ $postCount }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('organisation.organisationevent', ['id' => $group->id]) }}">
                        {{ $eventCount }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('organisation.orggroupmembers', ['id' => $group->id]) }}">
                        {{ $memberCount }}
                    </a>
                </td>
                <td>
                    <div class="mb-3">
                        @if(!empty($group->legal_docs))
                            <span class="badge bg-primary">
                                <a href="{{ asset($group->legal_docs) }}" target="_blank" class="text-white" style="text-decoration: none;">
                                    Open
                                </a>
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                Not Available
                            </span>
                        @endif
                    </div>
                </td>

                <td>
                    @if ($group->status == 0)
                    <!-- Pending Badge -->
                    <span class="badge bg-warning pending-badge"
                          data-id="{{ $group->id }}"
                          data-bs-toggle="tooltip"
                          title="Click to approve">
                        Pending
                    </span>
                    @elseif ($group->status == 1)

                    <!-- Active Badge -->
                    <span class="badge bg-success active-badge"
                          data-id="{{ $group->id }}"
                          data-bs-toggle="tooltip"
                          title="Click to suspend">
                        Active
                    </span>
                    @endif

                </td>
                <td>
                <!-- Deleted Badge -->
                 <span class="badge bg-danger delete-badge"
                    data-id="{{ $group->id }}"
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
