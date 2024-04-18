{{-- ENCABEZADO --}}
<div style="text-align: center">
    <img src="vendor/adminlte/dist/img/escudo.png" alt="logoEspe" width="60px">
    <h2 style="padding: 0;  margin:3px; margin-top:7px">FUERTE MILITAR "ECUADOR"</h2>
    <h3 style="padding: 0;  margin:3px; margin-top:2px">REPORTE PERSONAL CIVIL</h3>
    <div style="font-size: 11px;">
        <div>
            Fecha de Inicio del Reporte:
            {{ Carbon\Carbon::parse($fechaInicio)->format('d-M-Y H:i') }}
        </div>
        <div>
            Fecha de Fin del Reporte:
            {{ Carbon\Carbon::parse($fechaFin)->format('d-M-Y H:i') }}
        </div>
    </div>
</div>

{{-- CUERPO --}}
<div style="display: flex; flex-direction: column; width: 100%;">

    <table style="border-collapse: collapse; width: 100%; text-align: center;">
        <thead style=";">
            <tr style="border: 1px solid black; color: rgb(40, 38, 38);">
                <th style="padding: 5px;">Ord</th>
                <th style="padding: 5px;">Apellidos y Nombres</th>
                <th style="padding: 5px;">Ingreso</th>
                <th style="padding: 5px;">Salida</th>
                <th style="padding: 5px;">Actividad</th>
                <th style="padding: 5px;">Transporte</th>
                <th style="padding: 5px;">Responsable Ingreso</th>
                <th style="padding: 5px;">Responsable Salida</th>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
            @php
                $ord = 1;
            @endphp
            @foreach ($civilianLogs as $item)
                <tr style="border: 1px solid black;">
                    <td style="padding: 5px;">{{ $ord++ }}</td>
                    <td style="padding: 5px; text-align: left">{{ $item->civilian }}</td>
                    <td style="padding: 5px;">{{ $item->hour_in }}</td>
                    <td style="padding: 5px;">{{ $item->hour_out }}</td>
                    <td style="padding: 5px;">{{ $item->activity }}</td>
                    <td style="padding: 5px;">{{ $item->transport }}</td>
                    <td style="padding: 5px;">{{ $item->user_in }}</td>
                    <td style="padding: 5px;">{{ $item->user_out }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- FECHA --}}
    <section style="display: flex; justify-content: left; flex-direction: row">
        <div>Fecha que se generó reporte:
            @php
                date_default_timezone_set('America/Guayaquil');
            @endphp
            {{ $fecha_actual = date('Y-M-d H:i') }}
        </div>
    </section>

    <table style=" width: 100%; text-align: center; margin-top: 3px">
        <tr style=" padding-top: 2px">
            <td style="padding: 5px;">OFICIAL DE GUARDIA</td>
            <td style="padding: 5px;">JEFE CUARTEL</td>
            <td style="padding: 5px;">JEFE DE CONTROL</td>
            <td style="padding: 5px;">CMTE F.M.E</td>
        </tr>
        <tr style="padding-top: 40px">
            <td style="padding-top: 45px;">__________________</td>
            <td style="padding-top: 45px;">__________________</td>
            <td style="padding-top: 45px;">__________________</td>
            <td style="padding-top: 45px;">__________________</td>
        </tr>
    </table>
</div>
