<div class="content_spacing">
    <div class="modal fade" id="registrationmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Open account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" name="fname" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" name="lname" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="col-form-label">Gender:</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Phone number</label>
                            <input type="tel" name="phone" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Password</label>
                            <input type="password" name="phone" class="form-control" id="recipient-name" required>
                        </div>

                        <div class="mb-3">
                            <label for="profile-photo" class="col-form-label">Profile Photo:</label>
                            <input type="file" name="profile_photo" class="form-control" id="profile-photo" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-success">Login</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-link">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>
