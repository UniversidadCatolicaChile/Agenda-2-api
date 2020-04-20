# `GET` /api/v1/activities

### Request:

+ Headers:    
  + Ninguno


+ Url Params:
    
    | Nombre  | Tipo | Description   |  Requerido | default |
    |---|---|---|---|---|
    |from| fecha  |  Fecha desde para realizar búsqueda en formato `YYYYmmdd`   | No |Día actual|
    |to|fecha| Fecha hasta para realizar búsqueda en formato `YYYYmmdd`|No|---|
    |featured|integer| buscar por campo destacado, 1 si es destacado y 0 si no  |No|---|
    |limit|integer| cantidad de actividades a solicitar, máximo 40 si el valor es mayor se seteara el por defecto que es 20  |No|20|
    |page|integer| página de resultados  |No|1|
    |audience|string| ids de tipos de público separados por coma  |No|---|
    |organizers|string| ids de tipos de público separados por coma  |No|---|
    |types_of_activities|string| ids de tipos de actividades separados por coma  |No|---|
    |categories|string| ids de categorias separados por coma  |No|---|
    |api_token|string| token obtenido luego de un login correcto  |Si|---|


+ Body: 
  + Ninguno

### Response:

+ Status: **200**

+ Body:
```json
{
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
```
***
# `GET` /api/v1/activities/`{id|slug}`
### Request:

+ Headers:    
    + Ninguno

+ Url Params:
  + `id`: como parte de la URL, puede ser el ID o el SLUG
  + `api_token`: 36AkXVWbI8w1gvvUKzPPpUKzHnHyjSCsBu20qjuSvWfxeyHbRE9WJEC646hQCCKn85cH4D3r2VtL6o1U


+ Body:
    No specific body attributes needed.

### Response:

+ Status: **200**

+ Body:
```json
{
    "success": true,
    "activity": {
        "featured": true,
        "title": "Actividad de prueba",
        "content": "<p>Loremp ipsum</p>\n",
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
            ]
        },
        "pricing_info": {
            "is_free": true,
            "url": "http://www.google.cl",
            "agreements": "<p>Loremp ipsum</p>\n"
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
```