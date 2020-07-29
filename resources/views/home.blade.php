@extends('layouts.app')
<style>
    button{
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

  &:active{
    transform: scale(.9);
  }

  &:focus{
    outline: none;
  }
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
                </div>





                <a href="myjambcourselist" class="btn btn-success rounded-pill">
                    Enter JAMB Class!
                </a> <p></p>
                <a href="mypostcourselist" class="btn btn-success rounded-pill">
                Enter Post UTME Class!
                </a> <p></p>
                <a href="mysatcourselist" class="btn btn-success rounded-pill">
                Enter SAT Class!
                </a> <p></p>
                <a href="myietscourselist" class="btn btn-success rounded-pill">
                Enter IELTS Class!
                </a> <p></p>
                <a href="mywaeccourselist" class="btn btn-success rounded-pill">
                Enter WAEC Class!
                </a> <p></p>
                <a href= "{{ url('/tuition') }}"><button class="btn btn-success rounded-pill">
                Pay Tuition
                </button></a>
            </div>
        </div>
    </div>
</div>
@endsection
