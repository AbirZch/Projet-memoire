@extends('layouts.default')
@section('title', 'Choix du mode de formation')
@section('content')
    <style>
        /* styles.css */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        :root {
            --primary-color: #1E90FF;
            --secondary-color: #f2f2f2;
            --text-color: #333;
            --accent-color: #4CAF50;
            --font-family: 'Roboto', sans-serif;
        }

        body {
    font-family: var(--font-family);
    margin: 0;
    padding: 0;
    background-color: var(--secondary-color);
    color: var(--text-color);
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 40px;
    text-align: center;
}

h1 {
    margin-bottom: 30px;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
    gap: 20px; /* Ajout de l'espace entre les boutons */
}

.btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 12px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 10px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: var(--accent-color);
}

#message {
    font-weight: bold;
    font-size: 18px;
}
</style>

    <div class="container">
        <h1>Choisissez votre mode de formation</h1>
        <div class="button-container">
<form action="{{route('courses.online')}}" method="GET" id="onlineForm">
    <button id="onlineBtn" class="btn">En ligne</button>

</form>
<form action="{{route('courses.presence')}}" method="GET" id="presentialForm">
    <button id="presentialBtn" class="btn">Présentiel</button>

</form>

        </div>
        <p id="message"></p>
    </div>
<script>
    const onlineBtn = document.getElementById('onlineBtn');
    const presentialBtn = document.getElementById('presentialBtn');
    const message = document.getElementById('message');
    const onlineForm = document.getElementById('onlineForm');
    const presentialForm = document.getElementById('presentialForm');
    onlineBtn.addEventListener('click', function() {
        onlineForm.submit();
    })
    presentialBtn.addEventListener('click', function() {
        presentialForm.submit();
    })
</script>

@endsection
