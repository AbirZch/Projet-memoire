<?php
use Carbon\Carbon;

?>
@extends('layouts.default')
@section('title', 'Presence courses')
@section('content')

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
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


    <h2>Liste de nos Formations:</h2>

    <table>
        <thead>
            <tr>
                <th>Formation</th>
                <th>commencer à</th>
                <th>Fin à</th>
                <th>type</th>
                <th>Prix</th>
                <th>début du cours à</th>
                <th>fin du cours à</th>
                <th>Choisir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td rowspan={{ $course->sessions->count() === 0 ? 1 : $course->sessions->count() }}>{{ $course->name }}
                    </td>
                    <td>{{ Carbon::parse( $course->sessions[0]?->start_at)->format('H:i') ?? '' }}</td>
                    <td>{{Carbon::parse( $course->sessions[0]?->end_at)->format('H:i') ?? '' }} </td>
                    <td>{{ $course->sessions[0]?->courseType?->name ?? '' }}</td>
                    <td>{{  $course->sessions[0]?->courseType?->price ?? '' }}</td>
                    <td id="course-start-at-{{$course->sessions[0]->id }}" class="course_start_at">{{ Carbon::parse( $course->sessions[0]?->courseType?->start_at)->format('y-m-d') ?? '' }}</td>
                    <td id="course-end-at-{{$course->sessions[0]->id }}" class="course_end_at">{{  Carbon::parse($course->sessions[0]?->courseType?->end_at)->format('y-m-d') ?? '' }}</td>

                    <td>
                        <form action="{{ route('enrollment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="is_present" value={{true}}>
                            <input type="hidden" name="course_session_id" value="{{ $course->sessions[0]?->id }}">
                            <button type="submit" class="choose-button">Choisir</button>
                        </form>
                    </td>
                </tr>
                @if ($course->sessions->count() > 1)
                    @for ($i = 1; $i < $course->sessions->count(); $i++)
                        <tr>
                            <td>{{ Carbon::parse( $course->sessions[$i]?->start_at)->format('H:i') ?? '' }}</td>
                            <td>{{ Carbon::parse( $course->sessions[$i]?->end_at)->format('H:i') ?? '' }} </td>
                            <td>{{ $course->sessions[$i]?->courseType?->name ?? '' }}</td>
                            <td>{{ $course->sessions[$i]?->courseType?->price ?? '' }}</td>
                            
                            <td id="course-start-at-{{$course->sessions[$i]->id }}">{{ Carbon::parse($course->sessions[$i]?->courseType?->start_at)->format('y-m-d')   ?? '' }}</td>
                            <td id="course-end-at-{{$course->sessions[$i]->id }}">{{ Carbon::parse( $course->sessions[$i]?->courseType?->end_at)->format('y-m-d') ?? '' }}</td>
                            <td>
                                <from action="{{ route('enrollment.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="is_present" value={{true}}>

                                    <input type="hidden" name="course_session_id"
                                        value="{{ $course->sessions[$i]?->id }}">
                                    <button type="submit" class="choose-button">Choisir</button>
                                </form>
                            </td>

                        </tr>
                        <script>
                            function convertToLocalTime(dateString) {
                               const date = new Date(dateString);
                               const localTime = date.toLocaleString();
                               return localTime;
                            } 
                            let startAtUtcTime = new Date('{{$course->sessions[$i]?->courseType?->start_at}}'+"z"); ;
                            let endAtUtcTime = new Date('{{$course->sessions[$i]?->courseType?->end_at}}'+"z"); ;

           
                           document.getElementById('course-start-at-{{ $course->sessions[$i]->id }').innerHTML = startAtUtcTime.toLocaleString();
                           document.getElementById('course-end-at-{{ $course->sessions[$i]->id }').innerHTML = endAtUtcTime.toLocaleString();      
      
                       </script>
                    @endfor
                  
                @endif
            @endforeach
        
        </tbody>
    </table>


@endsection
