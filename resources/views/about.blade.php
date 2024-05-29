@extends('layouts.default')
@section('title',"AboutUs")
@section('content')

<style>
    .text{
        top:-100%;
        bottom:100;
            }
    .btn{
        width:auto;
        height: auto;
      margin:auto;
      display:block;
    }
    .about-image{
        display:flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="page-main">
    <div class="separator"></div>
<section class="about" id="about">
   <h1 class="heading"><div>A propos</div></h1>
   <div class="container">
        <div class="about-content">
            <figure class="about-image">
                 <img src="{{ asset('images\OIP.jpg')}}"  alt="" srcset="" width="400px" height="400px"> 
            </figure>
            <div class="text">
                <p>
                    <em>
                        <u>Notre academie ce n’est-pas seulement pour les etudiants</u>
                   
                    <em>
                        <u>Les professeurs peuvent également s’inscrire dans Cette accademie</u>

    
                        <u>Il existe de nombreux formation avec des bon prix et des meilleurs formation bien choisis..</u></em>
            </p>
                
        
</div>
@endsection