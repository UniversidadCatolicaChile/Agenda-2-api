<html>

<head>
  <title>FESTIVALS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div id='content'>
    <h1 id="get-apiv1festivals"><code>GET</code> /api/v1/festivals</h1>
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
            <li>Ninguno</li>
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
    "total_count": 1,
    "max_num_pages": 1,
    "festivals": [
        {
            "id": 174,
            "title": "Viña del Mar",
            "created_at": "2020-01-29 18:24:47",
            "status": "publish",
            "events": [
                156
            ],
            "dates": [
                {
                    "day": "20200215",
                    "hours": [
                        {
                            "hora_inicio": "15:00",
                            "hora_termino": "18:00"
                        }
                    ]
                },
                {
                    "day": "20200226",
                    "hours": [
                        {
                            "hora_inicio": "15:00",
                            "hora_termino": "16:00"
                        }
                    ]
                }
            ],
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
            }
        }
    ]
}
</code></pre>

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

    @mediaonly screen and (max-width: 600px) {
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