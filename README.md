# Project Folder Structure – open-events

```text
open-events/
│
├── public/
│   ├── index.php              # Front controller
│   ├── .htaccess              # URL rewriting
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
│
├── app/
│   ├── init.php               # App bootstrap
│   |
│   ├── config/
│   │   └── config.php         # DB + app config
│   |
│   ├── core/
│   │   ├── App.php            # Router
│   │   ├── Controller.php     # Base controller
│   │   ├── Model.php          # Base model
│   │   ├── Database.php       # PDO singleton
│   │   ├── Auth.php           # Auth helper (login, roles)
│   │   └── Csrf.php           # CSRF protection
│   |
│   ├── middleware/
│   │   ├── AuthMiddleware.php # Login required
│   │   └── RoleMiddleware.php # Role-based access
│   |
│   ├── controllers/
│   │   ├── HomeController.php
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── ProfileController.php
│   │   |
│   │   ├── Admin/
│   │   │   ├── UsersController.php
│   │   │   ├── EventsController.php
│   │   │   └── VenuesController.php
│   │   │
│   │   ├── Organizer/
│   │   │   ├── EventsController.php
│   │   │   ├── TicketsController.php
│   │   │   └── SalesController.php
│   │   │
│   │   └── Attendee/
│   │       ├── EventsController.php
│   │       └── TicketsController.php
│   |
│   ├── models/
│   │   ├── User.php
│   │   ├── Event.php
│   │   ├── Venue.php
│   │   ├── Ticket.php
│   │   ├── Registration.php
│   │   ├── Payment.php
│   │   └── Attendance.php
│   |
│   ├── views/
│   │   ├── auth/
│   │   │   ├── register.php
│   │   │   ├── login.php
│   │   │   ├── reset-password.php
│   │   │   └── verify-email.php
│   │   │
│   │   ├── dashboard/
│   │   │
│   │   │   ├── admin/
│   │   │   │   ├── index.php
│   │   │   │   ├── users/
│   │   │   │   │   ├── index.php
│   │   │   │   │   ├── view.php
│   │   │   │   │   └── edit.php
│   │   │   │   │
│   │   │   │   ├── events/
│   │   │   │   │   ├── index.php
│   │   │   │   │   ├── view.php
│   │   │   │   │   └── edit.php
│   │   │   │   │
│   │   │   │   ├── venues/
│   │   │   │   │   ├── index.php
│   │   │   │   │   ├── create.php
│   │   │   │   │   └── edit.php
│   │   │   │   │
│   │   │   │   └── profile/
│   │   │   │       ├── view.php
│   │   │   │       └── edit.php
│   │   │   |
│   │   │   ├── organizer/
│   │   │   │   ├── index.php
│   │   │   │   ├── events/
│   │   │   │   │   ├── index.php
│   │   │   │   │   ├── create.php
│   │   │   │   │   ├── edit.php
│   │   │   │   │   ├── tickets.php
│   │   │   │   │   └── sales.php
│   │   │   │   │
│   │   │   │   └── profile/
│   │   │   │       ├── view.php
│   │   │   │       └── edit.php
│   │   │   |
│   │   │   └── attendee/
│   │   │       ├── index.php
│   │   │       ├── events/
│   │   │       │   ├── index.php
│   │   │       │   └── view.php
│   │   │       │
│   │   │       ├── tickets/
│   │   │       │   └── index.php
│   │   │       │
│   │   │       └── profile/
│   │   │           ├── view.php
│   │   │           └── edit.php
│   │   |
│   │   └── partials/
│   │       ├── header.php
│   │       ├── footer.php
│   │       ├── sidebar-admin.php
│   │       ├── sidebar-organizer.php
│   │       └── sidebar-attendee.php
│
│   └── helpers/
│       ├── redirect.php
│       ├── session.php
│       └── validation.php
│
├── storage/
│   ├── uploads/
│   │   ├── avatars/
│   │   └── event-images/
│   └── logs/
│
├── database/
│   ├── migrations/
│   └── schema.sql
│
└── README.md
```

# Project TODO List – Event Management Application

---

## Authentication & Security

- [ ] Sign up
- [ ] Sign in
- [ ] Logout
- [ ] Password reset via email (token-based)
- [ ] Email verification after registration
- [ ] Secure password hashing (bcrypt)
- [ ] Session management
- [ ] Session ID regeneration on login
- [ ] CSRF protection for all forms
- [ ] Account blocking by admin
- [ ] Prevent login for blocked users
- [ ] Soft delete protection for users

---

## 👤 User Management (Admin)

- [ ] List all users
- [ ] View user profile
- [ ] Edit user details
- [ ] Change user role (admin / organizer / attendee)
- [ ] Block / unblock user
- [ ] Soft delete user
- [ ] Search and filter users
- [ ] View user activity (events, tickets)

---

## 👤 User Profile (All Users)

- [ ] View own profile
- [ ] Update profile details
- [ ] Change password
- [ ] View account status
- [ ] Delete own account (soft delete)

---

## 📅 Event Management

### Admin

- [ ] View all events
- [ ] View event details
- [ ] Update event
- [ ] Delete event (soft delete)
- [ ] Publish / unpublish event
- [ ] Assign venue to event
- [ ] View ticket sales per event

### Event Organizer

- [ ] Create events
- [ ] Update own events
- [ ] Delete own events
- [ ] View all own events
- [ ] View event details
- [ ] Publish / unpublish own events
- [ ] View ticket sales for own events

### Attendee

- [ ] View published events
- [ ] View event details
- [ ] Register for event
- [ ] View registered events

---

## 🏟 Venue Management (Admin)

- [ ] Create venue
- [ ] Update venue
- [ ] View all venues
- [ ] View venue details
- [ ] Delete venue (soft delete)
- [ ] Assign venue to event
- [ ] Manage venue capacity

---

## 🎟 Ticket Management

- [ ] Create ticket categories (Gold / Silver / Platinum)
- [ ] Set ticket prices per category
- [ ] Set ticket quantity per category
- [ ] Update ticket pricing
- [ ] Disable ticket categories
- [ ] View tickets per event

---

## 💳 Ticket Sales & Payments

- [ ] Purchase tickets
- [ ] Generate ticket per purchase
- [ ] Track ticket sales per event
- [ ] Payment record creation
- [ ] Payment status tracking (pending / paid / failed)
- [ ] View payment history (user)
- [ ] View payment reports (admin)
- [ ] Payment gateway integration (future)

---

## ✅ Event Attendance

- [ ] Mark attendance per ticket
- [ ] Validate ticket at event entry
- [ ] Prevent duplicate attendance marking
- [ ] Attendance report per event
- [ ] Attendance summary dashboard

---

## 📊 Dashboards

- [ ] Central dashboard routing
- [ ] Role-based dashboard redirection
- [ ] Admin dashboard
- [ ] Organizer dashboard
- [ ] Attendee dashboard
- [ ] Dashboard summary widgets

---

## 🧱 UI & Structure

- [ ] Layout system (header / footer / sidebar)
- [ ] Reusable partial views
- [ ] Admin base controller
- [ ] Organizer base controller
- [ ] Attendee base controller
- [ ] Authorization middleware helper
- [ ] Route-level access protection
- [ ] Flash messages (success / error)
- [ ] Form validation UI feedback

---

## 🧪 Validation & Error Handling

- [ ] Server-side validation
- [ ] Centralized error handling
- [ ] Custom 403 / 404 pages
- [ ] Friendly validation messages

---

## 📦 System & Maintenance

- [ ] Database migrations
- [ ] Seed default admin user
- [ ] Environment-based configuration
- [ ] Logging system
- [ ] Backup strategy
- [ ] Performance optimization

---

## 🔮 Future Enhancements

- [ ] Email notifications
- [ ] QR code ticket validation
- [ ] CSV export (users / events / sales)
- [ ] Analytics & reports
- [ ] REST API for mobile app
- [ ] Multi-language support
- [ ] Multi-currency support

---

# Database Schema

## Users Table

| Column Name   | Data Type    | Description        |
| ------------- | ------------ | ------------------ |
| id            | BIGINT       | User ID            |
| avatar        | VARCHAR(255) | Profile picture    |
| first_name    | VARCHAR(100) | First name         |
| last_name     | VARCHAR(100) | Last name          |
| email         | VARCHAR(150) | Email address      |
| phone         | VARCHAR(20)  | Phone number       |
| password_hash | VARCHAR(255) | Encrypted password |
| role          | ENUM         | User role          |
| status        | ENUM         | Account status     |
| created_at    | TIMESTAMP    | Created time       |
| updated_at    | TIMESTAMP    | Updated time       |
| created_by    | BIGINT       | Created by         |
| updated_by    | BIGINT       | Updated by         |
| deleted_at    | TIMESTAMP    | Soft delete        |

```sql

CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    avatar VARCHAR(255) NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','organizer','attendee') DEFAULT 'attendee',
    status ENUM('active','inactive','blocked') DEFAULT 'active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by BIGINT NULL,
    updated_by BIGINT NULL,
    deleted_at TIMESTAMP NULL,

    INDEX idx_users_deleted (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```

## Venues Table

| Column Name | Data Type    | Description      |
| ----------- | ------------ | ---------------- |
| id          | BIGINT       | Venue ID         |
| name        | VARCHAR(150) | Venue name       |
| address     | TEXT         | Full address     |
| city        | VARCHAR(100) | City             |
| country     | VARCHAR(100) | Country          |
| capacity    | INT          | Maximum capacity |
| cover_image | VARCHAR(255) | Venue image      |
| created_at  | TIMESTAMP    | Created time     |
| updated_at  | TIMESTAMP    | Updated time     |
| created_by  | BIGINT       | Created by       |
| updated_by  | BIGINT       | Updated by       |
| deleted_at  | TIMESTAMP    | Soft delete      |

```sql
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
```

## Events Table

| Column Name  | Data Type    | Description   |
| ------------ | ------------ | ------------- |
| id           | BIGINT       | Event ID      |
| title        | VARCHAR(200) | Event title   |
| description  | TEXT         | Event details |
| start_date   | DATETIME     | Start date    |
| end_date     | DATETIME     | End date      |
| venue_id     | BIGINT       | Venue         |
| organizer_id | BIGINT       | Organizer     |
| max_capacity | INT          | Max attendees |
| status       | ENUM         | Event status  |
| created_at   | TIMESTAMP    | Created time  |
| updated_at   | TIMESTAMP    | Updated time  |
| created_by   | BIGINT       | Created by    |
| updated_by   | BIGINT       | Updated by    |
| deleted_at   | TIMESTAMP    | Soft delete   |

```sql
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
```

## Tickets Table

| Column Name | Data Type     | Description       |
| ----------- | ------------- | ----------------- |
| id          | BIGINT        | Ticket ID         |
| event_id    | BIGINT        | Event             |
| type        | ENUM          | Ticket type       |
| price       | DECIMAL(10,2) | Ticket price      |
| quantity    | INT           | Available tickets |
| created_at  | TIMESTAMP     | Created time      |
| updated_at  | TIMESTAMP     | Updated time      |
| created_by  | BIGINT        | Created by        |
| updated_by  | BIGINT        | Updated by        |
| deleted_at  | TIMESTAMP     | Soft delete       |

```sql
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
```

# Registrations

| Column Name | Data Type | Description     |
| ----------- | --------- | --------------- |
| id          | BIGINT    | Registration ID |
| user_id     | BIGINT    | Attendee        |
| event_id    | BIGINT    | Event           |
| ticket_id   | BIGINT    | Ticket          |
| check_in_at | TIMESTAMP | Check-in time   |
| created_at  | TIMESTAMP | Registered time |
| updated_at  | TIMESTAMP | Updated time    |
| created_by  | BIGINT    | Created by      |
| updated_by  | BIGINT    | Updated by      |
| deleted_at  | TIMESTAMP | Soft delete     |

```sql
CREATE TABLE registrations (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    event_id BIGINT NOT NULL,
    ticket_id_at TIMESTAMP NULL,
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
```

# Payments

| Column Name     | Data Type     | Description       |
| --------------- | ------------- | ----------------- |
| id              | BIGINT        | Payment ID        |
| registration_id | BIGINT        | Registration      |
| amount          | DECIMAL(10,2) | Paid amount       |
| method          | ENUM          | Payment method    |
| status          | ENUM          | Payment status    |
| transaction_ref | VARCHAR(255)  | Gateway reference |
| created_at      | TIMESTAMP     | Payment time      |
| updated_at      | TIMESTAMP     | Updated time      |
| created_by      | BIGINT        | Created by        |
| updated_by      | BIGINT        | Updated by        |
| deleted_at      | TIMESTAMP     | Soft delete       |

```sql
CREATE TABLE payments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    registration_id BIGINT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    method ENUM('credit_card','paypal','bank_transfer') NOT NULL,
    status ENUM('pending','paid','failed') DEFAULT 'pending',
    transaction_ref VARCHAR(255) NULL,
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
