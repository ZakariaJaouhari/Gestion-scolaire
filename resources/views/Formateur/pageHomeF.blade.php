<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="formateur.css">
    <title>Document</title>
    <style>
        .active .hv {
            display: block;
        }

        @keyframes to-top {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .ajout-animation {
            animation: to-top 0.7s ease forwards;
        }
    </style>
    @vite('resources/css/pageHomeF.css')
    @vite('resources/css/app.css')

</head>

<body>
    <div class="sidebar fixed">
        <div class="profile">
            <img src="{{ auth()->guard('formateur')->user()->profile_picture }}" alt="">
        </div>
        <ul class="nav">
            <li id="tophome">
                <a href="{{ route('pagehomeF') }}" class="active">
                    <img class="logos home hidden" src="Bhome.png" alt="">
                    <img class="logos home hv block" src="Bhome-hover.png" alt=""> Home</a>
            </li>
            <li>
                <a href="{{ route('profilF') }}">
                    <img class="logos formateur" src="prof.png" alt="">
                    <img class="logos formateur hv" src="prof-hover.png" alt="">Profile</a>
            </li>
            <li>
                <a href="{{ route('groupesF') }}">
                    <img class="logos groupes" src="groupe.png" alt="">
                    <img class="logos groupes hv" src="groupe-hover.png" alt="">Groupes</a>
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
        <div class="flex">
            <img class="h-80 w-80 ml-44 relative bottom-28" src="{{ asset('NOTES.svg') }}" alt="Logo">
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
                <spa class="mt-3.5" style="font-family: 'Apple Chancery';">{{ auth()->guard('formateur')->user()->nom }}
                    {{ auth()->guard('formateur')->user()->prenom }}</span>
            </h1>
        </div>
        <div class="flex ml-28 relative bottom-72">
            <div class="ml-44 mt-28">
                <h1 class="text-3xl font-mono font-bold text-neutral-700" style="font-family: 'Apple Chancery';">Bonjour </h1>
                <h1 class="text-5xl font-bold mt-2" style="font-family: 'Apple Chancery';">{{ auth()->guard('formateur')->user()->nom }}
                    {{ auth()->guard('formateur')->user()->prenom }}</h1>
                <p class="text-xl mt-4 text-neutral-500 font-medium">Un système d'information intégré qui permet
                    la<br>
                    mise
                    en place de nouvelles méthodes de gestion scolaire.</p>
            </div>
            <div>
                <h1 style="  writing-mode: vertical-rl;text-orientation: mixed;transform: rotate(180deg);"
                    class="text-neutral-500 font-regular text-3xl mt-40 ml-12 mr-4 tracking-widest">
                    TODAY</h1>
            </div>
            <div id="header" class="justify-end">
                <div class="bg-emerald-600 rounded-3xl h-64 w-56 ml-1 text-stone-100 shadow-2xl shadow-slate-500">
                    <p class=" text-lg ml-4 mt-3">01</p>
                    <div class="flex justify-center mt-7 ">
                        <img class="h-20 w-20 " src="module.png" alt="">
                    </div>
                    <h1 class="text-2xl ml-4 mt-8">Modules</h1>
                    <p class="text-lg ml-4">{{ $nombreModules }}</p>
                </div>

                <div class="bg-indigo-800 rounded-3xl h-64 w-56 text-stone-100 shadow-2xl shadow-slate-500">
                    <p class="text-lg ml-4 mt-3">02</p>
                    <div class="flex justify-center mt-7">
                        <img class="h-20 w-20" src="stagiaire.png" alt="">
                    </div>
                    <h1 class="text-2xl ml-4 mt-8">Stagiaires</h1>
                    <p class="text-lg ml-4">{{ $nombreStagiaires }}</p>
                </div>

                <div class="bg-red-500 rounded-3xl h-64 w-56 text-stone-100 shadow-2xl shadow-slate-500">
                    <p class="text-lg ml-4 mt-3">03</p>
                    <div class="flex justify-center mt-7">
                        <img class="h-20 w-20" src="groupe.png" alt="">
                    </div>
                    <h1 class="text-2xl ml-4 mt-8">Groupes</h1>
                    <p class="text-lg ml-4">{{ $nombreGroupes }}</p>
                </div>
            </div>
        </div>


        <div class="calendar drop-shadow-2xl " style="position: absolute; left:1150px;top:440px">
            <div class="calendar-header">
                <span class="month-picker" id="month-picker">February</span>
                <div class="year-picker">
                    <span class="year-change" id="prev-year">
                        <pre><</pre>
                    </span>
                    <span id="year">2021</span>
                    <span class="year-change" id="next-year">
                        <pre>></pre>
                    </span>
                </div>
            </div>
            <div class="calendar-body">
                <div class="calendar-week-day">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="calendar-days"></div>
            </div>

            <div class="month-list"></div>
        </div>
        <div style="width: 500px ; position:relative ; left:310px ; bottom:183px ">
            <div class="min-w-[800px] min-h-[434px] max-h-[434px] w-full bg-white  shadow p-4 md:p-6 drop-shadow-2xl rounded-3xl overflow-auto">
                <div class="flex">
                    <div>
                        <h1 class="text-5xl font-bold mt-2" style="font-family: 'Apple Chancery';">Examens</h1>
                        <p class="ml-7 mb-10">Pour rester en contact avec vos stagiaires</p>
                    </div>
                    <div>
                        <input onclick="afficherAjout()" id="buttonaff"
                            class="relative left-60 ml-28 start-full top-5 rounded-md px-3 py-3 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600"
                            type="button" value="+ Examen ">
                        <button type="button" id="remove" onclick="removeAjout()"
                            class="text-emerald-600 hidden relative left-60 mt-2 ml-28 bg-transparent rounded-lg p-1.5  items-center">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="aff" class="overflow-y-visible">
                    @if($exams->isNotEmpty())
                    <table class="min-w-[750px] ">
                        <thead class="border-b mb-5">
                            <tr class="mb-5">
                                <th class="relative right-">Groupe</th>
                                <th class="relative left-8">Module</th>
                                <th class="relative right-5">Date</th>
                                <th class="relative ">Heure</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td class=" relative left-3">{{ $exam->groupe->matricule }}</td> <!-- Afficher le matricule du groupe -->
                                    <td class=" relative left-8">{{ $exam->module->nom }}</td> <!-- Afficher le nom du module -->
                                    <td class="relative left-5">{{ $exam->date_exam }}</td> <!-- Afficher la date de l'examen -->
                                    <td class="relative left-5">{{ date('H:i', strtotime($exam->heure_exam)) }}</td> <!-- Afficher l'heure de l'examen -->
                                    <td class="relative left-4">
                                        <a href="/deleteE/{{ $exam->id }}">
                                            <img src="supprimer.png" class="w-6 h-6">
                                        </a>
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
                    @else
                    <div class="p-6 pt-0 text-center relative right-60 top-10">
                        <svg class="w-20 h-20 text-gray-400 mx-auto relative left-60" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h2 class="text-xl font-normal text-gray-400 mt-5 mb-6 relative left-60">
                            Vous n’avez pas encore des exams planifiés</h2>
                    </div>
                    @endif
                </div>
                <form id="ajout" action="{{ route('ajouter_exam') }}" class="hidden ml-16 mt-10">
                    <div>
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
                                                <option value="{{ $groupe->id }}">{{ $groupe->matricule }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="relative h-11 w-full max-w-[300px]">
                                <label for="module"
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
                        <div class="flex space-x-4">
                            <div class="flex relative h-11 w-full max-w-[300px]">
                                <div class="min-w-[150px]">
                                    <input id="date_exam" name="date_exam" type="date"
                                        class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                    <label
                                        class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        Date et heure
                                    </label>
                                </div>

                                <div class="flex min-w-[150px]">
                                    <input type="time" id="time" name="heure_exam"
                                        class="peer ml-5 h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                        min="08:30" max="18:30" value="00:00" required>

                                    <span
                                        class="inline-flex items-center px-3 text-sm text-gray-900 border-gray-900 border-b ">
                                        <svg class="w-4 h-4 text-gray-600 mt-3 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="relative h-11 w-full  max-w-[300px]">
                                <input id="duree" name="duree"
                                    class="peer h-full w-full border-b border-gray-900 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                                <label
                                    class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-900 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-emerald-600 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-emerald-600 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Durée
                                </label>
                            </div>
                        </div>
                        <input onclick="afficherAjout()" id="buttonaff"
                            class="relative left-96 ml-40 top-5 rounded-md px-3 py-3 text-sm font-semibold text-white shadow-sm  bg-emerald-600 transition ease-in-out delay-10  hover:-translate-y-1 hover:scale-110 duration-300  focus-within:outline-none focus-within:ring-2 focus-within:ring-white focus-within:ring-offset-2 hover:bg-white hover:text-emerald-600"
                            type="submit" value=" Ajouter ">
                    </div>

                </form>


            </div>
        </div>
    </div>








    </div>


    <script>
        function afficherAjout() {
            var ajoutDiv = document.getElementById('ajout');
            var aff = document.getElementById('aff');
            var buttonaff = document.getElementById('buttonaff');
            var remove = document.getElementById('remove');
            ajoutDiv.style.display = 'flex';
            aff.style.display = 'none';
            ajoutDiv.classList.add('ajout-animation');
            buttonaff.classList.add('hidden');
            remove.style.display = 'flex';
        }

        function removeAjout() {
            var ajoutDiv = document.getElementById('ajout');
            var aff = document.getElementById('aff');
            var buttonaff = document.getElementById('buttonaff');
            var remove = document.getElementById('remove');
            ajoutDiv.style.display = 'none';
            aff.style.display = 'block';
            buttonaff.classList.remove('hidden');
            aff.classList.add('ajout-animation');
            remove.style.display = 'none';
        }
    </script>

    <script>
        let calendar = document.querySelector('.calendar')

        const month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ]

        isLeapYear = (year) => {
            return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 === 0)
        }

        getFebDays = (year) => {
            return isLeapYear(year) ? 29 : 28
        }

        generateCalendar = (month, year) => {

            let calendar_days = calendar.querySelector('.calendar-days')
            let calendar_header_year = calendar.querySelector('#year')

            let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]

            calendar_days.innerHTML = ''

            let currDate = new Date()
            if (!month) month = currDate.getMonth()
            if (!year) year = currDate.getFullYear()

            let curr_month = `${month_names[month]}`
            month_picker.innerHTML = curr_month
            calendar_header_year.innerHTML = year

            // get first day of month

            let first_day = new Date(year, month, 1)

            for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
                let day = document.createElement('div')
                if (i >= first_day.getDay()) {
                    day.classList.add('calendar-day-hover')
                    day.innerHTML = i - first_day.getDay() + 1
                    day.innerHTML += `<span></span>
                            <span></span>
                            <span></span>
                            <span></span>`
                    if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() &&
                        month === currDate.getMonth()) {
                        day.classList.add('curr-date')
                    }
                }
                calendar_days.appendChild(day)
            }
        }

        let month_list = calendar.querySelector('.month-list')

        month_names.forEach((e, index) => {
            let month = document.createElement('div')
            month.innerHTML = `<div data-month="${index}">${e}</div>`
            month.querySelector('div').onclick = () => {
                month_list.classList.remove('show')
                curr_month.value = index
                generateCalendar(index, curr_year.value)
            }
            month_list.appendChild(month)
        })

        let month_picker = calendar.querySelector('#month-picker')

        month_picker.onclick = () => {
            month_list.classList.add('show')
        }

        let currDate = new Date()

        let curr_month = {
            value: currDate.getMonth()
        }
        let curr_year = {
            value: currDate.getFullYear()
        }

        generateCalendar(curr_month.value, curr_year.value)

        document.querySelector('#prev-year').onclick = () => {
            --curr_year.value
            generateCalendar(curr_month.value, curr_year.value)
        }

        document.querySelector('#next-year').onclick = () => {
            ++curr_year.value
            generateCalendar(curr_month.value, curr_year.value)
        }

        let dark_mode_toggle = document.querySelector('.dark-mode-switch')

        dark_mode_toggle.onclick = () => {
            document.querySelector('body').classList.toggle('light')
            document.querySelector('body').classList.toggle('dark')
        }
    </script>
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
