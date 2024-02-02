<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')
<style>

</style>



<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">



<div class="card shadow">

        <div class="card-body">
           <h1> Your Woof adventure begins here </h1>  <h3>Choose any of the following options to start enjoying Woof, and we'll contact you right away.</h3>
            @if($errors->any())
            @foreach($errors ->all() as $error)
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please!!</strong> {{$error}}
            </div>
            @endforeach
            @endif
        </div>
        <div class="container" >
    <div class="container-dialog" role="document">
        <div class="container-content" style="width:100%">

            <div class="container">

        
                <div class="container d-block" style="justify-content: space-evenly;">
             
                                 <div class="container botonespaquetes text-center">
                                    <div class="row">
                                        <div class="container col-6 d-flex">
                                            <a href="javascript:void(0);" onclick="showSection('includePackagesSection')" class="texto_paquete" style="margin:30px 30px; color:black;">Include Packages  (Select Created Packages) </a> 
                                        </div>
                                        <div class="container col-6 d-flex">
                                            <a href="javascript:void(0);" onclick="showSection('includeServicesSection')" class="texto_servicio"style="margin:30px 30px; color:black;">Include Services (Create Custom Package) </a> 
                                        </div>
                                    </div>
                                </div>                                    

                                 <form action="{{ route('user.sendRequest', $userId) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


                                    <div id="includePackagesSection" class="form-group includePackagesSection" style="text-align:center;">
                                    @if (count($allPackages) > 0)



                                        @foreach ($allPackages as $package)
                                            <div id="PackagesSection" class="container PackagesSection" style="padding:10px;" >                                
                                            
                                                
                                                                    <tr>
                                                                    
                                                                        <h2> {{$package->name}}</h2>

                                                                        <br> 
                                                                        <strong>Description:</strong>  <br>  {{$package->description}} <br>
                                                                    
                                                                        <strong>Included Services:</strong>
                                                                        <td>
                                                                            <ul>
                                                                            
                                                                                @foreach($package->services as $service)
                                                                                {{ $service->name }} -
                                                                                Quantity: {{ $service->pivot->quantity }}<br>
                                                                                
                                                            
                                                                            
                                                                                @endforeach

                                                                               
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                        <input type="number" name="package_quantity[{{ $package->id }}]" placeholder="Quantity" value=""  class="quantity-input d-none"> 

                                                        <strong>Package price:</strong>  $ {{ $package->price }} (xUnit)<br><br>

                                                        Add Package <input type="checkbox" name="packages[]" value="{{ $package->id }}" id="package_{{ $package->id }}" ><br><br>



                                                </div>


                                            <hr>
                                            
                                        @endforeach
                                    </div>
                                @else

                                 <p>No hay paquetes disponibles.</p>
                                 @endif
                    </div>
                    <div id="includeServicesSection" class="form-group" style="text-align:center;">
                                                 
                            @if (count($allServices) > 0)
                    
      



                                    @foreach ($allServices as $service)
                                    <div class="container ServiceSection" style="padding:10px;" >                                    
                                            <h2> {{ $service->name }}</h2>

                                           
                                            <strong> Description: </strong> {{ $service->description }} <br> <br>
                                            <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="" class="quantity-input"> <br><br>

                                            <strong>Service price:</strong>  $ {{ $service->price }} (xUnit)<br> <br>

                                            Add Service <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}"><br><br>

                                    </div>
                                    @endforeach

                               
                            @else
                               <p>No hay Servicios disponibles.</p>
                            @endif
                    </div>        
               
                                    </div>
                                    <div class="container d-block" style="text-align:center">
                                        <input name="comment" placeholder="Make a comment" type="text"  style="width:80%; height 15h; border-radius:3px; padding:30px"><br>
                                        <button type="submit" class="btn btn-sm btn-primary w-20" style="margin: 14px 0px;">Send Request</button>
                                    </div>
                                </form>
                               
            </div>
        </div>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>

        showSection("includeServicesSection");

        function showSection(sectionId) {
            // Oculta todas las secciones
            document.getElementById('includePackagesSection').style.display = 'none';
            document.getElementById('includeServicesSection').style.display = 'none';

            // Muestra la sección correspondiente al ID recibido como parámetro
            document.getElementById(sectionId).style.display = 'block';

            // Declara e inicializa las variables antes de acceder a sus propiedades
            var textoPaquete = document.getElementsByClassName('texto_paquete')[0];
            var textoServicio = document.getElementsByClassName('texto_servicio')[0];

            // Cambia el color del texto y del fondo para reflejar la sección activa
            if (sectionId == "includePackagesSection") {
                textoPaquete.style.color = '#fff';
                textoPaquete.style.backgroundColor = "#F2761D";
                textoServicio.style.backgroundColor = "#fff";
                textoServicio.style.color = 'black'; // Cambia el color del otro enlace
            } else if (sectionId == "includeServicesSection") {
                textoServicio.style.color = 'white';
                textoServicio.style.backgroundColor = "#F2761D";
                textoPaquete.style.backgroundColor = "#fff";
                textoPaquete.style.color = 'black'; // Cambia el color del otro enlace
            }
        }
</script>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"][name^="packages"]').change(function () {
            var packageId = $(this).attr('id').split('_')[1];
            var quantityInput = $('input[name="package_quantity[' + packageId + ']"]');

            if ($(this).prop('checked')) {
                quantityInput.val(1);
            } else {
                quantityInput.val('');
            }
        });
    });
</script>
@endsection








