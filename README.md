# To-Do List Project

## Introduction

This project is a **To-Do List application** built to demonstrate the integration of modern technologies such as **PostgreSQL**, **GraphQL**, **Laravel**, and **React**. It is fully dockerized to simplify setup and deployment, ensuring consistency across development and production environments.

## Features

- **Frontend**:
  - Built with **React** for a responsive and dynamic user interface.
  - GraphQL queries and mutations for seamless communication with the backend.
  - State management for efficient to-do item updates (add, edit, delete, toggle status).

- **Backend**:
  - Powered by **Laravel**.
  - GraphQL API provided using the `rebing/graphql-laravel` package.
  - PostgreSQL database for reliable data storage.
  - Clean and scalable architecture.

- **Dockerized**:
  - Fully containerized with separate services for the frontend, backend, and database.
  - Ensures easy setup and consistent environments.

## Installation

### Prerequisites
- **Docker** and **Docker Compose** installed on your system.

### Setup Steps

1. Clone the repository:
```bash
   git clone https://github.com/reyhane1376/todolist-react-laravel.git
   cd todolist-react-laravel
```
2. Start the services:
 ```bash
  docker-compose up --build
```
3. Access the application:

- Frontend: http://localhost:3000
- Backend: http://localhost:8000
- GraphQL Playground: http://localhost:8000/api/graphql

4. Apply migrations:
```bash
     docker exec -it react-laravel-back php artisan migrate
```
## Usage
GraphQL Queries and Mutations
Get All Todos:
```bash
  query {
      todolists {
          id
          title
          status
          created_at
      }
  }

```
Add a Todo:
```bash
  mutation {
    createTodo(title: "Sample Todo") {
      id
      title
    }
  }

```
Update a Todo:
```bash
  mutation {
    updateTodoStatus(id: 1, status: true) {
      id
      status
    }
  }
```
Change Status Todo:
```bash
  mutation {
    updateTodoStatus(id: 1, status: true) {
      id
      status
    }
  }
```
Delete a Todo:
```bash
mutation {
  deleteTodo(id: 1) {
    id
    title
  }
}
```
## Frontend
View, add, edit, delete, and toggle the status of to-do items.
## Technologies
**Backend**: Laravel, GraphQL, PostgreSQL
**Frontend**: React, GraphQL
**Containerization**: Docker, Docker Compose

## Project Structure
```bash
react-laravel-back/
├── Back/   # Laravel backend
├── Front/  # React frontend
├── docker-compose.yml
└── README.md
```

## Future Improvements
Add user authentication for multi-user support.
Enhance error handling and validation.
Implement unit and integration tests.
## License
This project is licensed under the MIT License.

