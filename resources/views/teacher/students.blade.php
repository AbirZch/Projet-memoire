@extends('teacher.layout.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <form action="">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input class="form-control" type="text" name="search" value="{{ old('search') }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <button class="btn btn-primary">search</button>
                    </div>
                    {{--      <div class="col-md-4 text-right">
                        <a class="btn btn-primary" href="{{ route('students.create') }}">Ajouter</a>
                    </div> --}}
                </div>
            </form>
        </div>
        <div class="card-body">
            @if ($enrollements->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>date de demande</th>
                                <th>Présent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrollements as $enrollement)
                                <tr>
                                    <td>{{ $enrollement->id }}</td>
                                    <td>{{ $enrollement->student->user->firstname }}</td>
                                    <td>
                                        {{ $enrollement->student->user->lastname }}
                                    </td>
                                    <td>
                                        {{ $enrollement->student->user->email }}
                                    </td>
                                    <td>
                                        {{ $enrollement->enrollment_date }}
                                    </td>
                                    <td>
                                        {{ $enrollement->is_present ? "Yes" : "No" }}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h4 class="text-center">Aucun étudient trouvé</h4>
            @endif
        </div>
    </div>
@endsection
