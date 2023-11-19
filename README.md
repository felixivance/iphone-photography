Follow the steps below to setup the project

## Step 1: Clone the Project

---

`git clone git@github.com:felixivance/iphone-photography.git`

## Step 2: Composer Install

---

`composer install`

## Step 3: Set up your .env file

---

You can rename the .env.example file to .env and update the values to match your local environment.

## Step 4: Seed data to the database

---

Run the following command setup your database and add data:

`php artisan migrate:fresh --seed`

## Step 5: APIs to test with

---

Create a user by sending the following API:

` /api/v1/register` 

Body:
    
    `{
        "name": "Test User",
        "email": "test@email.com"
        "password": "password"
    }`

---

Register a user by sending the following API:

` /api/v1/register`

Body:
    
    `{
        "email": "test@email.com"
        "password": "password"
    }`

--- 

Add a comment by sending the following API (You can use the token from the login API):

` /api/v1/comment`

Body:
    
    `{
        "comment": "This is a comment"
    }`

--- 

Add a watched lesson by sending the following API (You can use the token from the login API):

` /api/v1/lessons-watched`

Body:
    
    `{
        "lesson_id": 1
    }`

---

Run the tests by running the following command:

`php artisan test`

You can also test via the postman collection in the directory, :

`/public/postman/iphone-photography.postman_collection.json`

## Step 6: Have questions?

---

Feel free to reach out. I'd be happy to help.

`felixrunye@gmail.com`
