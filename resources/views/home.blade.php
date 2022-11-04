@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-12">
                        <a href="{{ route('note.list') }}">{{ __('View Notes') }}</a>
                    </div>

                    <div class="col-md-12 pt-2">
                        <a href="{{ route('category.list') }}">{{ __('View Categories') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
