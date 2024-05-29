@extends('admin.layout.app')
@section('content')

<style>


</style>
    <div class="card">
        <div class="card-header">
            <form action={{route('admin.teachers.index')}}>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input class="form-control" type="text" name="search" value="{{ old("search") }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <button class="btn btn-primary">search</button>
                    </div>
              
                </div>
            </form>
        </div>
        <div class="card-body">
            @if ($teachers->isNotEmpty())
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
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->id }}</td>
                                    <td>
                                        {{ $teacher->user->firstname }}
                                    </td>
                                      <td>
                                        {{ $teacher->user->lastname }}
                                    </td>
                                         <td>
                                        {{ $teacher->user->email }}
                                    </td>
                                    <td>
                                   {{--     <a class="btn btn-sm btn-info" href="{{ route('teachers.edit', $teacher->id) }}">modifier</a> --}}
                     {{--                     <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                                                                                     @method('DELETE')

                                            @csrf
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </form>  --}}
                                            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" class="is-authorized-form" id="is-authorized-form-{{$teacher->id}}">
     <div class="form-group">                                                                                 @csrf
<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="is_teacher_verified_{{$teacher->id}}"  name="is_auth"  {{$teacher->is_authorized == true ? 'checked' : ''}}  >
  <label class="custom-control-label" for="is_teacher_verified_{{$teacher->id}}">isVerified</label>
</div>
</div>  

                                        </form>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $teachers->withQueryString()->links() }}
            @else
                <h4 class="text-center">Aucun maitres trouvé</h4>
            @endif
        </div>
    </div>
    <script>
       const forms = document.getElementsByClassName('is-authorized-form');
const switchElements= document.getElementsByClassName('custom-control-input');

Array.from(switchElements).forEach(function  (element, index) {
    element.addEventListener('change', function() {
        forms[index].submit();
    })
}); 

    
    </script>

@endsection