<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3fef3; /* Light green background */
            color: #155724; /* Dark green text */
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #d4edda; /* Soft green container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0c4128; /* Darker green heading */
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        strong {
            color: #0b3e2b; /* Slightly darker green for labels */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Form Submission</h2>
        <p><strong>FirsName:</strong> {{ $contactData['first_name'] }}</p>
        <p><strong>Name:</strong> {{ $contactData['last_name'] }}</p>
        <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
        <p><strong>Phone:</strong> {{ $contactData['phone'] }}</p>
        <p><strong>Date:</strong> {{ $contactData['appointment_date'] }}</p>
        <p><strong>Time:</strong> {{ $contactData['appointment_time'] }}</p>
        <p><strong>Message:</strong> {{ $contactData['message'] }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $contactData['message'] }}</p>
    </div>
</body>
</html>
