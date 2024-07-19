This test assignment was used as a basis: https://docs.google.com/document/d/1fl4eCKdpSXUNyu899NCKaDy_fdHcVPDE-GoO9siZPX4/edit

# Installation
To run the project, follow these steps:

1. Install dependencies:
    ```bash
    composer install
    ```

2. Copy variables from the .env.example file to .env

3. Create a secret key for the project:
    ```bash
    php artisan key:generate
    ```

4. You can run the project using docker-compose:
    ```bash
    docker-compose up
    ```

Documentation is available at: http://127.0.0.1:8000/api/documentation <br>
Note: The documentation does not contain all endpoints. It is planned to update it in the future and add all endpoints
