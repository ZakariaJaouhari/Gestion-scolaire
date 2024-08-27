<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
       
    </style>
    @vite('resources/css/inscription.css')
</head>

<body>
    <img src="{{ asset('LogoN.svg') }}" alt="Logo">
    <div class="container" id="container">

        <div class="form-container sign-up">
            <form action="createnew" method="POST">
                @csrf
                <h1>S’inscrire</h1>
                <p>C’est rapide et facile.</p>
                <div style="display: flex;">
                    <input name="nom_ecole" type="text" placeholder="Nom d'école">
                    <input style="margin-left: 10px" name="nom_directeur" type="text" placeholder="Nom directeur">
                </div>
                <input style="width:380px" name="email" type="email" placeholder="Adresse email">
                <div style="display: flex;">
                    <input name="password" type="password" placeholder="Mot de passe">
                    <input style="margin-left: 10px" name="annee" type="text" placeholder="Année scolaire">

                </div>
                <div style="display: flex;">
                    <input name="academie" type="text" placeholder="Academie">
                    <input style="margin-left: 10px" name="direction" type="text" placeholder="Direction">
                </div>
                
                <button type="submit">S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Bienvenue</h1>
                <input name="email" type="email" placeholder="Adresse email">
                <input name="password" type="password" placeholder="Mot de passe">
                <button type="submit">Connexion</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bonjour!</h1>
                    <p>Un système d'information intégré qui permet la mise en place de nouvelles méthodes de gestion
                        scolaire.</p>
                    <button class="hidden" id="login">se connecter</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Bonjour!</h1>
                    <p>Un système d'information intégré qui permet la mise en place de nouvelles méthodes de gestion
                        scolaire.</p>
                    <button class="hidden" id="register">Créer compte pour mon école</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>
