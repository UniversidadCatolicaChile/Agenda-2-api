# `GET` /api/v1/audiences

*Listado de públicos a los que va dirigido existentes el la API*

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
    "audiences": [
        {
            "term_id": 2,
            "name": "General",
            "slug": "general",
            "term_group": 0,
            "term_taxonomy_id": 2,
            "taxonomy": "publico",
            "description": "",
            "parent": 0,
            "count": 1,
            "filter": "raw"
        },
        {
            "term_id": 6,
            "name": "Universitarios",
            "slug": "universitarios",
            "term_group": 0,
            "term_taxonomy_id": 6,
            "taxonomy": "publico",
            "description": "",
            "parent": 0,
            "count": 2,
            "filter": "raw"
        }
    ],
    "success": true
}
```
***