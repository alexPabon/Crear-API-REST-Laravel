<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/validarFormEmail.js')}}"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 7.5vw;
            }

            .links > a {
                color: #636b6f;                
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }            
        </style>
    </head>
    <body id="inicio">
        <div class="fixed-top">
            @includeif('auth.menu')    
        </div>
        <div class="fixed-top col-3 col-md-2 col-lg-1 mx-auto p-0 pt-3 text-center">
            <a href="#inicio" class="bg bg-light rounded-pill px-2 py-1 font-weight-bold">Subir</a>
        </div>           
        
        <div class="flex-center position-ref full-height">     

            <div class="content p-2">
                <div class="title m-b-md">
                    API REST Laravel
                </div>            

               <div class="links">
                	 
                    <a class="btn btn-light mx-2 my-1" href="#recursos">Recursos</a>
                    <a class="btn btn-light mx-2 my-1" href="#rutas">Rutas</a>
                    <a class="btn btn-light mx-2 my-1" href="#otrasRutas">Otras Rutas</a>
                    <a class="btn btn-light mx-2 my-1" href="https://github.com/alexPabon/Crear-API-REST-Laravel"
                     target="_Blank">GITHUB</a>
                    <a class="btn btn-light mx-2 my-1" href="#datosFormulario">Datos para Formulario</a>
                    {{--<a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>--}}
                </div>
                <div class="container text-left">
        			<p class="text-justify pt-3 lead">
        				<b>API REST</b> gratuita en línea y se puede usar siempre que necesite algunos datos falsos.
                    	Es ideal para tutoriales, probar nuevas bibliotecas, compartir ejemplos de código, ...
                    </p>
                    @includeWhen($errors->any(),'layouts.error')   	
					@includeWhen(Session::has('success'),'layouts.success')                 
                    <div id="recursos"></div>        			
        		</div>                               
            </div>            
        </div>         
        <div  class="container">
            <h2  class="h2">Recursos</h2>
            <ul>
                <li>
                    <a class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-left" href="{{route('products.index')}}">/api/products</a>los productos
                </li>
                <li>
                    <a class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-left" href="{{route('transactions.index')}}">/api/transactions</a>las transacciones
                </li>
                <li>
                    <a class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-left" href="{{route('categories.index')}}">/api/categories</a>las categorias
                </li>
                <li>
                    <a class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-left" href="{{route('users.index')}}">/api/users</a>los usuarios
                </li>
            </ul>                    
            <p class="text-left lead">
                Los recursos tienes relaciones. Por ejemplo:<br>
                - Los usuarios registrados pueden ser compradores y tendrán un numero de idenficacion como comprador.<br>
                - Las transacciones estarán relacionadas con los compradores.<br>
                - Los productos pueden pertenecer a muchas transacciones.<br>                        
                - Los usuarios registrados, tambien pueden ser compradores y tendrán un numero de identificaion como vendedor.<br id="rutas">
                - Los productos estarán relacionado a un vendedor, ademas puden pertenecer a muchas categorias.
            </p>            
            <h3 class="h3">las Rutas</h3>
            <p class="lead">Todas las rutas soportan.</p>
            <ul>
                <li>
                    GET <a class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-right" href="{{route('products.index')}}">/api/products</a>
                </li>
                <li>
                    GET <a class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-right" href="{{route('products.show',2)}}">/api/products/2</a>
                </li>
            </ul>

            <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                Para las siguientes rutas el usuario se debe autenticar con <a href="{{route('home')}}"><b>api_token</b></a>
            </p>
            <ul>
                <li>
                    POST <span class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-right">/api/products</span> store
                </li>
                <li>
                    PUT <span class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-right">/api/products/2</span> update                   
                    <pre class="col-12 col-md-8 col-lg-4 text-center bg bg-light px-0 py-2">{{"<input type='hidden' name='_method' value='PUT'>"}}</pre>                  
                </li>
                <li class="mt-3">
                    DELETE <span class="col-6 col-md-2 col-lg-1 btn btn-link mr-5 text-right">/api/products/2</span>
                    <span id="otrasRutas" class="mx-2">destroy</span>
                    <pre class="col-12 col-md-8 col-lg-4 text-center bg bg-light px-0 py-2">{{"<input type='hidden' name='_method' value='DELETE'>"}}</pre>                    
                </li>
            </ul>
            <h3 class="h3">Otras Rutas</h3>
            <p class="lead">
                Tambien tenemos otras rutas, las cuales podremos ver todos los productos con el nombre del vendedor y consultar los productos que cada usuario a creado
            </p>
            <ul>
                <li>
                    <span>GET</span><span class="col-6 col-md-3 col-lg-2  mr-3 text-right text-primary"><b>/api/product/sellers</b></span>
                </li>
                <li>
                    <span>GET</span><span class="col-6 col-md-3 col-lg-2  mr-3 text-right text-primary"><b>/api/myproducts</b></span> <b>api_token</b><hr>
                </li>
                <li>
                    <span>GET</span><span class="col-6 col-md-3 col-lg-2  mr-3 text-right text-primary"><b>/api/category/products</b></span>
                </li>
                <li>
                    <span>GET</span><span class="col-6 col-md-3 col-lg-2  mr-3 text-right text-primary"><b>/api/mycategories</b></span> <b>api_token</b><hr>
                    <span class="bg bg-info px-2"><b>Relacionar los productos a las categorias</b></span>                    
                </li>
                <li>
                    <span>POST</span><span class="col-6 col-md-3 col-lg-2  mr-3 text-right text-primary"><b>/api/add/productcategory</b></span><b>api_token</b>
                </li>
                <li>
                    <span>DELETE</span><span class="col-6 col-md-3 col-lg-2  mr-2 text-right text-primary" ><b>/api/remove/productcategory</b></span> <b>api_token</b>
                    <pre class="col-12 col-md-8 col-lg-4 text-center bg bg-light px-0 py-2"> {{"{'category_id':5,'product_id':2}"}}</pre><hr>
                </li>
                <li>
                    <span>GET</span><span id="datosFormulario" class="col-6 col-md-3 col-lg-2  mr-2 text-right text-primary" ><b>/api/mytransactions</b></span> 
                    <b>api_token</b><hr>
                    
                </li>
            </ul>
            <div>
                <h2>Introduciendo los datos a través de un formulario</h2>
                <h3>Products</h3>
                <div class="col-12 col-md-8 col-lg-6 d-md-inline-flex">
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        POST <b> Store</b><br>
                        {<br>&nbsp name: 'string', <br> &nbsp description: 'string',<br>
                        &nbsp quantity: int,<br> &nbsp status: 'string'<br>}
                    </p>
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        PUT <b>Update</b><br>
                        {<br>&nbsp _method:'PUT',<br> &nbsp name: 'string', <br> &nbsp description: 'string',<br>
                        &nbsp quantity: int,<br> &nbsp status: 'string'<br>}
                    </p>                   
                </div>
                <h3>Transactions</h3>
                <p>Cuando se crea una transaccion y ponemos la cantidad de productos, estos se restaran de la cantidad del producto seleccionado</p>
                <div class="col-12 col-md-8 col-lg-6 d-md-inline-flex">
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        POST <b> Store</b><br>
                        {<br>&nbsp quantity_products: int, <br> &nbsp product_id: int,<br>}
                    </p>
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        PUT <b>Update</b><br>
                        {<br>&nbsp _method:'PUT',<br>&nbsp quantity_products: int, <br>}
                    </p>                   
                </div>
                <h3>Categories</h3>
                <div class="col-12 col-md-8 col-lg-6 d-md-inline-flex">
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        POST <b> Store</b><br>
                        {<br>&nbsp name: 'string', <br> &nbsp description: 'string',<br>}
                    </p>
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        PUT <b>Update</b><br>
                        {<br>&nbsp _method:'PUT',<br> &nbsp name: 'string', <br> &nbsp description: 'string',<br>}
                    </p>                   
                </div>
                <h3>Users</h3>
                <div class="col-12 col-md-8 col-lg-6 d-md-inline-flex">
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        POST <b> Store</b><br>
                        {<br>&nbsp name: 'string', <br> &nbsp email: 'string',<br>&nbsp password: 'string',<br>}
                    </p>
                    <p class="col-12 col-md-8 col-lg-6 bg bg-light card-body lead">
                        PUT <b>Update</b><br>
                        {<br>&nbsp _method:'PUT',<br>&nbsp name: 'string', <br> &nbsp email: 'string',<br>}
                    </p>                   
                </div>
                
            </div>            
            <p class="lead">
                Con un simple repositorio
                <b><a class="link" href="https://github.com/alexPabon/Crear-API-REST-Laravel" target="_Blank">GITHUB</a></b>
                ,puedes tener tu propio servidor REST en segundos.
            </p>
<<<<<<< HEAD
        </div>                      
=======
        </div>                  
>>>>>>> origin/master
		@includeif('contact.footer',['autor'=>'Alexander, implementando plantillas Blade'])
    </body>
</html>
