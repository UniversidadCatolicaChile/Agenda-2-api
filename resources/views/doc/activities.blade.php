          <html>

          <head>
            <title>ACTIVITIES</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
          </head>

          <body>
            <div id='content'>
              <h1 id="get-apiv1activities"><code>GET</code> /api/v1/activities</h1>
              <h3 id="request">Request:</h3>
              <ul>
                <li>
                  <p>Headers: </p>
                  <ul>
                    <li>Ninguno</li>
                  </ul>
                </li>
                <li>
                  <p>Url Params:</p>
                  <table>
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Description</th>
                        <th>Requerido</th>
                        <th>default</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>from</td>
                        <td>fecha</td>
                        <td>Fecha desde para realizar búsqueda en formato <code>YYYYmmdd</code></td>
                        <td>No</td>
                        <td>Día actual</td>
                      </tr>
                      <tr>
                        <td>to</td>
                        <td>fecha</td>
                        <td>Fecha hasta para realizar búsqueda en formato <code>YYYYmmdd</code></td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>featured</td>
                        <td>integer</td>
                        <td>buscar por campo destacado, 1 si es destacado y 0 si no</td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>limit</td>
                        <td>integer</td>
                        <td>cantidad de actividades a solicitar, máximo 40 si el valor es mayor se seteara el por defecto que es 20</td>
                        <td>No</td>
                        <td>20</td>
                      </tr>
                      <tr>
                        <td>page</td>
                        <td>integer</td>
                        <td>página de resultados</td>
                        <td>No</td>
                        <td>1</td>
                      </tr>
                      <tr>
                        <td>audience</td>
                        <td>string</td>
                        <td>ids de tipos de público separados por coma</td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>organizers</td>
                        <td>string</td>
                        <td>ids de tipos de público separados por coma</td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>types<em>of</em>activities</td>
                        <td>string</td>
                        <td>ids de tipos de actividades separados por coma</td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>categories</td>
                        <td>string</td>
                        <td>ids de categorias separados por coma</td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>keywords</td>
                        <td>string</td>
                        <td>ids de keywords separados por coma</td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>title_content</td>
                        <td>string</td>
                        <td>texto para búsqueda en título y contenido</td>
                        <td>No</td>
                        <td>---</td>
                      </tr>
                      <tr>
                        <td>api_token</td>
                        <td>string</td>
                        <td>token obtenido luego de un login correcto</td>
                        <td>Si</td>
                        <td>---</td>
                      </tr>
                    </tbody>
                  </table>
                </li>
                <li>
                  <p>Body:</p>
                  <ul>
                    <li>
                      <p>Ninguno</p>
                    </li>
                  </ul>
                </li>
              </ul>
              <h3 id="response">Response:</h3>
              <ul>
                <li>
                  <p>Status: <strong>200</strong></p>
                </li>
                <li>
                  <p>Body:</p>
                </li>
              </ul>
              <pre><code class="json language-json">{
      "success": true,
      "limit": 10,
      "page": 1,
      "total_count": 2,
      "max_num_pages": 1,
      "activities": [
          {
              "id": 159,
              "featured": true,
              "title": "Prueba de Actividad una fecha",
              "created_at": "2020-01-22 20:58:03",
              "status": "publish",
              "slug": "prueba-de-actividad-una-fecha",
              "featured_image": {
                  "alt": "",
                  "mime_type": "2020-02-05 12:19:29",
                  "sizes": {
                      "normal": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-17.05.40.png",
                      "normal-width": 199,
                      "normal-height": 435,
                      "normal_not_croped": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-17.05.40.png",
                      "normal_not_croped-width": 469,
                      "normal_not_croped-height": 1027
                  }
              },
              "audience": [
                  {
                      "id": 6,
                      "name": "Universitarios"
                  }
              ],
              "organizers": [
                  {
                      "id": 8,
                      "name": "Arquitectura"
                  }
              ],
              "type": [
                  {
                      "id": 9,
                      "name": "Oratorio"
                  }
              ],
              "place": {
                  "name": "Ilogica",
                  "addres": "Girardi 1825, Ñuñoa, Región Metropolitana, Chile",
                  "coordinates": {
                      "lat": -33.45101410000001,
                      "lng": -70.6230406
                  },
                  "detail": ""
              },
              "dates": [
                  {
                      "day": "20200226",
                      "hours": [
                          {
                              "hora_inicio": "15:00",
                              "hora_termino": "16:00"
                          }
                      ]
                  }
              ]
          },
          {
              "id": 158,
              "featured": true,
              "title": "Actividad de prueba",
              "created_at": "2020-01-22 20:55:13",
              "status": "publish",
              "slug": "evento-de-prueba",
              "featured_image": {
                  "alt": "",
                  "mime_type": "2020-01-29 12:31:33",
                  "sizes": {
                      "normal": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/single-469x435.png",
                      "normal-width": 469,
                      "normal-height": 435,
                      "normal_not_croped": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/single-469x149.png",
                      "normal_not_croped-width": 469,
                      "normal_not_croped-height": 149
                  }
              },
              "audience": [
                  {
                      "id": 2,
                      "name": "General"
                  },
                  {
                      "id": 6,
                      "name": "Universitarios"
                  }
              ],
              "organizers": [
                  {
                      "id": 3,
                      "name": "Informatica"
                  }
              ],
              "type": [
                  {
                      "id": 7,
                      "name": "Película"
                  }
              ],
              "place": {
                  "name": "Universidad Católica",
                  "addres": "Av Libertador Bernardo O'Higgins 390, Santiago, Región Metropolitana, Chile",
                  "coordinates": {
                      "lat": -33.441441,
                      "lng": -70.64230189999999
                  },
                  "detail": ""
              },
              "dates": [
                  {
                      "day": "20200215",
                      "hours": [
                          {
                              "hora_inicio": "15:00",
                              "hora_termino": "18:00"
                          }
                      ]
                  }
              ]
          }
      ]
  }
  </code></pre>
              <p>Campos de la respuesta:</p>
              <table class="uc-table">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>success</td>
                    <td>boolean</td>
                    <td>indica si la consulta fue correcta o no</td>
                  </tr>
                  <tr>
                    <td>limit</td>
                    <td>integer</td>
                    <td>limite seteado en los parametros de la URL si es mayor a 40 se deja el default que es 20</td>
                  </tr>
                  <tr>
                    <td>page</td>
                    <td>integer</td>
                    <td>número de página que se esta viendo actualmente</td>
                  </tr>
                  <tr>
                    <td>total_count</td>
                    <td>integer</td>
                    <td>cantidad total de actividades encontradas</td>
                  </tr>
                  <tr>
                    <td>max_num_pages</td>
                    <td>integer</td>
                    <td>número máximo de páginas</td>
                  </tr>
                  <tr>
                    <td>activities</td>
                    <td>array</td>
                    <td>Actividades con la siguientes campos como estructura:

                      <table class="uc-table">
                        <thead>
                          <tr>
                            <th>Campo</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>id</td>
                            <td>integer</td>
                            <td>Identificador único de la actividad</td>
                          </tr>
                          <tr>
                            <td>featured</td>
                            <td>boolean</td>
                            <td>Indica si la actividad es destacada</td>
                          </tr>
                          <tr>
                            <td>title</td>
                            <td>string</td>
                            <td>Título de la actividad</td>
                          </tr>
                          <tr>
                            <td>created_at</td>
                            <td>datetime</td>
                            <td>Fecha de creación de la actividad</td>
                          </tr>
                          <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>estado de la actividad</td>
                          </tr>
                          <tr>
                            <td>slug</td>
                            <td>string</td>
                            <td>slug de la actividad</td>
                          </tr>
                          <tr>
                            <td>featured_image</td>
                            <td>array</td>
                            <td>datos de la imagen destacada de la actividad</td>
                          </tr>
                          <tr>
                            <td>audience</td>
                            <td>array</td>
                            <td>el/los tipos de publico(s)</td>
                          </tr>
                          <tr>
                            <td>organizers</td>
                            <td>array</td>
                            <td>el/los organizador(es)</td>
                          </tr>
                          <tr>
                            <td>type</td>
                            <td>array</td>
                            <td>arreglo de el/los tipo(s)</td>
                          </tr>
                          <tr>
                            <td>place</td>
                            <td>array</td>
                            <td>Datos de la ubicación, como dirección, nombre y coordenadas</td>
                          </tr>
                          <tr>
                            <td>dates</td>
                            <td>array</td>
                            <td>fechas del evento con horas asociadas a cada fecha</td>
                          </tr>
                        </tbody>
                      </table>

                    </td>
                  </tr>


                </tbody>
              </table>
              <hr />
              <h1 id="get-apiv1activitiesid"><code>GET</code> /api/v1/activities/<code>{id|slug}</code></h1>
              <h3 id="request-1">Request:</h3>
              <ul>
                <li>
                  <p>Headers: </p>
                  <ul>
                    <li>Ninguno</li>
                  </ul>
                </li>
                <li>
                  <p>Url Params:</p>
                  <ul>
                    <li><code>id</code>: como parte de la URL, puede ser el <code>id</code> o el <code>slug</code></li>
                    <li><code>api_token</code>: 36AkXVWbI8w1gvvUKzPPpUKzHnHyjSCsBu20qjuSvWfxeyHbRE9WJEC646hQCCKn85cH4D3r2VtL6o1U</li>
                  </ul>
                </li>
                <li>
                  <p>Body:<br />
                    No specific body attributes needed.</p>
                </li>
              </ul>
              <h3 id="response-1">Response:</h3>
              <ul>
                <li>
                  <p>Status: <strong>200</strong></p>
                </li>
                <li>
                  <p>Body:</p>
                </li>
              </ul>
              <pre><code class="json language-json">{
      "success": true,
      "activity": {
          "id": 159,
          "featured": true,
          "title": "Actividad de prueba",
          "content": "&lt;p&gt;Loremp ipsum&lt;/p&gt;\n",
          "created_at": "2020-01-22 20:55:13",
          "updated_at": "2020-02-05 12:19:07",
          "status": "publish",
          "slug": "evento-de-prueba",
          "featured_image": {
              "alt": "",
              "mime_type": "2020-01-29 12:31:33",
              "sizes": {
                  "normal": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/single-469x435.png",
                  "normal-width": 469,
                  "normal-height": 435,
                  "normal_not_croped": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/single-469x149.png",
                  "normal_not_croped-width": 469,
                  "normal_not_croped-height": 149
              }
          },
          "images": [
              {
                  "id": 149,
                  "title": "Captura de Pantalla 2020-01-09 a la(s) 17.05.40",
                  "alt": "",
                  "created_at": "2020-01-15 11:47:28",
                  "updated_at": "2020-02-05 12:19:29",
                  "mime_type": "2020-02-05 12:19:29",
                  "sizes": {
                      "normal": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-17.05.40.png",
                      "normal-width": 199,
                      "normal-height": 435,
                      "normal_not_croped": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-17.05.40.png",
                      "normal_not_croped-width": 469,
                      "normal_not_croped-height": 1027
                  }
              },
              {
                  "id": 148,
                  "title": "Captura de Pantalla 2020-01-09 a la(s) 20.44.34",
                  "alt": "",
                  "created_at": "2020-01-15 11:47:25",
                  "updated_at": "2020-01-22 20:56:17",
                  "mime_type": "2020-01-22 20:56:17",
                  "sizes": {
                      "normal": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-20.44.34.png",
                      "normal-width": 469,
                      "normal-height": 149,
                      "normal_not_croped": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-20.44.34.png",
                      "normal_not_croped-width": 469,
                      "normal_not_croped-height": 149
                  }
              },
              {
                  "id": 147,
                  "title": "Captura de Pantalla 2020-01-09 a la(s) 20.44.39",
                  "alt": "",
                  "created_at": "2020-01-15 11:47:23",
                  "updated_at": "2020-01-22 20:53:56",
                  "mime_type": "2020-01-22 20:53:56",
                  "sizes": {
                      "normal": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-20.44.39.png",
                      "normal-width": 469,
                      "normal-height": 337,
                      "normal_not_croped": "http://localhost/agenda-uc-api-v2/content/uploads/2020/01/Captura-de-Pantalla-2020-01-09-a-las-20.44.39.png",
                      "normal_not_croped-width": 469,
                      "normal_not_croped-height": 337
                  }
              }
          ],
          "contact_info": {
              "emails": [
                  "soporte@ilogica.cl"
              ],
              "phone_numbers": [
                  "+56988279182"
              ],
              "url":"http://www.google.cl"
          },
          "pricing_info": {
              "is_free": true,
              "url": "http://www.google.cl",
              "agreements": "&lt;p&gt;Loremp ipsum&lt;/p&gt;\n"
          },
          "audience": [
              {
                  "id": 2,
                  "name": "General"
              },
              {
                  "id": 6,
                  "name": "Universitarios"
              }
          ],
          "organizers": [
              {
                  "id": 3,
                  "name": "Informatica"
              }
          ],
          "type": [
              {
                  "id": 7,
                  "name": "Película"
              }
          ],
          "place": {
              "name": "Universidad Católica",
              "addres": "Av Libertador Bernardo O'Higgins 390, Santiago, Región Metropolitana, Chile",
              "coordinates": {
                  "lat": -33.441441,
                  "lng": -70.64230189999999
              },
              "detail": ""
          },
          "dates": [
              {
                  "day": "20200122",
                  "hours": [
                      {
                          "hora_inicio": "02:00",
                          "hora_termino": "06:00"
                      }
                  ]
              },
              {
                  "day": "20200124",
                  "hours": [
                      {
                          "hora_inicio": "05:00",
                          "hora_termino": "07:00"
                      }
                  ]
              },
              {
                  "day": "20200131",
                  "hours": [
                      {
                          "hora_inicio": "14:00",
                          "hora_termino": "16:00"
                      }
                  ]
              },
              {
                  "day": "20200215",
                  "hours": [
                      {
                          "hora_inicio": "15:00",
                          "hora_termino": "18:00"
                      }
                  ]
              }
          ]
      }
  }
  </code></pre>
              <p>Campos de la respuesta:</p>
              <table class="uc-table">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>success</td>
                    <td>boolean</td>
                    <td>indica si la consulta fue correcta o no</td>
                  </tr>
                  <tr>
                    <td>activity</td>
                    <td>json</td>
                    <td>Actividad con la siguientes campos como estructura:

                      <table class="uc-table">
                        <thead>
                          <tr>
                            <th>Campo</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>id</td>
                            <td>integer</td>
                            <td>Identificador único de la actividad</td>
                          </tr>
                          <tr>
                            <td>featured</td>
                            <td>boolean</td>
                            <td>Indica si la actividad es destacada</td>
                          </tr>
                          <tr>
                            <td>title</td>
                            <td>string</td>
                            <td>Título de la actividad</td>
                          </tr>
                          <tr>
                            <td>content</td>
                            <td>string - html</td>
                            <td>Descripción de la actividad</td>
                          </tr>
                          <tr>
                            <td>created_at</td>
                            <td>datetime</td>
                            <td>Fecha de creación de la actividad</td>
                          </tr>
                          <tr>
                            <td>updated_at</td>
                            <td>datetime</td>
                            <td>Fecha de actualizacion de la actividad</td>
                          </tr>
                          <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>estado de la actividad</td>
                          </tr>
                          <tr>
                            <td>slug</td>
                            <td>string</td>
                            <td>slug de la actividad</td>
                          </tr>
                          <tr>
                            <td>featured_image</td>
                            <td>array</td>
                            <td>datos de la imagen destacada de la actividad</td>
                          </tr>
                          <tr>
                            <td>images</td>
                            <td>array</td>
                            <td>imagenes de la actividad, donde encontraras datos como el alt y distintos tamaños</td>
                          </tr>
                          <tr>
                            <td>contact_info</td>
                            <td>array</td>
                            <td>Tiene tres elementos: 
                              <table>
                                <tr>
                                  <td>emails</td>
                                  <td>array</td>
                                  <td>listado de correos para contacto</td>
                                </tr>
                                <tr>
                                  <td>phone_numbers</td>
                                  <td>array</td>
                                  <td>listado de números de teléfono en formato <code>+56XXXXXXXXX</code></td>
                                </tr>
                                <tr>
                                  <td>url</td>
                                  <td>string</td>
                                  <td>URL de web de contacto</td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td>audience</td>
                            <td>array</td>
                            <td>el/los tipos de publico(s)</td>
                          </tr>
                          <tr>
                            <td>organizers</td>
                            <td>array</td>
                            <td>el/los organizador(es)</td>
                          </tr>
                          <tr>
                            <td>type</td>
                            <td>array</td>
                            <td>arreglo de el/los tipo(s)</td>
                          </tr>
                          <tr>
                            <td>place</td>
                            <td>array</td>
                            <td>Datos de la ubicación, como dirección, nombre y coordenadas</td>
                          </tr>
                          <tr>
                            <td>dates</td>
                            <td>array</td>
                            <td>fechas del evento con horas asociadas a cada fecha</td>
                          </tr>
                        </tbody>
                      </table>

                    </td>
                  </tr>


                </tbody>
              </table>
            </div>
            <style type='text/css'>
              body {
                font: 400 16px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
                color: #111;
                background-color: #fdfdfd;
                -webkit-text-size-adjust: 100%;
                -webkit-font-feature-settings: "kern"1;
                -moz-font-feature-settings: "kern"1;
                -o-font-feature-settings: "kern"1;
                font-feature-settings: "kern"1;
                font-kerning: normal;
                padding: 30px;
              }

              @mediaonlyscreenand (max-width: 600px) {
                body {
                  padding: 5px;
                }

                body>#content {
                  padding: 0px 20px 20px 20px !important;
                }
              }

              body>#content {
                margin: 0px;
                max-width: 900px;
                border: 1px solid #e1e4e8;
                padding: 10px 40px;
                padding-bottom: 20px;
                border-radius: 2px;
                margin-left: auto;
                margin-right: auto;
              }

              hr {
                color: #bbb;
                background-color: #bbb;
                height: 1px;
                flex: 0 1 auto;
                margin: 1em 0;
                padding: 0;
                border: none;
              }

              /**
   * Links
   */
              a {
                color: #0366d6;
                text-decoration: none;
              }

              a:visited {
                color: #0366d6;
              }

              a:hover {
                color: #0366d6;
                text-decoration: underline;
              }

              pre {
                background-color: #f6f8fa;
                border-radius: 3px;
                font-size: 85%;
                line-height: 1.45;
                overflow: auto;
                padding: 16px;
              }

              /**
    * Code blocks
    */

              code {
                background-color: rgba(27, 31, 35, .05);
                border-radius: 3px;
                font-size: 85%;
                margin: 0;
                word-wrap: break-word;
                padding: .2em .4em;
                font-family: SFMono-Regular, Consolas, Liberation Mono, Menlo, Courier, monospace;
              }

              pre>code {
                background-color: transparent;
                border: 0;
                display: inline;
                line-height: inherit;
                margin: 0;
                overflow: visible;
                padding: 0;
                word-wrap: normal;
                font-size: 100%;
              }


              /**
   * Blockquotes
   */
              blockquote {
                margin-left: 30px;
                margin-top: 0px;
                margin-bottom: 16px;
                border-left-width: 3px;
                padding: 0 1em;
                color: #828282;
                border-left: 4px solid #e8e8e8;
                padding-left: 15px;
                font-size: 18px;
                letter-spacing: -1px;
                font-style: italic;
              }

              blockquote * {
                font-style: normal !important;
                letter-spacing: 0;
                color: #6a737d !important;
              }

              /**
   * Tables
   */
              table {
                border-spacing: 2px;
                display: block;
                font-size: 14px;
                overflow: auto;
                width: 100%;
                margin-bottom: 16px;
                border-spacing: 0;
                border-collapse: collapse;
              }

              td {
                padding: 6px 13px;
                border: 1px solid #dfe2e5;
              }

              th {
                font-weight: 600;
                padding: 6px 13px;
                border: 1px solid #dfe2e5;
              }

              tr {
                background-color: #fff;
                border-top: 1px solid #c6cbd1;
              }

              table tr:nth-child(2n) {
                background-color: #f6f8fa;
              }

              /**
   * Others
   */

              img {
                max-width: 100%;
              }

              p {
                line-height: 24px;
                font-weight: 400;
                font-size: 16px;
                color: #24292e;
              }

              ul {
                margin-top: 0;
              }

              li {
                color: #24292e;
                font-size: 16px;
                font-weight: 400;
                line-height: 1.5;
              }

              li+li {
                margin-top: 0.25em;
              }

              * {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
                color: #24292e;
              }

              a:visited {
                color: #0366d6;
              }

              h1,
              h2,
              h3 {
                border-bottom: 1px solid #eaecef;
                color: #111;
                /* Darker */
              }
            </style>
          </body>

          </html>