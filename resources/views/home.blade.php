@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <?php $user = App\Models\UserCred::where('user_id', auth()->id())->first(); ?>
        @if (isset($user) && $user->active)
            <main-component></main-component>
        @else
            <div class="container flex justify-center">
                <div class="card w-max border-0 shadow-md p-8">
                    <div class="card-body">
                        <div class="home-status capitalize">menunggu konfirmasi admin</div>
                        <div class="mt-4 text-lg">Hubungi admin WA Center untuk mendapatkan akses, <br> dengan
                            menyerahkan email dan nama api.</div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
