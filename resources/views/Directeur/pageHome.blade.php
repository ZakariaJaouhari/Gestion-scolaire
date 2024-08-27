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
    <style>
        .active .hv {
            display: block;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/css/pageHome.css')
</head>

<body>
    <div class="sidebar">
        <ul class="nav">
            <li id="tophome">
                <a href="{{ route('pagehome') }}" class="active">
                    <img class="logos home hidden" src="Bhome.png" alt="">
                    <img class="logos home hv block" src="Bhome-hover.png" alt=""> Home</a>
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
                    <img class="logos demande hv" src="certificat-hover.png" alt=""><span>Certificats</span></a>
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
                    {{ auth()->guard('directeur')->user()->nom_ecole }}</span>
            </h1>

            <h1 class="text-2xl  font-semibold mt-6 text-neutral-700  flex relative bottom-3 left-64 ml-20">
                <img src="profil.png" class="h-10 w-12 mr-3 mt-2.5" alt="">
                <a href="{{ route('profil') }}" class="mt-3.5 z-50 h-10" style="font-family: 'Apple Chancery';">
                    
                        {{ auth()->guard('directeur')->user()->nom_directeur }}
                </a>
            </h1>

        </div>

        <div class="flex ml-28 relative bottom-72">
            <div class="ml-44 mt-28">
                <h1 class="text-3xl font-mono font-semibold text-neutral-700" style="font-family: 'Apple Chancery';">
                    Bonjour </h1>
                <h1 class="text-5xl font-bold mt-2" style="font-family: 'Apple Chancery';">
                    {{ auth()->guard('directeur')->user()->nom_directeur }}</h1>
                <p class="text-xl mt-4 text-neutral-500 font-medium">Un système d'information intégré qui permet
                    la<br>
                    mise
                    en place de nouvelles méthodes de gestion scolaire.</p>
            </div>
            <div>
                <h1 style=" sans-serif; writing-mode: vertical-rl;text-orientation: mixed;transform: rotate(180deg);"
                    class="text-neutral-500 font-regular text-3xl mt-40 ml-12 mr-4 tracking-widest">
                    TODAY</h1>
            </div>
            <div id="header" class="justify-end">
                <div class="bg-emerald-600 rounded-3xl h-64 w-56 ml-1 text-stone-100 shadow-2xl shadow-slate-500">
                    <p class=" text-lg ml-4 mt-3">01</p>
                    <div class="flex justify-center mt-7 ">
                        <img class="h-20 w-20 " src="prof.png" alt="">
                    </div>
                    <h1 class="text-2xl ml-4 mt-8">Formateurs</h1>
                    <p class="text-lg ml-4">{{ $nombreFormateurs }}</p>
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

    </div>
    <div class="flex  justify-between max-w-[1400px] ml-60 relative bottom-40">
        <div style="width: 500px; position:relative; left:165px;">
            <div class="min-w-[700px] max-h-[434px] w-full bg-white  shadow p-4 md:p-6 drop-shadow-2xl rounded-3xl">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 ">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-lg bg-gray-100  flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 19">
                                <img class="h-8 w-8 mr-2 " src="groupe-hover.png" alt="">
                            </svg>
                        </div>
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900  pb-1">{{ $nombreGroupes }}</h5>
                            <p class="text-sm font-normal text-gray-500 ">Groupes</p>
                        </div>

                        <div class="w-3 h-3 bg-indigo-800 rounded-full relative left-60 bottom-5"></div>
                        <p class="ml-2 text-sm relative left-60 bottom-5">Hommes</p>
                        <div class="w-3 h-3 bg-red-500 rounded-full relative left-72 bottom-5"></div>
                        <p class="ml-2 text-sm relative left-72 bottom-5">Femmes</p>
                        <div class="w-3 h-3 bg-cyan-500 rounded-full relative ml-1.5 left-52 top-3"></div>
                        <p class=" text-sm relative ml-1.5 left-52 top-3">Modules</p>
                        <div class="w-3 h-3 bg-emerald-600 rounded-full relative left-2 top-3"></div>
                        <p class=" text-sm relative left-4 top-3">Formateurs</p>
                    </div>

                </div>

                <div class="grid grid-cols-2">
                    <dl class="flex items-center">
                        <dt class="text-gray-500  text-sm font-normal me-1">Total hommes:</dt>
                        <dd class="text-gray-900 text-sm  font-semibold">{{ $hommes_count }}</dd>
                    </dl>
                    <dl class="flex items-center justify-end">
                        <dt class="text-gray-500  text-sm font-normal me-1">Total femmes:</dt>
                        <dd class="text-gray-900 text-sm  font-semibold">{{ $femmes_count }}</dd>
                    </dl>
                </div>
                <div id="chart-container" style="height: 300px;">
                    <canvas id="column-chart"></canvas>
                </div>
            </div>
        </div>


        <div class="calendar shadow drop-shadow-2xl max-w-[600px]">
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = @json($data);

        const groupes = Object.keys(data);
        const hommes = groupes.map(groupe => data[groupe].hommes);
        const femmes = groupes.map(groupe => data[groupe].femmes);
        const modules = groupes.map(groupe => data[groupe].modules);
        const formateurs = groupes.map(groupe => data[groupe].formateurs);

        const ctxColumn = document.getElementById('column-chart').getContext('2d');
        const columnChart = new Chart(ctxColumn, {
            type: 'bar',
            data: {
                labels: groupes,
                datasets: [{
                    label: 'Hommes',
                    backgroundColor: '#3730a3',
                    data: hommes,
                    borderRadius: 100,
                }, {
                    label: 'Femmes',
                    backgroundColor: '#ef4444',
                    data: femmes,
                    borderRadius: 100,
                }, {
                    label: 'Modules',
                    backgroundColor: '#06b6d4', // Couleur pour les barres de modules
                    data: modules, // Utiliser les données sur les modules
                    borderRadius: 100,
                }, {
                    label: 'Formateurs',
                    backgroundColor: '#059669', // Couleur pour les barres de formateurs
                    data: formateurs, // Utiliser les données sur les formateurs
                    borderRadius: 100,
                }]
            },
            options: {
                scales: {
                    y: {
                        display: false // Masque l'axe Y et ses valeurs
                    },
                    x: {
                        grid: {
                            display: false // Masque les lignes de la grille de l'axe X
                        },
                        ticks: {
                            display: true, // Affiche les étiquettes de l'axe X
                            maxRotation: 70, // Rotation des étiquettes à 90 degrés
                            minRotation: 70, // Rotation des étiquettes à 90 degrés
                            autoSkip: false, // Désactive le saut automatique des étiquettes
                            font: {
                                size: 13 // Diminue la taille de la police des étiquettes
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10 // Ajuste le padding pour masquer la bordure supérieure
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    },
                    legend: {
                        display: false, // Masque la légende
                        labels: {
                            boxWidth: 25, // Reduit la largeur du conteneur de la légende
                            borderRadius: 5,
                        },
                    }
                },
                maintainAspectRatio: false, // Désactive le maintien du ratio d'aspect
            }
        });
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



</body>

</html>
