@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>You are logged in!</h4><br>

                    @auth
                        <h5>api_token:<br><br>{{Auth::user()->api_token}}</h5>                       

                        <form method="post" action="{{route('users.token')}}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="api_token" value="{{Auth::user()->api_token}}">
                            <input class="btn btn-primary mt-3" type="submit" name="cambiarToken" value="Cambiar token">
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
