@extends('welcome')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Show categorie - {{$categorie->name}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    <div class="row flex-center">

        


    <div class="card text-center mx-auto" style="width: 50rem; padding: 10px ">
        <img class="card-img-top img-responsive center-block" style="height: 300px" src="/storage/images/{{$categorie->slug}}" >
         <div class="card-body">
          <h1 class="card-title">{{$categorie->name}}</h1>
        <form action="{{ route('categories.destroy',$categorie->id) }}" method="POST">


                    

    

                    <a class="btn btn-success" href="{{ route('categories.edit',$categorie->id) }}">Edit</a>

   

                    @csrf

                    @method('DELETE')

      

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>                </div>

      </div>
        </div>


@endsection