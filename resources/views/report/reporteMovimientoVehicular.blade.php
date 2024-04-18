  {{-- ENCABEZADO --}}
  <div style="text-align: center">
    <img src="vendor/adminlte/dist/img/escudo.png" alt="logoEspe" width="60px">
    <h2 style="padding: 0;  margin:3px; margin-top:7px">FUERTE MILITAR "ECUADOR"</h2>
    <h3 style="padding: 0;  margin:3px; margin-top:2px">MOVIMIENTO VEHICULAR</h3>
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
    {{-- TABLA MOVIMIENTO --}}
    <table style="border-collapse: collapse; width: 100%; text-align: center;">
        <thead style=";">
            <tr style="border: 1px solid black; color: rgb(40, 38, 38);">
                <th style="padding: 5px;">Ord</th>
                <th style="padding: 5px;">Unidad</th>
                <th style="padding: 5px;">Placa</th>
                <th style="padding: 5px;">Descripción</th>
                <th style="padding: 5px;">Conductor</th>
                <th style="padding: 5px;">Salida</th>
                <th style="padding: 5px;">Entrada</th>
                <th style="padding: 5px;">Destino</th>
                <th style="padding: 5px;">Misión</th>
                <th style="padding: 5px;">Guardia Salida</th>
                <th style="padding: 5px;">Guardia Entrante</th>
                <th style="padding: 5px;">Observación</th>
            </tr>
        </thead>

        <tbody style="font-size: 12px;">
            @php
                $ord = 1;
            @endphp
            @foreach ($vehicleLogs as $item)
            <tr style="border: 1px solid black;">
                <td style="padding: 5px;">{{ $ord++ }}</td>
                <td style="padding: 5px;">{{ $item->abbreviation }}</td>
                <td style="padding: 5px;">{{ $item->plate }}</td>
                <td style="padding: 5px;">{{ $item->description }}</td>
                <td style="padding: 5px;">{{ $item->driver }}</td>
                <td style="padding: 5px;">{{ $item->departure_time }}</td>
                <td style="padding: 5px;">
                    @if ($item->entry_time === null)
                        <div>-</div>
                    @elseif ($item->entry_time == 0)
                        <div>Valor es 0</div>
                    @else
                        {{ $item->entry_time }}
                    @endif
                </td>
                <td style="padding: 5px;">{{ $item->destination }}</td>
                <td style="padding: 5px;">{{ $item->mission }}</td>
                <td style="padding: 5px;">{{ $item->guardOut }}</td>
                <td style="padding: 5px;">{{ $item->guardIn }}</td>
                <td style="padding: 5px;">{{ $item->observation }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TÍTULO SEGUNDA TABLA --}}
    <div style="display: flex; align-items: center; width: 100%; justify-content: center; flex-direction: column">
        <h4 style="padding: 0;  margin:3px; text-align: center">VEHÍCULOS FUERA DEL FUERTE</h4>
    </div>

    {{-- TABLA CONSOLIDADO VEHÍCULOS --}}
    <table style="border-collapse: collapse; width: 100%; text-align: center;">
        <thead style=";">
            <tr style="border: 1px solid black; color: rgb(40, 38, 38);">
                <th style="padding: 5px;">Ord</th>
                <th style="padding: 5px;">Unidad</th>
                <th style="padding: 5px;">Placa</th>
                <th style="padding: 5px;">Descripción</th>
                <th style="padding: 5px;">Salida</th>
                <th style="padding: 5px;">Destino</th>
                <th style="padding: 5px;">Misión</th>

            </tr>
        </thead>
        <tbody style="font-size: 13px;">
            @php
                $ord = 1;
            @endphp
            @foreach ($vehiclesOut as $item)
                <tr style="border: 1px solid black;">
                    <td style="padding: 5px;">{{ $ord++ }}</td>
                    <td style="padding: 5px;">{{ $item->abbreviation }}</td>
                    <td style="padding: 5px;">{{ $item->plate }}</td>
                    <td style="padding: 5px;">{{ $item->description }}</td>
                    <td style="padding: 5px;">{{ $item->departure_time }}</td>
                    <td style="padding: 5px;">{{ $item->destination }}</td>
                    <td style="padding: 5px;">{{ $item->mission }}</td>

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

