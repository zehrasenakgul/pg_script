@extends('Frontend.layouts.loginlayout')
@section('content')
    @if (isset($user_id))
        <login-page url={{$url}} user_id={{$user_id}} access_token={{$access_token}}> </login-page>
    @else
    <login-page url={{$url}}> </login-page>
    @endif

@endsection
