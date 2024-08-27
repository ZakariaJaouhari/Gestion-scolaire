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
        <div class="sidebar fixed z-50">
            <ul class="nav">
                <li id="tophome">
                    <a href="{{ route('pagehome') }}">
                        <img class="logos home" src="Bhome.png" alt="">
                        <img class="logos home hv" src="Bhome-hover.png" alt=""> Home</a>
                </li>
                <li>
                    <a href="{{ route('formateurs') }}">
                        <img class="logos formateur " src="prof.png" alt="">
                        <img class="logos formateur hv " src="prof-hover.png" alt="">Formateurs</a>
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
                    <a href="{{ route('gestionC') }}" class="active">
                        <img class="logos demande hidden" src="certificat.png" alt="">
                        <img class="logos demande hv block" src="certificat-hover.png"
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
            <div class="relative bottom-44 left-60 max-w-[700px]">
                <h1 class=" font-extrabold text-5xl ml-10 mb-5" style="font-family: 'Apple Chancery';">Certificat scolaire</h1>
                <p class="ml-28 font-semibold text-xl">- Les demandes</p>
                {{-- <div class="relative left-60 top-5">
                    <p class=" text-orange-600 font-mono font-semibold flex relative left-20">
                        <img src="{{ asset('heure.png') }}" class="h-4 relative top-1 mr-1.5">En attente : <span
                            class=" text-gray-500 ml-3">Votre demande est envoyée et est en cours de
                            traitement.</span>
                    </p>
                    <p class="text-emerald-600 font-mono font-semibold flex relative left-16 ml-3.5">
                        <img src="{{ asset('coche.png') }}" class="h-5 relative top-1 mr-1">Prêt : <span
                            class=" text-gray-500 ml-3">Votre certificat est prêt, vous pouvez le recevoir de
                            l'administration.</span>
                    </p>
                    <p class="text-emerald-600 font-mono font-semibold flex relative left-16 ml-2.5">
                        <img src="{{ asset('livrer.png') }}" class="h-6 relative top-0.5 mr-1">Livré :<span
                            class=" text-gray-500 ml-3">Vous avez reçu votre certificat.</span>
                    </p>
                </div> --}}
            </div>
            @if ($certificats->whereIn('status', ['Prêt', 'En attente'])->isNotEmpty())
                <table class="relative left-60 ml-32 min-w-[1200px] bottom-32">
                    <thead class="border-b">
                        <tr>
                            <th class=" relative right-11">Nom et prenom</th>
                            <th class=" relative right-7">CIN</th>
                            <th class=" relative left-9">groupe</th>
                            <th class=" relative left-10">Date de demande</th>
                            <th class=" relative left-10">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificats as $certificat)
                            @if ($certificat->status == 'En attente' || $certificat->status == 'Prêt')
                                <tr class=" h-10">
                                    <td class=" relative left-7">{{ $certificat->stagiaire->nom }}
                                        {{ $certificat->stagiaire->prenom }}</td>
                                    <td>{{ $certificat->stagiaire->CIN }}</td>
                                    <td class=" relative left-20">{{ $certificat->stagiaire->groupe->matricule }}</td>
                                    <td class=" relative left-36">{{ $certificat->created_at->format('Y-m-d') }}</td>
                                    @if ($certificat->status == 'En attente')
                                        <td
                                            class=" text-orange-600 font-mono font-semibold flex relative top-2 left-24">
                                            <img src="{{ asset('heure.png') }}"
                                                class="h-4 relative top-1 mr-1.5">{{ $certificat->status }}
                                        </td>
                                        <td class=" relative right-20">
                                            <a href="{{ route('pret', ['id' => $certificat->id]) }}">
                                                <input
                                                    class="relative start-full rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-indigo-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-indigo-600"
                                                    type="button" value="   Prêt   ">
                                            </a>
                                        </td>
                                    @elseif($certificat->status == 'Prêt')
                                        <td
                                            class="text-emerald-600 font-mono font-semibold flex relative top-2 left-24">
                                            <img src="{{ asset('coche.png') }}"
                                                class="h-5 relative top-0.5 mr-1">{{ $certificat->status }}
                                        </td>
                                        <td class=" relative right-20">
                                            <a href="{{ route('livre', ['id' => $certificat->id]) }}">
                                                <input
                                                    class="relative start-full rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600"
                                                    type="button" value="   Livré   ">
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <hr class="my-4 min-w-[420px] bg-gray-300">
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-6 pt-0 text-center relative bottom-16">
                    <svg class="w-20 h-20 text-gray-400 mx-auto relative left-60" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-xl font-normal text-gray-400 mt-5 mb-6 relative left-60">Vous n'avez pas encore
                        de demandes</h2>
                </div>
            @endif
            @if ($certificats->where('status', 'Livré')->isNotEmpty())
                <p class="ml-80 relative left-8 font-semibold text-xl mb-10">- Historique</p>
                <table class="relative left-60 ml-32 min-w-[1200px] ">
                    <thead class="border-b">
                        <tr>
                            <th class=" relative right-24">Nom et prenom</th>
                            <th class=" relative right-28">CIN</th>
                            <th class=" relative right-16">groupe</th>
                            <th class=" relative right-16">Date de remise</th>
                            <th class=" relative right-10">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificats as $certificat)
                            @if ($certificat->status == 'Livré')
                                <tr class=" h-10">
                                    <td class=" relative left-5">{{ $certificat->stagiaire->nom }}
                                        {{ $certificat->stagiaire->prenom }}</td>
                                    <td class=" relative right-16">{{ $certificat->stagiaire->CIN }}</td>
                                    <td>{{ $certificat->stagiaire->groupe->matricule }}</td>
                                    <td class=" relative left-12">{{ $certificat->updated_at->format('Y-m-d') }}
                                    </td>
                                    <td class="text-emerald-600 font-mono font-semibold flex relative left-10 mt-2">
                                        <img src="{{ asset('livrer.png') }}"
                                            class="h-6 relative top-0.5 mr-1">{{ $certificat->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <hr class="my-4 min-w-[420px] bg-gray-300">
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="ml-80 relative left-8 font-semibold text-xl mb-10">- Historique</p>
                <div class="p-6 pt-0 text-center">
                    <svg class="w-20 h-20 text-gray-400 mx-auto relative left-60" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-xl font-normal text-gray-400 mt-5 mb-6 relative left-60">Vous n'avez pas encore
                        d’historique</h2>
                </div>
            @endif
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
