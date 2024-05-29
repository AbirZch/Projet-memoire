<?php
use Carbon\Carbon;

?>
@extends('admin.layout.app')

@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .container {
            padding: 20px;
            margin: 20px;
        }

        h2 {
            margin: 20px 0px
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .choose-button {
            background-color: cadetblue;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>

    @if (count($enrollments) > 0)
    <div class="container">
        <h2>Événements Présentiels</h2>
        <table>
            <thead>
                <tr>
                    <th>Événement</th>
                    <th>étudiant</th>
                    <th>Date d'inscription</th>
                    <th>Formation</th>
                    <th>session_start_at</th>
                    <th>session_end_at</th>
                    <th>Course_start_at</th>
                    <th>Course_end_at</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($enrollments as $index => $enrollment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{$enrollment->student->user->getName()}}</td>
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
                        document.getElementById('enrollment-{{ $enrollment->id }}').innerHTML = utcTime.toLocaleString('en-US', {
                            hour12: false
                        });
                    </script>
                @endforeach

            </tbody>
        </table>
    </div>
        @else
        <div>ya pas d'inscriptions </div>
    @endif
@endsection
