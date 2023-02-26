Grodas test task (backend).

To setup the project using docker, please run 'make setup'.
Don't forget to run 'sudo chmod -R 777 storage/' on fresh project.

Tips: 
1. Resource routes API - https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controller
2. To use API currency conversion for the products you can use 'currency' parameter (?currency=GBP) on such routes:
 - api/products
 - api/products/{id}
