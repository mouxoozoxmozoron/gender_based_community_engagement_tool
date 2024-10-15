<style>
    .custom-input {
        height: 30px;
        /* Reducing the height */
        border-radius: 30px;
        /* Making the input rounded */
        padding-left: 15px;
        /* Adding some padding for a clean look */
    }

    .custom-input:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Optional: Adding focus effect */
        border-color: #80bdff;
        /* Optional: Change the border color on focus */
    }

    .custom-textarea {
        border-radius: 15px;
        /* Rounded corners */
        padding: 10px;
        /* Adjust padding for text inside textarea */
        resize: none;
        /* Disable resizing (optional) */
    }

    .custom-textarea:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Focus effect */
        border-color: #80bdff;
        /* Change border color on focus */
    }
</style>


<div class="card-body">
    <table id="organisationtable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Organisation Mame</th>
                <th>Created By</th>
                <th>Managed By</th>
                <th>Aproved By</th>
                <th>Created At</th>
                <th>Legal Docs</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Organisation Mame</th>
                <th>Created By</th>
                <th>Managed By</th>
                <th>Aproved By</th>
                <th>Created At</th>
                <th>Legal Docs</th>
            </tr>
        </tfoot>
        <tbody>
            @if (!$organisations)
                <span>No Data found</span>
            @else
                @foreach ($organisations as $organisation)
                    @php
                        $aprovedBy = \App\Models\User::where('id', $organisation->aproved_by)->first();
                        $managedBy = \App\Models\User::where('id', $organisation->org_admin_id)->first();
                        $createdBy = \App\Models\User::where('id', $organisation->user_id)->first();
                    @endphp
                    <tr>
                        <td>{{ $organisation->id }}</td>
                        <td>
                            <a href="{{ route('organisation.organisationreport', $organisation->id) }}">
                                {{ $organisation->organisation_name }}
                            </a>
                        </td>
                        <td>
                            {{ $createdBy->first_name }}
                            {{ $createdBy->last_name }}
                        </td>
                        <td>
                            {{ $managedBy->first_name ?? 'Not Asidned' }}
                            {{ $managedBy->last_name ?? '...' }}
                        </td>
                        <td>
                            {{ $aprovedBy->first_name ?? 'Pending...' }}
                            {{ $aprovedBy->last_name ?? '...' }}
                        </td>
                        <td>{{ $organisation->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="mb-3">
                                <span class="badge bg-primary">
                                    <a href="{{ asset($organisation->legal_docs) }}" target="_blank" class="text-white"
                                        style="text-decoration: none;">
                                        Open
                                    </a>
                                </span>
                            </div>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>


<!-- Create Account Modal -->
<div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAccountModalLabel">Create Organisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newOrganisationForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control custom-input" id="inputFirstName" name="groupName"
                                    type="text" placeholder="Organisation name" />
                                <label for="inputFirstName">Organisation Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control custom-input" id="inputLastName" name="legaldocs"
                                    type="file" placeholder="Provide a description" />
                                <label for="inputLastName">Legal Document</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control custom-textarea" id="inputDescription" name="description"
                            placeholder="Provide a description" style="height: 100px;"></textarea>
                        <label for="inputDescription">Description</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="saveorganisation">Create</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="assignAdminModal" tabindex="-1" aria-labelledby="assignAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignAdminModalLabel">Assign Assistant Admin to Organisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="adminstable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Use Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $Users = \App\Models\User::where('archive', 0)->where('status', 1)->get();
                        @endphp

                        @if ($Users->isEmpty())
                            <tr>
                                <td colspan="5">No Data found</td>
                            </tr>
                        @else
                            @foreach ($Users as $user)
                                <tr>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>
                                        <button class="btn btn-primary assign-btn"
                                            data-user-id="{{ $user->id }}">Assign</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
