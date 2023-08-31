<div class="sidebar-item {{ (request()->is('/')) ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}" title="Dashboard"><i class="feather" data-feather="home"></i> <span
            class="item-name">Dashboard</span></a>
</div>

<div class="sidebar-header">
    TRACK
</div>
<div class="sidebar-item {{ (request()->routeIs('track.index')) ? 'active' : '' }}">
    <a href="{{ route('track.index') }}" title="Dashboard"><i class="feather" data-feather="home"></i> <span
            class="item-name">Overview</span></a>
</div>
<div class="sidebar-item {{ (request()->routeIs('track.shipment.*')) ? 'active' : '' }}">
    <a href="{{ route('track.shipment.overview') }}" title="overview"><i class="feather" data-feather="overview"></i> <span
            class="item-name">List</span></a>
</div>
