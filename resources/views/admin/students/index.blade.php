@extends('admin.layout.app')

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
            @if ($students->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>firstname</th>
                                <th>lastname</th>
                                <th>email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->user->firstname }}</td>
                                    <td>
                                        {{ $student->user->lastname }}
                                    </td>
                                    <td>
                                        {{ $student->user->email }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_blocked" class="custom-control-input"
                                                    id="is_student_blocked_{{ $student->id }}"
                                                    {{ $student->is_blocked == true ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="is_student_blocked_{{ $student->id }}">isBlocked</label>
                                            </div>

                                        </form>
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </form>
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
