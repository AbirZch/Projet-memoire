@extends('admin.layout.app')

@section('content')
    <style>
        .btn-cadetblue {
            background-color: cadetblue;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.2s ease-in-out;
        }

        .btn-cadetblue:hover {
            background-color: cadetblue;
            /* Couleur de survol */
        }

      .course-image {
        height: 100px;object-fit: cover;
      }
    </style>
    <div class="card">
        <div class="card-header">
            <form action="">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input class="form-control" type="text" name="search" value="{{ old('search') }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <button class="btn btn-sm btn-cadetblue">search</button>

                    </div>
                    <div class="col-md-4 text-right">
                        <a class="btn btn-sm btn-cadetblue" href="{{ route('admin.courses.create') }}">Ajouter</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if ($courses->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Formation</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $formation)
                                <tr>
                                    <td>{{ $formation->id }}</td>
                                    <td>{{ $formation->name }}</td>
                                    <td>
                                        {{ $formation->description }}
                                    </td>
                                    <td>
                                        <img class="course-image" src="{{ asset($formation->image) }}"
                                            alt="{{ $formation->image }}" />
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-cadetblue"
                                            href="{{ route('admin.courses.edit', $formation->id) }}">modifier</a>
                                        <form action="{{ route('admin.courses.destroy', $formation->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-cadetblue">supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <h4 class="text-center">Aucune formation trouvée</h4>
            @endif
        </div>
    </div>
@endsection
