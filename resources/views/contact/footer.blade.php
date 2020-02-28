<!-- PARTE INFERIOR -->
<footer class="page-footer font-small p-4 bg-dark text-white">
    <div class="border border-primary rounded">
    	<h4 class="bg-secondary p-1">Otra web personal</h4>
    	<a href="http://preguntas.alexpabon.es" target="_blank" class="view overlay zoom"><img src="/images/portales/preguntas.png" title="Ir a preguntas de programación" class="img-fluid rounded m-3 col-11 col-sm-3 col-lg-2"></a>
        <a href="http://alexpabon.es" target="_blank" class="view overlay zoom"><img src="/images/portales/porfolio.png" title="Ir a porfolio" class="img-fluid rounded m-3 col-11 col-sm-3 col-lg-2"></a>           
    </div>   
    <div class="my-3">
    	<h3>contacto:</h3>
        <form id="formContacto" autocomplete="off" class="col-12 col-sm-7 col-lg-6 border border-light p-3 rounded" method="post" action="{{route('send.mail')}}">
         {{csrf_field()}} 
        	<ul class="list-group p-0">
        		<li class="list-group lead">
        			<b>Alexander Pabon: alepabon@gmail.com</b><br>
        		</li>
        		<li class="list-group py-2">        			
        			<label style="visibility: hidden;" for="nomb">Nombre</label>
        			<input class="entradas bg-light form-control @if($errors->first('nombre')) {{'is-invalid'}} @else {{'border-0'}} @endif" id="nomb" type="text" name="nombre" placeholder="Nombre" value="{{old('nombre')}}">
        			{!!$errors->first('nombre','<small class="text-danger mt-1">:message</small>')!!}  			
        		</li>
        		<li class="list-group py-2">
        			<label style="visibility: hidden;" for="email">Email</label>
        			
        			<input class="entradas bg-light form-control @if($errors->first('email')) {{'is-invalid'}} @else {{'border-0'}} @endif" 
        				id="email" type="email" name="email" placeholder="Email" 
        				value="@if(old('email')) {{old('email')}} @else @auth{{Auth::user()->email}}@endauth @endif">
        				
        			{!!$errors->first('email','<small class="text-danger mt-1">:message</small>')!!}
        			<input type="hidden" name="miEmail" placeholder="MiEmail" value="alepabon@gmail.com">
        			
        		</li>
        		<li class="list-group-item bg-dark d-flex justify-content-between p-0 py-2">
            		<div class="col-6 list-group">
            			<label style="visibility: hidden;" for="empresa">Empresa</label>
            			<input class="entradas bg-light form-control border-0" id="empresa" type="text" name="empresa" placeholder="Empresa" value="{{old('empresa')}}">       									
            		</div>
            		<div class="col-6 list-group">
            			<label style="visibility: hidden;" for="tel">Telefono</label>
            			<input class="entradas bg-light form-control border-0" id="tel" type="number" name="tel" placeholder="Telefono" maxlength="15" value="{{old('tel')}}">
            		</div>
        		</li>
        		<li class="list-group py-2">
        			<label style="visibility: hidden;" for="asunto">Asunto</label>
        			<input class="entradas bg-light form-control @if($errors->first('asunto')) {{'is-invalid'}} @else {{'border-0'}} @endif" id="asunto" type="text" name="asunto" placeholder="Asunto" value="{{old('asunto')}}">
        			{!!$errors->first('asunto','<small class="text-danger mt-1">:message</small>')!!}						
        		</li>
        		<li class="list-group py-3">
        			<label style="visibility: hidden;" for="mensaje">Mensaje</label>
        			<textarea id="mensaje" class="entradas bg-light form-control @if($errors->first('mensaje')) {{'is-invalid'}} @else {{'border-0'}} @endif" rows="8" name="mensaje" maxlength="500" placeholder="Mensaje">{{old('mensaje')}}</textarea>
        			{!!$errors->first('mensaje','<small class="text-danger mt-1">:message</small>')!!}
        		</li>
        		<li class="list-group p-0 py-2">
        			<div class="d-flex justify-content-left align-content-center">
	        			<input id="privacidad" class="custom-checkbox @if($errors->first('acepto')) {{'is-invalid'}} @else {{'border-0'}} @endif" type="checkbox" name="acepto" @if(old('acepto')){{'checked'}} @endif value="1">
	        			<label id="condiciones" class="m-0 mx-1" for="acepto">Acepto la <a href=""><b>POLITICA DE PRIVACIDAD</b></a></label>
        			</div>
        			{!!$errors->first('acepto','<small class="col-12 text-danger m-0">:message</small>')!!}		
        		</li>
        		<li class="list-group">        			
        			<input type="submit" class="mt-2 btn btn-primary" name="contacto" value="Enviar">
        			<input type="reset" class="mt-2 btn btn-secondary" value="Borrar datos">
        			{{old('contacto')}}
        		</li>
        	</ul>
        </form>
        <div id="msnError" class="col-12 col-sm-7 col-lg-6 p-0"></div>         
    </div> 
     <p class="Vh-100 lead">
       Aplicacion creada por <b>{{$autor}}</b> como ejemplo.<br>
       Si tienes alguna pregunta o sugerencia, me pudees escribir a mi correo, rellenando el formulario que se cuentra arriba.
    </p>
</footer>