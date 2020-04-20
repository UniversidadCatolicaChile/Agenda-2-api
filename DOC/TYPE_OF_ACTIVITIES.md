# `GET` /api/v1/types_of_activities

*Listado de tipos de actividades existentes el la API*

### Request:

+ Headers:
  + Ninguno


+ Url Params:
  + `api_token`: 36AkXVWbI8w1gvvUKzPPpUKzHnHyjSCsBu20qjuSvWfxeyHbRE9WJEC646hQCCKn85cH4D3r2VtL6o1U


+ Body:
  + Ninguno

***


### Response:

+ Status: **200**

+ Body:
```json
{
    "types_of_activities": [
        {
            "term_id": 9,
            "name": "Oratorio",
            "slug": "oratorio",
            "term_group": 0,
            "term_taxonomy_id": 9,
            "taxonomy": "tipo",
            "description": "",
            "parent": 0,
            "count": 1,
            "filter": "raw"
        },
        {
            "term_id": 7,
            "name": "Película",
            "slug": "pelicula",
            "term_group": 0,
            "term_taxonomy_id": 7,
            "taxonomy": "tipo",
            "description": "",
            "parent": 0,
            "count": 1,
            "filter": "raw"
        }
    ],
    "success": true
}
```