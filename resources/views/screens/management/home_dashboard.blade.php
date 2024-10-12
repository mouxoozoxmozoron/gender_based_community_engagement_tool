@php
    $usercompanies = session('usercompanies', collect());
@endphp

@include('components.utilis.app')


{{-- <x-header /> --}}
{{-- @include('components.header') --}}


{{-- <x-dashboard.side_nav_bar :groupdata="$groupdata"/> --}}
{{-- <div id="layoutSidenav"> --}}
    {{-- started div from side nav bar page --}}
    @include('components.dashboard.side_nav_bar', ['groupdata' => $groupdata])

    <div id="layoutSidenav_content">

        @if (in_array(Auth()->user()->user_type, [2, 3]))
        <main>
            <div class="container-fluid px-4">
                @if (Route::is('dashboard.companyorder'))
                    <x-dashboard.company_orders />
                    <h2>this wilkl be another section</h2>
                @elseif (Route::is('group_details'))
                    <x-dashboard.default_home :groupdata="$groupdata" :usercount="$usercount" :postcount="$postcount" :eventcount="$eventcount" />
                @elseif (Route::is('group_details.members'))
                    <x-dashboard.members :groupdata="$groupdata" :groupusers="$groupusers" />
                @elseif (Route::is('group_details.posts'))
                    <x-dashboard.posts :groupdata="$groupdata" />
                @elseif (Route::is('group_details.events'))
                    <x-dashboard.events :groupdata="$groupdata" />
                @elseif (Route::is('group_details.events.viewevent'))
                    <x-dashboard.viewevent :groupdata="$groupdata" :eventdata="$event" />
                @endif
            </div>
        </main>

        @elseif (Auth()->user()->user_type == 1)
        <main>
            <div class="container-fluid px-4">
                @include('screens.management.systemAdmin.home', [
                    'groupdata' => $groupdata,
                    'usercount' => $usercount,
                    'postcount' => $postcount,
                    'eventcount' => $eventcount
                ])
            </div>
        </main>


        @elseif (Auth()->user()->user_type == 4)
        <main>
            <div class="container-fluid px-4">
                @include('screens.management.OrganisationAdmin.dashboard', [
                    'groupdata' => $groupdata,
                    'usercount' => $usercount,
                    'postcount' => $postcount,
                    'eventcount' => $eventcount
                ])
            </div>
        </main>
        @endif

        @include('components.footer')

    </div>
</div>

<x-models.profile_model />
<x-models.group_list />
