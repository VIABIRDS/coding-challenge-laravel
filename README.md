# Viabirds Coding Challenge

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Summary 
1. Create a fork of `viabirds/coding-challenge-laravel`
   1. See https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/working-with-forks/fork-a-repo
2. Create a new branch with `<firstname>_<lastname>`.
3. Implement the described task below in the new branch.
4. Create a pull request from the forked repository to `viabirds/coding-challenge-laravel`
    1. See https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request-from-a-fork
5. When done, please send us the link to the pull request in a mail.

## Task

* The application should implement a REST endpoint with path `POST /api/score` that accepts an integer `score`.
* This endpoint should create a new score for a user and ensure it's saved to the database. 
* An `User` entity is defined with properties:
  * `int id`
  * `string name`
  * `int score`
  * `datetime created_at`
* The client must send a bearer token in the Authorization header when making a request to protected resource:
  * HTTP-Header: `Authorization: Bearer <token>`
* The token is defined to be a JSON Web Token (JWT).
  * For more information on JWT, see https://jwt.io/introduction
* The sent JWT token must be decoded to extract the user's `name`.
* The endpoint should check if there is already a `User` entry with the given `name`.
  * If entry exists, the endpoint must respond with:
    * HTTP status: `409 Conlfict`
    * Body: `Given user already has a score` 
  * If entry does not exist, an `User` entry should be added:
    * Properties `name` and `score` from the request.
    * Properties `id` and `created_at` are automatically generated.
  * If entry does not exist, the endpoint must respond with:
    * HTTP status `200 OK`
    * Body: JSON representation of saved `User` object. 

## API Definition

* Check `swagger.yml` to see a detailed definition of the API endpoint.

## JWT Token

* This is an example token where `"name": "John Doe"` is included:

> eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c
