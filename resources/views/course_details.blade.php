@extends('layouts.default')

@section('title', 'Formations')
@section('content')

    <div class="center"><br>
        <h1>Nos Proffesseurs qui vous donne des cours en ligne: </h1>
    </div>
    <div class="container">
        @if (count($classrooms) > 0)
            @foreach ($classrooms as $classroom)
                <div class="card">

                    <h2>{{ $classroom->teacher->user->firstname . ' ' . $classroom->teacher->user->lastname }}</h2>
                    <p>Professeur d'informatique <br> Dispo pour les cours en ligne <br></p><br>
                    <div class="center">
                        <form action="{{ route('enrollment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $classroom->id }}" name="classroom_id">
                            <button class="btn rejoindreCours" >Rejoindre un cours</button>

                        </form>
                    </div>
                </div>
            @endforeach

    </div>

  


@else
    <div class="center">
        <h1>aucun professeur n'est disponible pour ce cours</h1>
    </div>
    @endif


    </div>
    </div>
    <style>
        /* Réinitialisation des marges et des rembourrages */
        html,
        body {
            margin: 0;
            padding: 0;
        }

        /* Utilisation d'une police de caractères de secours */
        body {
            font-family: 'Arial', sans-serif;
            /* Utilisation de la police Arial en tant que police de secours */
        }

        /* Styles de base pour une meilleure lisibilité */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 10px 0;
        }

        p {
            margin: 28px 0;

        }

        ul,
        ol {
            margin: 10px 0;
            padding-left: 20px;
        }

        /* Ajoutez d'autres styles de base selon vos besoins */

        body {
            top: 10%;
            justify-content: center;
            background-color: cadetblue;

        }

        h1 {
            justify-content: center;

        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            position: relative;
            width: 1000px;
            display: flex;
            justify-content: left;
            align-items: center;
            flex-wrap: wrap;
            padding: 100px;
            margin-top: 0%;
        }

        .container .card {
            width: 250px;
            position: relative;
            height: 250px;
            background: #f0f0f0;
            margin: 30px 10px;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            box-shadow: 0.5px 10px #e6e6e6;
            transition: 0.3s ease-in-out;
            margin-top: 5%;


        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: cadetblue;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            right: 0%;

        }

        .btn:hover {
            background-color: #2980B9;
        }

        .card p {
            font-size: 15px;
        }

        /* Style pour la modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .modal-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-btn:hover {
            background-color: #0056b3;
        }
#closeModal{
    font-size: 2.5rem;
    user-select: none;
}
        /* Style pour le bouton "Rejoindre un cours" */
        .btn {
            background-color: cadetblue;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: cadetblue;
        }
.modal-content p {
    font-size: 1.2rem;
}
        /* Style pour la modal */

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #f00;
        }
    </style>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const modalButtons=document.getElementsByClassName("rejoindreCours");
            document.querySelectorAll(".rejoindreCours").forEach(element => {
                element.addEventListener("click", function() {
                  
                });
            });
    
    
            });
    
        </script>
@endsection
