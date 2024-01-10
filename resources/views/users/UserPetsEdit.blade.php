<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">New Pet</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('users')}}" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i>Return</a>
            </div>
          </div>
        </div>
           <div class="card-body">

            @if($errors->any())
            @foreach($errors ->all() as $error)
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please!!</strong> {{$error}}
            </div>
            @endforeach
            @endif


            <form action="{{ route('user.pets.store', ['userId' => $userId]) }}" method="POST">

                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $pet->name }}" required>
                </div>


                <div class="form-group">
                    <label for="phone">Age</label>
                    <input type="tel" name="age" class="form-control" value="{{ $pet->age }}" required>
                </div>
                <div class="form-group">
                    <label for="direction">Breed</label>
                    <input type="text" name="breed" class="form-control" value="{{ $pet->breed }}">
                </div>
                <div class="form-group">
                    <label for="direction">Comment</label>
                    <input type="text" name="comment" class="form-control" value="{{ $pet->comment }}">
                </div>



                    
                <button type="submit" class="btn btn-sm btn-primary">Create Pet</button>

            </form>
            
           </div>     
      </div>
 

@endsection
