@extends('layouts.app')

@section('content')
    <app :is_doctor="'{{ \Illuminate\Support\Facades\Auth::user()->isDoctor() }}'"></app>
@endsection
