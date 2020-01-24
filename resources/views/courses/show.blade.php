@extends('welcome')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb ">

            <div class="pull-left ">

                <h2>Show Course - {{$course->name}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

      <div class="row flex-center">

        


    <div class="card text-center mx-auto" style="width: 50rem; padding: 10px ">
        <img class="card-img-top img-responsive center-block" style="height: 300px" src="/storage/images/{{$course->slug}}" >
         <div class="card-body">
          <p class="card-title">Name: {{$course->name}}</p>
          <p class="card-text">Category: {{ $course->category->name }}
          </p>
          <p class="card-text">Description: {{$course->description}}</p>
        <form action="{{ route('courses.destroy',$course->id) }}" method="POST">


                    

    

                    <a class="btn btn-success" href="{{ route('courses.edit',$course->id) }}">Edit</a>

   

                    @csrf

                    @method('DELETE')

      

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>                </div>

      </div>
        </div>

@endsection