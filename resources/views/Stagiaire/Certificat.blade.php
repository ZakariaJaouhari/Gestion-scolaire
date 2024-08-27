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
            z-index: 9998;
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
        <div class="sidebar fixed">
            <div class="profile">
                <img src="{{ auth()->guard('stagiaire')->user()->profile_picture }}" alt="">
            </div>
            <ul class="nav">
                <li id="tophome">
                    <a href="{{ route('pagehomeS') }}">
                        <img class="logos home " src="Bhome.png" alt="">
                        <img class="logos home hv " src="Bhome-hover.png" alt=""> Home</a>
                </li>
                <li>
                    <a href="{{ route('profilS') }}">
                        <img class="logos stagiaire" src="stagiaire.png" alt="">
                        <img class="logos stagiaire hv" src="stagiaire-hover.png" alt="">Profile</a>
                </li>
                <li>
                    <a href="{{ route('notesS') }}">
                        <img class="logos notes" src="note.png" alt="">
                        <img class="logos notes hv" src="note-hover.png" alt=""><span>Notes</span></a>
                </li>
                <li>
                    <a href="{{ route('modulesS') }}">
                        <img class="logos module " src="module.png" alt="">
                        <img class="logos module hv " src="module-hover.png" alt="">Modules</a>
                </li>
                <li>
                    <a href="{{ route('pageCertificat') }}" class="active">
                        <img class="logos demande hidden" src="certificat.png" alt="">
                        <img class="logos demande hv block" src="certificat-hover.png"
                            alt=""><span>Certificat</span></a>
                </li>
                <li id="logout">
                    <a href="{{ route('logout') }}">
                        <img class="logos" src="logout.png" alt="">
                        <img class="logos hv" src="logout-hover.png" alt="">Log out</a>
                </li>
            </ul>
        </div>
        <div>
            <div class="flex re">
                <img class="h-80 w-80 ml-44 relative bottom-28" src="{{ asset('NOTES.svg') }}" alt="Logo">
                <p
                    class="relative right-28 top-9 text-neutral-50 bg-red-500 h-4 w-14 text-center text-xs font-medium rounded-full">
                    V 0.1.0</p>
                <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-72 flex">
                    <img src="ecole(1).png" class="h-10 w-12 mr-3 mt-2" alt="">
                    <spa class="mt-4" style="font-family: 'Apple Chancery';">
                        {{ auth()->guard('stagiaire')->user()->directeur->nom_ecole }}</span>
                </h1>
                <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-20 flex">
                    <img src="profil.png" class="h-10 w-12 mr-3 mt-2.5" alt="">
                    <spa class="mt-3.5" style="font-family: 'Apple Chancery';">
                        {{ auth()->guard('stagiaire')->user()->nom }}
                        {{ auth()->guard('stagiaire')->user()->prenom }}</span>
                </h1>
            </div>
            <div class="relative bottom-44 left-60">
                <h1 class=" font-extrabold text-5xl ml-10 mb-5" style="font-family: 'Apple Chancery';">Certificat scolaire</h1>
                <p class="ml-36">Suivez votre demande de certificat scolaire.</p>
                <div class="relative left-60 top-5">
                    <p class=" text-orange-600 font-mono font-semibold flex relative left-20">
                        <img src="{{ asset('heure.png') }}"
                            class="h-4 relative top-1 mr-1.5">En attente : <span class=" text-gray-500 ml-3">Votre demande est envoyée et est en cours de traitement.</span>
                    </p>
                    <p class="text-emerald-600 font-mono font-semibold flex relative left-16 ml-3.5">
                        <img src="{{ asset('coche.png') }}"
                            class="h-5 relative top-1 mr-1">Prêt : <span class=" text-gray-500 ml-3">Votre certificat est prêt, vous pouvez le recevoir de l'administration.</span>
                    </p>
                    <p class="text-emerald-600 font-mono font-semibold flex relative left-16 ml-2.5">
                        <img src="{{ asset('livrer.png') }}"
                            class="h-6 relative top-0.5 mr-1">Livré :<span class=" text-gray-500 ml-3">Vous avez reçu votre certificat.</span>
                    </p>
                </div>
                
                <div class="relative ml-96">
                    <input id="saveButton"
                        class="relative bottom-36 left-96 ml-96 rounded-md  px-4 py-4 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600"
                        type="button" value="+ Demander certificat">
                </div>
                <div id="confirm" class="hidden border rounded-lg shadow relative max-w-[900px]">
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

                    <div class="p-6 pt-0 ">
                        <h2 class="text-lg font-normal text-gray-500 relative bottom-7 mb-6">Envoyer une demande de certificat
                            scolaire<br>
                            à M.{{ $stagiaire->directeur->nom_directeur }} </h2>
                        <div class="flex space-x-4">
                            <div class="relative h-11 w-full min-w-[300px]">
                                <input id="nom" name="nom" value="{{ old('nom', $stagiaire->nom) }}"
                                    readonly
                                    class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                <label
                                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Nom
                                </label>
                            </div>

                            <div class="relative h-11 w-full  min-w-[300px]">
                                <input id="prenom" name="prenom" readonly
                                    value="{{ old('prenom', $stagiaire->prenom) }}"
                                    class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                <label
                                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Prenom
                                </label>
                            </div>
                        </div>
                        <div class="flex space-x-4 mb-20">
                            <div class="relative h-11 w-full top-6  min-w-[300px]">
                                <input id="CIN" name="CIN" value="{{ old('CIN', $stagiaire->CIN) }}"
                                    readonly
                                    class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                <label
                                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    CIN
                                </label>
                            </div>
                            <div class="relative h-11 w-full top-6   min-w-[300px]">
                                <input id="Groupe" name="Groupe"
                                    value="{{ old('Groupe', $stagiaire->groupe->matricule) }}" readonly
                                    class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                <label
                                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Groupe
                                </label>
                            </div>
                        </div>
                        <a href="{{ route('ajouterC') }}">
                            <button type="submit"
                                class="text-white bg-emerald-600  focus:ring-4  font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600">
                                Envoyer</button>
                        </a>

                        <input type="button" value="Annuler" id="removeconfirm"
                            class="text-gray-900 font-medium inline-flex items-center text-base px-3 py-2.5 text-center">
                    </div>
                </div>
            </div>
            <table class="relative left-96 ml-32 min-w-[920px] bottom-32">
                <thead class="border-b">
                    <tr>
                        <th class=" relative right-16">Date de demande</th>
                        <th class=" relative right-12">Heure de demande</th>
                        <th class=" relative right-">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificats as $certificat)
                        <tr>
                            <td class=" relative left-12">{{ $certificat->created_at->format('Y-m-d') }}</td>
                            <td class=" relative left-24">{{ $certificat->created_at->format('H:i') }}</td>
                            @if ($certificat->status == 'En attente')
                                <td class=" text-orange-600 font-mono font-semibold flex relative left-20">
                                    <img src="{{ asset('heure.png') }}"
                                        class="h-4 relative top-1 mr-1.5">{{ $certificat->status }}
                                </td>
                            @elseif($certificat->status == 'Prêt')
                                <td class="text-emerald-600 font-mono font-semibold flex relative left-20">
                                    <img src="{{ asset('coche.png') }}"
                                        class="h-5 relative top-0.5 mr-1">{{ $certificat->status }}
                                </td>
                            @elseif($certificat->status == 'Livré')
                                <td class="text-emerald-600 font-mono font-semibold flex relative left-20">
                                    <img src="{{ asset('livrer.png') }}"
                                        class="h-6 relative top-0.5 mr-1">{{ $certificat->status }}
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
</body>

</html>
