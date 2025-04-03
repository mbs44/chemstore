## Step 1 - Install Docker Engine

Install the Docker engine by instructions from official web page
https://docs.docker.com/engine/install/

In case of Windows you can install Docker Desktop for Windows
https://docs.docker.com/desktop/setup/install/windows-install/

## Step 2 - Starting Docker Images

Run Docker Compose: In the bash terminal, run the following command to start the LAMP stack:

    docker-compose up -d

The -d flag runs the containers in detached mode.


Access the LAMP Stack
Access Apache:
Open a web browser and go to http://localhost:8080/info.php. You should see the PHP information page.

Access c:
Open a web browser and go to http://localhost:8081. You can log in using the following credentials:

Username: user
Password: user123


## Step 3 - Creating Database

Create the database chemlab in phpMyAdmin. 

Open and run the database script tests/Docker/database/chemlab.sql

## Step 4 - Setting Local LDAP

Access the LDAP container's shell:

bash

	docker exec -it ldap_server /bin/bash


Create file

	touch users.ldif


Find users.ldif in Linux/docker-desktop. Add the following content to the file:

dn: uid=student,dc=gjh,dc=sk
objectClass: inetOrgPerson
cn: Student
sn: User
uid: student
userPassword: Student123

dn: uid=teacher,dc=gjh,dc=sk
objectClass: inetOrgPerson
cn: Teacher
sn: User
uid: teacher
userPassword: Teacher123


Use the ldapadd command to add the users:

bash

	ldapadd -x -D "cn=admin,dc=gjh,dc=sk" -w Admin123 -f users.ldif


## Step 5 - Run the Web Application

Deploy the Laravel application following the official Laravel instructions
https://laravel.com/docs/12.x/deployment

Our application uses vite so read the vite official instruction for building the applications.
https://vite.dev/guide/build


## Step 6 - Close the Web Application

Stopping and Removing Containers
Stop the containers:

    docker-compose down

Remove the containers and volumes: If you want to remove the containers and associated volumes, you can run:

    docker-compose down -v

