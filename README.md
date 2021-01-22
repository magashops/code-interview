Tu objetivo hoy es crear un endpoint que cumpla con lo definido.

_Esta es la especificacion del endpoint:_

**endpoint:** /api/product

**method:** POST

**body:**

```json
{
    "name": "string",
    "description": "string",
    "provider": "string",
    "price": "float",
    "size": {
        "x": "int",
        "y": "int"
    },
    "activation_date": "ATOM"
}
```

El cuerpo de la peticion seguira las siguiente reglas:

- Todos los campos son obligatorios
- Se tiene que validar que el valor de los campos sea del tipo correcto
- En caso de que el proveedor sea "home" se añadira al nombre el sufijo "de HOME" en caso de que no lo tenga.
- Las medidas de un colchon vienen en centimetros y no supera en ninguno de los lados los 200 cm

Una vez realizadas las validaciones y modificaciones correspondientes tenemos que responder en formato JSON la siguiente
informacion:

```json
{
    "name": "string",
    "price": "float",
    "activation_date": "ATOM"
}
```

Por ultimo ejecuta los tests para validar el correcto funcionamiento de la aplicacion
