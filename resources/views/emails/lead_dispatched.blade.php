<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Lead Assigned | Move Smooth</title>
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
            font-size: 24px;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .header p {
            color: #94a3b8;
            font-size: 14px;
            margin: 5px 0 0;
        }
        .content {
            padding: 40px 30px;
        }
        .lead-alert {
            background-color: #fff8f5;
            border-left: 4px solid #FF6B35;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 30px;
        }
        .lead-alert h3 {
            margin: 0 0 5px 0;
            color: #FF6B35;
            font-size: 16px;
            font-weight: 700;
        }
        .lead-alert p {
            margin: 0;
            font-size: 14px;
            color: #475569;
        }
        .section-title {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
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
            padding: 12px 0;
            font-size: 15px;
            vertical-align: top;
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
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            background-color: #FF6B35;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 30px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 30px;
            transition: background-color 0.2s ease;
            box-shadow: 0 4px 6px rgba(255, 107, 53, 0.2);
        }
        .footer {
            background-color: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #FF6B35;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Move Smooth</h1>
            <p>Certified Moving Network Partner</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="lead-alert">
                <h3>New General Moving Lead Assigned!</h3>
                <p>You have been selected as a preferred mover for this customer. Please contact them immediately to secure the booking.</p>
            </div>

            <!-- Customer Details -->
            <div class="section-title">Customer Information</div>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Name</td>
                    <td class="info-value">{{ $lead->name }}</td>
                </tr>
                <tr>
                    <td class="info-label">Email</td>
                    <td class="info-value"><a href="mailto:{{ $lead->email }}" style="color: #FF6B35; text-decoration: none;">{{ $lead->email }}</a></td>
                </tr>
                <tr>
                    <td class="info-label">Phone</td>
                    <td class="info-value"><a href="tel:{{ $lead->phone }}" style="color: #FF6B35; text-decoration: none;">{{ $lead->phone }}</a></td>
                </tr>
            </table>

            <!-- Move Details -->
            <div class="section-title">Move Details</div>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Origin (From)</td>
                    <td class="info-value" style="font-weight: bold;">{{ $lead->zip_from }}</td>
                </tr>
                <tr>
                    <td class="info-label">Destination (To)</td>
                    <td class="info-value" style="font-weight: bold;">{{ $lead->zip_to }}</td>
                </tr>
                <tr>
                    <td class="info-label">Move Date</td>
                    <td class="info-value">{{ $lead->move_date ? \Carbon\Carbon::parse($lead->move_date)->format('F d, Y') : 'To Be Determined' }}</td>
                </tr>
                <tr>
                    <td class="info-label">Move Size</td>
                    <td class="info-value"><span style="background-color: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 4px; font-size: 13px; font-weight: bold;">{{ $lead->move_size }}</span></td>
                </tr>
            </table>

            <div class="btn-wrapper">
                <a href="{{ route('company.leads') }}" class="btn">View Lead In Dashboard</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>This lead was dispatched by the <strong>Move Smooth</strong> administration.</p>
            <p>&copy; {{ date('Y') }} Move Smooth. All rights reserved.</p>
            <p>Need support? Contact us at <a href="mailto:contact@movesmooth.com">contact@movesmooth.com</a></p>
        </div>
    </div>
</body>
</html>
