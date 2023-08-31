@extends('layouts.dashboard')

@section('content')
    <div class="main-container">
        <track-view-shipment :shipment="{{ $shipment }}" ></track-view-shipment>
    </div>
@endsection
