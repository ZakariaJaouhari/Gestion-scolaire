<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="pageHome.css">
    <title>Document</title>
    <style>
        #confirm {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            /* Assurez-vous que la boîte de confirmation est au-dessus de tous les autres éléments */
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* couleur semi-transparente */
            z-index: 9998;
            /* Assurez-vous que l'overlay est sous la boîte de confirmation mais au-dessus de tout autre contenu */
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite('resources/css/pageHomeF.css')
    @vite('resources/css/app.css')
</head>

<body>
    <div id="overlay" class="hidden overlay"></div>
    <div class="flex">
        <div class="sidebar fixed z-50">
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
                    <a href="{{ route('modulesF') }}">
                        <img class="logos module " src="module.png" alt="">
                        <img class="logos module hv " src="module-hover.png" alt="">Modules</a>
                </li>
                <li>
                    <a href="{{ route('notesF') }}" class="active">
                        <img class="logos notes hidden" src="note.png" alt="">
                        <img class="logos notes hv block" src="note-hover.png" alt=""><span>Notes</span></a>
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
                        {{ auth()->guard('formateur')->user()->directeurs->nom_ecole }}</span>
                </h1>
                <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-20 flex">
                    <img src="profil.png" class="h-10 w-12 mr-3 mt-2.5" alt="">
                    <spa class="mt-3.5" style="font-family: 'Apple Chancery';">
                        {{ auth()->guard('formateur')->user()->nom }}
                        {{ auth()->guard('formateur')->user()->prenom }}</span>
                </h1>
            </div>
            <h1 class=" font-extrabold relative text-5xl left-72 bottom-44 mb-24" style="font-family: 'Apple Chancery';">Les notes</h1>
            <p class="relative left-80 bottom-60 mb-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
            <form action="{{ route('filter.notes') }}" method="post"  class=" bottom-64 ml-96 left-44 relative  min-w-[950px] mb-20">
                @csrf
                <div class="flex space-x-4 mb-10">
                    <div class="relative h-11 w-full max-w-[300px]">
                        <label for="sexe" class="after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Sélectionner un groupe
                        </label>
                        <div class="sm:col-span-3">
                            <div class="relative h-11 w-full min-w-[300px]">
                                <select name="groupe" id="groupe"
                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-0 empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                    <option></option>
                                    @foreach ($groupes as $groupe)
                                    <option value="{{ $groupe->id }}">{{ $groupe->matricule }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="relative h-11 w-full max-w-[300px]">
                        <label for="sexe" class="after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Sélectionner un module
                        </label>
                        <div class="sm:col-span-3">
                            <div class="relative h-11 w-full min-w-[300px]">
                                <select name="module" id="module"
                                    class="peer h-full w-full border border-gray-900 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-0 empty:!bg-emerald-600 focus:border-2 focus:border-emerald-600 focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="flex justify-end relative right-32">
                    <a href="{{ route('notesF') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                    <button type="submit"
                            class=" rounded-md  px-4 py-3 text-sm font-semibold text-white shadow-sm  bg-indigo-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-indigo-600">Recherche</button>
                </div>
            </form>

            <form action="{{ route('sauvegarder') }}" method="post" class=" bottom-64  relative  min-w-[950px] ">
                @csrf
                <table class="table relative left-96 ml-10 min-w-[1200px]">
                    <thead>
                        <tr class="border-b w-80">
                            <th class="relative right-40 ">Nom</th>
                            <th class="relative right-36">Date naissance</th>
                            <th class="relative right-32">Sexe</th>
                            <th class="relative right-24">Note</th>

                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $notesExist = false; // Initialiser la variable $notesExist à false
                        @endphp
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

                                @php
                                    $note = $notes->where('stagiaire_id', $stagiaire->id)->first();
                                    if ($note) {
                                        $notesExist = true; // Mettre à true si des notes existent
                                    } 
                                @endphp
                                @if ($note)
                                    <td class="relative">
                                        {{ $stagiaire->date_naissance }}
                                    </td>
                                    <td class="relative right-16">
                                        {{ $stagiaire->sexe }}
                                    </td>
                                    <td class="relative right-12">
                                        {{ $note->note }} <span> /20</span>
                                    </td>
                                @else
                                    <td class="relative right-12">
                                        {{ $stagiaire->date_naissance }}
                                    </td>
                                    <td class="relative right-20">
                                        {{ $stagiaire->sexe }}
                                    </td>
                                    <input type="hidden" name="stagiaire_id" value="{{ $stagiaire->id }}">
                                    <input type="hidden" name="module" value="{{ $module->id }}">
                                    <td>
                                        <input type="number" min="0" max="20"
                                            class="peer w-40 relative left-5 border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                            name="notes[{{ $stagiaire->id }}]" id="note_{{ $stagiaire->id }}"
                                            placeholder="Entrez la note">
                                    </td>
                                @endif



                            </tr>

                            <tr>
                                <td colspan="9">
                                    <hr class="my-4 min-w-[420px] bg-gray-300">
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
                
                @if (!$notesExist)
                    <div class="flex justify-end">
                        <button type="reset" class="relative left-36">Réinitialiser</button>
                        <input type="button" id="saveButton" value="Enregistrer"
                            class="rounded-md relative left-40 px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600">
                    </div>
                    <div id="confirm" class="hidden border rounded-lg shadow relative max-w-sm">
                        <div class="flex justify-end p-2">
                            <button type="button" id="removeconfirm2"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>


                        <div class="p-6 pt-0 text-center">
                            <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h2 class="text-xl font-normal text-gray-500 mt-5 mb-6">Êtes-vous sûr ?</h2>
                            <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Après l'enregistrement, vous ne
                                pourrez pas modifier</h3>
                            <button type="submit"
                                class="text-white bg-emerald-600 hover:bg-emerald-600 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                                Enregistrer</button>
                            <input type="button" value="Annuler" id="removeconfirm"
                                class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center">
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <script>
        document.getElementById('saveButton').addEventListener('click', function() {
            document.getElementById('confirm').classList.remove('hidden');
            document.getElementById('overlay').classList.remove('hidden');
        });

        document.getElementById('removeconfirm').addEventListener('click', function() {
            document.getElementById('confirm').classList.add('hidden');
            document.getElementById('overlay').classList.add('hidden');
        });

        document.getElementById('removeconfirm2').addEventListener('click', function() {
            document.getElementById('confirm').classList.add('hidden');
            document.getElementById('overlay').classList.add('hidden');
        });

        
    </script>
    <script>
        document.getElementById('groupe').addEventListener('change', function() {
            var groupeId = this.value;
            var modules = @json($groupes->pluck('modules', 'id'));

            var moduleSelect = document.getElementById('module');
            moduleSelect.innerHTML = '';

            if (groupeId !== '') {
                modules[groupeId].forEach(module => {
                    // Ajoutez une condition pour filtrer les modules en fonction de l'id du formateur
                    if (module.formateur_id === {{ auth()->guard('formateur')->user()->id }}) {
                        var option = document.createElement('option');
                        option.value = module.id;
                        option.textContent = module.nom;
                        moduleSelect.appendChild(option);
                    }
                });
            }
        });
    </script>
</body>

</html>
