@php
    $limit = 10;
    $page = Request::get("page") ? Request::get("page") : 1 ;
    $i = 1;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Sun LyHuor</title>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-center py-3" >
        <u>Laravel 9 CRUD</u>
    </h1>
    <div class="w-75 m-auto mt-5" >
        <span class="text-danger" >{{ Request::get("message") }}</span>
        <form action="{{url('/add_user')}}" method="post">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="First name" aria-label="First name">
                        <span class="text-danger"> @error("firstname") {{$message}} @enderror </span>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput2" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Last name" aria-label="Last name">
                        <span class="text-danger"> @error("lastname") {{$message}} @enderror </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
                    <span class="text-danger"> @error("email") {{$message}} @enderror </span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date of birth</label>
                    <input type="date" name="date_of_birth" class="form-control" id="exampleFormControlInput1" placeholder="Date Of Birth">
                    <span class="text-danger"> @error("date_of_birth") {{$message}} @enderror </span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Place of birth</label>
                    <input type="text" name="place_of_birth" class="form-control" id="exampleFormControlInput2" placeholder="kampot,#..,..">
                    <span class="text-danger"> @error("place_of_birth") {{$message}} @enderror </span>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success" >Submit</button>
                </div>
        </form>
    </div>

    <div class="w-75 m-auto" >
        <div>
            <span class="d-block text-center text-danger" id="delete_message" ></span>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th>ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date Of Birth</th>
                <th scope="col">Place Of Birth</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                  <tr>
                    <th>{{ $i; }}</th>
                    <th scope="row">{{ $data->id }}</th>
                    <td> {{ $data->firstname }} </td>
                    <td> {{ $data->lastname }} </td>
                    <td> {{ $data->email }} </td>
                    <td> {{ $data->date_of_birth }} </td>
                    <td> {{ $data->place_of_birth }} </td>
                    <td>
                        <a href="{{url('/update/'.$data->id)}}" class="btn btn-success" ><i class="fa-solid fa-pen-to-square"></i></a>
                        <button onclick="deleteData({{$data->id}})" class="btn btn-danger text-light"><i class="fa-solid fa-trash"></i></button>
                    </td>
                  </tr>
                  @php $i++; @endphp
                @endforeach
            </tbody>
          </table>

    </div>
    <div class="w-75 m-auto" style="padding:20px 0px;margin-top: -200px;" >
        @if( $page > 1 )
            <a href="{{ url('/?page='.( $page - 1 ) ) }}" class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i></a>
        @else
            <button class="btn btn-danger" style="cursor: not-allowed;" ><i class="fa-solid fa-arrow-left"></i></button>
        @endif
        <span> {{$page}}/{{ ceil( $total / $limit ) }} </span>
        @if( $page < ( ceil( $total / $limit ) ) )
            <a href="{{ url('/?page='.( $page + 1 ) ) }}" class="btn btn-success" ><i class="fa-solid fa-arrow-right"></i></a>
        @else
            <button class="btn btn-success"  style="cursor: not-allowed;" ><i class="fa-solid fa-arrow-right"></i></button>
        @endif
    </div>

    <script>
        function deleteData( id ){

            if( confirm("Are you sure!") ){
                fetch( `{{ url('/delete_data/${id}') }}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body:""
                } )
                .then( async ( response )=> {
                        window.location.reload()
                } )
                .catch((error)=>{
                        console.log( e )
                })
            }

        }
    </script>

</body>
</html>