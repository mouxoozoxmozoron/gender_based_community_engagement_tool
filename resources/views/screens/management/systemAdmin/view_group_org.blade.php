@php
    $usercompanies = session('usercompanies', collect());
@endphp

@include('components.utilis.app')

    @include('components.dashboard.side_nav_bar')

    <div id="layoutSidenav_content">

        <main>
{{-- vie goes here --}}
@include('screens.management.systemAdmin.views.group_managers')
        </main>
        @include('components.footer')

    </div>
</div>

<x-models.profile_model />
<x-models.group_list />





<script>
    window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const groupmanagerstable = document.getElementById('groupmanagerstable');
    if (groupmanagerstable) {
        new simpleDatatables.DataTable(groupmanagerstable);
    }
});

</script>
