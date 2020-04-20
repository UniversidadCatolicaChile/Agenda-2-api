@extends('layouts.main')

@section('content')
<section class="mt-60">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="mb-32">{{$post->post_title}}</h1>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <hr class="uc-hr mb-60">
        <div class="row">
          <div class="col-lg-4">
            @if ($fields['imagen_principal'])
              <img src="{{$fields['imagen_principal']['sizes']['normal']}}" alt="{{$fields['imagen_principal']['alt']}}" style="width: 100%;">
            @endif
          </div>
          <div class="col-lg-8">
            <!--
            <?php print_r($fields); ?>
            -->
            <div class="body-article">
              {!! $fields['descripcion'] !!}
            </div>
          </div>
        </div>
        <div class="row my-80">
          <div class="col-lg-12">
            <!--iframe width="100%" height="450" frameborder="0" src="https://maps.google.com/maps?q=-33.44120148383754,-70.64026063173827&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=&amp;output=embed" allowfullscreen="allowfullscreen"
              style="border: 0px;">
            </iframe-->
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="uc-card">
          <div class="uc-card_body--lg">
            <h3 class="mb-8"><span>Fechas</span></h3>
            <div class="uc-table-list">
              <ul class="uc-table-list_content">
                @foreach ($dates as $key => $value)
                  <li>{{date_i18n('d \d\e F \d\e Y', strtotime($value['day']))}}</li>
                @endforeach
              </ul>
            </div>
            <span class="uc-subtitle">
              <i class="uc-icon icon-color--gray icon-size--sm">location_on</i>
              Lugar
            </span> 
            <a href="/agenda/?lugar=390">
              Texto Lugar
            </a> 
            
            <span class="uc-subtitle mt-24">
              <i class="uc-icon icon-color--gray icon-size--sm">local_play</i>
              Valor
            </span>
            <p class="no-margin">Entrada liberada previa inscripción</p> 
            
            <span class="uc-subtitle mt-24">
              <i class="uc-icon icon-color--gray icon-size--sm">account_circle</i>
              Dirigido a
            </span>
            @foreach ($audiences as $key => $value)
            <p class="no-margin">{{$value['name']}}</p>  
            @endforeach
            <div>
              <div class="uc-subtitle mt-24 mb-12">
                <i class="uc-icon icon-color--gray icon-size--sm">label</i>
                Etiquetas
              </div>
              <div>
                @foreach ($types as $key => $value)
                  <a href="https://www.uc.cl/agenda/agenda/?tipo={{$value['id']}}" class="uc-tag">{{$value['name']}}</a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <!--div class="mt-32">
          <a href="https://www.google.com/calendar/render?action=TEMPLATE&amp;text=Charla Astronomía para las tardes de verano: Formando planetas habitables&amp;details=&amp;location=Casa Central&amp;dates=20200130T184500/20200130T200000" target="_blank" class="uc-btn btn-primary ">
            Añadir a mi calendario
            <i class="uc-icon">calendar_today</i>
          </a>
        </div-->
        <div class="uc-card mt-32">
          <div class="uc-card_body">
            <div class="uc-subtitle color-black">CONTACTO DEL EVENTO</div>
            <hr class="uc-hr my-24"> <span class="uc-subtitle"><i class="uc-icon icon-color--gray">person</i>
              Organiza
            </span> 
            @foreach ($organizers as $key => $value)
              <a href="https://www.uc.cl/agenda/?organizador={{$value['id']}}">{{$value['name']}} </a>
            @endforeach

            <p style="word-break: break-word;"></p> 
            @if (!empty($fields['informacion_de_contacto']['telefonos']))
              @foreach ($fields['informacion_de_contacto']['telefonos'] as $key => $tel)
                <a href="tel:+56{{$tel['telefono']}}" class="link-inline">{{$tel['telefono']}}</a> 
              @endforeach
            @endif

            @if (!empty($fields['informacion_de_contacto']['emails']))
              @foreach ($fields['informacion_de_contacto']['emails'] as $key => $mail)
                <a href="mailto:{{$mail['email']}}" class="link-inline">{{$mail['email']}}</a> 
              @endforeach
            @endif

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <div>
            <div class="row">
              <div class="col-lg-12 mb-36">
                <div>
                  <div id="section-cultura" class="heading-container mb-36">
                    <h3>Actividades</h3>
                    <div class="uc-heading-decoration"></div>
                  </div>
                </div>
              </div>
              @foreach ($activities as $activity)
                <div class="mb-60 col-lg-4">
                  <div class="uc-card card-type--event card-height--same">
                    <div class="uc-card card-type--date">
                      <div class="day"><span>{{date_i18n('d', strtotime($activity['dates'][0]['day']))}}</span></div>
                      <div class="month"><span>{{date_i18n('M', strtotime($activity['dates'][0]['day']))}}.</span></div>
                    </div>
                    <div class="uc-card_body">
                      <a href="https://www.uc.cl/agenda/?tipo={{$activity['type'][0]['id']}}" class="uc-tag my-20">{{$activity['type'][0]['name']}}</a> 
                      <a href="https://www.uc.cl/agenda/{{$activity['slug']}}" title="{{$activity['title']}}" class="h3 color-black uc-btn">
                        {{$activity['title']}}
                      </a>
                      <div class="uc-card_event--content">
                        <div class="date"><span>{{date_i18n('d \d\e F \d\e Y', strtotime($activity['dates'][0]['day']))}}</span></div>
                        @foreach ($activity['dates'][0]['hours'] as $hour)
                          <div class="time">{{$hour['hora_inicio']}} a {{$hour['hora_termino']}} horas</div>
                        @endforeach
                        <div class="venue">{{$activity['place']['name']}}</div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
          </div>
        </div>
    </div>
  </div>
</section>
@endsection