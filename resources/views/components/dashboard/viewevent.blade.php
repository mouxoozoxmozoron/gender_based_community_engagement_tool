@props(['eventdata'])


    <div class="container-fluid mt-3 mb-4">
        <div class="row">
            <div class="col-lg-12 mt-4 mt-lg-0">
                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                    <div class="card mb-3">
                        <img src="{{ asset('storage/' . $eventdata->image) }}" alt="Event Image" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Attendees</h5>

                            {{-- <div class="input-group mb-3">
                                <input type="text" id="filterInput" class="form-control" placeholder="Enter booking token">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="filterButton">Filter</button>
                                </div>
                            </div> --}}

                            <div id="bookingList">
                                @foreach ($eventdata->bookings as $booking)
                                    @if ($booking->user)
                                        <div class="small-card">
                                            <div class="user-info d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $booking->user->photo) }}" alt="Avatar" class="small-avatar mr-2">
                                                <div>
                                                    <span class="small-username">
                                                        {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                                    </span>
                                                    <span class="booking-token">
                                                        {{ $booking->token }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var filterInput = document.getElementById('filterInput');
            var filterButton = document.getElementById('filterButton');
            var bookingItems = document.querySelectorAll('.small-card');

            function applyFilter() {
                var filterValue = filterInput.value.toLowerCase().trim();

                bookingItems.forEach(function(bookingItem) {
                    var bookingToken = bookingItem.querySelector('.booking-token').textContent.toLowerCase().trim();
                    var display = bookingToken.includes(filterValue) ? 'block' : 'none';
                    bookingItem.style.display = display;
                });
            }

            filterButton.addEventListener('click', applyFilter);

            // Optionally, you can also filter on Enter key press in the input field
            filterInput.addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    applyFilter();
                }
            });
        });
    </script>

