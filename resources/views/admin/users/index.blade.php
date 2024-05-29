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
            @if ($users->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>email</th>
                                <th>role</th>
                                <th>Verifier à </th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>
                                        {{ $user->lastname }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->role }}
                                    </td>
                               <td>
                                {{$user->email_verified_at}}
                               </td>
                                    <td>
                                 
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
                <h4 class="text-center">Aucun utilisateur trouvé</h4>
            @endif
        </div>
    </div>
@endsection
