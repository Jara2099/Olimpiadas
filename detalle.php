<?php include("template/header.php") ?>
<style>
    body {
        background-image: url('img/w/fondo.jpg');
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-lg rounded-4 border-0" style="min-height: 900px;">
                <div class="card-body">
                    <h1 id="titulo" class="text-center mb-4 display-4 text-primary fw-bold">
                        <i class="bi bi-geo-alt-fill me-2"></i> Cargando...
                    </h1>

                    <div class="text-center mb-4">
                        <img id="imagen" src="" alt="Imagen destino"
                            class="img-fluid rounded shadow-lg border border-3 border-primary"
                            style="max-height: 350px; object-fit: cover; display:none; transition: opacity 0.5s ease-in-out;">
                    </div>

                    <h2 class="card-title text-primary border-bottom border-primary pb-2 mb-3">
                        <i class="bi bi-journal-text me-2"></i> Descripción
                    </h2>
                    <p id="descripciondetallada" class="card-text fs-5 text-secondary mb-4"></p>

                    <h3 class="card-title text-primary border-bottom border-primary pb-2 mb-4">
                        <i class="bi bi-list-ul me-2"></i> Actividades
                    </h3>
                    <ul id="listaactividades" class="list-group list-group-flush fs-5 mb-4"></ul>

                    <h3 class="card-title text-primary border-bottom border-primary pb-2 mb-3">
                        <i class="bi bi-geo-alt me-2"></i> Ubicación
                    </h3>
                    <p id="ubicacion" class="fs-5 text-secondary mb-4"></p>

                    <h3 class="card-title text-primary border-bottom border-primary pb-2 mb-3">
                        <i class="bi bi-cloud-sun me-2"></i> Clima
                    </h3>
                    <p id="clima" class="fs-5 text-secondary mb-4"></p>

                    <h3 class="card-title text-primary border-bottom border-primary pb-2 mb-3">
                        <i class="bi bi-truck me-2"></i> Accesibilidad
                    </h3>
                    <p id="accesibilidad" class="fs-5 text-secondary mb-4"></p>

                    <h3 class="card-title text-primary border-bottom border-primary pb-2 mb-3">
                        <i class="bi bi-exclamation-triangle me-2"></i> Consejos
                    </h3>
                    <ul id="consejos" class="list-group list-group-flush fs-5 mb-4"></ul>

                    <div class="d-grid">
                        <a id="btnComprar" href="#" class="btn btn-primary">Reservar Viaje</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getParam(param) {
        const params = new URLSearchParams(window.location.search);
        return params.get(param);
    }

    window.addEventListener('DOMContentLoaded', () => {
        const tituloElemento = document.getElementById("titulo");
        const btnComprar = document.getElementById("btnComprar");

        if (tituloElemento && btnComprar) {
            const nombreDestino = tituloElemento.textContent.trim();
            btnComprar.href = `comprar_boleto.php?titulo=${encodeURIComponent(nombreDestino)}`;
        }
    });
</script>
<?php include("template/footer.php") ?>