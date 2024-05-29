<style>
    @import url('https://fonts.googleapis.com/css2? family-Poppins:wght@300;400;500;600;700; 800;9008 display=swap');



    .header .logo img {
        width: 5%;
    }

    .header .navbar a {

        font-size: 1.9rem;

        color: var(--black);

        margin: 6 1rem;
        padding-block: 1rem;

    }

    .header .navbar a:hover {
        color: var(--primary-color);
    }

    .header .navbar .hover-underline {

        position: relative;
        margin: 0px 10px;
        max-width: max-content;

    }

    .header .navbar .hover-underline::after {

        content: '';

        position: absolute;

        left: 0;
        bottom: 0;

        width: 100%;

        height: .5rem;

        border: .1rem solid var(--primary-color);
        border: .1rem solid var(--primary-color);

        transform: scaleX(0.2);

        opacity: 0;

        transition: 50ms ease;

    }

    .header .navbar .hover-underline:is(:hover, :focus-visible)::after {

        transform: scaleX(1);

        opacity: 1;

    }

    .icons div {

        font-size: 2.5rem;

        margin-left: 1.7rem;

        color: var(--black);

        cursor: pointer;

    }

    .header .icons div:hover {

        color: var(--primary-color);
    }

    #wrapper {
        position: relative;
        width: 400px;
        height: auto;
        min-height: 440px;
        max-height: 700px;
        display: block;
        flex-direction: column;
        overflow-y: auto; 

        background: white;
        box-shadow: 0 0 50px cadetblue;
        border-radius: 20px;
        padding: 40px;
    }

    .form-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        transition: 1s ease-in-out;
    }


   
    h2 {
        display: grid;
        font-size: 20px;
        color: black;
        text-align: center;
    }

    input:invalid {
        border: 2px dashed red;
    }

    #popup {

        z-index: 5;
        height: 100vh;
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        justify-content: center;
        align-items: center;
    }
#close {
    position: absolute;
    top: 10px;
    right: 10px;
}
    .input-group {
        position: relative;
        margin: 30px 0;
        border-bottom: 2px solid cadetblue;
    }

    .input-group label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        font-size: 16px;
        color: black;
        pointer-events: none;
        transition: .5s;
    }

    .input-group input {
        width: 320px;
        height: 40px;
        font-size: 16px;
        color: black;
        padding: 0 5px;
        background: transparent;
        border: none;
        outline: none;
    }

    .input-group input:focus~label,
    .input-group input:valid~label {
        top: -5px;
    }

    .remember {
        margin: -5px 0 15px 5px;
    }

    .remember label {
        color: black;
        font-size: 14px;
    }

    .remember label input {
        accent-color: cadetblue;
    }

    button {
        position: relative;
        width: 100%;
        height: 40px;
        background: cadetblue;
        box-shadow: 0 0 10px cadetblue;
        font-size: 16px;
        color: black;
        font-weight: 500;
        cursor: pointer;
        border-radius: 30px;
        border: none;
        outline: none;
    }

    .SignUp-link {
        font-size: 14px;
        text-align: center;
        margin: 15px 0;

    }

    .SignUp-link p {
        color: black;
    }

    .SignUp-link p a {
        color: cadetblue;
        text-decoration: inline;
        font-weight: 500;
    }

    .SignUp-link p a:hover {
        text-decoration: underline;
    }

    .signIn-link p a {
        color: cadetblue;
    }

    .SignIn-link p {
        color: black;
        font-size: 14px;
        text-align: center;
        margin: 15px 0;
        text-decoration: none;
    }

    .SignIn-link p a:hover {
        text-decoration: underline;
    }

    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid black;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    option {
        font-size: 16px;
        padding: 5px;
    }

    .header_button {
        margin-top: 0px
    }

    a {
        display: inline-block;
    }
</style>
<header class="header">
    <a href="#" class="logo">
        <img src="{{ asset('School\public\images\Beta-badge.svg.png') }}" alt="" srcset="">
    </a>

    <nav class="navbar">
        <ul>
            <a href="{{ route('home') }}" class="hover-underline">Acceuil</a>
            <a href="{{ route('about') }}" class="hover-underline">A propos</a>
            <a href="{{ route('courses.showCourses') }}" class="hover-underline">Formations</a>
            <a href="{{ route('contact') }}" class="hover-underline">Contact</a>

        </ul>

    </nav>

    @guest
        <div class="header__auth">


            <button class="header_button" id="open">Se connecter</button>
            <div id="popup">
                <div id="wrapper">
                    <span class="close" id="close" >&times;</span>
                    <div class="form-wrapper sign-in row">

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <h2>Se connecter</h2>
                            <div class="input-group">
                                <input type="text" name="email" id="signin-email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-group">
                                <input type="password" name="password" id="signin-password" required>
                                <label for="password">Mot de passe</label>
                            </div>
                            <div class="remember">
                                <label>
                                    <input type="checkbox" name="remember">
                                    Souviens-toi de moi
                                </label>
                            </div>

                            <button type="submit">Se connecter</button>
                            <div class="signUp-link">
                                <p>Je n'ai pas de compte.
                                    <a href="#"class="signUpBtn-link">Inscrivez-vous</a>
                                </p>
                            </div>

                        </form>
                        <p>
                            <a href="{{ route('password.request') }}">Mot de passe oublie</a>
                        </p>
                    </div>
                    <div class="form-wrapper sign-up row" style="display:none;">
                        <form action="{{ route('signup') }}" method="POST" onsubmit='return validateSignUpForm()'>
                            @csrf
                            <h2>Inscrivez-vous</h2>
                            <div class="input-group">
                                <input type="text" name="firstname" class="@error('firstname') is-invalid @enderror"
                                    id="firstname" required>
                                <label for="firstname">Prénom</label>
                                @error('firstname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group">
                                <input type="text" name="lastname" id="lastname" required>
                                <label for="lastname">Nom</label>
                            </div>
                            <div class="input-group">
                                <input type="email" name="email" id="signup-email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-group">
                                <input type="password" name="password" class="@error('password') is-invalid @enderror"
                                    id="signup-password" onkeyup="check();" required>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <label for="password">Mot de passe </label>
                            </div>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" min="8" max="50"
                                    id="password_confirmation" onkeyup="check();" required>
                                <label for="password_confirmation">Confirmez le mot de passe</label>

                            </div>
                            <div class="choix">
                                <select name="role" id="role">
                                    <option value="">Vous êtes un :</option>
                                    <option value="teacher">Professeur</option>
                                    <option value="student">Etudiant</option>
                                </select>
                            </div>

                            <button type="submit">S'inscrire</button>
                            <div class="signIn-link">
                                <p>J'ai déjà un compte.
                                    <a href="#" class="signInBtn-link">Se connecter</a>
                                </p>
                            </div>
                        </form>
                    </div>

                    <script>
                        const signInForm = document.querySelector('.sign-in');
                        const signUpForm = document.querySelector('.sign-up');
                        const signInBtn = document.querySelector('.signInBtn-link');
                        const signUpBtn = document.querySelector('.signUpBtn-link');
                        const roleSelect = document.querySelector('#role');
                        const bopen = document.querySelector("#open");
                        const bclose = document.querySelector("#close");
                        const wrapper = document.querySelector("#wrapper");
                        const popup = document.querySelector("#popup");
                        let isSignUp = false;


                        bopen.addEventListener("click", () => {
                            console.log('connecter is clicked');
                            popup.style.display = "flex";
                        });

                        bclose.addEventListener("click", () => {
                            popup.style.display = "none";
                        });


                        let check = function() {
                            if (document.getElementById('signup-password').value ==
                                document.getElementById('password_confirmation').value) {
                                document.getElementById('message').style.color = 'green';
                                document.getElementById('message').innerHTML = 'matching';
                            } else {
                                document.getElementById('message').style.color = 'red';
                                document.getElementById('message').innerHTML = 'not matching';
                            }
                        }
                        let validateSignUpForm = function() {
                            // Get form elements
                            var firstname = document.getElementById('firstname').value;
                            var lastname = document.getElementById('lastname').value;
                            var email = document.getElementById('signup-email').value;
                            var password = document.getElementById('signup-password').value;
                            var passwordConfirmation = document.getElementById('password_confirmation').value;
                            var role = document.getElementById('role').value;

                            // Basic validation
                            if (firstname === "" || lastname === "" || email === "" || password === "" || passwordConfirmation === "" ||
                                role === "") {
                                alert("Please fill all required fields.");
                                return false;
                            }

                            // Email validation
                            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                            if (!emailRegex.test(email)) {
                                alert("Please enter a valid email address.");
                                return false;
                            }

                            // Password validation
                            if (password.length < 8) {
                                alert("Password must be at least 8 characters long.");
                                return false;
                            }

                            // Password confirmation
                            if (password !== passwordConfirmation) {
                                alert("Passwords do not match.");
                                return false;
                            }

                            // If all validations pass, return true to submit the form
                            return true;
                        }
                        signUpBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            wrapper.style.height = "100%";
                            isSignUp = true;
                            toggleForms();
                        });

                        signInBtn.addEventListener('click', function(e) {

                            e.preventDefault();
                            wrapper.style.height = "auto";
                            isSignUp = false;
                            toggleForms();
                        });

                        roleSelect.addEventListener('change', function() {
                            isSignUp = (this.value != '');
                            toggleForms();
                        });

                        function toggleForms() {
                            signInForm.style.display = isSignUp ? 'none' : 'flex';
                            signUpForm.style.display = isSignUp ? 'flex' : 'none';
                        }

                        const signInBtnLink = document.querySelector(".signInBtn-link");
                        const signUpBtnLink = document.querySelector(".signUpBtn-link")
                    </script>

                </div>
            </div>
        @endguest

        @auth
            <div style="width:20%;display:flex;align-items:center;justify-content:center">
                <div class="navbar" style="width:50%; display: flex;justify-content: flex-end;">
                    @php
                        $route = '';
                        if (auth()->user()->role === 'student') {
                            $route = route('me');
                        } elseif (auth()->user()->role === 'teacher') {
                            $route = route('teachers.profile');
                        } elseif (auth()->user()->role === 'admin') {
                            $route = route('admin.dashboard');
                        }
                    @endphp
                    <a style="margin-right:10px" href="{{ $route }}">Profile</a>
                </div>
                <div style="width:50%;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn" onclick="return confirm('Are you sure you want to logout?')"
                            type="submit">
                            Se déconnecter</button>
                    </form>
                </div>

            </div>

        @endauth


        @guest

        @endguest

    </div>
</header>
