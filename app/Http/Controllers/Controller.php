<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Ynovee Hotel Booking API",
 *     version="1.0.0",
 *     description="REST API for the Ynovee Hotel Booking System. Supports room management, bookings, Stripe payments, and content management.",
 *     @OA\Contact(email="noreply@ynovee.com")
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter the Bearer token obtained from POST /api/auth/login"
 * )
 *
 * @OA\Schema(
 *     schema="RoomType",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string", example="Deluxe Ocean View"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="capacity", type="integer", example=2),
 *     @OA\Property(property="price_usd", type="number", format="float", example=150.00),
 *     @OA\Property(property="price_eur", type="number", format="float", example=140.00),
 *     @OA\Property(property="price_ghs", type="number", format="float", example=2500.00),
 *     @OA\Property(property="total_rooms", type="integer", example=5),
 *     @OA\Property(property="amenities", type="array", @OA\Items(type="integer")),
 *     @OA\Property(property="images", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="Booking",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="room_type_id", type="integer"),
 *     @OA\Property(property="customer_name", type="string"),
 *     @OA\Property(property="customer_email", type="string", format="email"),
 *     @OA\Property(property="customer_phone", type="string"),
 *     @OA\Property(property="check_in", type="string", format="date", example="2025-01-01"),
 *     @OA\Property(property="check_out", type="string", format="date", example="2025-01-05"),
 *     @OA\Property(property="guests_count", type="integer"),
 *     @OA\Property(property="total_price", type="number", format="float"),
 *     @OA\Property(property="currency", type="string", enum={"USD","EUR","GHS"}),
 *     @OA\Property(property="status", type="string", enum={"pending","confirmed","checked_in","checked_out","cancelled"}),
 *     @OA\Property(property="created_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="Slide",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="image_url", type="string"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="subtitle", type="string"),
 *     @OA\Property(property="cta_link", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="Amenity",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="icon_url", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="Place",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="location", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="rating", type="number", format="float"),
 *     @OA\Property(property="image_url", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="Activity",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="image_url", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="Review",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="role", type="string"),
 *     @OA\Property(property="feedback", type="string"),
 *     @OA\Property(property="rating", type="integer", minimum=1, maximum=5),
 *     @OA\Property(property="image_url", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="Article",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="author", type="string"),
 *     @OA\Property(property="category", type="string"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="image_url", type="string"),
 *     @OA\Property(property="published_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="ServiceValue",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="icon_url", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="Inquiry",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="email", type="string", format="email"),
 *     @OA\Property(property="message", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="Subscriber",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="email", type="string", format="email")
 * )
 *
 * @OA\Schema(
 *     schema="User",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="email", type="string", format="email"),
 *     @OA\Property(property="username", type="string")
 * )
 */
abstract class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
