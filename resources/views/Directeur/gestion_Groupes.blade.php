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
                    <a href="{{ route('stagiaires') }}">
                        <img class="logos stagiaire" src="stagiaire.png" alt="">
                        <img class="logos stagiaire hv" src="stagiaire-hover.png" alt="">Stagiaires</a>
                </li>
                <li>
                    <a href="{{ route('groupes') }}" class="active">
                        <img class="logos groupes hidden" src="groupe.png" alt="">
                        <img class="logos groupes hv block" src="groupe-hover.png" alt="">Groupes</a>
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
            <div class="relative left-64">
                <div class="flex -ml-20">
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
                <div class="relative bottom-44">
                    <h1 class=" font-extrabold text-5xl ml-10 mb-5" style="font-family: 'Apple Chancery';">Les groupes</h1>
                    <p class="ml-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
                    <a href="{{ route('ajouGr') }}">
                        <input
                            class="relative start-full bottom-16 rounded-md  px-3 py-3 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600"
                            type="button" value="+ Ajouter groupe">
                    </a>
                    <form method="post" action="{{ route('filtrer_groupes') }}">
                        @csrf
                        <div class="flex space-x-4 ml-80">
                            <div class="relative h-11 w-full max-w-[300px]">
                                <input id="matricule" name="matricule"
                                    class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                <label
                                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Matricule
                                </label>
                            </div>
                            <div class="relative h-11 w-full  max-w-[300px]">
                                <label for="niveau"
                                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Niveau
                                </label>
                                <div class="sm:col-span-3">
                                    <div class="relative h-11 w-full min-w-[300px]">
                                        <select id="niveau" name="niveau"
                                            class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  outline-0   empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                            <option value=""></option>
                                            <option value="1ér année">1ér année</option>
                                            <option value="2éme année">2éme année</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mb-16 mt-8">
                            <a href="{{ route('groupes') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                            <button type="submit"
                                class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-indigo-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-indigo-600">Filtrer</button>
                        </div>

                    </form>

                    <table class="relative left-36 min-w-[1200px] w-auto">
                        <thead>
                            <tr class="border-b ">
                                <th class="relative left-5">Matricule</th>
                                <th class="relative left-16">Niveau</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupes as $groupe)
                                <tr>
                                    <td class="relative left-7 ">
                                        {{ $groupe->matricule }}
                                    </td>
                                    <td class="relative left-20 ">
                                        {{ $groupe->niveau }}
                                    </td>
                                    <th class="relative font-normal">
                                        <table class="relative left-28">
                                            <thead>
                                                <tr>
                                                    <th class="border-l border-b opacity-50">Nom module</th>
                                                    <th class="border-b  opacity-50">Matricule module</th>
                                                    <th class="border-b border-r opacity-50">Formateur</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($groupe->modules as $module)
                                                    <tr>
                                                        <td class="border-l border-b w-96 opacity-50">
                                                            {{ $module->nom }}
                                                        </td>
                                                        <td class=" border-b  opacity-50 w-40">
                                                            {{ $module->matricule }}
                                                        </td>
                                                        <td class=" border-b border-r opacity-50 w-60">
                                                            {{ $module->formateur->nom }}
                                                            {{ $module->formateur->prenom }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </th>

                                    <th class="relative right-3">
                                        <a href="{{ route('groupe.edit', $groupe->id) }}">
                                            <img src="crayon.png" class="w-6 h-6">
                                        </a>
                                    </th>
                                    <th>
                                        <a href="/deleteG/{{ $groupe->id }}">
                                            <img src="supprimer.png" class="w-6 h-6">
                                        </a>
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <hr class=" ">
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
