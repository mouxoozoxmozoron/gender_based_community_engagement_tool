  <!-- Modal -->
  <div class="modal fade" id="mygrouplist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Advocacy Groups</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              @if (session('user_groups') && count(session('user_groups')) > 0)
                  @foreach (session('user_groups') as $user_group)
                      <div class="modal-body">
                          <a href="{{ route('group_details', ['id' => $user_group->id]) }}" class="group_list_link">
                              {{ $user_group->name }}
                          </a>
                      </div>
                  @endforeach
              @else
                  <div class="modal-body">
                      No groups found, you can use the gbc app to create a new group.
                  </div>
              @endif
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
