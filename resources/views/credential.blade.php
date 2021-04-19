@extends('layouts.app')
@section('content')
    <div class="container">
        <credential-component :creds="{{ $creds }}"></credential-component>
    </div>
@endsection
