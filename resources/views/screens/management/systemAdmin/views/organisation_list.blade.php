<style>
    .custom-input {
        height: 30px; /* Reducing the height */
        border-radius: 30px; /* Making the input rounded */
        padding-left: 15px; /* Adding some padding for a clean look */
    }

    .custom-input:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional: Adding focus effect */
        border-color: #80bdff; /* Optional: Change the border color on focus */
    }

    .custom-textarea {
        border-radius: 15px; /* Rounded corners */
        padding: 10px; /* Adjust padding for text inside textarea */
        resize: none; /* Disable resizing (optional) */
    }

    .custom-textarea:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Focus effect */
        border-color: #80bdff; /* Change border color on focus */
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
                        <th>Groups</th>
                        <th>Legal Docs</th>
                        <th>Status</th>
                        <th>Action</th>
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
                        <th>Groups</th>
                        <th>Legal Docs</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if (!$organisations)
                    <span>No Data found</span>
                        @else
                    @foreach ($organisations as $organisation)

                    @php
                                $gropsCount = \App\Models\Group::where('organisation_id', $organisation->id)->count();
                    @endphp
                    <tr>
                        <td>{{$organisation->id}}</td>
                        <td>{{$organisation->organisation_name}}</td>
                        <td>{{$organisation->user_id}}</td>
                        <td>{{$organisation->org_admin_id?? 'Not Asidned'}}</td>
                        <td>{{$organisation->aproved_by ?? 'Pending...'}}</td>
                        <td>{{$organisation->created_at}}</td>
                        <td>
                            <a href="{{ route('organisationgroups', $organisation->id) }}">
                                {{ $gropsCount }}
                            </a>
                        </td>
                        <td>
                            <div class="mb-3">
                                <span class="badge bg-primary">
                                    <a href="{{ asset($organisation->legal_docs) }}" target="_blank" class="text-white" style="text-decoration: none;">
                                        Open
                                    </a>
                                </span>
                            </div>
                        </td>

                        <td>
                            <!-- Pending Badge -->
                            <span class="badge bg-warning pending-badge"
                                  data-id="{{ $organisation->id }}"
                                  data-bs-toggle="tooltip"
                                  title="Click to approve">
                                Pending
                            </span>

                            <!-- Active Badge -->
                            <span class="badge bg-success active-badge"
                                  data-id="{{ $organisation->id }}"
                                  data-bs-toggle="tooltip"
                                  title="Click to suspend">
                                Active
                            </span>

                            <!-- Deleted Badge -->
                            <span class="badge bg-danger deleted-badge"
                                  data-id="{{ $organisation->id }}"
                                  data-bs-toggle="tooltip"
                                  title="Click to backup">
                                Deleted
                            </span>

                        </td>
                        <td>
                        <!-- Deleted Badge -->
                         <span class="badge bg-danger delete-badge"
                            data-id="{{ $organisation->id }}"
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




<!-- Create Account Modal -->
<div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel" aria-hidden="true">
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
                                <input class="form-control custom-input" id="inputFirstName" name="groupName" type="text" placeholder="Organisation name" />
                                <label for="inputFirstName">Organisation Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control custom-input" id="inputLastName" name="legaldocs" type="file" placeholder="Provide a description" />
                                <label for="inputLastName">Legal Document</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control custom-textarea" id="inputDescription" name="description" placeholder="Provide a description" style="height: 100px;"></textarea>
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














{{--
<div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAccountModalLabel">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control custom-input" id="inputFirstName" type="text" placeholder="Organisation name" />
                                <label for="inputFirstName">First name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control custom-input" id="inputLastName" type="text" placeholder="Enter your last name" />
                                <label for="inputLastName">Last name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control custom-input" id="inputEmail" type="email" placeholder="name@example.com" />
                        <label for="inputEmail">Email address</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control custom-input" id="inputPassword" type="password" placeholder="Create a password" />
                                <label for="inputPassword">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control custom-input" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                <label for="inputPasswordConfirm">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Account</button>
            </div>
        </div>
    </div>
</div> --}}
