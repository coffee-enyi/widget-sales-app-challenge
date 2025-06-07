# widget-sales-app-challenge

Widget sales proof of concept with delivery charges and discount offers

## Requirements

- PHP 8.2 or higher
- Composer
- PHP Extensions:
  - `mbstring`
  - `curl`
  - `json`
  - `xml`
  - `zip`
  - `fileinfo`
  - `intl`

Please make sure these extensions are enabled in your PHP installation.




## Installation

1. Clone the repository:
```sh
   git clone git@github.com:coffee-enyi/widget-sales-app-challenge.git
   
   cd widget-sales-app-challenge
```

2. Install dependencies using Composer:
   
>  You may add the following flags to optimize and automate composer installation: --optimize-autoloader --no-interaction --prefer-dist.
```sh
   composer install 
```

3. Run this command in the project root:
```sh
   php -S localhost:8000 -t /app
```

4. Open your browser and go to:
```sh
   http://localhost:8000/manual-test.php
```

5. Update the manual-test.php (in the root directory) file, with "add" calls to test inputs on the application




## Docker installation

### Prerequisites

- Docker installed 

- Docker Compose installed (optional)

1. Clone and enter the repository:
```sh
   git clone git@github.com:coffee-enyi/widget-sales-app-challenge.git
   
   cd widget-sales-app-challenge
```
> Ensure the Docker entrypoint script is executable
```sh
   chmod +x docker/entrypoint.sh
```

2. Build the Docker image (runs composer install automatically):
```sh
   docker compose build
```
> This step installs PHP dependencies inside the container using Composer.

3. Build the Docker image (runs composer install automatically):
```sh
   docker compose up -d
```
> Your app should now be available at: http://localhost:8000

4. Do your manual testing here:
```sh
   http://localhost:8000/manual-test.php
```

### Manual Docker Usage (No Docker Compose)
1. Build the Docker image (includes Composer install):
```sh
   git clone git@github.com:coffee-enyi/widget-sales-app-challenge.git
   
   cd widget-sales-app-challenge

   docker build -t widget-sales-app .
```
> This step runs composer install during image build and includes the vendor/ directory in the final image.


2. Run the container and expose port 8000:
```sh
   docker run -p 8000:8000 -v $(pwd):/app widget-sales-app
```




## Testing
1. Manual testing as mentioned above, can be done at:
```sh
   http://localhost:8000/manual-test.php
```

### Unit and Integration Tests 
1. Testing manually inside the container (No Docker Compose)
```sh
   docker build -t widget-sales-app .
   docker run --rm -v $(pwd):/app widget-sales-app vendor/bin/phpunit
```

2. Use the available Test service (If having Docker Compose)
```sh
   docker-compose run --rm testvendor/bin/phpstan analyse
```


### Running PHPStan (Static Analysis)
1. If you're using Docker:
```sh
   docker run --rm -v $(pwd):/app widget-sales-app vendor/bin/phpstan analyse
```
2. If you're using Docker Compose, use the phpstan service created:
```sh
   docker compose run --rm phpstan
```
3. If you're running it manually on your local system (PHP + Composer installed):
```sh
   vendor/bin/phpstan analyse
```





## Problem This Code Intends to Solve
### Bill Widget Co
Bill Widget Co are the leading provider of made up widgets and they’ve contracted you to
create a proof of concept for their new sales system.


They sell three products –
| Product              | Code              | Price                |
|----------------------|-------------------|----------------------|
| Red Widget           | R01               | $32.95               |
| Green Widget         | G01               | $24.95               |
| Blue Widget          | B01               |  $7.95               |

To incentivise customers to spend more, delivery costs are reduced based on the amount
spent. Orders under $50 cost $4.95. For orders under $90, delivery costs $2.95. Orders of
$90 or more have free delivery.

They are also experimenting with special offers. The initial offer will be “buy one red widget,
get the second half price”.

Your job is to implement the basket which needs to have the following interface –
- It is initialised with the product catalogue, delivery charge rules, and offers (the
format of how these are passed it up to you)
- It has an add method that takes the product code as a parameter.
- It has a total method that returns the total cost of the basket, taking into account
the delivery and offer rules.

Here are some example baskets and expected totals to help you check your
implementation.

| Products                    | Total             |
|-----------------------------|-------------------|
| B01, G01                    | $37.85            |
| R01, R01                    | $54.37            |
| R01, G01                    | $60.85            |
| B01, B01, R01, R01, R01     | $98.27            |


What we expect to see –
- A solution written in easy to understand and update PHP
- A README file explaining how it works and any assumptions you’ve made
Pushed to a public Github repo