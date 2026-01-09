# Users
| Column Name     | Data Type    | Constraints                | Description        |
| --------------- | ------------ | -------------------------- | ------------------ |
| id              | BIGINT       | PK, AUTO_INCREMENT         | User ID            |
| first_name      | VARCHAR(100) | NOT NULL                   | First name         |
| last_name       | VARCHAR(100) | NULL                       | Last name          |
| email           | VARCHAR(150) | UNIQUE, NOT NULL           | Email address      |
| phone           | VARCHAR(20)  | NULL                       | Phone number       |
| password_hash   | VARCHAR(255) | NOT NULL                   | Encrypted password |
| role            | ENUM         | admin, organizer, attendee | User role          |
| status          | ENUM         | active, inactive           | Account status     |
| created_at      | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP  | Created time       |
| updated_at      | TIMESTAMP    | AUTO UPDATE                | Updated time       |
| created_by      | BIGINT       | FK → users.id              | Created by         |
| updated_by      | BIGINT       | FK → users.id              | Updated by         |
| deleted_at      | TIMESTAMP    | NULL                       | Soft delete        |

# Venues
| Column Name  | Data Type    | Constraints               | Description      |
| ------------ | ------------ | ------------------------- | ---------------- |
| id           | BIGINT       | PK, AUTO_INCREMENT        | Venue ID         |
| name         | VARCHAR(150) | NOT NULL                  | Venue name       |
| address      | TEXT         | NULL                      | Full address     |
| city         | VARCHAR(100) | NULL                      | City             |
| country      | VARCHAR(100) | NULL                      | Country          |
| capacity     | INT          | NULL                      | Maximum capacity |
| created_at   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP | Created time     |
| updated_at   | TIMESTAMP    | AUTO UPDATE               | Updated time     |
| created_by   | BIGINT       | FK → users.id             | Created by       |
| updated_by   | BIGINT       | FK → users.id             | Updated by       |
| deleted_at   | TIMESTAMP    | NULL                      | Soft delete      |

# Events
| Column Name    | Data Type    | Constraints                            | Description   |
| -------------- | ------------ | -------------------------------------- | ------------- |
| id             | BIGINT       | PK, AUTO_INCREMENT                     | Event ID      |
| title          | VARCHAR(200) | NOT NULL                               | Event title   |
| description    | TEXT         | NULL                                   | Event details |
| start_date     | DATETIME     | NOT NULL                               | Start date    |
| end_date       | DATETIME     | NOT NULL                               | End date      |
| venue_id       | BIGINT       | FK → venues.id                         | Venue         |
| organizer_id   | BIGINT       | FK → users.id                          | Organizer     |
| max_capacity   | INT          | NULL                                   | Max attendees |
| status         | ENUM         | draft, published, cancelled, completed | Event status  |
| created_at     | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP              | Created time  |
| updated_at     | TIMESTAMP    | AUTO UPDATE                            | Updated time  |
| created_by     | BIGINT       | FK → users.id                          | Created by    |
| updated_by     | BIGINT       | FK → users.id                          | Updated by    |
| deleted_at     | TIMESTAMP    | NULL                                   | Soft delete   |

#Tickets
| Column Name  | Data Type     | Constraints               | Description       |
| ------------ | ------------- | ------------------------- | ----------------- |
| id           | BIGINT        | PK, AUTO_INCREMENT        | Ticket ID         |
| event_id     | BIGINT        | FK → events.id            | Event             |
| type         | ENUM          | free, standard, vip       | Ticket type       |
| price        | DECIMAL(10,2) | DEFAULT 0.00              | Ticket price      |
| quantity     | INT           | NOT NULL                  | Available tickets |
| created_at   | TIMESTAMP     | DEFAULT CURRENT_TIMESTAMP | Created time      |
| updated_at   | TIMESTAMP     | AUTO UPDATE               | Updated time      |
| created_by   | BIGINT        | FK → users.id             | Created by        |
| updated_by   | BIGINT        | FK → users.id             | Updated by        |
| deleted_at   | TIMESTAMP     | NULL                      | Soft delete       |


# Registrations
| Column Name  | Data Type | Constraints               | Description     |
| ------------ | --------- | ------------------------- | --------------- |
| id           | BIGINT    | PK, AUTO_INCREMENT        | Registration ID |
| user_id      | BIGINT    | FK → users.id             | Attendee        |
| event_id     | BIGINT    | FK → events.id            | Event           |
| ticket_id    | BIGINT    | FK → tickets.id           | Ticket          |
| check_in     | BOOLEAN   | DEFAULT FALSE             | Check-in status |
| created_at   | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Registered time |
| updated_at   | TIMESTAMP | AUTO UPDATE               | Updated time    |
| created_by   | BIGINT    | FK → users.id             | Created by      |
| updated_by   | BIGINT    | FK → users.id             | Updated by      |
| deleted_at   | TIMESTAMP | NULL                      | Soft delete     |

# Payments
| Column Name       | Data Type     | Constraints               | Description       |
| ----------------- | ------------- | ------------------------- | ----------------- |
| id                | BIGINT        | PK, AUTO_INCREMENT        | Payment ID        |
| registration_id   | BIGINT        | FK → registrations.id     | Registration      |
| amount            | DECIMAL(10,2) | NOT NULL                  | Paid amount       |
| method            | ENUM          | card, upi, cash, paypal   | Payment method    |
| status            | ENUM          | pending, success, failed  | Payment status    |
| transaction_ref   | VARCHAR(255)  | NULL                      | Gateway reference |
| created_at        | TIMESTAMP     | DEFAULT CURRENT_TIMESTAMP | Payment time      |
| updated_at        | TIMESTAMP     | AUTO UPDATE               | Updated time      |
| created_by        | BIGINT        | FK → users.id             | Created by        |
| updated_by        | BIGINT        | FK → users.id             | Updated by        |
| deleted_at        | TIMESTAMP     | NULL                      | Soft delete       |



```sql
-- Users Table

CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100),
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','organizer','attendee') DEFAULT 'attendee',
    status ENUM('active','inactive') DEFAULT 'active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by BIGINT NULL,
    updated_by BIGINT NULL,
    deleted_at TIMESTAMP NULL,

    INDEX idx_users_deleted (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Venues Table

CREATE TABLE venues (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    address TEXT,
    city VARCHAR(100),
    country VARCHAR(100),
    capacity INT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by BIGINT NULL,
    updated_by BIGINT NULL,
    deleted_at TIMESTAMP NULL,

    INDEX idx_venues_deleted (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Events Table
CREATE TABLE events (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    venue_id BIGINT,
    organizer_id BIGINT,
    max_capacity INT,
    status ENUM('draft','published','cancelled','completed') DEFAULT 'draft',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by BIGINT NULL,
    updated_by BIGINT NULL,
    deleted_at TIMESTAMP NULL,

    INDEX idx_events_deleted (deleted_at),
    FOREIGN KEY (venue_id) REFERENCES venues(id),
    FOREIGN KEY (organizer_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tickets Table
CREATE TABLE tickets (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    event_id BIGINT NOT NULL,
    type ENUM('free','standard','vip') NOT NULL,
    price DECIMAL(10,2) DEFAULT 0.00,
    quantity INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by BIGINT NULL,
    updated_by BIGINT NULL,
    deleted_at TIMESTAMP NULL,

    CONSTRAINT fk_tickets_event
        FOREIGN KEY (event_id) REFERENCES events(id),

    INDEX idx_tickets_deleted (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- Registrations Table
CREATE TABLE registrations (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    event_id BIGINT NOT NULL,
    ticket_id BIGINT NOT NULL,
    check_in BOOLEAN DEFAULT FALSE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by BIGINT NULL,
    updated_by BIGINT NULL,
    deleted_at TIMESTAMP NULL,

    CONSTRAINT fk_reg_user
        FOREIGN KEY (user_id) REFERENCES users(id),

    CONSTRAINT fk_reg_event
        FOREIGN KEY (event_id) REFERENCES events(id),

    CONSTRAINT fk_reg_ticket
        FOREIGN KEY (ticket_id) REFERENCES tickets(id),

    UNIQUE KEY uniq_user_event (user_id, event_id),
    INDEX idx_reg_deleted (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Payments Table
CREATE TABLE payments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    registration_id BIGINT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    method ENUM('card','upi','cash','paypal') NOT NULL,
    status ENUM('pending','success','failed') DEFAULT 'pending',
    transaction_ref VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by BIGINT NULL,
    updated_by BIGINT NULL,
    deleted_at TIMESTAMP NULL,

    CONSTRAINT fk_payment_registration
        FOREIGN KEY (registration_id) REFERENCES registrations(id),

    INDEX idx_payments_deleted (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


```