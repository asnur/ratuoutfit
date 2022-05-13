@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    {{ __('You are logged in!') }}
</div>
</div>
</div>
</div> --}}

<div class="row">
    @foreach ($data_product as $dp)
    <div class="col-6"><a href="{{ route('detail', $dp->slug) }}">{{ $dp->name }}</a></div>
    @endforeach
</div>
</div>
@endsection
