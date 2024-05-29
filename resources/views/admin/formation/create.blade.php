@extends('admin.layout.app')

@section('content')
    <style>
        .form-group {
            display: relative;
            align-items: center;
        }

        .form-group label {
            margin-right: 10px;
            /* Espacement entre l'étiquette et le champ de saisie */
        }

        .upload-group {
            display: relative;
            align-items: center;
        }

        .upload-group label {
            margin-right: 10px;
            /* Espacement entre l'étiquette et le bouton de téléchargement d'image */
        }

        .card {
            padding: 10px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .session-buttons {
            margin-top: 10px;
            /* Espacement vertical entre les boutons de session */
        }
    </style>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-4 form-group align-self-center">
                        <div class="form-group">
                            <label for="">Nom de la formation</label> <br>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>


                    </div>
                    <div class="col-md-4 form-group align-self-center">
                        <div class="form-group">
                            <label for="">Nombre des étudients</label> <br>
                            <input class="form-control" type="number" name="number_of_students"
                                value="{{ old('number_of_students') }}" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="upload-group">
                        <label for="imageUploadButton" class="btn btn-primary mr-2">
                            Importer Image
                        </label>
                    </div>

                    <input type="file" class="form-control d-none" id="imageUploadButton"
                        accept=".jpg, .jpeg, .png, .webp"
                        style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; position: absolute; z-index: -1;"
                        name="image">
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="row mt-4" id="sessionsContainer">
                    <div class="col-12">
                        <h4>Types des formations</h4>
                        <div id="courseTypesFields">
                            <!-- Les champs de type de formation seront ajoutés ici -->
                        </div>

                        <button type="button" class="btn btn-success" onclick="addCourseType()">Ajouter un type</button>
                        <button type="button" class="btn btn-success" onclick="registerCourseTypes()">enregistrer</button>
                    </div>
                </div>
                <!-- Sessions -->
                <div class="row mt-4" id="sessionsContainer">
                    <div class="col-12">
                        <h4>Sessions</h4>
                        <div id="sessionFields">
                            <!-- Les champs de session seront ajoutés ici -->
                        </div>
                        <button type="button" class="btn btn-success" onclick="addSession()">Ajouter Session</button>
                    </div>
                </div>
                <!-- Fin des sessions -->

                <div class="text-right mt-4">
                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let courseTypes = [];
        const addtoCounter = (function() {
            let count = 0; // Initialize the counter with the given value

            return function() {
                return ++count; // Increment the counter and return the new value
            };
        })();

        function addSession() {
            const id = addtoCounter();

            const sessionFields = document.getElementById('sessionFields');
            const sessionCount = sessionFields.querySelectorAll('.session-group').length;

            const sessionGroup = document.createElement('div');
            sessionGroup.classList.add('session-group', 'row', 'mt-2');

            sessionGroup.innerHTML = `
          <div class="col-md-3">
              <div class="form-group">
                  <label for="sessions_start_at_${id}">start at</label>
                  <input class="form-control" type="time" name="sessions_start_at[]" id="sessions_start_at_${id}" required>
              </div>
          </div>
          <div class="col-md-3">
              <div class="form-group">
                  <label for="sessions_end_at_${id}">end at</label>
                  <input class="form-control" type="time" name="sessions_end_at[]" id="sessions_end_at_${id}" required>
              </div>
          </div>
          <label for="sessionType_${id}">type</label>
          <select class="sessionType" name="sessions_types[]" id="session_types_${id}">

</select>
          <div class="col-md-3">
              <button type="button" class="btn btn-danger" onclick="removeSession(this)">Supprimer</button>
          </div>
      `;

            console.log(sessionGroup);
            sessionFields.appendChild(sessionGroup);
            courseTypes.forEach(courseType => {
                console.log(courseTypes)
                document.getElementById('session_types_' + id).innerHTML +=
                    `<option value="${courseType.name}">${courseType.name}</option>`;

            });
        }

        function removeSession(button) {
            const sessionGroup = button.closest('.session-group');
            sessionGroup.remove();
        }

        const courseTypesContainer = document.getElementById('courseTypesFields');


        function addCourseType() {


            const id = addtoCounter();

            const courseTypeCount = courseTypes.length;

            const sessionTypeGroup = document.createElement('div');
            sessionTypeGroup.id = id;
            sessionTypeGroup.classList.add('sessionType-group', 'row', 'mt-2');

            sessionTypeGroup.innerHTML = `<div class="col-md-4">
                <div class="form-group">
                  <label for="name_${id}">nom</label>
                  <input class="form-control" type="text" name="course_type_names[]" id="name_${id}" required>
                </div>
           
          </div>
          <div class="col-md-4">
            <div class="form-group">
                  <label for="price_${id}">Prix</label>
                  <input class="form-control" type="number" name="course_type_prices[]" id="price_${id}" required>
              </div>
            </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="duration_${id}">Durée (en jours)</label>
                  <input class="form-control" type="number" name="course_type_durations[]" id="duration_${id}" required>
              </div>
          </div>
      
          <div class="col-md-4">
              <button type="button" class="btn btn-danger" onclick="removeCourseType(${id})">Supprimer</button>
          </div>`;

            courseTypesContainer.appendChild(sessionTypeGroup);
        }

        function registerCourseTypes() {
            const courseTypesElements = courseTypesContainer.querySelectorAll('.sessionType-group')

            courseTypesElements.forEach(function(element) {
                const inputObject = {}
                inputObject['name'] = document.getElementById('name_' + element.id).value;
                inputObject['price'] = document.getElementById('price_' + element.id).value;
                inputObject['duration'] = document.getElementById('duration_' + element.id).value;
                if (!courseTypes.some((e) => e.name === inputObject.name)) {

                    courseTypes.push(inputObject);
                }
            });
            console.log(courseTypes, "Courses Types");
        }

        function removeCourseType(id) {

            console.log(id, "id")
            const courseTypeElement = document.getElementById(id);
            const sessionTypeName = document.getElementById("name_" + id).name;
            console.log(sessionTypeName);
            const courseType = courseTypes.find((e) => e.name === sessionTypeName);
            courseTypes.splice(courseTypes.indexOf(courseType), 1);

            courseTypeElement.remove();
        }
    </script>
@endsection
