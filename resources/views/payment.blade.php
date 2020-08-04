@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase font-weight-bold my-3">
                        {{ __("Payment for $exam") }}
                    </h4>
                </div>

                <div class="card-body h5">
                    <div class="mb-3">
                        The tuition fee for <strong class="text-uppercase">{{ $exam }}</strong> is 
                        <strong class="text-uppercase">&#8358;{{ $cost }}</strong>
                        for a period of 3 months.
                    </div>

                    <div class="payment details mt-5">
                        <input type="hidden" id="hidden-cost" value="{{ $cost }}">
                        <input type="hidden" id="hidden-exam" value="{{ $exam }}">

                        <div class="form-group">
                            <label for="name" class="mb-0">Name</label>
                            <div class="h4 font-weight-bold block" id="name-label">{{ $name }}</div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="email" class="mb-0">Email Address</label>
                            <div class="h4 font-weight-bold block" id="email-label">{{ $email }}</div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="email" class="mb-0">Amount</label>
                            <div class="h4 font-weight-bold block" id="cost-label">&#8358;{{ $cost }}</div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button id="pay" onclick="payWithPaystack('{{ $paystackKey }}')" class="btn btn-success btn-lg">
                        Proceed to Payment
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
var payWithPaystack = (key) => {
    let name = document.querySelector('#name-label').innerText;
    let email = document.querySelector('#email-label').innerText;
    let phone = document.querySelector('#phone').value;
    let cost = document.querySelector('#hidden-cost').value;
    let exam = document.querySelector('#hidden-exam').value;
    let [ firstname, lastname ] = name.split(' ')

    if (phone.trim().length > 0) {
        let handler = PaystackPop.setup({
            key,
            email: email,
            amount: cost * 100,
            currency: 'NGN',
            firstname,
            lastname,
    
            callback: (response) => {
                let reference = response.reference;
                alert(`You have successfully paid for ${exam.toUpperCase()}`);
                // Log payment in DB
                location.href = `${location.origin}/payment?class=${exam}&txref=${reference}`;
            },
    
            onClose: () => {
                alert('Transaction was not Completed');
            },
        });
        handler.openIframe();
    } else {
        alert('You must enter a phone number');
    }
}
</script>
@endsection