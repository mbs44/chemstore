## Step 1

Start the LAMP Stack
Run Docker Compose: In the bash terminal, run the following command to start the LAMP stack:

    docker-compose up -d

The -d flag runs the containers in detached mode.

## Step 2

Access the LAMP Stack
Access Apache:
Open a web browser and go to http://localhost:8080/info.php. You should see the PHP information page.

Access phpMyAdmin:
Open a web browser and go to http://localhost:8081. You can log in using the following credentials:

Username: user
Password: user123


## Step 3

Stopping and Removing Containers
Stop the containers:

    docker-compose down

Remove the containers and volumes: If you want to remove the containers and associated volumes, you can run:

    docker-compose down -v

