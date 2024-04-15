Promoter Management

Deployment

- Install Composer if you haven't already.
- Create a .env file and configure the database connection.
- Run php artisan key:generate to generate the application key.
- Run php artisan migrate to perform the database migrations.
- To populate test data into the database, first execute the seeders   for skills and then for promoters:
    - php artisan db:seed --class=SkillSeeder
    - php artisan db:seed --class=PromoterSeeder
- Start the Laravel development server with php artisan serve.

Documentation and Test Functions

- Visit http://127.0.0.1:8000/api/documentation#/ to view the API documentation and test the API.

- In the api-docs directory, you'll find an api-docs.json file. You can use this file to generate TypeScript clients or other documentation as needed.

- To generate TypeScript clients from the API documentation, follow these steps:

- 1.Locate the api-docs.json file in the api-docs directory.
- 2.Use a tool or library, such as Swagger Codegen, to generate TypeScript clients based on the JSON file.
- 3.Customize the generated TypeScript code according to your project's requirements.

