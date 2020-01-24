
osdgfskdghskdfhjg


  <!--  @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
      <img src="/images/{{ Session::get('image') }}">
     @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
      @endif
     </br>
     <form action="{{ url('imageupload') }}" enctype="multipart/form-data" method="post">
       @csrf
        <div class="row">
            <div class="col-md-12">
              <input type="file" name="image" />
                      <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </div>
    </form> -->

