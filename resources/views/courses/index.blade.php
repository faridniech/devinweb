@extends('welcome')

 

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">


            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('courses.create') }}"> Create New Course</a>

            </div>

        </div>

    </div>

   

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif


  <h2>Courses</h2>
  <p>Click the Course's image to view/edit</p>
      

      <!-- Page Content -->
<div class="container">


  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left bg-dark">
            @foreach ($courses as $course)

    <div class="col-lg-3 col-md-4 col-6 figure bg-dark ">
      <a href="{{ route('courses.show',$course->id) }}" class="d-block mb-4 h-100 thumbnail " style="text-decoration: none">
            <img class="img-fluid" src="/storage/images/{{$course->slug}}" alt="">
            <figcaption  class="figure-caption text-center">
            {{$course->name}}
          </figcaption >
          </a>
    </div>
    @endforeach
    
  </div>
</div>
<!-- /.container -->
  

    {!! $courses->links() !!}

      

@endsection