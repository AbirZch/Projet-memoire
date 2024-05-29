@extends ('layouts.default')
@section('title', 'Courses')

@section('content')



    <style>
  main {
   flex: 1;
   background-color: cadetblue;

  }
     .container {
            padding:  50px 50px ;
            width: 100%;
            height: 100%;
        }

        .container .courses-heading {
            text-align: center;
            color: white;
display: flex;
justify-content: center;
align-items: center;
margin: 20px auto;
        }

        .container .courses-heading i {
            text-shadow: 0 5px 10px black;
            font-size: 50px;

        }

        .box>h3 {
            user-select: none;

        }

        .box>p {
            user-select: none;

        }
       
        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px,400px));
            gap: 15px;
        }

        .container .box-container .box {
            padding: 20px;
            box-shadow: 0 5px 10px black;
            border-radius: 5px;
            background: white;
            text-align: center;
        }

        .container .box-container .box img {
            height: 80px;
        }

        .container .box-container .box h3 {
            color: black;
            font-size: 22px;
        }

        .container .box-container .box  {
            color: black;
            font-size: 10px;
        }
        .box p {
            margin-top: 20px;
        }

        .container .box-container .box .btn {
            background: #C8BBBE;
            color: black;
            font-size: 10px;
            border-radius: 5px;
        }

        #snackbar {
            visibility: hidden;
            /* Hidden by default. Visible on click */
            min-width: 250px;
            /* Set a default minimum width */
            margin-left: -125px;
            /* Divide value of min-width by 2 */
            background-color: #333;
            /* Black background color */
            color: #fff;
            /* White text color */
            text-align: center;
            /* Centered text */
            border-radius: 2px;
            /* Rounded borders */
            padding: 16px;
            /* Padding */
            position: fixed;
            /* Sit on top of the screen */
            z-index: 1;
            /* Add a z-index if needed */
            left: 50%;
            /* Center the snackbar */
            bottom: 30px;
            /* 30px from the bottom */
        }

        /* Show the snackbar when clicking on a button (class added with JavaScript) */
        #snackbar.show {
            visibility: visible;
            /* Show the snackbar */
            /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
          However, delay the fade out process for 2.5 seconds */
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        /* Animations to fade the snackbar in and out */
        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>




    <div class="container">
        
        <h1 class="courses-heading">  <i>les formations disponibles</i> </h1>
        <div class="box-container">
            @if (count($courses) > 0)
                @foreach ($courses as $course)
                    <div class="box">
                        <img src="{{ asset($course->image) }}" alt="">
                        <h3> {{ $course->name }} </h3>
                        <p>{{ $course->description }}</p>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn">Accéder</a>
                    </div>
                @endforeach
  
            @endif

        </div>
        <div id="snackbar">{{ session('success') }}</div>

    </div>
</div>
    @if (session('success'))
        <script>
            function showSnackBar() {
                // Get the snackbar DIV
                var x = document.getElementById("snackbar");

                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function() {
                    x.className = x.className.replace("show", "");
                }, 3000);
            }
            showSnackBar();
        </script>
    @endif


@endsection
