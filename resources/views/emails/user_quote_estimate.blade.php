<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Free Moving Cost Estimate | Move Smooth</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
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
            border: 1px solid #edf2f7;
        }
        .header {
            background-color: #0A1628;
            padding: 35px 30px;
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
        .estimate-box {
            background-color: #fff8f5;
            border: 1px dashed #FF6B35;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 30px;
        }
        .estimate-title {
            margin: 0 0 5px 0;
            color: #475569;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .estimate-price {
            font-size: 32px;
            color: #FF6B35;
            font-weight: 800;
            margin: 10px 0;
        }
        .estimate-sub {
            margin: 0;
            font-size: 13px;
            color: #64748b;
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
            color: #1e293b;
            font-weight: 700;
        }
        .guide-box {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            margin-top: 30px;
        }
        .guide-title {
            font-weight: 700;
            font-size: 15px;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .guide-text {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 15px 0;
        }
        .guide-list {
            margin: 0;
            padding-left: 20px;
            font-size: 13.5px;
            color: #475569;
            line-height: 1.6;
        }
        .guide-list li {
            margin-bottom: 6px;
        }
        .footer {
            background-color: #f8fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #edf2f7;
            font-size: 13px;
            color: #64748b;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="header">
            <h1>Move Smooth</h1>
            <p>Your Hassle-Free Relocation Partner</p>
        </div>

        {{-- Content --}}
        <div class="content">
            <p style="font-size: 16px; line-height: 1.6; margin-top: 0;">Hi {{ $quote->name }},</p>
            <p style="font-size: 15px; line-height: 1.6; color: #475569;">
                Thank you for using our interactive Moving Cost Calculator! Based on the relocation parameters you provided, we have compiled your custom, free moving cost estimate.
            </p>

            {{-- Estimate box --}}
            <div class="estimate-box">
                <div class="estimate-title">Estimated Cost Range</div>
                <div class="estimate-price">${{ number_format($quote->min_price) }} – ${{ number_format($quote->max_price) }}</div>
                <p class="estimate-sub">Based on a distance of {{ $quote->calculated_distance }} miles for a {{ $quote->move_size }} shipment.</p>
            </div>

            {{-- Info Table --}}
            <div class="section-title">Your Move Parameters</div>
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
            </table>

            {{-- Vetting Advice --}}
            <div class="guide-box">
                <h4 class="guide-title"><i class="fas fa-shield-halved" style="color:#FF6B35; margin-right: 5px;"></i> Consumer Protection Tips</h4>
                <p class="guide-text">
                    This estimate acts as an initial guidance tool. To guarantee a secure, stress-free move, always observe these consumer protection best practices:
                </p>
                <ul class="guide-list">
                    <li><strong>Verify DOT Licensing:</strong> Any mover crossing state lines MUST have an active USDOT and MC number registered with the Federal Motor Carrier Safety Administration (FMCSA).</li>
                    <li><strong>Request Binding Estimates:</strong> Ensure you get a binding or "binding-not-to-exceed" written agreement from the mover so your final price is legally protected.</li>
                    <li><strong>Check Reviews:</strong> Review the company's verified review profiles on Move Smooth to examine real user feedback.</li>
                </ul>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <p><strong>Move Smooth</strong></p>
            <p>Connecting you with top-rated, fully licensed, and verified professional moving companies nationwide.</p>
            <p style="margin-top: 15px; font-size: 11px; color: #94a3b8;">&copy; {{ date('Y') }} Move Smooth. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
