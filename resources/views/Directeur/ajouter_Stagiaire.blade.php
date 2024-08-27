<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite('resources/css/gestion_Formateurs.css')
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex">
        <div class="sidebar fixed">
            <ul class="nav">
                <li id="tophome">
                    <a href="{{ route('pagehome') }}">
                        <img class="logos home" src="Bhome.png" alt="">
                        <img class="logos home hv" src="Bhome-hover.png" alt=""> Home</a>
                </li>
                <li>
                    <a href="{{ route('formateurs') }}">
                        <img class="logos formateur" src="prof.png" alt="">
                        <img class="logos formateur hv" src="prof-hover.png" alt="">Formateurs</a>
                </li>
                <li>
                    <a href="{{ route('stagiaires') }}" class="active">
                        <img class="logos stagiaire hidden" src="stagiaire.png" alt="">
                        <img class="logos stagiaire hv block" src="stagiaire-hover.png" alt="">Stagiaires</a>
                </li>
                <li>
                    <a href="{{ route('groupes') }}">
                        <img class="logos groupes" src="groupe.png" alt="">
                        <img class="logos groupes hv" src="groupe-hover.png" alt="">Groupes</a>
                </li>
                <li>
                    <a href="{{ route('modules') }}">
                        <img class="logos module" src="module.png" alt="">
                        <img class="logos module hv" src="module-hover.png" alt="">Modules</a>
                </li>
                <li>
                    <a href="{{ route('showForm') }}">
                        <img class="logos notes" src="note.png" alt="">
                        <img class="logos notes hv" src="note-hover.png" alt=""><span>Notes</span></a>
                </li>
                <li>
                    <a href="{{ route('gestionC') }}">
                        <img class="logos demande" src="certificat.png" alt="">
                        <img class="logos demande hv" src="certificat-hover.png"
                            alt=""><span>Certificats</span></a>
                </li>
                <li id="logout">
                    <a href="{{ route('logout') }}">
                        <img class="logos" src="logout.png" alt="">
                        <img class="logos hv" src="logout-hover.png" alt="">Log out</a>
                </li>
            </ul>
        </div>
        <div>
            <div class="flex ml-44">
                <img class="h-80 w-80 relative bottom-28" src="{{ asset('NOTES.svg') }}" alt="Logo">
                <p
                    class="relative right-28 top-9 text-neutral-50 bg-red-500 h-4 w-14 text-center text-xs font-medium rounded-full">
                    V 0.1.0</p>
                <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-72 flex">
                    <img src="ecole(1).png" class="h-10 w-12 mr-3 mt-2" alt="">
                    <spa class="mt-4" style="font-family: 'Apple Chancery';">
                        {{ auth()->guard('directeur')->user()->nom_ecole }}</span>
                </h1>
                <h1 class="text-2xl  font-semibold mt-6 text-neutral-700  flex relative bottom-3 left-64 ml-20">
                    <img src="profil.png" class="h-10 w-12 mr-3 mt-2.5" alt="">
                    <a href="{{ route('profil') }}" class="mt-3.5 z-50 h-10" style="font-family: 'Apple Chancery';">

                        {{ auth()->guard('directeur')->user()->nom_directeur }}
                    </a>
                </h1>
            </div>
            <h1 class=" font-extrabold relative text-5xl left-72 bottom-44 mb-32"
                style="font-family: 'Apple Chancery';">Ajouter stagiaire</h1>
            <form class=" bottom-64 ml-96 left-32 relative " action="createnewS" enctype="multipart/form-data"
                method="POST">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div>
                            <div>
                                <label for="photo"
                                    class="block text-base font-semibold leading-7 text-gray-900">Photo</label>
                                <div class="mt-2 flex items-center gap-x-3 justify-between">
                                    <img id="image-preview" class="h-32 w-32 rounded-full border border-gray-950"
                                        src="#" alt="">
                                    <label for="image-upload"
                                        class="relative h-11 w-24 ml-14 cursor-pointer rounded-xl bg-indigo-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  font-semibold text-white focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-indigo-600">
                                        <span class="ml-4 relative top-2">Change</span>
                                        <input type="file" class="sr-only" id="image-upload"
                                            name="profile_picture" accept="image/*">
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('profile_picture')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Informations du Stagiaire</h2>

                        <div class="flex-col mt-10 space-y-8">
                            <div class="flex space-x-4">
                                <div class="relative h-11 w-full min-w-[400px]">
                                    <input id="nom" name="nom"
                                        class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                    <label
                                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        Nom
                                    </label>
                                    @error('nom')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="relative h-11 w-full  min-w-[400px]">
                                    <input id="prenom" name="prenom" oninput="generatepassword()"
                                        class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                    <label
                                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        Prenom
                                    </label>
                                    @error('prenom')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div>
                                    <label for="day"
                                        class="block text-sm font-normal leading-6 text-gray-900 ">Date
                                        naissance</label>
                                    <div class="flex  space-x-2">
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[140px]">

                                                <select id="day" name="day" onchange="generateEmail()"
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ sprintf('%02d', $i) }}">
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[140px]">
                                                <select id="month" name="month" onchange="generateEmail()"
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @foreach (['01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'] as $key => $value)
                                                        <option value="{{ $key }}">
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[130px]">
                                                <select id="year" name="year" onchange="generateEmail()"
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @for ($i = date('Y'); $i >= 1905; $i--)
                                                        <option value="{{ $i }}">
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative h-11 w-full top-6  min-w-[400px]">
                                    <input id="CIN" name="CIN"
                                        class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                    <label
                                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        CIN
                                    </label>
                                    @error('CIN')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div class="relative h-11 w-full  min-w-[400px]">
                                    <label for="sexe"
                                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        sexe
                                    </label>
                                    <div class="sm:col-span-3">
                                        <div class="relative h-11 w-full min-w-[400px]">
                                            <select id="sexe" name="sexe" autocomplete="country-name"
                                                class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                <option value="Homme" {{ old('sexe') == 'Homme' ? 'selected' : '' }}>Homme</option>
                                                <option value="Femme" {{ old('sexe') == 'Femme' ? 'selected' : '' }}>Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative h-11 w-full  min-w-[400px]">
                                    <label for="groupe"
                                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        Groupe
                                    </label>
                                    <div class="sm:col-span-3">
                                        <div class="relative h-11 w-full min-w-[260px]">
                                            <select id="groupe" name="groupe"
                                                class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                @foreach ($groupes as $groupe)
                                                    <option value="{{ $groupe->id }}">{{ $groupe->matricule }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex space-x-4">
                                <div class="relative h-11 w-full min-w-[400px]">
                                    <input type="text" id="email" name="email"
                                        class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                    <span
                                        class="relative bottom-7 left-80 ml-7 font-sans   select-none text-gray-500 sm:text-sm">@taalim.ma</span>

                                    @error('email')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                    <label
                                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight  peer-focus:after:scale-x-100 ">
                                        Email
                                    </label>
                                </div>

                                <div class="relative h-11 w-full  min-w-[400px]">
                                    <input id="password" name="password"
                                        class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                    <label
                                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight  peer-focus:after:scale-x-100  ">
                                        Mot de passe
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('stagiaires') }}">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Annuler</button>
                    </a>
                    <button type="submit"
                        class="rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const imageUrl = URL.createObjectURL(file);
            document.getElementById('image-preview').src = imageUrl;
        }

        document.getElementById('image-upload').addEventListener('change', previewImage);


        function generateEmail() {
            const year = document.getElementById('year').value;
            const month = document.getElementById('month').value;
            const day = document.getElementById('day').value;
            const randomNumber = Math.floor(Math.random() * 9000) + 1000;
            const email = `${year}${month}${day}${randomNumber}`;

            document.getElementById('email').value = email;
        }


        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function generatepassword() {
            const firstName = document.getElementById('prenom').value.trim();
            const randomNumber = Math.floor(Math.random() * 9000) + 1000;
            const password = `${firstName.toLowerCase()}${randomNumber}`;

            document.getElementById('password').value = password;
        }
    </script>
</body>

</html>
