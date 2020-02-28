<!DOCTYPE html>
<html>
<head>
	<title>envio de Email</title>
	<meta charset="utf-8">
</head>
<body>
	<h3>Envio de Email de Laravel</h3>
	<p>
		Nombre: {{$mensaje['nombre']}}<br>
		Email: {{$mensaje['email']}}<br>
		Empresa: {{$mensaje['empresa']}}<br>
		Telefono: {{$mensaje['tel']}}<br>
		Asunto: {{$mensaje['asunto']}}		
	</p>
	<p>
<<<<<<< HEAD
		Mensaje:<br>{!!nl2br($mensaje['mensaje'])!!}
=======
		Mensaje:<br>{{nl2br($mensaje['mensaje'])}}
>>>>>>> origin/master
	</p>
</body>
</html>