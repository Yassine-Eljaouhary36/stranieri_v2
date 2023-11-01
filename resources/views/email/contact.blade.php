<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007BFF;
        }

        .info {
            margin-top: 20px;
        }

        .info-label {
            font-weight: bold;
        }

        .message {
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Form Submission</h1>
        <div class="info">
            <p><span class="info-label">Name:</span> {{ $dataMail['name'] }}</p>
            <p><span class="info-label">Email:</span> {{ $dataMail['email'] }}</p>
            <p><span class="info-label">Phone:</span> {{ $dataMail['phone'] }}</p>
            <p><span class="info-label">Subject:</span> {{ $dataMail['subject'] }}</p>
        </div>
        <div class="message">
            <p><strong>Message:</strong></p>
            <p>{{ $dataMail['comment'] }}</p>
        </div>
    </div>
</body>
</html>
