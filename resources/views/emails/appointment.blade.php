<!DOCTYPE html>
<html>
<head>
    <title>New Appointment Booking</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #2E8B57; text-align: center;">New Appointment Booking</h2>

        <p style="font-size: 16px; line-height: 1.5;">Dear {{ $first_name }},</p>
        <p style="font-size: 16px; line-height: 1.5;">Thank you for booking an appointment with us. Below are the details of your appointment:</p>

        <ul style="list-style-type: none; padding: 0;">
            <li style="margin-bottom: 10px;"><strong>First Name:</strong> {{ $first_name }}</li>
            <li style="margin-bottom: 10px;"><strong>Last Name:</strong> {{ $last_name }}</li>
            <li style="margin-bottom: 10px;"><strong>Email:</strong> {{ $email }}</li>
            <li style="margin-bottom: 10px;"><strong>Phone:</strong> {{ $phone }}</li>
            <li style="margin-bottom: 10px;"><strong>Date:</strong> {{ $appointment_date }}</li>
            <li style="margin-bottom: 10px;"><strong>Time:</strong> {{ $appointment_time }}</li>
        </ul>

        <p style="font-size: 16px; line-height: 1.5;">We look forward to seeing you soon!</p>

        <hr style="border: 1px solid #2E8B57; margin: 20px 0;">

        <p style="text-align: center; color: #555;">Best regards,<br>BreemHealthcare Team</p>
    </div>
</body>
</html>
