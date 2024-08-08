<div class="dasghboard_content">
    @if (Route::is('dashboard.companyorder'))
    <x-dashboard.company_orders
    {{-- :locations="$locations"
    :categories="$categories" --}}
    />
    <h2>this wilkl be another section</h2>
    @elseif (Route::is('group_details'))
    <x-dashboard.default_home
    :groupdata="$groupdata"
    :usercount="$usercount"
    :postcount="$postcount"
    :eventcount="$eventcount"

    />


    @elseif (Route::is('group_details.members'))
    <x-dashboard.members
    :groupdata="$groupdata"
    :groupusers="$groupusers"
    />
    @elseif (Route::is('group_details.posts'))
    <x-dashboard.posts :groupdata="$groupdata"/>

    @elseif (Route::is('group_details.events'))
    <x-dashboard.events :groupdata="$groupdata"/>

    @elseif (Route::is('group_details.events.viewevent'))
    <x-dashboard.viewevent
    :groupdata="$groupdata"
    :eventdata="$event"

    />

    @endif
    {{-- company_orders.blade --}}
</div>
