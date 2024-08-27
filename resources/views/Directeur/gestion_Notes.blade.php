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
    <div id="overlay" class="hidden overlay"></div>
    <div class="flex">
        <div class="sidebar fixed z-50">
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
                    <a href="{{ route('groupes') }}">
                        <img class="logos groupes" src="groupe.png" alt="">
                        <img class="logos groupes hv" src="groupe-hover.png" alt="">Groupes</a>
                </li>
                <li>
                    <a href="{{ route('modules') }}" >
                        <img class="logos module " src="module.png" alt="">
                        <img class="logos module hv " src="module-hover.png" alt="">Modules</a>
                </li>
                <li>
                    <a href="{{ route('showForm') }}" class="active">
                        <img class="logos notes hidden" src="note.png" alt="">
                        <img class="logos notes hv block" src="note-hover.png" alt=""><span>Notes</span></a>
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
        <div class="relative ">
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
            <h1 class=" font-extrabold relative text-5xl left-72 bottom-44 mb-24" style="font-family: 'Apple Chancery';">Les notes</h1>
            <p class="relative left-80 bottom-60 mb-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
            <form action="{{ route('filter.notesDr') }}" method="post"
                class=" bottom-64 ml-96 left-44 relative  min-w-[950px] ">
                @csrf
                <div class="flex space-x-4 mb-10">
                    <div class="relative h-11 w-full max-w-[300px]">
                        <label for="groupe"
                            class="after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Sélectionner un groupe
                        </label>
                        <div class="sm:col-span-3">
                            <div class="relative h-11 w-full min-w-[300px]">
                                <select name="groupe" id="groupe" 
                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-0 empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                    <option></option>
                                    @foreach ($groupes as $groupe)
                                        <option value="{{ $groupe->id }}" >{{ $groupe->matricule }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="relative h-11 w-full max-w-[300px]">
                        <label for="sexe"
                            class="after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Sélectionner un module
                        </label>
                        <div class="sm:col-span-3">
                            <div class="relative h-11 w-full min-w-[300px]">
                                <select name="module" id="module" aria-valuetext=""
                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-0 empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex justify-end relative right-32">
                    <button type="submit"
                        class=" rounded-md mb-20 px-4 py-3 text-sm font-semibold text-white shadow-sm  bg-indigo-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-indigo-600">Recherche</button>
                </div>
            </form>
            
            <table class="table relative bottom-52 left-96 ml-10 min-w-[1200px]">
                <thead>
                    <tr class="border-b w-80">
                        <th class="relative right-40 ">Nom</th>
                        <th class="relative right-36">Date naissance</th>
                        <th class="relative right-32">Sexe</th>
                        <th class="relative right-24">Note</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($stagiaires as $stagiaire)
                        <tr class=" h-10">
                            <td>
                                <div class="flex items-center gap-3">
                                    <div>
                                        <div class="mask mask-squircle  relative right-24">
                                            <img src="{{ asset($stagiaire->profile_picture) }}"
                                                class=" w-20 h-20 rounded-full border" />
                                        </div>
                                    </div>
                                    <div class="relative right-20">
                                        <div class="font-bold">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="relative">
                                {{ $stagiaire->date_naissance }}
                            </td>
                            <td class="relative right-16">
                                {{ $stagiaire->sexe }}
                            </td>
                            @php
                                $note = $notes->where('stagiaire_id', $stagiaire->id)->first();
                            @endphp
                            <td class="relative right-12">
                                {{ $note ? $note->note : '' }} <span> /20</span>
                            </td>
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
    <script>
        document.getElementById('groupe').addEventListener('change', function() {
            var groupeId = this.value;
            var modules = @json($groupes->pluck('modules', 'id'));

            var moduleSelect = document.getElementById('module');
            moduleSelect.innerHTML = ''; // Effacer les options précédentes


            if (groupeId !== '') {
                modules[groupeId].forEach(module => {
                    var option = document.createElement('option');
                    option.value = module.id;
                    option.textContent = module.nom;

                    moduleSelect.appendChild(option);
                });
            }
        });
    </script>
</body>

</html>
