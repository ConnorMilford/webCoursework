<!DOCTYPE html>
<html lang="en">

<head>
    <title>ConText - @yield('Title')</title> 
</head>

<body>
    <h1>ConText  - @yield("HeaderTitle")'s page</h1>

    @if ($errors->any())

    <div>
        !-- ERROR --!

        <ul>
            @foreach ($errors->all() as $error)
                <li> {{$error}}</li>
            @endforeach
        </ul>
    </div>
    
    @endif

    @if (session('message'))
        <p><b> {{session('message')}} </b></p>
    
    @endif



    <div>
        @yield('userContent')
    </div>



</body>


</html>
