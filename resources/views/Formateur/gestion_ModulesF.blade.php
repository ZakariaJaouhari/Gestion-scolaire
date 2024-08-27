<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="pageHome.css">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
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
                    <a href="{{ route('profilF') }}">
                        <img class="logos formateur" src="prof.png" alt="">
                        <img class="logos formateur hv" src="prof-hover.png" alt="">Profile</a>
                </li>
                <li>
                    <a href="{{ route('groupesF') }}">
                        <img class="logos groupes " src="groupe.png" alt="">
                        <img class="logos groupes hv " src="groupe-hover.png" alt="">Groupes</a>
                </li>
                <li>
                    <a href="{{ route('modulesF') }}" class="active">
                        <img class="logos module hidden" src="module.png" alt="">
                        <img class="logos module hv block" src="module-hover.png" alt="">Modules</a>
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
            <div class="relative bottom-44">
                <h1 class=" font-extrabold text-5xl ml-10 mb-5" style="font-family: 'Apple Chancery';">Les modules</h1>
                <p class="ml-16 mb-10">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
                <form method="post" action="{{ route('filtrer_modulesF') }}">
                    @csrf
                    <div class="flex space-x-4 ml-80">
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="nom" name="nom"
                                class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Nom de module
                            </label>
                        </div>
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="matricule" name="matricule"
                                class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Matricule
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mb-16 mt-8">
                        <a href="{{ route('modulesF') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                        <button type="submit"
                            class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-indigo-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-indigo-600">Filtrer</button>
                    </div>

                </form>

                <table class="relative left-36 min-w-[1200px] w-auto">
                    <thead>
                        <tr class="border-b ">
                            <th class="relative right-5 ">Nom</th>
                            <th class="relative right-8 ">Matricule</th>
                            <th class="relative ">Date début</th>
                            <th class="relative ">Date fin</th>
                            <th class="relative ">Heures</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $module)
                            <tr class=" h-10">
                                <td class="relative text- opacity-70">
                                    {{ $module->nom }}
                                </td>
                                <td class="relative left-8">
                                    {{ $module->matricule }}
                                </td>
                                <th class="relative font-normal">
                                    {{ $module->date_D }}
                                </th>
                                <th class="relative  font-normal">
                                    {{ $module->date_F }}
                                </th>
                                <th class="relative font-normal">
                                    {{ $module->heures_P }}
                                </th>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <hr class="my-4 min-w-[420px] bg-gray-300">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
