@extends('layouts.app')
<style>
a {
    text-decoration: none
}

a:hover {
    text-decoration: none !important;
}

button {
    border-radius: 20px;
    border: 1px solid #009345;
    background-color: #009345;
    color: #fff;
    font-size: 1rem;
    font-weight: bold;
    padding: 10px 40px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform .1s ease-in-out;

}

button:active {
    transform: scale(.9);
}

button:focus {
    outline: none;
}
</style>

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

                    {{ __('You are logged in!') }}

                    <div class="row mt-5">
                        @foreach ($exams as $exam)
                            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                <x-exam-class :name="$exam[0]" :url="$exam[1]" />
                            </div>
                        @endforeach
                    </div>

                    <!--<a href= "{{ url('/tuition') }}"><button class="btn btn-success rounded-pill">
                    Pay Tuition
                    </button></a>-->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
