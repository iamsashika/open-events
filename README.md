# Users
| Column Name     | Data Type    | Constraints                | Description        |
| --------------- | ------------ | -------------------------- | ------------------ |
| id            | BIGINT       | PK, AUTO_INCREMENT         | User ID            |
| first_name`    | VARCHAR(100) | NOT NULL                   | First name         |
| last_name`     | VARCHAR(100) | NULL                       | Last name          |
| `email`         | VARCHAR(150) | UNIQUE, NOT NULL           | Email address      |
| `phone`         | VARCHAR(20)  | NULL                       | Phone number       |
| `password_hash` | VARCHAR(255) | NOT NULL                   | Encrypted password |
| `role`          | ENUM         | admin, organizer, attendee | User role          |
| `status`        | ENUM         | active, inactive           | Account status     |
| `created_at`    | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP  | Created time       |
| `updated_at`    | TIMESTAMP    | AUTO UPDATE                | Updated time       |
| `created_by`    | BIGINT       | FK → users.id              | Created by         |
| `updated_by`    | BIGINT       | FK → users.id              | Updated by         |
| `deleted_at`    | TIMESTAMP    | NULL                       | Soft delete        |

# Venues
| Column Name  | Data Type    | Constraints               | Description      |
| ------------ | ------------ | ------------------------- | ---------------- |
| `id`         | BIGINT       | PK, AUTO_INCREMENT        | Venue ID         |
| `name`       | VARCHAR(150) | NOT NULL                  | Venue name       |
| `address`    | TEXT         | NULL                      | Full address     |
| `city`       | VARCHAR(100) | NULL                      | City             |
| `country`    | VARCHAR(100) | NULL                      | Country          |
| `capacity`   | INT          | NULL                      | Maximum capacity |
| `created_at` | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP | Created time     |
| `updated_at` | TIMESTAMP    | AUTO UPDATE               | Updated time     |
| `created_by` | BIGINT       | FK → users.id             | Created by       |
| `updated_by` | BIGINT       | FK → users.id             | Updated by       |
| `deleted_at` | TIMESTAMP    | NULL                      | Soft delete      |

# Events
| Column Name    | Data Type    | Constraints                            | Description   |
| -------------- | ------------ | -------------------------------------- | ------------- |
| `id`           | BIGINT       | PK, AUTO_INCREMENT                     | Event ID      |
| `title`        | VARCHAR(200) | NOT NULL                               | Event title   |
| `description`  | TEXT         | NULL                                   | Event details |
| `start_date`   | DATETIME     | NOT NULL                               | Start date    |
| `end_date`     | DATETIME     | NOT NULL                               | End date      |
| `venue_id`     | BIGINT       | FK → venues.id                         | Venue         |
| `organizer_id` | BIGINT       | FK → users.id                          | Organizer     |
| `max_capacity` | INT          | NULL                                   | Max attendees |
| `status`       | ENUM         | draft, published, cancelled, completed | Event status  |
| `created_at`   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP              | Created time  |
| `updated_at`   | TIMESTAMP    | AUTO UPDATE                            | Updated time  |
| `created_by`   | BIGINT       | FK → users.id                          | Created by    |
| `updated_by`   | BIGINT       | FK → users.id                          | Updated by    |
| `deleted_at`   | TIMESTAMP    | NULL                                   | Soft delete   |

#Tickets
| Column Name  | Data Type     | Constraints               | Description       |
| ------------ | ------------- | ------------------------- | ----------------- |
| `id`         | BIGINT        | PK, AUTO_INCREMENT        | Ticket ID         |
| `event_id`   | BIGINT        | FK → events.id            | Event             |
| `type`       | ENUM          | free, standard, vip       | Ticket type       |
| `price`      | DECIMAL(10,2) | DEFAULT 0.00              | Ticket price      |
| `quantity`   | INT           | NOT NULL                  | Available tickets |
| `created_at` | TIMESTAMP     | DEFAULT CURRENT_TIMESTAMP | Created time      |
| `updated_at` | TIMESTAMP     | AUTO UPDATE               | Updated time      |
| `created_by` | BIGINT        | FK → users.id             | Created by        |
| `updated_by` | BIGINT        | FK → users.id             | Updated by        |
| `deleted_at` | TIMESTAMP     | NULL                      | Soft delete       |


# Registrations
| Column Name  | Data Type | Constraints               | Description     |
| ------------ | --------- | ------------------------- | --------------- |
| `id`         | BIGINT    | PK, AUTO_INCREMENT        | Registration ID |
| `user_id`    | BIGINT    | FK → users.id             | Attendee        |
| `event_id`   | BIGINT    | FK → events.id            | Event           |
| `ticket_id`  | BIGINT    | FK → tickets.id           | Ticket          |
| `check_in`   | BOOLEAN   | DEFAULT FALSE             | Check-in status |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Registered time |
| `updated_at` | TIMESTAMP | AUTO UPDATE               | Updated time    |
| `created_by` | BIGINT    | FK → users.id             | Created by      |
| `updated_by` | BIGINT    | FK → users.id             | Updated by      |
| `deleted_at` | TIMESTAMP | NULL                      | Soft delete     |

# Payments
| Column Name       | Data Type     | Constraints               | Description       |
| ----------------- | ------------- | ------------------------- | ----------------- |
| `id`              | BIGINT        | PK, AUTO_INCREMENT        | Payment ID        |
| `registration_id` | BIGINT        | FK → registrations.id     | Registration      |
| `amount`          | DECIMAL(10,2) | NOT NULL                  | Paid amount       |
| `method`          | ENUM          | card, upi, cash, paypal   | Payment method    |
| `status`          | ENUM          | pending, success, failed  | Payment status    |
| `transaction_ref` | VARCHAR(255)  | NULL                      | Gateway reference |
| `created_at`      | TIMESTAMP     | DEFAULT CURRENT_TIMESTAMP | Payment time      |
| `updated_at`      | TIMESTAMP     | AUTO UPDATE               | Updated time      |
| `created_by`      | BIGINT        | FK → users.id             | Created by        |
| `updated_by`      | BIGINT        | FK → users.id             | Updated by        |
| `deleted_at`      | TIMESTAMP     | NULL                      | Soft delete       |


