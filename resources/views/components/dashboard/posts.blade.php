@props(['groupdata'])


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-deletepost').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.href;

                Swal.fire({
                    title: `Do you want to delete this post`,
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
</script>

@if (@session('postdeletionsuccess'))
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

@if (@session('postdeletionerror'))
    <script>
        Swal.fire({
            icon: "warning",
            title: "Sorry...",
            text: "we could not process your request right now!",
            // footer: '<a href="#">Why do I have this issue?</a>'
        });
    </script>
@endif



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
    integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<div class="container mt-3 mb-4">
    <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="row">
            <div class="col-md-12">
                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                    <table class="table manage-candidates-top mb-0">
                        <thead>
                            <tr>
                                <th>Group Posts</th>
                                <th class="text-center">Reaction</th>
                                <th class="action text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            {{-- start of user data --}}
                            @foreach ($groupdata->posts as $post)
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="col-md-2 img-content">
                                            <img class="img-fluid" src="{{ asset('storage/' . $post->post_image) }}"
                                                alt="...">
                                        </div>
                                        <div class="candidate-list-details event_sub_details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title ">
                                                    <h5 class="mb-0"><a href="#" class="title_link">{{ $post->title }}</a></h5>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li><i
                                                                class="fas fa-file-alt fa-lg pr-1 text-warning" ></i>{{ $post->description }}
                                                        </li> <br>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="candidate-list-favourite-time text-center">
                                        <a class="candidate-list-favourite order-2 text-info" href="#"><i
                                                class="fas fa-comment fa-lg pr-1"></i></a> {{"  "}}
                                        <span class="candidate-list-time order-1">{{ $post->comments->count() }}</span> <br>
                                        <a class="candidate-list-favourite order-2 text-info" href="#"><i
                                                class="fas fa-thumbs-up pr-1 fa-lg"></i></a> {{"   "}}
                                        <span class="candidate-list-time order-1">{{ $post->likes->count() }}</span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip"
                                                    title="" data-original-title="view"><i
                                                        class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            </li>
                                            <li><a href="{{ route('group_details.post.delete', ['id' => $post->id]) }}"
                                                    class="text-danger btn-deletepost" data-toggle="tooltip" title=""
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
</div>
