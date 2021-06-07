# backend-fmp-assessment
RestAPI for Find My Profession assessment

# Requirements: 
  - Docker
  - Docker-compose
  
# Set up:
Clone this repository to your machine
  
In the root folder (```backend-fmp-assessment```) and run the following commands in terminal to set up the project:
* ```make build``` - This will build and up all container and this terminal to show their logs, so open another terminal run next command
* ```make create-db ``` - This will create database structure and populate it with initial data (services)
  
After built, you can just run ```make up``` to get the containers working.
  
After doing this, your api must be ready to be used.

# API Usage:
The api will run locally at port 8080 (```localhost:8080```) and there's 3 possible routes:
- ```/services``` - get all services on the database
- ```/services/{id}``` - get one especific service by ID
- ```/clients/create``` - create a client 

You can see the complete documentation using swagger:
Copy the `swagger.json` file content and paste on swagger editor (`https://editor.swagger.io/`)
  
# Help
You can check the all make commands by running ```make help```
