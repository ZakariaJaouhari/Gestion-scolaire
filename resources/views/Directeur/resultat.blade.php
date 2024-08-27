<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #table1 {
            border-collapse: collapse;
            width: 750px;
            position: relative;
            right: 23px;
            bottom: 120px;
            font-size: 11px;
        }

        th,td{
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: center;
            height: 1px;
        }

        

        .h-10 {
            height: 2.5rem;
            /* Hauteur de 2.5rem (10px) */
        }

        /* Autres styles personnalisés à ajouter selon vos besoins */
    </style>
</head>

<body>
    <div style="position: relative;bottom:30px">
        <div style="text-align: center">
            <img src="ministre.png" style="width:130px; height:110px;">
        </div>
        <h4 style="position: relative;bottom:100px;right:20px;font-size:14px">Académie : {{ auth()->guard('directeur')->user()->academie }}</h4>
        <h4 style="position: relative;bottom:110px;right:20px;font-size:14px">Direction : {{ auth()->guard('directeur')->user()->direction }}</h4>
        <h4 style="position: relative;bottom:160px;left:640px;font-size:14px">{{ auth()->guard('directeur')->user()->annee }}</h4>
    </div>
    <div style="text-align: center;position: relative;bottom:170px;border-bottom:solid black 1px">
        <h2 style="">BULLETIN DE NOTES</h2>
    </div>
    <div style="position: relative;bottom:160px;border-bottom:solid black 1px;height:110px">
        <p style="font-size:14px">Etablissement : {{ auth()->guard('directeur')->user()->nom_ecole }}</p>
        <p style="position: relative;bottom:10px;font-size:14px">Nom : {{ $stagiaire->nom }}</p>
        <p style="position: relative;bottom:47px;left:540px;font-size:14px">Prenom : {{ $stagiaire->prenom }}</p>
        <p style="position: relative;bottom:50px;font-size:14px">Né le : {{ $stagiaire->date_naissance }}</p>
        <p style="position: relative;bottom:87px;left:540px;font-size:14px">CIN : {{ $stagiaire->CIN }}</p>
        <p style="position: relative;bottom:90px;font-size:14px">Groupe : {{ $stagiaire->groupe->matricule }}</p>
        <p style="position: relative;bottom:127px;left:540px;font-size:14px">Niveau : {{ $stagiaire->groupe->niveau }}</p>
    </div>


    <table id="table1">
        <thead>
            <tr class="border-b">
                <th style="text-align: left">Nom module</th>
                <th style="width: 50px">Note (1)</th>
                <th style="width: 50px">Coef (2)</th>
                <th style="width: 70px">Note Gle (1)*(2)</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($modules as $module)
                <tr class="h-10">
                    <td style="text-align: left">{{ $module->nom }}</td>
                    @php
                        $note = $notes->where('module_id', $module->id)->first();
                    @endphp
                    <td>{{ $note ? $note->note : '' }} <span>/20</span></td>
                    <td>{{ $module->coefficient }}</td>
                    <td>
                        @if ($note)
                            {{ $module->coefficient * $note->note }}
                        @endif
                    </td>
                </tr>
            @endforeach
            @php
                $nummodules = $modules->count();
                $numnotes = $notes->count();
            @endphp

        </tbody>

    </table>
    <table style="border-collapse: collapse;font-size: 11px;position:relative;right:23px;bottom:80px;">
        <thead>
            <tr class="border-b">
                <th>Moyenne Générale /20</th>
                @if ($nummodules == $numnotes)
                    <td>{{ number_format($totalScore/$totalCoefficient, 2) }}</td>
                @endif
            </tr>
            <tr class="border-b">
                <th>Décision</th>
                @if ($totalScore / $totalCoefficient < 10)
                    <td>Redoublant</td>
                @elseif($totalScore / $totalCoefficient >= 10)
                    <td>Admis</td>
                @endif
            </tr>
        </thead>
    </table>
    <div style="text-align: center;position:relative;bottom:40px;">
        <p style="font-size: 11px;">Fait à : .................................................................. , 
            le : ..................................................................</p>
        <p style="border-bottom: solid black 1px;width:180px;font-size:12px;position:relative;left:270px;">DIRECTEUR D'ETABLISSEMENT</p>
    </div>
</body>

</html>
