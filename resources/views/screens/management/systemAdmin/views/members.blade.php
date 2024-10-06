
                    <div class="container-fluid px-4">
                        <h2 class="mt-6">Tables</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('system_admindashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Members</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-users me-1" style="font-size: 24px; color: blue;"></i>
                                Group Mmebers
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Start date</th>
                                            <th>Last Update</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Start date</th>
                                            <th>Last Update</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if (!$users)
                                        <span>No Dat found</span>
                                            @else
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->gender?? 'Undefined'}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->updated_at}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


