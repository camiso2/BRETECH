<!DOCTYPE html>
<html lang="en">

<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" value="notranslate">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <!-- Bootstrap core CSS -->
    <link href="/panel/css/bootstrap.min.css" rel="stylesheet">
    <link href="/panel/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="/panel/css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="/panel/css/custom.css" rel="stylesheet">
    <link href="/panel/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="/panel/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="/panel/js/jquery.min.js"></script>
    <script src="/panel/js/nprogress.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/registerProduct.js') }}" defer></script>
    <script src="{{ asset('js/registerSales.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body class="nav-md">


    <script>
    @if (session('alert_error'))
    <script>
        $(document).ready(function()
      {
        $("#profile").modal("show");
    });
    </script>
    @include('sections.modal_profile')
    @endif

    @include('sections.menu_panel')
    <!-- page content -->
    <div class="right_col" role="main">
        @include('sections.preload')
        <!-- top tiles -->
        <div class="row tile_count">

            <div class="animated flipInY col-md-4 col-sm-8 col-xs-8 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-user"></i> Registrar Productos</span>
                    <div class="count green">
                        <button type="submit" class="btn btn-info " style="width:80%;" data-toggle="modal"
                            data-target=".bs-productos-modal-lg"><i class="	fa fa-check-circle fa-esp"
                                aria-hidden="true"></i> REGISTRE SUS PRODUCTOS
                        </button>
                    </div>
                    @if (count($listProduct)>0)
                    <span class="count_bottom">
                        <i class="green">
                            <i class="fa fa-sort-asc"></i>{{count($listProduct)==1?
                            count($listProduct).' producto registrado':count($listProduct).' productos
                            registrados'}}
                        </i>
                    </span>
                    @else
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>NO HAY</i>
                        Productos</span>
                    @endif
                </div>
            </div>

            <div class="animated flipInY col-md-4 col-sm-8 col-xs-8 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-user"></i> Venta de Productos</span>
                    <div class="count green"><button type="submit" class="btn btn-warning " style="width:80%;"
                            data-toggle="modal" data-target=".bs-sales-modal-lg"><i class="	fa fa-check-circle fa-esp"
                                aria-hidden="true"></i> VENDA SUS PRODUCTOS
                        </button></div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>100% </i>
                        Productos</span>
                </div>
            </div>

            <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-user"></i> Productos eliminados</span>
                    <div class="count" style="color: red;">{{count($deleted)}}</div>
                    @if (count($listProduct)>0)
                    <span class="count_bottom"><i class="red">{{
                            number_format((count($deleted)*100)/count($listProduct),2,',','.') }} %</i> Eliminados
                    </span>
                    @endif
                </div>
            </div>
            <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                <div class="left"></div>
                <div class="right">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Ventas del Día </span>

                    <div class="count_bottom" style="font-size: 18px;font-weight:600;">$
                        {{number_format($sales,0,"",".")}}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>$ {{$Yesterday}} </i> Ayer
                    </span>
                </div>
            </div>
            {{--@endif--}}
        </div>
        <!-- /top tiles -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b>DATOS DE LOS PRODUCTOS</b>
                            <small>(Total :
                                {{count($listProduct)==1? count($listProduct).' producto
                                registrado':count($listProduct).' productos registrados'}} )
                            </small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div style="overflow-x:auto;">
                        @if (count($listProduct)<1) <h4>NO HAY PRODUCTOS REGISTRADOS !</h4>
                            @else
                            <div class="x_content">
                                <p>Los Productos <code>Cumplen</code> con todos los requerimientos !</p>
                                <script src="/panel/js/buscador.js"></script>
                                <div class="title_right" style="padding-top: 5px;">
                                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th style="width: 5%;text-align: center;"><i class="fa fa-registered"
                                                        aria-hidden="true"></i>&nbsp;&nbsp;</th>
                                                <th class="column-title">SKU </th>
                                                <th class="column-title">Nombre </th>
                                                <th class="column-title">Descripción </th>
                                                <th class="column-title">Estado </th>
                                                <th class="column-title">Precio </th>
                                                <th class="column-title">IVA</th>
                                                <th class="column-title " style="width: 1%;font-size: 18px;">
                                                    <span class="nobr"><i class="fa fa-trash"></i></span>
                                                </th>
                                                <th class="column-title " style="width: 1%;font-size: 18px;">
                                                    <span class="nobr"><i class="fa fa-check"></i></span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listProduct as $p)
                                            @if(is_null($p->deleted_at))

                                            <tr class="even pointer" id="tr{{$p->id}}">
                                                <td class="cv ">
                                                    <a href="/{{ $p->foto }}" target="_blank">
                                                        <p style="width: 90px !important" data-toggle="tooltip"
                                                            title="Nº : {{ $p->SKU }}">VER PRODUCTO
                                                        </p>
                                                    </a>
                                                </td>

                                                <td class="cv">
                                                    <p data-toggle="tooltip" title="Nº : {{ $p->SKU }}">{{
                                                        $p->SKU }}</p>
                                                </td>
                                                <td class="cv-cre">
                                                    <p data-toggle="tooltip" title="{{ $p->nombre }}">{{
                                                        $p->nombre }}</p>
                                                </td>
                                                <td class="cv-desc">
                                                    <p data-toggle="tooltip" title="{{ $p->descripcion }}">{{
                                                        $p->descripcion }}</p>
                                                </td>

                                                <td class="cv">
                                                    @if(is_null($p->state))
                                                    <p id="habilitado{{$p->id}}" style="color: #5bc0de">
                                                        <b>Producto Habilitado</b>
                                                    </p>
                                                    @else
                                                    <p id="habilitado{{$p->id}}" style="color: #d9534f">
                                                        <b>Producto desabilitado</b>
                                                    </p>
                                                    @endif
                                                </td>

                                                <td class="cv">
                                                    <p data-toggle="tooltip" title="$ {{ number_format($p->precio,0,"","
                                                        .") }}">$ {{number_format($p->precio,0,"",".")}}
                                                    </p>
                                                </td>
                                                <td class="cv">
                                                    <p data-toggle="tooltip" title="{{ $p->IVA }}">{{$p->IVA }} %</p>
                                                </td>
                                                <td class="cv">
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                        onclick="destroy({{$p->id}})"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td class="cv">
                                                    @if(is_null($p->state))
                                                    <button type="submit" class="btn btn-success btn-xs"
                                                        onclick="update({{$p->id}})" id="update{{$p->id}}"> <i
                                                            class="fa fa-check-square-o"></i> <span>Deshabiliar</span>
                                                    </button>
                                                    @else
                                                    <button type="submit" class="btn btn-default btn-xs"
                                                        onclick="update({{$p->id}})" id="update{{$p->id}}"><i
                                                            class="fa fa-check-square-o"></i> <span>Habilitar</span>
                                                    </button>
                                                    @endif

                                                </td>
                                            </tr>
                                            <script type="text/javascript">
                                                $(document).ready(function(e){
                                                    $('[data-toggle="tooltip"]').tooltip();
                                                });
                                            </script>
                                            @endif
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                    </div>
                </div>
                @include('sections.footer')
            </div>
            <div class="clearfix"></div>
            <br />
            <div id="custom_notifications" class="custom-notifications dsp_none">
                <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
                </ul>
                <div class="clearfix"></div>
                <div id="notif-group" class="tabbed_notifications"></div>
            </div>
            <script src="/panel/js/bootstrap.min.js"></script>
            <!-- bootstrap progress js -->
            <script src="/panel/js/progressbar/bootstrap-progressbar.min.js"></script>
            <script src="/panel/js/nicescroll/jquery.nicescroll.min.js"></script>
            <script src="/panel/js/custom.js"></script>
            <script>
                NProgress.done();
            </script>
            <!-- /datepicker -->
            <!-- /footer content -->
            @include('sections.modal_productos')
            @include('sections.modal_sales')

            <script>
                function update(id){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    Swal.fire({
                        title: 'Esta Seguro/a?',
                        text: "Puede Habilitar del Producto en Cualquier Momento",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#00a6d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Deseo Deshabilitar/Habilitar el Producto'
                    }).then((result) => {
                        if (result.isConfirmed) {

                           var authenticate = "{{$authenticate}}";
                            $.ajax({
                                data:  {id:id,authenticate:authenticate},
                                url:   '/api/update',
                                type:  'post',
                                beforeSend: function () { },
                                success:  function (response) {
                                    if(response.success != null){
                                        $("#update"+id).removeClass('btn-default').addClass('btn-success').find('span').text('Deshabilitar');
                                        $("#habilitado"+id).text('Producto Habilitado').css("color", "#5bc0de").css("font-weight", "bold");

                                    }else{
                                        $("#update"+id).removeClass('btn-success').addClass('btn-default').find('span').text('Habilitar ');
                                        $("#habilitado"+id).text('Producto desabilitado').css("color", "#d9534f").css("font-weight", "bold");

                                    }
                                    location.reload();
                                },
                                error:function(){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Tenemos un error, intente de nuevo ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            });
                            Swal.fire({
                                icon: 'success',
                                title: 'Su Producto fue Deshabilitado/Habilitardo, Puede Habilitarlo en Cualquier Momento',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    })
                }
                function destroy(id){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    Swal.fire({
                        title: 'Esta Seguro/a?',
                        text: "No Podrá Revertir Esto",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#00a6d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Deseo Eliminar el Producto'
                    }).then((result) => {
                        if (result.isConfirmed) {
                           var authenticate = "{{$authenticate}}";
                            $.ajax({
                                data:  {id:id,authenticate:authenticate},
                                url:   '/api/destroy',
                                type:  'post',
                                beforeSend: function () { },
                                success:  function (response) {
                                    //console.log("respuest:."+response);
                                    var request =JSON.parse(response);
                                    $("#tr"+request).hide("slow");
                                },
                                error:function(){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Tenemos un error, intente de nuevo ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            });
                            Swal.fire({
                                icon: 'success',
                                title: 'Su Publicación fue Eliminada No Podrá Reestablecerla',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    })
                }

            </script>
</body>

</html>
