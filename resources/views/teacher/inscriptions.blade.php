@extends('teacher.layout.app')

@section('content')


<div class="card">
    <div class="card-header">
        <form action={{route('teachers.inscriptions')}}>
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
        @if ($courses->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>description</th>
                        <th>image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>
                            {{ $course->name }}
                        </td>
                        <td>
                            {{ $course->description }}
                        </td>
                        <td>
                            <img src="{{asset( $course->image) }}" height=70px>
                        </td>
                        <td>
                            <form id="is_subscribed_form_{{$course->id}}" action="{{ route('teachers.edit', $course->id) }}" method="POST" class="is-subscribed-form">
                                @csrf

                                <div class="custom-control custom-switch">

                                    <input type="checkbox" id="is_subscribed_{{$course->id}}" class="custom-control-input" name="is_subscribed" {{$classrooms->contains('course_id', $course->id) == true ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="is_subscribed_{{$course->id}}">Is Subscribed</label>
                                </div>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @else
        <h4 class="text-center">Aucun formation trouvé</h4>
        @endif
    </div>
</div>
<script>
    const forms = document.getElementsByClassName('is-subscribed-form');
    const isSubscribedSwitches = document.getElementsByClassName('custom-control-input');
    
    Array.from(isSubscribedSwitches).forEach(function(element, index) {
        element.addEventListener('change', function() {
            forms[index].submit();

        });
    });
</script>
@endsection