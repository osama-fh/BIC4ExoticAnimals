@extends('layouts.app')

@section('content')
    <section class="section is-fullheight">
        <example-component title="Dashboard">
            @if (session('status'))
                <query-message :success="true" :fail="false" message="{{ session('status') }}"></query-message>
            @endif
            <p style="text-align: center">Welcome <strong>{{ auth()->user()->name }}!</strong></p>

        </example-component>
    </section>
@endsection
