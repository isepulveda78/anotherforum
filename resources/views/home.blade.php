@extends('layouts.app')

@section('content')
            @auth 
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('discussions.create') }}" class="btn btn-success">Add Discusion</a>
            </div>
            @else 
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
            </div>
            @endauth
        
            <div class="card">
                <div class="card-header">Discussion Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth 
                        You are logged in!
                    @else 
                        Need to login to add to discussion.
                    @endauth
                    
                </div>
            </div>
@endsection
