# `GET` /api/v1/categories

*Listado de categorias existentes el la API*

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
    "categories": [
        {
            "term_id": 1,
            "name": "Sin categoría",
            "slug": "sin-categoria",
            "term_group": 0,
            "term_taxonomy_id": 1,
            "taxonomy": "category",
            "description": "",
            "parent": 0,
            "count": 1,
            "filter": "raw"
        }
    ],
    "success": true
}
```