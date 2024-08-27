<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .active .hv {
            display: block;
        }
    </style>
    @vite('resources/css/pageHomeF.css')
    @vite('resources/css/app.css')

</head>

<body>
    <div class="flex">
        <div class="sidebar fixed">
            <div class="profile">
                <img src="{{ auth()->guard('formateur')->user()->profile_picture }}" alt="">
            </div>
            <ul class="nav">
                <li id="tophome">
                    <a href="{{ route('pagehomeF') }}">
                        <img class="logos home " src="Bhome.png" alt="">
                        <img class="logos home hv " src="Bhome-hover.png" alt=""> Home</a>
                </li>
                <li>
                    <a href="{{ route('profilF') }}" class="active">
                        <img class="logos formateur hidden" src="prof.png" alt="">
                        <img class="logos formateur hv block" src="prof-hover.png" alt="">Profile</a>
                </li>
                <li>
                    <a href="{{ route('groupesF') }}">
                        <img class="logos groupes " src="groupe.png" alt="">
                        <img class="logos groupes hv " src="groupe-hover.png" alt="">Groupes</a>
                </li>
                <li>
                    <a href="{{ route('modulesF') }}">
                        <img class="logos module" src="module.png" alt="">
                        <img class="logos module hv" src="module-hover.png" alt="">Modules</a>
                </li>
                <li>
                    <a href="{{ route('notesF') }}">
                        <img class="logos notes" src="note.png" alt="">
                        <img class="logos notes hv" src="note-hover.png" alt=""><span>Notes</span></a>
                </li>
                <li id="logout">
                    <a href="{{ route('logout') }}">
                        <img class="logos" src="logout.png" alt="">
                        <img class="logos hv" src="logout-hover.png" alt="">Log out</a>
                </li>
            </ul>
        </div>
        <div>
            <div class="relative left-64">
                <div class="flex -ml-20">
                    <img class="h-80 w-80 relative bottom-28" src="{{ asset('NOTES.svg') }}" alt="Logo">
                    <p
                        class="relative right-28 top-9 text-neutral-50 bg-red-500 h-4 w-14 text-center text-xs font-medium rounded-full">
                        V 0.1.0</p>
                    <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-72 flex">
                        <img src="ecole(1).png" class="h-10 w-12 mr-3 mt-2" alt="">
                        <spa class="mt-4" style="font-family: 'Apple Chancery';">
                            {{ auth()->guard('formateur')->user()->directeurs->nom_ecole }}</span>
                    </h1>
                    <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-20 flex">
                        <img src="profil.png" class="h-10 w-12 mr-3 mt-2.5" alt="">
                        <spa class="mt-3.5" style="font-family: 'Apple Chancery';">
                            {{ auth()->guard('formateur')->user()->nom }}
                            {{ auth()->guard('formateur')->user()->prenom }}</span>
                    </h1>
                </div>
                <div class="relative bottom-44 mb-16">
                    <h1 class=" font-extrabold text-5xl ml-10 mb-5" style="font-family: 'Apple Chancery';">Profil de
                        {{ auth()->guard('formateur')->user()->nom }}
                        {{ auth()->guard('formateur')->user()->prenom }}</h1>
                </div>
                <form id="form" class=" bottom-64 ml-60 relative  min-w-[950px]  rounded-3xl"
                    action="{{ route('changepassword', $formateur) }}" enctype="multipart/form-data" method="POST">
                    <br>
                    @csrf
                    @method('PUT')
                    <div class="space-y-12 relative mr-10 ml-10">
                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="mt-10 grid  gap-x-6 gap-y-8 sm:grid-cols-6 ">


                                <div class="col-span-full">
                                    <label for="photo"
                                        class="block text-base font-semibold leading-7 text-gray-900">Photo</label>
                                    <div class="mt-2 flex items-center gap-x-3 justify-between">
                                        <img id="image-preview" class="h-32 w-32 rounded-full border border-gray-950"
                                            src="{{ old('profile_picture', isset($formateur) ? asset($formateur->profile_picture) : '#') }}"
                                            alt="">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Informations du formateurs</h2>

                            <div class="flex-col mt-10 space-y-8">
                                <div class="flex space-x-4">
                                    <div class="relative h-11 w-full min-w-[400px]">
                                        <input id="nom" name="nom" readonly
                                            value="{{ old('nom', $formateur->nom) }}"
                                            class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                        <label
                                            class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                            Nom
                                        </label>
                                    </div>

                                    <div class="relative h-11 w-full  min-w-[400px]">
                                        <input id="prenom" name="prenom" readonly
                                            value="{{ old('prenom', $formateur->prenom) }}"
                                            class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                        <label
                                            class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                            Prenom
                                        </label>
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div class="relative h-11 w-full min-w-[400px]">
                                        <input type="text" id="matricule" name="matricule" readonly
                                            value="{{ old('matricule', $formateur->matricule) }}"
                                            class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                        <label
                                            class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                            Matricule
                                        </label>
                                    </div>

                                    <div class="relative h-11 w-full min-w-[400px]">
                                        <input type="text" id="CIN" name="CIN" readonly
                                            value="{{ old('CIN', $formateur->CIN) }}"
                                            class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                        <label
                                            class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                            CIN
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label for="day"
                                        class="block text-sm font-normal leading-6 text-gray-900 ">Date
                                        naissance</label>
                                    <div class="flex  space-x-4">
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[280px]">

                                                <select id="day" name="day" readonly
                                                    value="{{ old('day', $formateur->day) }}"
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ sprintf('%02d', $i) }}"
                                                            {{ old('day', substr($formateur->date_naissance, 8, 2)) == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[280px]">
                                                <select id="month" name="month" readonly
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @foreach (['01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'] as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ old('month', substr($formateur->date_naissance, 5, 2)) == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[280px]">
                                                <select id="year" name="year" readonly
                                                    value="{{ old('year', $formateur->year) }}"
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @for ($i = date('Y'); $i >= 1905; $i--)
                                                        <option value="{{ $i }}"
                                                            {{ old('year', substr($formateur->date_naissance, 0, 4)) == $i ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
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
                                                <select id="sexe" name="sexe" readonly
                                                    value="{{ old('sexe', $formateur->sexe) }}"
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    <option value=""></option>
                                                    <option value="Homme"
                                                        {{ $formateur->sexe == 'Homme' ? 'selected' : '' }}>
                                                        Homme</option>
                                                    <option value="Femme"
                                                        {{ $formateur->sexe == 'Femme' ? 'selected' : '' }}>
                                                        Femme</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative h-11 w-full  min-w-[400px]">
                                        <label for="situation"
                                            class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                            Situation familiale
                                        </label>
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[400px]">
                                                <select id="situation" name="situation" readonly
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    <option value=""></option>
                                                    <option value="Marié(e)"
                                                        {{ old('situation', $formateur->situation) == 'Marié(e)' ? 'selected' : '' }}>
                                                        Marié(e)</option>
                                                    <option value="Célibataire"
                                                        {{ old('situation', $formateur->situation) == 'Célibataire' ? 'selected' : '' }}>
                                                        Célibataire</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="dayR"
                                        class="block text-sm font-normal leading-6 text-gray-900 ">Date
                                        recrutement</label>
                                    <div class="flex  space-x-4">
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[280px]">

                                                <select id="dayR" name="dayR" readonly
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ sprintf('%02d', $i) }}"
                                                            {{ old('dayR', substr($formateur->date_recrutement, 8, 2)) == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[280px]">
                                                <select id="monthR" name="monthR" readonly
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @foreach (['01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'] as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ old('monthR', substr($formateur->date_recrutement, 5, 2)) == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <div class="relative h-11 w-full min-w-[280px]">
                                                <select id="yearR" name="yearR" readonly
                                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                                    @for ($i = date('Y'); $i >= 1905; $i--)
                                                        <option value="{{ $i }}"
                                                            {{ old('yearR', substr($formateur->date_recrutement, 0, 4)) == $i ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex space-x-4">
                                    <div class="relative h-11 w-full min-w-[400px]">
                                        <input type="text" id="email" name="email" readonly
                                            value="{{ old('email', $email) }}"
                                            class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                        <span
                                            class="relative bottom-7 left-80 ml-7 font-sans   select-none text-gray-500 sm:text-sm">@taalim.ma</span>

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
                                        @if ($errors->has('password'))
                                        <div class="px-2 py-4 mx-2 my-4 relative bottom-5 right-3 rounded-md text-sm flex items-cente4  max-w-lg">
                                            <svg viewBox="0 0 24 24" class="text-red-600 w-2 h-2 sm:w-3 sm:h-3 mr-3 relative bottom-1">
                                                <path fill="currentColor"
                                                    d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                                                </path>
                                            </svg>
                                            <span class="text-red-800 relative bottom-2">{{ $errors->first('password') }}</span>
                                        </div>
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </div>



                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6 relative mr-10 ml-10 ">
                        <button type="submit"
                            class="rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600">Modifier
                            mot de passe</button>
                    </div>


                </form>
            </div>
        </div>
</body>

</html>
