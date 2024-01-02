<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')
<style>
    .ServiceSection:hover,
    .PackagesSection:hover,
    .texto_servicio:hover,
    .texto_paquete:hover {
        background-color: #F2761D;
        color: #fff;
        transition: background-color 0.3s ease;
    }
    .PackagesSection{
        margin: 54px 0px;

    }




    .texto_paquete, .texto_servicio {
        margin: 30px;
        padding: 10px;
        text-decoration: none;
        border: 1px solid #000;
        transition: background-color 0.3s, color 0.3s;
        transition: background-color 0.3s ease;
        padding:20px;
        border-radius: 20px; /* Radio de las esquinas */;
    }
    .texto_paquete:hover, .texto_servicio:hover {
        background-color: #F2761D;
        color: #fff;
        padding:20px;
        border-radius: 20px; /* Radio de las esquinas */;
    }
    
</style>






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
             
                                 <div class="form-group" style="text-align:center;">
                                 <a href="javascript:void(0);" onclick="showSection('includePackagesSection')" class="texto_paquete" style="margin:30px 30px; color:black;">Include Packages  (Select Created Packages) </a> 
                                 <a href="javascript:void(0);" onclick="showSection('includeServicesSection')" class="texto_servicio"style="margin:30px 30px; color:black;">Include Services (Create Custom Package) </a> 

                                 <form action="{{ route('user.sendRequest', $userId) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


                                    <div id="includePackagesSection" class="form-group includePackagesSection" style="text-align:center;">
                                    @if (count($allPackages) > 0)



                                        @foreach ($allPackages as $package)
                                            <div id="PackagesSection" class="container PackagesSection" style="padding:30px;" >                                          <br> 
                                            <br> 
                                                
                                                                    <tr>
                                                                    
                                                                        <h2> {{$package->name}}</h2>

                                                                        <br> 
                                                                        Description:    {{$package->description}} <br>
                                                                    
                                                                        <h4>Included Services:</h4>
                                                                        <td>
                                                                            <ul>
                                                                            
                                                                                @foreach($package->services as $service)
                                                                                {{ $service->name }} -
                                                                                Quantity: {{ $service->pivot->quantity }}<br>
                                                            
                                                                            
                                                                                @endforeach
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                        <input type="number" name="package_quantity[{{ $package->id }}]" placeholder="Quantity" value=""  class="quantity-input">
                                                        Add Package <input type="checkbox" name="packages[]" value="{{ $package->id }}" id="package_{{ $package->id }}">


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
                    
    

                            @foreach($serviceRequest->services as $service)
                                    <div class="container ServiceSection" style="padding:30px;" >                                          <br> 
                                            <h2> {{ $service->name }}</h2>

                                           
                                            Description: {{ $service->description }} <br> <br>
                                            <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="{{ $service->pivot->service_quantity }}"  class="quantity-input">
                                            Add Service <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" checked>

                                    </div>
                                @endforeach

                               
                            @else
                               <p>No hay Servicios disponibles.</p>
                            @endif
                            @foreach($allServices as $availableService)
                                @if (!$serviceRequest->services->contains($availableService->id))
                                <div class="container ServiceSection" style="padding:30px;" >                                          <br> 
                                            <h2>{{ $availableService->name }} //</h2>

                                           
                                            Description: {{ $availableService->description }} <br> <br>
                                            <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="" class="quantity-input">
                                            Add Service <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_checkbox_{{ $availableService->id }}">

                                    </div>

                                @endif
                            @endforeach                            
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
@endsection








