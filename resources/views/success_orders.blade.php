<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Success Orders Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
            color: gray;
        }

        .order {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .order-title {
            font-size: 14px;
            font-weight: bold;
            background-color: #f2f2f2;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .details {
            margin: 10px 0;
            font-size: 12px;
        }

        .meals-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .meals-table th,
        .meals-table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
            text-align: left;
        }

        .meals-table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Success Orders Report</h2>
            <p>Generated on: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
            <p>
                Report Date: <strong>{{ $selectedDate }}</strong>
            </p>
        </div>

        @foreach ($data as $record)
        <div class="order">
            <div class="order-title">
                Success Order #{{ $record['successOrder']['id'] }} - {{ $record['successOrder']['invoice_no'] }}
            </div>
            <div class="details">
                <p><strong>Total Amount:</strong> P {{ number_format($record['successOrder']['total_amount'], 2) }}</p>
                <p><strong>Tender:</strong> P {{ number_format($record['successOrder']['tender'], 2) }}</p>
                <p><strong>Change:</strong> P {{ number_format($record['successOrder']['change'], 2) }}</p>
                <p><strong>Payment Method:</strong> {{ $record['successOrder']['paymentMethod'] }}</p>
                <p><strong>Order Type:</strong> {{ $record['successOrder']['orderType'] }}</p>
                <p><strong>Discounted:</strong> {{ $record['successOrder']['isDiscounted'] ? 'Yes' : 'No' }}</p>
                <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($record['successOrder']['created_at'])->toFormattedDateString() }}</p>
            </div>

            <div class="details">
                <p><strong>Crew Details:</strong></p>
                <p><strong>Name:</strong> {{ $record['user']['name'] }}</p>
                <p><strong>Crew ID:</strong> {{ $record['user']['crew_id'] }}</p>
            </div>

            <table class="meals-table">
                <thead>
                    <tr>
                        <th>Meal Name</th>
                        <th>Meal Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($record['success_order_meal'] as $meal)
                    <tr>
                        <td>{{ $meal['meal_name'] }}</td>
                        <td>{{ number_format($meal['meal_price'], 2) }}</td>
                        <td>{{ $meal['quantity'] }}</td>
                        <td>P {{ number_format($meal['meal_price'] * $meal['quantity'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach

    </div>
</body>

</html>