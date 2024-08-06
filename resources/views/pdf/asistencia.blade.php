<style>

table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#335fe0;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:14px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
    border-left: solid 1px #bdc3c7;
    border-right: solid 1px #bdc3c7;
    border-width: solid 1px #bdc3c7;
    padding: 3px 4px 3px;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}

</style>
<table cellspacing="0" style="width: 100%;">
        <tr>
       
            <td style="width: 25%; color: #444444;">
           
            <img style="width: 100%;" src="logos.png" alt="Logo">

            <br>
          
            </td>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"> DATOS EMMPRESA</span>
				<br>Nombre :APP_NAME<br> 
				Email: asistencia@gmail.com <br>
                Ruc : 32424343 <br>
                Direccion:de por hay
                
            </td>
          
			<td style="width: 25%;text-align:right">
			Fecha : <?php echo  date('Y-d-m') ?>  
			</td>
			
        </tr>
    </table>
    <br>
<h1 style="text-align:center">Asistencia</h1>
<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
    <thead>
        <th style="width:20%; " class='midnight-blue'>Calendario</th>
        <th style="width: 20% ; text-align: center;" class='midnight-blue'>Tipo</th>
        <th style="width: 30% ; text-align: center;" class='midnight-blue'>Entrada</th>
        <th style="width: 30% ; text-align: center;" class='midnight-blue'>Salida</th>
    </thead>
    <tbody>
        @foreach ($timesheets as $item)
        <tr>
            <td class='border-top' style="width: 20%; text-align: center">{{ $item->calendar->name }}</td>
            <td class='border-top' style="width: 20%; text-align: center">{{ $item->type }}</td>
            <td class='border-top' style="width: 30%; text-align: center">{{ $item->day_in }}</td>
            <td class='border-top' style="width: 30%; text-align: center">{{ $item->day_out }}</td>
        </tr>

        @endforeach
    </tbody>
</table>