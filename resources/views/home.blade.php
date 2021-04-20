@extends('layouts.app')

@section('content')
    <div class="container-fluid">
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
        <?php $user = App\Models\UserCred::where('user_id', auth()->id())->first(); ?>
        @if (isset($user) && $user->active)
            <main-component></main-component>
        @else
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="home-status">menunggu konfirmasi admin</div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
