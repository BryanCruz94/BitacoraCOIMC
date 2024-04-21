<div style="display: flex; width: 100%;">
    <!-- Columna Izquierda -->
    <div
        style="width: 49%; float: left;
    border-top: 1px dashed rgb(63, 62, 62); border-right: 1px dashed rgb(63, 62, 62);
    border-bottom: 1px dashed rgb(63, 62, 62); padding-bottom:2px;">
        <div style="text-align: center; border-collapse: collapse;">
            <img src="vendor/adminlte/dist/img/logoComaco.jpg" alt="logo" width="34px">
            <h2 style="padding: 0; margin: 3px; margin-top: 4px; font-size: 13px;">
                FUERTE MILITAR "ECUADOR"</h2>
            <h2 style="padding: 0; margin: 3px; margin-top: 4px; font-size: 12px;">
                {{ $pass->military_unit }}</h2>
            <h3 style="padding: 0; margin: 3px; margin-top: 2px; font-size: 12px;">
                ORDEN DE CIRCULACIÓN</h3>
            <div style="font-size: 11px;">
                <div>
                    Fecha:
                    @php
                        date_default_timezone_set('America/Guayaquil');
                    @endphp
                    {{ $fecha_actual = date('Y-M-d') }}
                </div>
            </div>

            <div style="display: flex; flex-direction: column; width: 90%;">

                <table style="border-collapse: collapse; width: 100%; text-align: center; font-size: 12px;">
                    <tr>
                        <td style="padding: 2px; text-align: left;">Destino:</td>
                        <td style="padding: 2px; text-align: left;"> {{ $pass->destination }} </td>
                    </tr>

                    <tr>
                        <td style="padding: 2px; text-align: left;">Vehículo:</td>
                        <td style="padding: 2px; text-align: left;"> {{ $pass->description }}</td>
                        <td style="padding: 2px; text-align: left;">Placa:</td>
                        <td style="padding: 2px; text-align: left;"> {{ $pass->plate }} </td>
                    </tr>

                    <tr>
                        <td style="padding: 2px; text-align: left;">Misión:</td>
                        <td colspan="3" style="padding: 2px; text-align: left;"> {{ $pass->mission }} </td>
                    </tr>

                    <tr>
                        <td style="padding: 2px; text-align: left;">Km Salida:</td>
                        <td style="padding: 2px; text-align: left;"> </td>
                        <td style="padding: 2px; text-align: left;">Km Entrada:</td>
                        <td style="padding: 2px; text-align: left;"> </td>
                    </tr>

                </table>

                <table style="width: 100%; text-align: center; margin-top: 2px; font-size: 12px;">
                    <tr style="padding-top: 1px;">
                        <td style="padding: 5px;">CONDUCTOR</td>
                        <td style="padding: 5px;">ENCARGADO LOGÍSTICA</td>
                    </tr>
                    <tr style="padding-top: 25px;">
                        <td style="padding-top: 12px;">__________________</td>
                        <td style="padding-top: 12px;">__________________</td>
                    </tr>
                    <tr style="padding-top: 1px;">
                        <td style="padding: 1px;"> {{ $pass->driver }} </td>
                        <td style="padding: 1px;"> {{ $pass->user_logistic }} </td>
                    </tr>
                </table>
                <table style="width: 100%; text-align: center; margin-top: 3px; font-size: 12px;">
                    <tr style="padding-top: 2px;">
                        <td style="padding: 5px;">COMANDANTE UNIDAD</td>
                    </tr>
                    <tr style="padding-top: 25px;">
                        <td style="padding-top: 12px;">__________________</td>
                    </tr>
                    <tr style="padding-top: 25px;">
                        <td style="padding-top: 1px;"> {{ $pass->user_authorized }} </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

    <!-- Columna Derecha -->
    <div
        style="width: 49%; float: right;
    border-top: 1px dashed rgb(63, 62, 62); border-left: 1px dashed rgb(63, 62, 62);
    border-bottom: 1px dashed rgb(63, 62, 62); margin-left:2px; padding-bottom:2px">
        <div style="text-align: center; border-collapse: collapse;">
            <img src="vendor/adminlte/dist/img/logoComaco.jpg" alt="logo" width="34px">
            <h2 style="padding: 0; margin: 3px; margin-top: 4px; font-size: 13px;">
                FUERTE MILITAR "ECUADOR"</h2>
            <h2 style="padding: 0; margin: 3px; margin-top: 4px; font-size: 12px;">
                {{ $pass->military_unit }}</h2>
            <h3 style="padding: 0; margin: 3px; margin-top: 2px; font-size: 12px;">
                ORDEN DE CIRCULACIÓN</h3>
            <div style="font-size: 11px;">
                <div>
                    Fecha:
                    @php
                        date_default_timezone_set('America/Guayaquil');
                    @endphp
                    {{ $fecha_actual = date('Y-M-d') }}
                </div>
            </div>

            <div style="display: flex; flex-direction: column; width: 90%;">

                <table style="border-collapse: collapse; width: 100%; text-align: center; font-size: 12px;">
                    <tr>
                        <td style="padding: 2px; text-align: left;">Destino:</td>
                        <td style="padding: 2px; text-align: left;"> {{ $pass->destination }} </td>
                    </tr>

                    <tr>
                        <td style="padding: 2px; text-align: left;">Vehículo:</td>
                        <td style="padding: 2px; text-align: left;"> {{ $pass->description }}</td>
                        <td style="padding: 2px; text-align: left;">Placa:</td>
                        <td style="padding: 2px; text-align: left;"> {{ $pass->plate }} </td>
                    </tr>

                    <tr>
                        <td style="padding: 2px; text-align: left;">Misión:</td>
                        <td colspan="3" style="padding: 2px; text-align: left;"> {{ $pass->mission }} </td>
                    </tr>

                    <tr>
                        <td style="padding: 2px; text-align: left;">Km Salida:</td>
                        <td style="padding: 2px; text-align: left;"> </td>
                        <td style="padding: 2px; text-align: left;">Km Entrada:</td>
                        <td style="padding: 2px; text-align: left;"> </td>
                    </tr>

                </table>

                <table style="width: 100%; text-align: center; margin-top: 2px; font-size: 12px;">
                    <tr style="padding-top: 1px;">
                        <td style="padding: 5px;">CONDUCTOR</td>
                        <td style="padding: 5px;">ENCARGADO LOGÍSTICA</td>
                    </tr>
                    <tr style="padding-top: 25px;">
                        <td style="padding-top: 12px;">__________________</td>
                        <td style="padding-top: 12px;">__________________</td>
                    </tr>
                    <tr style="padding-top: 1px;">
                        <td style="padding: 1px;"> {{ $pass->driver }} </td>
                        <td style="padding: 1px;"> {{ $pass->user_logistic }} </td>
                    </tr>
                </table>
                <table style="width: 100%; text-align: center; margin-top: 3px; font-size: 12px;">
                    <tr style="padding-top: 2px;">
                        <td style="padding: 5px;">COMANDANTE UNIDAD</td>
                    </tr>
                    <tr style="padding-top: 25px;">
                        <td style="padding-top: 12px;">__________________</td>
                    </tr>
                    <tr style="padding-top: 25px;">
                        <td style="padding-top: 1px;"> {{ $pass->user_authorized }} </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
