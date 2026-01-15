# Three-Tier Web Application with Database

## 📋 Project Overview
This project demonstrates a fully functional three-tier web application deployed using Docker containers. The application consists of a frontend web server (Nginx), an application layer (PHP-FPM), and a backend database (MySQL). Users can submit their information through a web form, which is then stored in the MySQL database.

## 🏗️ Architecture Diagram
![](/img/architecture%20diagram.png)

## 🗂️ Project Structure
```
threetier/
├── docker-compose.yml          # Main orchestration file
├── app/
│   └── code/
│       └── submit.php          # PHP form processing script
├── db/
│   ├── Dockerfile              # Custom MySQL image
│   └── init.sql               # Database initialization script
└── web/
    └── config/
        └── default.conf       # Nginx configuration
```

## 🚀 Quick Start Commands

### 1. **Clone and Navigate to Project**
```bash
cd /home/ec2-user/threetier
```

### 2. **Start the Application**
```bash
docker-compose up -d
```
**Expected Output:**
```
[+] Running 3/3
Container threetier-db-1 Started
Container threetier-app-1 Started
Container threetier-web-1 Started
```

### 3. **Verify Running Containers**
```bash
docker ps
```
**Expected Output:**
```
CONTAINER ID    IMAGE    COMMAND    CREATED    STATUS    PORTS    NAMES
3e1ae9f6bd4d    nginx    "/docker-entrypoint..."    13 seconds ago   Up 11 seconds  0.0.0.0:80->80/tcp, :::80->80/tcp   threetier-web-1
a30d7b60b050    bitnami/php-fpm    "php-fpm -F --pid..."    13 seconds ago   Up 12 seconds  9000/tcp    threetier-app-1
8daac627d62f    threetier-db    "docker-entrypoint.s…"    13 seconds ago   Up 12 seconds  3306/tcp   threetier-db-1
```

### 4. **Access Database**
```bash
# Access MySQL container shell
docker exec -it threetier-db-1 /bin/bash

# Login to MySQL
mysql -u root -p
# Password: (as defined in docker-compose.yml)

# Use the database
use FCT;

# View submitted user data
select * from users;
```

## 📊 Database Operations

### View Submitted User Data
```sql
mysql> use FCT;
mysql> select * from users;
```

**Sample Output:**
```
+----+------------------+-------------------------------+
| id | name             | email                         |
+----+------------------+-------------------------------+
| 1  | aniket jagadale  | aniketjagadale362@gmail.com   |
| 2  | aniket jagadale  | aniketjagadale362@gmail.com   |
+----+------------------+-------------------------------+
```

## 🖼️ Screenshots

### 1. **Signup Form Page**
![Signup Page](/img/signup%20page.png)
*User registration form with fields for name, email, website, comment, and gender.*

### 2. **Form Submission Result**
![Submission Result](/img/after%20submit.png)
*Confirmation page showing successful form submission with user data.*

### 3. **Database View**
![Database View](/img/powershell%20veiw.png)
*Command-line view of the MySQL database showing stored user records.*

### 4. **AWS EC2 Instance Management**
![AWS Instances](/img/aws%20instances.png)
*AWS EC2 dashboard showing running instances for this project.*

## 🔧 Configuration Files

### docker-compose.yml
```yaml
version: '3.8'
services:
  web:
    image: nginx:latest
    ports:
      - "80:80"
    volumes:
      - ./web/config/default.conf:/etc/nginx/conf.d/default.conf
      - ./app/code:/var/www/html
    depends_on:
      - app
  
  app:
    image: bitnami/php-fpm:latest
    volumes:
      - ./app/code:/var/www/html
  
  db:
    build: ./db
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_DATABASE: FCT
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

### db/Dockerfile
```dockerfile
FROM mysql:9.5.0
COPY init.sql /docker-entrypoint-initdb.d/
```

## 🌐 Accessing the Application

1. **Web Application URL:** `http://34.227.74.125` (Public IPv4 address)
2. **Ports:**
   - Web Server: Port 80
   - Application: Port 9000 (internal)
   - Database: Port 3306 (internal)

## 📋 Prerequisites

- Docker Engine
- Docker Compose
- AWS EC2 Instance (for cloud deployment)
- Basic knowledge of MySQL and PHP

## 🛠️ Troubleshooting

### Check Container Logs
```bash
docker-compose logs
```

### Stop Application
```bash
docker-compose down
```

### Rebuild Containers
```bash
docker-compose up -d --build
```

## 📈 Monitoring

The application includes:
- Container health checks
- Database connection pooling
- Nginx access/error logs
- MySQL query logging

## 🔒 Security Notes

- Database credentials are managed via environment variables
- Nginx is configured to only expose necessary ports
- PHP-FPM runs with appropriate user permissions
- Regular security updates for container images

---

## 📝 License
This project is for educational purposes. Ensure proper security measures before deploying in production environments.

## 🤝 Contributing
Feel free to submit issues and enhancement requests for improving this three-tier application setup.