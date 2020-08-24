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

                    {{ __('Pay Your Tuition') }} <i class="fa fa-money"></i>
                </div>


                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
              
               <div class="card-body">
                  <form method="post" action="https://api.flutterwave.com/v3/payments" enctype="multipart/form-data">
                 @csrf
                 
                 <div class="form-group">
                 <label for="">Student Name </label>
                 
                 <input type="name" class="form-control" name="Name" id="" placeholder="Enter your Name">
                 <br>
                   <label for="">Your Email</label>
                 <input type="email" class="form-control" name="Email" id="" placeholder="Enter your Email">
                 <br>
                 </div>
                  <div class="form-group">
                 <select name="tuition" id="tuition" class="form-control">
                 <option >Select Tuition type</option>
                 <option value="10000" id="jamb_tuition"> JAMB : 10,000 for 3 months</option>
                 <option value="10000" id="waec_tuition"> WAEC : 10,000 for 3 months</option>
                 <option value="10000" id="postutme_tuition"> Post UTME : 10,000 for 3 months</option>
                 <option value="40000" id="sat_tuition"> SAT : 40,000 for 3 months</option>
                 <option value="40000" id="ielts_tuition"> IELTS : 40,000 for 3 months</option>
                 </select>
               </div>


                 <button class="rounded-pill float-right" name="tuition" type="submit">Pay Tuition</button>
                </form>
               </div>
                
                <p></p>
                 
                 
    </div>
</div>
@endsection
