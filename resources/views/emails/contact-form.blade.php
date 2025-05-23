<!DOCTYPE html>
<html>
<head>
    <title>Pesan Contact Form</title>
</head>
<body>
    <h2>Anda menerima pesan baru dari contact form</h2>
    
    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ $message }}</p>
</body>
</html>