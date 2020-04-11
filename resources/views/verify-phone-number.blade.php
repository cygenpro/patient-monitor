@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3 class="text-danger mb-4">Phone number verification</h3>
        </div>
        <div class="row justify-content-center">
            <form action="{{ route('phone.verify.submit') }}" class="col-md-4 col" method="post">
                @csrf
                <phone-verify-input></phone-verify-input>
                @foreach($errors->all() as $error)
                <span class="invalid-feedback d-block mb-3" role="alert">
                    <strong>{{ $error }}</strong>
                </span>
                @endforeach
                <div class="form-row">
                    <input type="submit" class="btn btn-outline-danger btn-block" value="Verify">
                </div>
            </form>
        </div>
    </div>
@endsection
