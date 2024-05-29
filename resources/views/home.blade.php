@php
use Illuminate\Support\Facades\Request;
$query = Request::query('needs-auth');

@endphp


@extends('layouts.default')
@section('title',"Home")

@section('content')



<style>
   .home img {
        background-repeat: no-repeat;
        width: 100vw;
       height:40vw;
        
        
    }
</style>
<section class="home" id="home">
   
   <div> <img src="{{ asset('images\Purple Red Course Accounting Intro Outro Youtube Video.gif')}}"  alt="" srcset=""></div>
 
</section>


@if (isset($query) && $query==="true")
<script>
document.querySelector("#popup").style.display = "flex";
 
</script>
@endif
@endsection




