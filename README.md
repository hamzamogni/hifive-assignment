# Hi-five Laravel/VueJS assignment

## How to run

**Note: To make the process of testing easier, I have pushed the .env files to the git repository**

### Backend

#### Docker

The easiest way to run the backend is using docker-compose, I have implemented a docker-compose file to make the process smoother.

Please run ```docker-compose up --build``` at the root of the project.

To complete the setup using docker-compose you can run the following commands

```bash

docker-compose run composer install

docker-compose run artisan migrate:fresh --seed
```

To run tests execute the following

``` docker-compose run artisan test ```

#### Without Docker

Run the following 

```bash
cd server

composer install

php artisan migrate:fresh --seed

```

### Frontend

Run the following 

```bash
cd webapp

yarn install

yarn serve

```

## Explanations

- I implemented the repository pattern to abstract storage logic away from the controller.
- I followed a short controller principle, meaning that the controller's job is to only forward requests to the repository and send the response to the client.
- Request validation was abstracted away from controllers and implemented in their classes (Form Requests).
- Response structure was implemented in dedicated resources.

- Regarding the API, I followed the Cruddy by Design principle. For example, to get categories of product with id 2 you would call `GET /products/2/categories`, and to attach the category with id 5 to the product with id 2 you would call `POST /products/2/categories/5`, this makes API usage intuitive and avoids route guessing.

- Tests were implemented for product update.

- I used VueJS and Vuetify for the frontend, I also integrated the Vue router.