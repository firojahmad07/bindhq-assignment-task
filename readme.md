## Assignment Task
 - Create a database
 - Stablish connection via adding configuration in **.env** file

## System Requirenments
- Php verions >= 7.2.5(**would be better if you will use php 8.0 that i used**)
- MySQL verions 8.0(**that i used**).
- Node v18 (**I used**)

## Installation Steps
- composer install
- yarn install
- php bin/console doctrine:migrations:migrate
- php bin/console ca:cl && php bin/console assets:install --symlink --relative && yarn run webpack

## Feed Dummy Informations

- **php bin/console feed:dummy:data**

## API End Points:

# Get All company list:
url: {baseUrl}/company/list

# Get All companies with sales data:
url: {baseUrl}/companies/sales

# Get single company sales data:
url: {baseUrl}/company/{companyId}/sales