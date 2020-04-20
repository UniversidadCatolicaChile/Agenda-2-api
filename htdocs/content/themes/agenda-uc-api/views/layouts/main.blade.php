<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://kit-digital-uc-desa.s3.amazonaws.com/uc-kitdigital.css">
    @head
</head>
<body @php(body_class())>
  <header class="uc-header">
    <div class="uc-top-bar">
      <div class="container">
        <div class="top-bar_mobile-logo d-block d-lg-none">
          <img src="https://kit-digital-uc-desa.s3.amazonaws.com/img/logo-uc-comprimido.svg" alt="Logo UC" class="img-fluid">
        </div>
        <div class="top-bar_links justify-content-between d-none d-lg-flex">
          <ul class="top-bar_links">
            <li>
              <a href="http://uc.cl/" target="_blank" class="text-size--sm external">
                ir al sitio UC
              </a>
            </li>
          </ul>
          <ul class="top-bar_links">
            <li>
              <a href="http://bibliotecas.uc.cl/" target="_blank" class="text-size--sm external">
                Biblioteca
              </a>
            </li>
            <li>
              <a href="https://donaciones.uc.cl/" target="_blank" class="text-size--sm external">
                Donaciones
              </a>
            </li>
            <li>
              <a href="https://sso.uc.cl/cas/login" target="_blank" class="text-size--sm external">
                Mi Portal UC
              </a>
            </li>
            <li>
              <a href="https://correo.uc.cl" target="_blank" class="text-size--sm external">
                Correo
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <nav class="uc-navbar navbar-dark">
      <!-- Menú para versión Escritorio -->
      <div class="container d-none d-lg-block">
        <div class="row align-items-center">
          <div class="col-lg-3">
            <img src="https://dummyimage.com/300x80/edeaed/0076de.png" alt="Logo" class="img-fluid">
          </div>
          <div class="col-lg-9 text-right">
            <div class="p-text--condensed color-white">Slogan de la marca (Alineado a la derecha)</div>
          </div>
        </div>
        <ul class="uc-navbar_nav">
          <li class="nav-item">
            <a href="#" class="uc-btn btn-inline">Item 1</a>
          </li>
          <li class="nav-item">
            <a href="#" class="uc-btn btn-inline">Item 2</a>
          </li>
          <li class="nav-item">
            <a href="#" class="uc-btn btn-inline">Item 3</a>
          </li>
          <li class="nav-item">
            <a href="#" class="uc-btn btn-inline">Item 4</a>
          </li>
          <li class="nav-item">
            <a href="#" class="uc-btn btn-inline">Item 5</a>
          </li>
          <li class="nav-item">
            <a href="#" class="uc-btn btn-inline">Item 6</a>
          </li>
        </ul>
      </div>
      <!-- Menú para versión Móvil -->
      <div class="uc-navbar_mobile d-block d-lg-none">
        <div class="uc-navbar_mobile-bar navbar-brand">
          <div class="uc-navbar_mobile-logo navbar-light">
            <img src="https://dummyimage.com/260x75/edeaed/0076de.png" alt="Logo" class="img-fluid">
          </div>
          <a href="javascript:void(0);" class="uc-navbar_mobile-button" data-collapse="collapseMobileNav6">
            <span class="uc-icon"></span>
            Menú
          </a>
        </div>
        <div class="uc-navbar_mobile-content" data-toggle="collapseMobileNav6" data-open="false" style="height: 0;">
          <div class="uc-navbar_mobile-list">
            <a href="#" class="list-item">Item 1</a>
            <a href="#" class="list-item">Item 2</a>
            <a href="#" class="list-item">Item 3</a>
            <a href="#" class="list-item">Item 4</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <div class="container">
    @yield('content')
  </div>
  <footer class="uc-footer">
      <div class="container pb-80">
          <div class="row no-gutters" data-accordion>
              <div class="col-lg-3">
                  <div class="mb-40">
                      <a href="/" class="nabvar-brand">
                          <img src="/logo-uc-wh.svg" alt="" class="img-fluid">
                      </a>
                      <p class="my-24 mr-28">Avda. Libertador Bernando O’Higgins 340, Santiago - Chile</p>
                      <a href="#">¿Cómo llegar?</a>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="uc-footer_list-title footer-collapse-title" data-collapse="footerNavExample01">
                      La universidad
                  </div>
                  <ul class="uc-footer_list footer-collapse" data-toggle="footerNavExample01">
                      <li><a href="#">Programas de estudio</a></li>
                      <li><a href="#">Investigación</a></li>
                      <li><a href="#">Investigación</a></li>
                      <li><a href="#">Extensión</a></li>
                      <li><a href="#">La Universidad</a></li>
                      <li><a href="#">Código de Honor</a></li>
                      <li><a href="#">Donaciones</a></li>
                      <li><a href="#">Admisión</a></li>
                  </ul>
              </div>
              <div class="col-lg-4">
                  <div class="uc-footer_list-title footer-collapse-title" data-collapse="footerNavExample02">
                      Servicios
                  </div>
                  <ul class="uc-footer_list footer-collapse" data-toggle="footerNavExample02">
                      <li><a href="#">Red Salud UC</a></li>
                      <li><a href="#">Validación de Certificados</a></li>
                      <li><a href="#">Pago de Matrículas</a></li>
                      <li><a href="#">Pago de Créditos</a></li>
                      <li><a href="#">Trabaja en la UC</a></li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="uc-footer_help">
          <div class="container">
              <div class="row">
                  <div class="col-md-3">
                      <div class="uc-footer_list-title">
                          Mesa central
                      </div>
                      <p>Teléfono para comunicarse con las distintas áreas de la Universidad.</p>
                      <p><i class="uc-icon">phone</i> <a href="#">(56)22354 4000</a></p>
                  </div>
                  <div class="col-md-3">
                      <div class="uc-footer_list-title">
                          emergencias uc
                      </div>
                      <p>En caso de accidente o situacón que ponga en riesgo tu vida dentro de los campus</p>
                      <p><i class="uc-icon">phone</i> <a href="#">(56)22354 5000</a></p>
                  </div>
                  <div class="col-md-3">
                      <div class="uc-footer_list-title">
                          violencia sexual
                      </div>
                      <p>Para denuncias, asesoría o acompañamiento en casos de violencia sexual</p>
                      <p><i class="uc-icon">phone</i> <a href="#">(56)95814 5614</a></p>
                  </div>
                  <div class="col-md-3">
                      <img src="dist/images/social-footer.svg" alt="" class="mb-3">
                      <ul class="uc-footer_list">
                          <li><a href="#">Políticas de Privacidad</a></li>
                          <li><a href="#">Mapa del sitio</a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <script src="https://kit-digital-uc-desa.s3.amazonaws.com/uc-kitdigital.js"></script>
@footer

</body>
</html>
