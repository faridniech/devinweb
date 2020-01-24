@extends('./welcome')

 

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

           

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New categorie</a>

            </div>

        </div>

    </div>

   

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif




  <h2>Categories</h2>
  <p>Click the category's image to view/edit</p>


     


  


      



<!-- Page Content -->
<div class="container">


  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left bg-dark">
            @foreach ($categories as $categorie)

    <div class="col-lg-3 col-md-4 col-6 figure bg-dark ">
      <a href="{{ route('categories.show',$categorie->id) }}" class="d-block mb-4 h-100 thumbnail " style="text-decoration: none">
            <img class="img-fluid" src="/storage/images/{{$categorie->slug}}" alt="">
            <figcaption  class="figure-caption text-center">
            {{$categorie->name}}
          </figcaption >
          </a>
    </div>
    @endforeach
    
  </div>
</div>
<!-- /.container -->

    {!! $categories->links() !!}

@endsection