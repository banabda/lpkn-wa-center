@extends('layouts.app')

@section('content')
    <div class="container-fluid">
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
