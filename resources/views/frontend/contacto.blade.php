<x-layout title="Contacto">

    <div class="container my-5">
        <h1 class="text-center mb-5">Ponete en contacto con nosotros</h1>

        <div class="row g-4">

            <div class="col-md-7">
                <form action="/contacto" method="POST" class="border p-4 rounded shadow-sm bg-white h-100">
                    @csrf
                    
                    <h4 class="mb-4">Escribí tu mensaje</h4>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre y apellido</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" class="form-control" id="correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" name="motivo" class="form-control" id="motivo" required>
                    </div>

                    <div class="mb-3">
                        <label for="consulta" class="form-label">Consulta</label>
                        <textarea name="consulta" class="form-control" id="consulta" rows="4" required></textarea>
                    </div>

                    <div class="text-end mt-4">
                        <input class="btn btn-primary px-4" type="submit" value="Enviar consulta">
                    </div>
                </form>
            </div>

            <div class="col-md-5">
                <div class="bg-dark text-white p-4 rounded h-100 border d-flex flex-column justify-content-center">
                    
                    <div class="text-center mb-3">
                        <img src="{{ asset('img/logo1.png') }}" alt="Logo Viñas del Taragüí" class="img-fluid" style="max-height: 120px;">
                    </div>

                    <h4 class="mb-4 text-center border-bottom pb-2">Nuestros Datos</h4>
                    
                    <ul class="list-unstyled fs-5 ms-3"> 
                        <li class="mb-4">
                            📍 <strong>Dirección:</strong><br> 
                            <span class="text-white-50">San Juan 1567, Corrientes.</span>
                        </li>
                        <li class="mb-4">
                            📞 <strong>Teléfono:</strong><br> 
                            <span class="text-white-50">+54 379 4123456</span>
                        </li>
                        <li class="mb-4">
                            ✉️ <strong>Correo:</strong><br> 
                            <span class="text-white-50">contacto@vinas.com</span>
                        </li>
                    </ul>

                    <div class="d-flex justify-content-start gap-4 mt-4 ms-3">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fa-brands fa-facebook-f fs-4"></i>
                        </a>
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fa-brands fa-instagram fs-4"></i>
                        </a>
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fa-solid fa-location-dot fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div> </div>
    <div class="container my-4">
  <div class="ratio ratio-16x9">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d884.9537008653035!2d-58.83802293047758!3d-27.475024408675147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456c98f5b367a9%3A0x3cb2476a3e14bb6a!2sSan%20Juan%201567%2C%20W3400%20CBV%2C%20Corrientes!5e0!3m2!1ses-419!2sar!4v1776776503567!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      allowfullscreen>
    </iframe>
  </div>
</div>
</x-layout>