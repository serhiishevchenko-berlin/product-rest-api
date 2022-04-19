# Products REST API

## Technologies

As the base I choose to use Codeigniter 3

## Structure

The main functionality is implemented in the following files:

Routing for the app
`application/config/routes.php`

Controller and request handling
`application/controllers/ProductController.php`

Data loader(loading the products and prices)
`application/libraries/ProductLoader.php`

Model - handling the logic of working with data
`application/models/Products_model.php`

App config
`application/config/app_config.php`

## How to run

In order to run this application you need to have installed php on your laptop
The easiest way to run would be to use php built it server, then you can run it by executing a following command for the root dir of the application

```
cd htdocs && php -S localhost:8088
```

After that you can access this application via http://localhost:8088

## Implemented endpoints

### List all products with their master data

Request:

```
http://localhost:8088/products
```

Response

```
[
  {
    "name": "Banana",
    "description": "some description ",
    "sku": "BA-01",
    "id": "43b105a0-b5da-401b-a91d-32237ae418e4"
  },
  {
    "name": "Tomato",
    "description": "some description",
    "sku": "TO-02",
    "id": "b867525e-53f8-4864-8990-5f13a5dd9d14"
  }
]
```


### Show a single product with master data and all available prices

Request:

```
http://localhost:8088/products/b867525e-53f8-4864-8990-5f13a5dd9d14
```

Response

```
{
  "name": "Tomato",
  "description": "some description",
  "sku": "TO-02",
  "id": "b867525e-53f8-4864-8990-5f13a5dd9d14",
  "prices": [
    {
      "id": "TO-02",
      "price": {
        "value": 4.01,
        "currency": "EUR"
      },
      "unit": "piece"
    },
    {
      "id": "TO-02",
      "price": {
        "value": 32.18,
        "currency": "EUR"
      },
      "unit": "package"
    }
  ]
}
```

### Show a single product price for one product and specific unit

#### Prices for package unit

Request:

```
http://localhost:8088/products/b867525e-53f8-4864-8990-5f13a5dd9d14/prices?unit=package
```

Response

```
[
  {
    "id": "TO-02",
    "price": {
      "value": 32.18,
      "currency": "EUR"
    },
    "unit": "package"
  }
]
```

#### Prices for piece unit

Request:

```
http://localhost:8088/products/b867525e-53f8-4864-8990-5f13a5dd9d14/prices?unit=piece
```

Response

```
[
  {
    "id": "TO-02",
    "price": {
      "value": 4.01,
      "currency": "EUR"
    },
    "unit": "piece"
  }
]
```



## Improvements

1. Add unit tests
2. Add better error handling
3. Cover all the edge cases(when unit does not exist, product does not exist and etc)
4. Add docscrings with descriptions for the methods

