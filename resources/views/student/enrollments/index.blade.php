@extends('teacher.layout.app')
@section('content')

    <div>
        @if (count($enrollments) > 0)
            @foreach ($enrollments as $index => $enrollment)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>date de demande</th>
                            <th>status</th>
                            <th>lien</th>
                            <th>date de Réunion</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                {{ $enrollment->enrollment_date }}
                            </td>
                            <td>
                                {{ $enrollment->status }}
                            </td>

                            <td>
                                <a href="{{ $enrollment->meeting->join_url ?? '#' }}" target="_blank">Join Meeting </a>
                            </td>

                            <td>
                                {{ $enrollment->meeting_date }}
                            </td>

                        </tr>
                    </tbody>
                </table>
            @endforeach
        @endif

    </div>

@endsection
