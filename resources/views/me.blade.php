<?php
use Carbon\Carbon;

?>
@extends('layouts.default')

@section('title', 'profile')
@section('content')
    @auth

        <style>
            .profile {
                max-width: 90%;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .profile img {
                width: 100%;
                max-width: 200px;
                height: auto;
                border-radius: 50%;
                margin-bottom: 20px;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            .profile h2 {
                margin: 0;
                font-size: 24px;
                text-align: center;
            }

            .profile p {
                margin: 10px 0;
                line-height: 1.6;
                text-align: center;
            }

            .profile table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .profile th,
            .profile td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }

            .profile th {
                background-color: #f2f2f2;
            }

            .join-button {
                display: block;
                width: 200px;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-align: center;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .join-button:hover {
                background-color: #0056b3;
            }

            .event h3 {
                margin-top: 0;
            }

            .event p {
                margin: 5px 0;
            }

            .event .details {
                margin-top: 10px;
            }
        </style>

        <div class="profile">
            <img src="https://via.placeholder.com/200" alt="Profile Picture">
            <h2>Nom du Etudiant : {{ $student->user->firstname . ' ' . $student->user->lastname }}</h2>
            <p><strong>Âge:</strong> </p>
            <p><strong>Adresse:</strong> Adresse du Etudiant</p>
            <p><strong>Email:</strong> {{ $student->user->email }}</p>


            <h2>Événements en Ligne</h2>
            <table>
                <thead>
                    <tr>
                        <th>Événement</th>
                        <th>Date</th>
                        <th>Réunion</th>
                        <th>Lien</th>
                        <th>Sujet</th>
                        <th>Validation</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $onlineEnrollments = array_filter($enrollments->all(), function ($enrollment) {
                            return $enrollment->is_present == false;
                        });
                    @endphp
                    @foreach ($onlineEnrollments as $index => $enrollment)
                        @php
                            $status = '';
                            if ($enrollment->status === 'accepted') {
                                $status = '✓';
                            } elseif ($enrollment->status === 'rejected') {
                                $status = 'x';
                            } elseif ($enrollment->status === 'pending') {
                                $status = '-';
                            } elseif ($enrollment->status === 'completed') {
                                $status = 'completed';
                            }

                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td id="enrollment-{{ $enrollment->id }}">{{-- {{ Carbon::parse($enrollment->enrollment_date)->format('y-m-d H:i') }} --}}</td>
                            <td>{{ $enrollment->meeting_date ? Carbon::parse($enrollment->meeting_date)->format('y-m-d H:i') : '#' }}
                            </td>
                            <td>
                                @if (isset($enrollment->link))
                                    <a href={{ $enrollment->link }} class="link">Entrez dans la Réunion</a>
                                @else
                                    #
                                @endif
                            </td>
                            <td>{{ $enrollment->topic ?? '' }}</td>
                            <td>{{ $status }}</td>
                        </tr>
                        <script>
                            console.log('{{ $enrollment->enrollment_date }}')
                            var utcTime = new Date('{{ $enrollment->enrollment_date }}' + "z");;


                            document.getElementById('enrollment-{{ $enrollment->id }}').innerHTML = utcTime.toLocaleString('en-US',{
                                hour12: false
                            });
                        </script>
                    @endforeach

                </tbody>
            </table>
          
            @php
                $presenceEnrollments = array_filter($enrollments->all(), function ($enrollment) {
                    return $enrollment->is_present == true;
                });
            @endphp
            <br>
            @if (count($presenceEnrollments) > 0)
                <h2>Événements Présentiels</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Événement</th>
                            <th>Date d'inscription</th>
                            <th>Formation</th>
                            <th>la séance commence à</th>
                            <th>fin de la séance à</th>
                            <th>Début du cours à</th>
                            <th>Fin du cours à</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($presenceEnrollments as $index => $enrollment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td id="enrollment-{{ $enrollment->id }}">
                                    {{--   {{ Carbon::parse($enrollment->enrollment_date)->format('y/m/d H:i') }} --}}</td>
                                <td>{{ $enrollment->session?->course?->name }}</td>
                                <td>{{ $enrollment->session?->start_at ? Carbon::parse($enrollment->session?->start_at)->format('H:i') : '' }}
                                </td>
                                <td>{{ $enrollment->session?->end_at ? Carbon::parse($enrollment->session?->end_at)->format('H:i') : '' }}
                                </td>
                                <td>{{ $enrollment->session?->courseType?->start_at ? Carbon::parse($enrollment->session?->courseType?->start_at)->format('y/m/d') : '' }}
                                </td>
                                <td>{{ $enrollment->session?->courseType?->end_at ? Carbon::parse($enrollment->session?->courseType?->end_at)->format('y/m/d') : '' }}
                                </td>

                            </tr>
                            <script>
                                console.log('{{ $enrollment->enrollment_date }}')
                                var utcTime = new Date('{{ $enrollment->enrollment_date }}' + "z");;
                                document.getElementById('enrollment-{{ $enrollment->id }}').innerHTML = utcTime.toLocaleString('en-US',{
                                hour12: false
                            });
                            </script>
                        @endforeach

                    </tbody>
                </table>
            @endif

        </div>

    @endauth
@endsection



<style>
    /* Style pour la présentation du profil étudiant */

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    .profile {
        max-width: 90%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile img {
        width: 100%;
        max-width: 200px;
        height: auto;
        border-radius: 50%;
        margin-bottom: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .profile h2 {
        margin: 0;
        font-size: 24px;
        text-align: center;
    }

    .profile p {
        margin: 10px 0;
        line-height: 1.6;
        text-align: center;
    }

    .profile table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .profile th,
    .profile td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .profile th {
        background-color: #f2f2f2;
    }

    .join-button {
        display: block;
        width: 200px;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .join-button:hover {
        background-color: #0056b3;
    }


    .attendance {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .attendance h2 {
        margin-top: 0;
        font-size: 20px;
        color: #333;
    }

    .attendance p {
        margin: 10px 0;
    }

    .attendance p strong {
        font-weight: bold;
    }

    .attendance p span {
        font-weight: bold;
        color: #007bff;
    }

    .attendance ul {
        list-style-type: none;
        padding: 0;
    }

    .attendance ul li {
        margin-bottom: 5px;
    }

    .attendance ul li::before {
        content: "\2022";
        /* Utilisation du caractère bullet pour un style de puce */
        color: #007bff;
        /* Couleur du bullet */
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }
</style>
</head>
