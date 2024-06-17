<!-- Profile Modal -->
@props(['user']);
<div class="modal fade" id="userprofilemodel" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                    <img src="{{ asset('storage/' . $user->photo) }}"
                        class="rounded-circle mb-3 profile_photo_on_model" alt="Avatar" alt="N/A" />
                    <h5 class="mb-2"><strong>
                            {{ $user->first_name }}
                            {{ '' }}
                            {{ $user->last_name }}
                        </strong></h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p class="text-muted">{{ $user->phone }}</p>
                    {{-- <p class="text-muted">Web designer <span class="badge bg-primary">PRO</span></p> --}}
                    <a class="btn btn-info" href="#">Update</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
