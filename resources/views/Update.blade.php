<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flex" >
        <a class="py-2 btn" href="{{ url('/') }}" >
            <span class="btn btn-danger" >Back</span>
        </a>
        <h1 class="h4 text-center py-2" >Update Page</h1>
    </div>
    @if( count( $datas ) > 0 )
    <div class="w-75 m-auto mt-5" >
        <span class="text-danger" >{{ Request::get("message") }}</span>
        <form action="{{url('/update_data/'.$datas[0]->id)}}" method="post">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{$datas[0]->firstname}}" name="firstname" placeholder="First name" aria-label="First name">
                        <span class="text-danger"> @error("firstname") {{$message}} @enderror </span>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput2" class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{$datas[0]->lastname}}" name="lastname" placeholder="Last name" aria-label="Last name">
                        <span class="text-danger"> @error("lastname") {{$message}} @enderror </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$datas[0]->email}}" id="exampleFormControlInput1" placeholder="Email">
                    <span class="text-danger"> @error("email") {{$message}} @enderror </span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date of birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{$datas[0]->date_of_birth}}" id="exampleFormControlInput1" placeholder="Date Of Birth">
                    <span class="text-danger"> @error("date_of_birth") {{$message}} @enderror </span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Place of birth</label>
                    <input type="text" name="place_of_birth" class="form-control" value="{{$datas[0]->place_of_birth}}" id="exampleFormControlInput2" placeholder="kampot,#..,..">
                    <span class="text-danger"> @error("place_of_birth") {{$message}} @enderror </span>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" >Update</button>
                </div>
        </form>
    </div>
    @else
        <h1 class="h5 text-center py-2" >Please try other id.</h1>
        <a href="{{url('/')}}" class="btn btn-primary">Go back</a>
    @endif
</body>
</html>