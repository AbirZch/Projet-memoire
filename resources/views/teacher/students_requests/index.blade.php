<?php
use Carbon\Carbon;
?>
@extends('teacher.layout.app')

@section('content')
@if (count($errors) > 0) {
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
 <div class="toast-header">
    <strong class="mr-auto">Bootstrap</strong>
    <small class="text-muted">Just now</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
 </div>
 <div class="toast-body">
 @foreach ($errors->all() as $error) 
     <p>{{$error}}</p>
 @endforeach
   
 </div>
</div>
@section('scripts')

<script>
$(document).ready(function(){
 $('.toast').toast('show');
});

</script>
@endsection
}
@endif
@if (session('success'))
    <div id="messages" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
 </button>
 <strong>Success!</strong> Your request was successful.
</div>
@section('scripts')
<script>
$(document).ready(function() {
    $('#messages').slideDown().show();
});

</script>
@endsection

@endif

    <div class="card">
        <div class="card-header">
            <form action="">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input class="form-control" type="text" name="search" value="{{ old("search") }}">
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
                                <th>firstname</th>
                                <th>lastname</th>
                                <th>email</th>
                                <th>request date</th>
                                <th>status</th>
                                <th>topic</th>
                                <th>start url</th>
                                <th>meeting_date</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrollements as $enrollement)
                            <script>
                                   var utcTime = new Date('{{ $enrollement->meeting_date }}');
        var userTime = new Date(utcTime.getTime() + (utcTime.getTimezoneOffset() * 60000));
document.getElementById('meeting_date-{{$loop->index}}').html = userTime.toISOString();
                            </script>
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
                                        {{ Carbon::parse($enrollement->enrollment_date)->format('y-m-d H:i')}}
                                    </td>
                                       <td>
                                        {{ $enrollement->status }}
                                    </td>   
                                       <td>
                                        {{ $enrollement->topic ?? "" }}
                                       </td>
                                       <td>
                                        <a href={{ /*$enrollement->meeting->start_url ?? "#" */ isset($enrollement->link) ? $enrollement->link : "#" }} target="_blank">Join Meeting </a>

                                    </td>
                                      
                                       <td id="meeting_date-{{$loop->index}}">
                                       {{--  {{ Carbon::parse($enrollement->meeting_date)->format('y-m-d H:i') }} --}}
                                    </td>
                                    <td>
                     
                                        <button  class="btn btn-sm btn-success schedulebtn" data-toggle="modal" data-target="#meetingModal-{{ $enrollement->id }}">Schedule Meeting</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                      @foreach ($enrollements as $enrollement)
                    <div class="modal fade" id="meetingModal-{{ $enrollement->id }}" tabindex="-1" role="dialog" aria-labelledby="meetingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meetingModalLabel">Schedule Meeting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('enrollment.update', $enrollement->id) }}" method="POST">
            @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="status" value="accepted">
                    <div class="form-group">
                        <label for="Topic">Topic</label>
                        <input type="text" class="form-control" id="topic" name="topic" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                    <div class="form-group">
                        <label for="meeting_date">Meeting Date</label>
                        <input type="datetime-local" class="form-control" id="meeting_date" name="meeting_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
                </div>

            @else
                <h4 class="text-center">Aucun étudient trouvé</h4>
            @endif
        </div>
    </div>
    <script>


    document.addEventListener('DOMContentLoaded', function() {
        var currentTime = new Date();
        
        var formattedTime = currentTime.toISOString().slice(0, 16);
        document.getElementById('meeting_date').value = formattedTime;
    });
</script>
@endsection