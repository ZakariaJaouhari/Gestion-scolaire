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
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"> --}}
    @vite('resources/css/pageHomeF.css')
    @vite('resources/css/app.css')
</head>

<body>
    <div id="overlay" class="hidden overlay"></div>
    <div class="flex">
        <div class="sidebar fixed z-50">
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
                    <a href="{{route('profilS')}}">
                        <img class="logos stagiaire" src="stagiaire.png" alt="">
                        <img class="logos stagiaire hv" src="stagiaire-hover.png" alt="">Profile</a>
                </li>
                <li>
                    <a href="{{ route('notesS') }}" class="active">
                        <img class="logos notes hidden" src="note.png" alt="">
                        <img class="logos notes hv block" src="note-hover.png" alt=""><span>Notes</span></a>
                </li>
                <li>
                    <a href="{{ route('modulesS') }}">
                        <img class="logos module " src="module.png" alt="">
                        <img class="logos module hv " src="module-hover.png" alt="">Modules</a>
                </li>
                <li>
                    <a href="{{route('pageCertificat')}}">
                        <img class="logos demande" src="certificat.png" alt="">
                        <img class="logos demande hv" src="certificat-hover.png"
                            alt=""><span>Certificat</span></a>
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
                        {{ auth()->guard('stagiaire')->user()->directeur->nom_ecole }}</span>
                </h1>
                <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-12 flex">
                    <img src="profil.png" class="h-10 w-12 mr-3 mt-2.5" alt="">
                    <spa class="mt-3.5" style="font-family: 'Apple Chancery';">
                        {{ auth()->guard('stagiaire')->user()->nom }}
                        {{ auth()->guard('stagiaire')->user()->prenom }}</span>
                </h1>
            </div>
            <h1 class=" font-extrabold relative text-5xl left-72 bottom-44 mb-24" style="font-family: 'Apple Chancery';">Les notes</h1>

            <table class="table relative bottom-52 left-96 ml-10 min-w-[1200px]">
                <thead>
                    <tr class="border-b w-80">
                        <th class="relative right-36 ">Nom module</th>
                        <th class="relative right-14">Matricule</th>
                        <th class="relative right-8">Note (1)</th>
                        <th class="relative">Coefficient (2)</th>
                        <th class="relative right-7">Note Gle (1)*(2)</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($modules as $module)
                        <tr class=" h-10">
                            <td>
                                {{ $module->nom }}
                            </td>
                            <td class="right-32">
                                {{ $module->matricule }}
                            </td>

                            @php
                                $note = $notes->where('module_id', $module->id)->first();
                            @endphp
                            <td class="relative left-4">
                                {{ $note ? $note->note : '' }} <span> /20</span>
                            </td>
                            <td class="relative left-28">
                                {{ $module->coefficient }}
                            </td>
                            <td class="relative left-20">
                                @if ($note)
                                    {{ $module->coefficient * $note->note }} 
                                @else
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td colspan="9">
                                <hr class="my-4 min-w-[420px] bg-gray-300">
                            </td>
                        </tr>
                    @endforeach
                    @php
                        $nummodules = $modules->count();
                        $numnotes = $notes->count();
                    @endphp

                </tbody>

            </table>
            <table class="table relative bottom-32 left-96 w-80 ">
                <thead>
                    <tr class="border-b h-10 ">
                        <th class="">Moyenne Générale /20</th>
                        @if($nummodules == $numnotes)
                        <td>{{ number_format($totalScore/$totalCoefficient, 2) }}</td>
                        @endif
                    </tr>
                    <tr class="border-b h-10 ">
                        <th>Décision</th>
                        @if($totalScore/$totalCoefficient <10)
                        <td>Redoublant</td>
                        @elseif($totalScore/$totalCoefficient >=10 )
                        <td>Admis</td>
                        @endif
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</body>

</html>
