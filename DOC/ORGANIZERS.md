# `GET` /api/v1/organizers

*Listado de organizadores existentes el la API*

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
    "organizers": [
        {
            "term_id": 8,
            "name": "Arquitectura",
            "slug": "arquitectura",
            "term_group": 0,
            "term_taxonomy_id": 8,
            "taxonomy": "organizador",
            "description": "",
            "parent": 0,
            "count": 1,
            "filter": "raw"
        },
        {
            "term_id": 3,
            "name": "Informatica",
            "slug": "informatica",
            "term_group": 0,
            "term_taxonomy_id": 3,
            "taxonomy": "organizador",
            "description": "",
            "parent": 0,
            "count": 1,
            "filter": "raw"
        }
    ],
    "success": true
}
```