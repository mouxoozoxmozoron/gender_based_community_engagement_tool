<!-- Tooltip styling -->
<style>
.tooltip {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.75);
    color: white;
    padding: 5px;
    border-radius: 3px;
    font-size: 12px;
    z-index: 1000;
}

.card {
    opacity: 0;
    transform: translateY(-30px); /* Start above */
    transition: opacity 0.5s ease, transform 0.5s ease;
    animation: bounceIn 0.5s forwards; /* Use animation for the bounce effect */
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: translateY(-30px); /* Start position */
    }
    60% {
        opacity: 1;
        transform: translateY(10px); /* Move down slightly */
    }
    80% {
        transform: translateY(-5px); /* Move up slightly */
    }
    100% {
        transform: translateY(0); /* End at original position */
    }
}

.card.visible {
    opacity: 1;
    transform: translateY(0);
}

</style>




<div class="row">



    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-users me-3" style="font-size: 40px; color: white;"></i>
                <div>
                    <h5 class="card-title">GBC Users</h5>
                    <h3 class="card-text" id="groupOfPeopleCount">{{$uCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-building me-3" style="font-size: 40px; color: white;"></i>
                <div>
                    <h5 class="card-title">Organization</h5>
                    <h3 class="card-text" id="organizationCount">{{$organisationCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{route('allorganisation')}}" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-users-cog me-3" style="font-size: 40px; color: white;"></i>
                <div>
                    <h5 class="card-title">Groups</h5>
                    <h3 class="card-text" id="groupsCount">{{$groupCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background: linear-gradient(45deg, #007BFF, #00FFCC);">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-comments me-3" style="font-size: 40px; color: white;"></i>
                <div>
                    <h5 class="card-title">Insights</h5>
                    <h3 class="card-text" id="insightsCount">{{$insightCount}}</h3> <!-- Updated ID -->
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-link text-white">More Info</a>
            </div>
        </div>
    </div>


</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-line me-1" style="font-size: 30px; color: blue;"></i>
                GBCE Platform Growth
            </div>
            <div class="card-body">
                {{-- <canvas id="myLineChart" width="100%" height="40"></canvas> --}}
                <canvas id="userGrowthChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1" style="font-size: 30px; color: blue;"></i>
                Post & Event Trend Chart
            </div>
            <div class="card-body">
                <canvas id="trendChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>









<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-clock" style="font-size: 24px; color: blue;"></i>
                Event summary
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S/n</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Created By</th>
                            <th>Group</th>
                            <th>Organisation</th>
                            <th>Attendee Number</th>
                            <td>Organised On</td>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>S/n</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Created By</th>
                            <th>Group</th>
                            <th>Organisation</th>
                            <th>Attendee Number</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach($events as $event)

                        @php
                            $groupOrgID = $event->group->organisation_id;
                            $organisationName = DB::table('organisations')->where('id', $groupOrgID)->value('organisation_name');
                        @endphp
                        <tr>

                            <td>{{$loop->iteration}}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->location }}</td>
                            <td>
                                {{ $event->date }} <br>
                                {{$event->time}}
                            </td>
                            <td>{{ $event->user->first_name }} {{ $event->user->last_name }}</td>
                            <td>{{$event->group->name}}</td>
                            <td>{{$organisationName?? 'n/a'}}</td>
                            <td>{{$event->bookings->count()}}</td>
                            <td>{{ $event->created_at->format('M d, Y') }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-pen" style="font-size: 24px; color: blue;"></i>
                Post Summary
            </div>
            <div class="card-body">
                <table id="groupstable">
                    <thead>
                        <tr>
                            <th>S/n</th>
                            <th>title</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Organisation</th>
                            <th>Group</th>
                            <th>Comments</th>
                            <th>LIkes</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>S/n</th>
                            <th>title</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Organisation</th>
                            <th>Group</th>
                            <th>Comments</th>
                            <th>LIkes</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach($posts as $post)
                        @php
                            $groupOrgID = $post->group->organisation_id?? 0;
                            $organisationName = DB::table('organisations')->where('id', $groupOrgID)->value('organisation_name');
                        @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at->format('M d, Y') }}</td>
                            <td>{{ $post->user->first_name }} {{ $post->user->last_name }}</td>
                            <td>{{$organisationName?? 'n/a'}}</td>
                            <td>{{ $post->group->name?? 'n/a' }}</td>
                            <td>{{ $post->comments->count() }}</td>
                            <td>{{ $post->likes->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
        </div>
    </div>
</div>



{{-- <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Event Schedule
    </div>
    <div id="calendar"></div>
</div> --}}




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>


<script>
    $(document).ready(function() {
    $('#datatablesSimple').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    $('#groupstable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


            // Add visible class to cards for animation
            document.querySelectorAll('.card').forEach(card => {
            card.classList.add('visible');
        });


    });



//platform growth overview
let userGrowthChart; // Declare it outside

function createChart() {
    if (userGrowthChart) {
        userGrowthChart.destroy(); // Destroy previous instance
    }

    const ctx = document.getElementById('userGrowthChart').getContext('2d');

    const counts = @json($counts);
    const months = @json($months);

    // Prepare color array based on growth
    const borderColors = counts.map((count, index) => {
        if (index === 0) return 'rgba(75, 192, 192, 1)'; // First point is always the default color
        const previousCount = counts[index - 1];
        return count > previousCount ? 'green' : (count < previousCount ? 'red' : 'rgba(75, 192, 192, 1)');
    });

    userGrowthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'User Growth',
                data: counts,
                borderColor: borderColors,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
                fill: false, // Do not fill under the line
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const count = counts[tooltipItem.dataIndex];
                            return `Accounts Created: ${count}`;
                        }
                    }
                }
            }
        }
    });

    // Add click event
    ctx.canvas.onclick = function(evt) {
        const activePoints = userGrowthChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, false);
        if (activePoints.length > 0) {
            const monthIndex = activePoints[0].index; // Get the index of the clicked point
            const count = counts[monthIndex]; // Get the corresponding count
            const month = months[monthIndex]; // Get the corresponding month
            alert(`Accounts Created in ${month}: ${count}`);
        }
    };
}

createChart();




//post and event trend
$(document).ready(function() {
    let ctx = document.getElementById('trendChart').getContext('2d');
    let trendChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($monthstre),
            datasets: [
                {
                    label: 'Posts',
                    data: @json($postCounts),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: false,
                },
                {
                    label: 'Events',
                    data: @json($eventCounts),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    fill: false,
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Creations'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const label = tooltipItem.dataset.label || '';
                            const value = tooltipItem.raw;
                            return `${label}: ${value}`;
                        }
                    }
                }
            }
        }
    });
});
</script>
