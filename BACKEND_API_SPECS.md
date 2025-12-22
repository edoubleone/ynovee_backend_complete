# Comprehensive Backend API Documentation (Hotel System Update)

This documentation outlines the complete API requirements for the **Ynovee** application, now upgraded to a **Standard Hotel Booking System**.

**Base URL**: `http://your-backend-domain.com/api` (PROD) / `http://localhost:8000/api` (DEV)
**Authentication**: All "Admin" endpoints require an `Authorization: Bearer <token>` header.

---

## 1. Authentication (Admin)
*(Unchanged from previous version)*
- `POST /auth/login`
- `GET /auth/me`

---

## 2. Room Management (New Core Feature)

Manages hotel inventory, types, and dynamic pricing.

### Data Model: `RoomType`
| Field | Type | Required | Description |
| :--- | :--- | :--- | :--- |
| `id` | Integer | - | PK |
| `name` | String | Yes | e.g., "Deluxe Ocean View", "Presidential Suite" |
| `description` | Text | Yes | Full details of the room. |
| `capacity` | Integer | Yes | Max guests (e.g., 2). |
| `price_usd` | Decimal | Yes | Price in USD (North America). |
| `price_eur` | Decimal | Yes | Price in EUR (Europe). |
| `price_ghs` | Decimal | Yes | Price in GHS (Ghana/Local). |
| `amenities` | Array | No | List of amenity IDs. |
| `images` | Array | Yes | URLs of room photos. |
| `total_rooms` | Integer | Yes | Total physical rooms of this type (inventory size). |

### Endpoints & Payloads

*   `GET /rooms` - Public list of Room Types. Support query params:
    *   `start_date`, `end_date`: Filter by availability.
    *   `guests`: Filter by capacity.
*   `GET /rooms/:id` - Details for a specific room type.
*   `POST /rooms` - Admin create Room Type.
    *   **Payload**:
        ```json
        {
          "name": "Deluxe Suite",
          "description": "Ocean view luxury...",
          "capacity": 2,
          "price_usd": 150.00,
          "price_eur": 140.00,
          "price_ghs": 2500.00,
          "total_rooms": 5,
          "image_url": "http://example.com/img.jpg"
        }
        ```
*   `PUT /rooms/:id` - Admin update Room Type (Same payload as POST).
*   `DELETE /rooms/:id` - Admin delete.

---

## 3. Booking & Availability (New Core Feature)

Handles the reservation logic.

### Data Model: `Booking`
| Field | Type | Required | Description |
| :--- | :--- | :--- | :--- |
| `id` | Integer | - | PK |
| `room_type_id` | Integer | Yes | FK to RoomType. |
| `customer_name` | String | Yes | Full name. |
| `customer_email` | String | Yes | Contact email. |
| `customer_phone` | String | Yes | Phone number. |
| `check_in` | Date | Yes | YYYY-MM-DD. |
| `check_out` | Date | Yes | YYYY-MM-DD. |
| `guests_count` | Integer | Yes | Number of people. |
| `total_price` | Decimal | Yes | Calculated total cost. |
| `currency` | Enum | Yes | 'USD', 'EUR', 'GHS'. |
| `status` | Enum | Yes | 'pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'. |

### Endpoints & Payloads

*   `POST /bookings` - Create a new booking (Public/User).
    *   **Payload**:
        ```json
        {
          "room_type_id": 1,
          "check_in": "2024-12-25",
          "check_out": "2024-12-30",
          "guests": 2,
          "customer_name": "John Doe",
          "customer_email": "john@example.com",
          "customer_phone": "+1234567890",
          "currency": "USD"
        }
        ```
*   `GET /bookings` - Admin list all bookings (Filter by status, date).
*   `PUT /bookings/:id/status` - Admin update status.
    *   **Payload**: `{ "status": "confirmed" }`
*   `DELETE /bookings/:id` - Admin cancel booking.
    *   **Logic**: Must set status to `cancelled` (or soft delete).
    *   **Availability**: The system MUST immediately release the room inventory for the booked dates, allowing other users to book it again.
    *   **Availability Logic Formula**:
        `Count(Existing Bookings for RoomType X where dates overlap AND status != 'cancelled') < RoomType.total_rooms`

### Email Notifications (Requirement)
Upon successful creation (`POST /bookings`), the backend **MUST** send a confirmation email to `customer_email` containing:
*   **Booking Reference ID**
*   **Room Number/Name**
*   **Check-in / Check-out Dates & Times**
*   **List of Room Features/Amenities**
*   **Total Amount Paid**

---

## 4. Payment System (New)

Handles Stripe payment processing.

### Endpoints
*   `POST /create-payment-intent` - Generate a Stripe Payment Intent.
    *   **Payload**:
        ```json
        {
          "room_type_id": 1,
          "check_in": "2024-12-25",
          "check_out": "2024-12-30",
          "guests": 2,
          "currency": "USD"
        }
        ```
    *   **Response**: `{ "clientSecret": "pi_12345_secret_abcde", "amount": 15000 }`

---

## 5. Dynamic Pricing & Localization

The frontend will detect user region (or allow toggle) and request pricing accordingly.

### Logic
- **North America**: Show `price_usd` ($).
- **Europe**: Show `price_eur` (€).
- **Ghana/Africa**: Show `price_ghs` (₵).

---

## 5. General Content (Existing)

*(Retained from previous version)*
- **Hero Slides (`/slides`)** - Managed by Admin.
    ### Data Model: `Slide`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `image_url` | String | Yes | Background image. |
    | `title` | String | Yes | Large heading. |
    | `subtitle` | String | Yes | Smaller text. |
    | `cta_link` | String | No | URL for button (e.g., "/booking"). |

- **Amenities (`/amenities`)** - Managed by Admin.
    ### Data Model: `Amenity`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `title` | String | Yes | e.g. "Free WiFi", "Swimming Pool". |
    | `icon_url` | String | Yes | URL to icon image. |

- **Places (`/places`)** - Managed by Admin.
    ### Data Model: `Place`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `title` | String | Yes | Name of the attraction. |
    | `location` | String | Yes | e.g., "Accra". |
    | `description` | Text | Yes | Short summary. |
    | `content` | LongText | No | HTML content for "Read More". |
    | `rating` | Float | No | 0-5 stars. |
    | `image_url` | String | Yes | |

- **Activities (`/activities`)** - Managed by Admin.
    ### Data Model: `Activity`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `title` | String | Yes | e.g. "Canopy Walk". |
    | `description` | Text | Yes | |
    | `image_url` | String | Yes | |

- **Service Values (`/service-values`)** - Managed by Admin.
    ### Data Model: `ServiceValue`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `title` | String | Yes | e.g. "Integrity". |
    | `description` | Text | Yes | |
    | `icon_url` | String | Yes | |

- **Reviews (`/reviews`)** - Managed by Admin.
    ### Data Model: `Review`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `name` | String | Yes | Reviewer Name. |
    | `role` | String | No | e.g. "Tourist". |
    | `feedback` | Text | Yes | The review content. |
    | `rating` | Integer | Yes | 1-5. |
    | `image_url` | String | No | Reviewer avatar. |

- **Articles (`/articles`)** - Managed by Admin.
    ### Data Model: `Article` (Blog)
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `title` | String | Yes | Blog post title. |
    | `author` | String | Yes | Author name. |
    | `category` | String | Yes | e.g. "Travel", "Food". |
    | `content` | LongText | Yes | Full HTML content. |
    | `image_url` | String | Yes | Featured image. |
    | `published_at` | DateTime | Yes | |

- **Inquiries (`/inquiries`)** - Contact Form.
    ### Data Model: `Inquiry`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `name` | String | Yes | |
    | `email` | String | Yes | |
    | `message` | Text | Yes | |
    | `created_at` | DateTime | - | |

- **Newsletter (`/newsletter`)** - Email Subscription.
    ### Data Model: `Subscriber`
    | Field | Type | Required | Description |
    | :--- | :--- | :--- | :--- |
    | `id` | Integer | - | PK |
    | `email` | String | Yes | Unique. |

- **Settings (`/settings`)** - Managed by Admin.
    *   `GET /settings` - Returns key-value pair object (e.g. `{ "site_name": "Ynovee", "contact_email": "..." }`)
    *   `POST /settings` - Update settings.

---

## 6. Summary of Frontend Integration

1.  **Home Page**:
    *   "Book Now" buttons redirect to `/booking`.
    *   Hero Search Bar redirects to `/booking` with query params (dates, guests).

2.  **Booking Page (`/booking`)**:
    *   **Currency Toggle**: Switch between USD/EUR/GHS.
    *   **Search**: Date Range Picker, Guest Count.
    *   **Results**: List of defined `RoomType`s.
        *   Show Price in selected currency.
        *   Show "Sold Out" if availability check fails.
    *   **Checkout**: Simple form to submit user details and create `Booking`.

3.  **Admin Dashboard**:
    *   **Rooms Manager**: Manage Room Types, Prices, Inventory.
    *   **Bookings Manager**: Calendar/List view of reservations.
