# `GET` /api/v1/events

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
    "total_count": 1,
    "max_num_pages": 1,
    "events": [
        {
            "id": 156,
            "title": "Eventos de Prueba",
            "created_at": "2020-01-22 19:26:52",
            "status": "publish",
            "activities": [
                158,
                159
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
```
***

# `GET` /api/v1/events/{id}

### Request:

+ Headers:    
    + Ninguno

+ Url Params:
    + `api_token`: 36AkXVWbI8w1gvvUKzPPpUKzHnHyjSCsBu20qjuSvWfxeyHbRE9WJEC646hQCCKn85cH4D3r2VtL6o1U

+ Body:
    No specific body attributes needed.

### Response:

+ Status: **200**

+ Body:
```json
{
    "success": true,
    "event": {
        "id": 156,
        "title": "Eventos de Prueba",
        "created_at": "2020-01-22 19:26:52",
        "status": "publish",
        "activities": [
            158,
            159
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
}
```