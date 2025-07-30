<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Request</title>
</head>
<body>
    <h1>Loan Request Details</h1>
    @foreach($lead_details as $key => $value)
        <p><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</p>
    @endforeach
</body>
</html>
