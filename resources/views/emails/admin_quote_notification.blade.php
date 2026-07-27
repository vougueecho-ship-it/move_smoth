<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Quote Request Received | Move Smooth Admin</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }
        .header {
            background-color: #0A1628;
            padding: 30px;
            text-align: center;
            border-bottom: 4px solid #FF6B35;
        }
        .header h1 {
            color: #ffffff;
            font-size: 22px;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .header p {
            color: #94a3b8;
            font-size: 13px;
            margin: 5px 0 0;
        }
        .content {
            padding: 40px 30px;
        }
        .alert-bar {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 30px;
        }
        .alert-bar h3 {
            margin: 0 0 5px 0;
            color: #1d4ed8;
            font-size: 16px;
            font-weight: 700;
        }
        .alert-bar p {
            margin: 0;
            font-size: 14px;
            color: #475569;
        }
        .section-title {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 700;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .info-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .info-grid td {
            padding: 10px 0;
            font-size: 15px;
            vertical-align: top;
            border-bottom: 1px solid #f8fafc;
        }
        .info-label {
            width: 35%;
            font-weight: 600;
            color: #64748b;
        }
        .info-value {
            color: #0f172a;
            font-weight: 500;
        }
        .btn-wrapper {
            text-align: center;
            margin-top: 35px;
        }
        .btn {
            display: inline-block;
            background-color: #FF6B35;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 28px;
            font-weight: 700;
            font-size: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.2);
            transition: all 0.2s ease;
        }
        .footer {
            background-color: #f8fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #edf2f7;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="header">
            <h1>Move Smooth Admin</h1>
            <p>Notification Center</p>
        </div>

        {{-- Content --}}
        <div class="content">
            <div class="alert-bar">
                <h3>New Quote Request Created</h3>
                <p>A new customer has successfully estimated their moving cost on the platform.</p>
            </div>

            <div class="section-title">Customer Information</div>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Full Name</td>
                    <td class="info-value" style="font-weight: bold; color: #1e293b;">{{ $quote->name }}</td>
                </tr>
                <tr>
                    <td class="info-label">Email Address</td>
                    <td class="info-value"><a href="mailto:{{ $quote->email }}" style="color: #FF6B35; text-decoration: none;">{{ $quote->email }}</a></td>
                </tr>
                <tr>
                    <td class="info-label">Phone Number</td>
                    <td class="info-value">{{ $quote->phone }}</td>
                </tr>
            </table>

            <div class="section-title">Relocation Specifics</div>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Moving From</td>
                    <td class="info-value">{{ $quote->zip_from }}</td>
                </tr>
                <tr>
                    <td class="info-label">Moving To</td>
                    <td class="info-value">{{ $quote->zip_to }}</td>
                </tr>
                <tr>
                    <td class="info-label">Relocation Date</td>
                    <td class="info-value">{{ $quote->move_date ? $quote->move_date->format('F d, Y') : 'Not Scheduled' }}</td>
                </tr>
                <tr>
                    <td class="info-label">Shipment Size</td>
                    <td class="info-value">{{ $quote->move_size }}</td>
                </tr>
                <tr>
                    <td class="info-label">Distance Calculated</td>
                    <td class="info-value" style="font-weight: bold;">{{ $quote->calculated_distance }} miles</td>
                </tr>
                <tr>
                    <td class="info-label">Calculated Price Range</td>
                    <td class="info-value" style="color: #FF6B35; font-weight: bold;">${{ number_format($quote->min_price) }} – ${{ number_format($quote->max_price) }}</td>
                </tr>
            </table>

            <div class="btn-wrapper">
                <a href="{{ route('admin.dashboard') }}" class="btn">Go to Admin Dashboard</a>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>Sent automatically by Move Smooth Notification Center.</p>
            <p>&copy; {{ date('Y') }} Move Smooth. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
