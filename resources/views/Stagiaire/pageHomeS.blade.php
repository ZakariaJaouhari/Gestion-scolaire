<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stagiaire.css">
    <title>Document</title>
    @vite('resources/css/pageHomeF.css')
    @vite('resources/css/app.css')
</head>

<body>
    <div class="sidebar">
        <div class="profile">
            <img src="{{ auth()->guard('stagiaire')->user()->profile_picture }}" alt="">
        </div>
        <ul class="nav">
            <li id="tophome">
                <a href="{{route('pagehomeS')}}" class="active">
                    <img class="logos home hidden" src="Bhome.png" alt="">
                    <img class="logos home hv block" src="Bhome-hover.png" alt=""> Home</a>
            </li>
            <li>
                <a href="{{route('profilS')}}">
                    <img class="logos stagiaire" src="stagiaire.png" alt="">
                    <img class="logos stagiaire hv" src="stagiaire-hover.png" alt="">Profile</a>
            </li>
            <li>
                <a href="{{ route('notesS') }}">
                <img class="logos notes" src="note.png" alt="">
                <img class="logos notes hv" src="note-hover.png" alt=""><span>Notes</span></a>
            </li>
            <li>
                <a href="{{route('modulesS')}}">
                <img class="logos module" src="module.png" alt="">
                <img class="logos module hv" src="module-hover.png" alt="">Modules</a>
            </li>
            <li>
                <a href="{{route('pageCertificat')}}">
                <img class="logos demande" src="certificat.png" alt="">
                <img class="logos demande hv" src="certificat-hover.png" alt=""><span>Certificat</span></a>
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
                <spa class="mt-4" style="font-family: 'Apple Chancery';">{{ auth()->guard('stagiaire')->user()->directeur->nom_ecole}}</span>
            </h1>
            <h1 class="text-2xl  font-semibold mt-6 text-neutral-700 relative bottom-3 left-64 ml-20 flex">
                <img src="profil.png" class="h-10 w-12 mr-3 mt-2.5" alt=""> 
                <spa class="mt-3.5" style="font-family: 'Apple Chancery';">{{ auth()->guard('stagiaire')->user()->nom}} {{ auth()->guard('stagiaire')->user()->prenom}}</span>
            </h1>
        </div>
        <div class="flex ml-28 relative bottom-72">
            <div class="ml-44 mt-28">
                <h1 class="text-3xl font-mono font-bold text-neutral-700" style="font-family: 'Apple Chancery';">Bonjour  </h1>
                <h1 class="text-5xl font-extrabold mt-2" style="font-family: 'Apple Chancery';">{{ auth()->guard('stagiaire')->user()->nom}} {{ auth()->guard('stagiaire')->user()->prenom}}</h1>
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
                <div class="bg-red-500 rounded-3xl h-64 w-56 text-stone-100 shadow-2xl shadow-slate-500">
                    <p class="text-lg ml-4 mt-3">01</p>
                    <div class="flex justify-center mt-7">
                        <img class="h-20 w-20" src="groupe.png" alt="">
                    </div>
                    <h1 class="text-2xl ml-4 mt-8">Groupe</h1>
                    <p class="text-lg ml-4">{{ auth()->guard('stagiaire')->user()->groupe->matricule}}</p>
                </div>
                <div class="bg-emerald-600 rounded-3xl h-64 w-56 ml-1 text-stone-100 shadow-2xl shadow-slate-500">
                    <p class=" text-lg ml-4 mt-3">02</p>
                    <div class="flex justify-center mt-7 ">
                        <img class="h-20 w-20 " src="module.png" alt="">
                    </div>
                    <h1 class="text-2xl ml-4 mt-8">Modules</h1>
                    <p class="text-lg ml-4">{{ $nombreDeModules }}</p>
                </div>

                <div class="bg-indigo-800 rounded-3xl h-64 w-56 text-stone-100 shadow-2xl shadow-slate-500">
                    <p class="text-lg ml-4 mt-3">03</p>
                    <div class="flex justify-center mt-3 ml-4">
                        <img class="h-24 w-24" src="note.png" alt="">
                    </div>
                    <h1 class="text-2xl ml-4 mt-8">Examens</h1>
                    <p class="text-lg ml-4">{{ $nombre_exams }}</p>
                </div>

                
            </div>
        </div>
        <div class="calendar drop-shadow-2xl" style="position: absolute; left:1150px;top:440px">
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




        <div style="width: 500px ; position:relative ; left:310px ; bottom:180px ">
            <div class="min-w-[800px] min-h-[434px] max-h-[434px] w-full bg-white  shadow p-4 md:p-6 drop-shadow-2xl rounded-3xl overflow-auto">
                <div class="flex">
                    <div>
                        <h1 class="text-4xl font-bold mt-2" style="font-family: 'Apple Chancery';">Examens</h1>
                        <p class="ml-7 mb-10">Pour rester informé de tous vos examens</p>
                    </div>
                </div>
                <div id="aff" class="overflow-y-visible">
                    @if($exams->isNotEmpty())
                    <table class="min-w-[750px] ">
                        <thead class="border-b mb-5">
                            <tr class="mb-5">
                                <th class="relative right-10">Module</th>
                                <th class="relative right-11">Date</th>
                                <th class="relative right-2">Heure</th>
                                <th>Durée</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td class=" relative left-">{{ $exam->module->nom }}</td>
                                    <td class="relative ">{{ $exam->date_exam }}</td>
                                    <td class="relative left-5">{{ date('H:i', strtotime($exam->heure_exam)) }}</td> 
                                    <td class="relative left-10">{{ $exam->duree}}</td>
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
            </div>
        </div>                    


    </div>


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

   

        
</body>

</html>
