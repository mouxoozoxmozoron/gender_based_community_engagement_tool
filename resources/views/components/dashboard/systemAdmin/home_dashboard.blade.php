@props(['groupdata', 'usercount', 'postcount', 'eventcount'])

@if (@session('emailsentsuccess'))
    <script>
        alert("email sent");
    </script>
@endif

@if (session('emailsendfailure'))
    <script>
        alert("An error occured, please try again later");
    </script>
@endif


<div class="app-wrapper overviewcontainer">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Overview</h1>

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration overviewcard" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <h3 class="mb-3">Welcome, admin!</h3>
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-9">

                                <div>
                                    gbce web allows you to manage your group you created with gbce mobile app, the
                                    first
                                    gbce app version, let you manage your group activities with an easy and
                                    effective
                                    achievements
                                </div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

            <div class="row g-4 mb-4 overviewcontainer">

                {{-- @foreach ($groupdata->group_members as $member)
                    @if ($member->users) --}}

                <div class="col-6 col-lg-3 memberscontainer">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Members</h4>
                            <div class="stats-figure">{{ $groupdata->group_members->count() }}</div>
                            <div class="stats-meta text-success">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                </svg> {{ number_format(($groupdata->group_members->count() / $usercount) * 100, 2) }}%
                            </div>
                        </div><!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div><!--//app-card-->
                </div><!--//col-->


                <div class="col-6 col-lg-3 eventcontainser">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Events</h4>
                            <div class="stats-figure">{{ $groupdata->events->count() }}</div>
                            <div class="stats-meta text-success">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                </svg> {{ number_format(($groupdata->events->count() / $eventcount) * 100, 2) }}%
                            </div>
                        </div><!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div><!--//app-card-->
                </div><!--//col-->


                <div class="col-6 col-lg-3 postcontainer">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total Posts</h4>
                            <div class="stats-figure">{{ $groupdata->posts->count() }}</div>
                            <div class="stats-meta text-success">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                </svg> {{ number_format(($groupdata->posts->count() / $postcount) * 100, 2) }}%
                            </div>
                        </div><!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div><!--//app-card-->
                </div><!--//col-->

                <div class="col-6 col-lg-3 feedbackcontainer">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Feedbacs</h4>
                            <div class="stats-figure">0</div>
                            <div class="stats-meta">New</div>
                        </div><!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div><!--//app-card-->
                </div><!--//co
                        l-->
            </div><!--//row-->





            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-progress-list h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">
                                        {{ count(session('user_groups')) -1 }}
                                        {{""}}
                                        More groups
                                    </h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body">




                            @if (session('user_groups') && count(session('user_groups')) > 0)
                            @php $count = 0; @endphp
                            @foreach (session('user_groups') as $user_group)
                                @if ($count < 3)
                                    <div class="item p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="title mb-1 ">
                                                    {{ $user_group->name }}
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 90%;" aria-valuenow="68" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div><!--//col-->
                                            <div class="col-auto">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                    class="bi bi-chevron-right" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="item-link-mask" href="#"></a>
                                    </div><!--//item-->
                                    @php $count++; @endphp
                                @else
                                    @break
                                @endif
                            @endforeach

                            @if (count(session('user_groups')) > 3)
                                <div class="item p-3">
                                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#mygrouplist">View More</a>
                                </div>
                            @endif
                        @endif




                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->

{{-- pie chat start from here --}}
                <div class="col-lg-6 piechartcard">
                    <div class="card mb-4 piechartcard">
                        <div class="card-header">
                            <i class="fas fa-building me-1"></i>
                            STATUS OVER VIEW
                        </div>
                        <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
                    </div>
                </div>


            </div><!--//row-->
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-4 insightcard">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="2em" height="2em" color="green"  viewBox="0 0 16 16" class="bi bi-receipt"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                            <path fill-rule="evenodd"
                                                d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                    </div><!--//icon-holder-->

                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">From gbce Insights</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4">

                            <div class="intro">
                                Great Admin, your group contribute to about
                                {{ number_format(($groupdata->group_members->count() / $usercount) * 100, 2) }}%
                                to our main goal of reaching the society with breaking existed berrier
                            </div>
                        </div><!--//app-card-body-->
                        {{-- <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="#">Create New</a>
                        </div><!--//app-card-footer--> --}}
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-12 col-lg-4 gbceappcard">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="2em" height="2em" color="green"  viewBox="0 0 16 16"
                                            class="bi bi-code-square" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                            <path fill-rule="evenodd"
                                                d="M6.854 4.646a.5.5 0 0 1 0 .708L4.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0zm2.292 0a.5.5 0 0 0 0 .708L11.793 8l-2.647 2.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708 0z" />
                                        </svg>
                                    </div><!--//icon-holder-->

                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">gbce Apps</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4">

                            <div class="intro">
                                We keep updating by introducing new features with our moile app version
                                working together with gbce web, keep updated for better experiences.
                            </div>
                        </div><!--//app-card-body-->
                        {{-- <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="#">Create New</a>
                        </div><!--//app-card-footer--> --}}
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-12 col-lg-4 successcard">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="2em" height="2em" color="green" viewBox="0 0 16 16"
                                            class="bi bi-trophy " fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3 3V1h2v2h6V1h2v2a3 3 0 0 1 1 5.83V10a5 5 0 0 1-1.721 3.76C11.68 14.916 9.383 15 8 15c-1.383 0-3.68-.084-4.279-.24A5 5 0 0 1 2 10V8.83A3 3 0 0 1 3 3zM2.236 6.92A2 2 0 0 0 4 8v2c0 .835.302 1.534.805 2.058.547.571 1.657.93 3.195.93 1.538 0 2.648-.359 3.195-.93A2.99 2.99 0 0 0 12 10V8a2 2 0 0 0 1.764-1.08A2.994 2.994 0 0 1 13 5h-1a3.008 3.008 0 0 1-2.116.787 5.99 5.99 0 0 0-.61 0A3.008 3.008 0 0 1 7 5H6a3 3 0 0 1-.764 1.92zm.794-1.1a2.013 2.013 0 0 0-.448-.076l.241-.335A2 2 0 0 0 4 3v1c0 .154.012.305.036.453a2.012 2.012 0 0 0-.448-.076zm11.732 0a2.012 2.012 0 0 0-.448.076c.024-.148.036-.299.036-.453V3a2 2 0 0 0 1.207.655l.241.335a2.013 2.013 0 0 0-.448-.076z" />
                                        </svg>

                                    </div><!--//icon-holder-->

                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">SUCCESS</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4">

                            <div class="intro">
                                About {{ ' ' }} {{ $usercount }} {{ ' ' }} people over the world
                                are aware of
                                gender inclusion and equality for development brought by the introduction of gbce
                                tool,

                            </div>
                        </div><!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-info" data-bs-toggle="modal" data-bs-target="#emailModal"
                                href="#">inform my neighbour</a>
                        </div><!--//app-card-footer-->
                    </div><!--//app-card-->
                </div><!--//col-->
            </div><!--//row-->

        </div><!--//container-fluid-->
    </div><!--//app-content-->

    {{-- free download --}}

</div><!--//app-wrapper-->


<!-- Javascript -->
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Charts JS -->
<script src="assets/plugins/chart.js/chart.min.js"></script>
<script src="assets/js/index-charts.js"></script>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>


{{-- eqtf wplo gplq gyvo --}}

<script>
    var posts={{ number_format(($groupdata->posts->count() / $postcount) * 100, 2) }}
    var events= {{ number_format(($groupdata->events->count() / $eventcount) * 100, 2) }}
    var members={{ number_format(($groupdata->group_members->count() / $usercount) * 100, 2) }}
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Posts", "Events", "Members"],
    datasets: [{
        data: [posts, events, members],
      backgroundColor: ['#007bff', '#28a745', '#ffc107'],
    }],
  },
});
</script>






<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="emailForm" action="{{ route('send.email') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient_email" class="col-form-label">Recipient Email:</label>
                        <input type="email" name="email" class="form-control" id="recipient_email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.memberscontainer {
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}


.eventcontainser {
    background: radial-gradient(
        circle,
        rgba(255, 0, 150, 0.5),
        rgba(0, 204, 255, 0.5)
    );
}

.postcontainer {
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}
.feedbackcontainer {
    background: radial-gradient(
        circle,
        rgba(255, 0, 150, 0.5),
        rgba(0, 204, 255, 0.5)
    );
}
.overviewcontainer{
    justify-content: space-evenly
}
.overviewcard{
    border-radius: 5px;
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}
.overviewcontainer{
    background: linear-gradient(
        to left,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}

.insightcard{
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}
.gbceappcard{
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}
.successcard{
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}
.piechartcard{
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.5),
        rgba(200, 200, 255, 0.5)
    );
}

</style>
