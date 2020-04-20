# `POST` /api/v1/login/auth

### Request:

+ Headers:    
  + Ninguno

+ Url Params:
    No specific query parameters needed.

+ Body:
```
--__X_PAW_BOUNDARY__
Content-Disposition: form-data; name="email"

soporte@ilogica.cl
--__X_PAW_BOUNDARY__
Content-Disposition: form-data; name="password"

zxcv250..-ilogica
--__X_PAW_BOUNDARY__--

```

***


### Response:

+ Status: **200**

+ Body:
```json
{
    "success": true,
    "token": "36AkXVWbI8w1gvvUKzPPpUKzHnHyjSCsBu20qjuSvWfxeyHbRE9WJEC646hQCCKn85cH4D3r2VtL6o1U"
}
```
***