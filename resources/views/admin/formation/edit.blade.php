@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.courses.update', $formation->id) }}" method="POST">
                @csrf
                <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">Nom de la formation</label>
                            <input class="form-control" type="text" name="name" value="{{ $formation->name }}" required>
                        </div>
                     
                </div>
                <div class="row">
                    <input type="file" class="form-control d-none" id="imageUploadButton"
                    accept=".jpg, .jpeg, .png"
                    style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; position: absolute; z-index: -1;"
                    name="image">

                <label for="imageUploadButton" > <div class="btn btn-primary text-center self-center" style="max-height:50px"> Upload
                        Image </div></label>

                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" cols="30" rows="10">{{ $formation->description }}</textarea>
                    </div>
                </div>

                <div class="text-right mt-4">
                    <button class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
