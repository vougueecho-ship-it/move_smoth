<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Request Sent | Move Smooth</title>
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
            background-color: #0f172a;
            padding: 35px 30px;
            text-align: center;
            border-bottom: 4px solid #3b82f6;
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
        .success-box {
            background-color: #f0f9ff;
            border: 1px dashed #3b82f6;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 30px;
        }
        .success-title {
            margin: 0 0 5px 0;
            color: #0369a1;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .success-subtitle {
            font-size: 18px;
            color: #0f172a;
            font-weight: 800;
            margin: 10px 0;
        }
        .success-note {
            margin: 0;
            font-size: 13px;
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
        .mover-info-box {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            margin-top: 30px;
        }
        .mover-title {
            font-weight: 700;
            font-size: 15px;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .mover-text {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 10px 0;
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
            <p style="font-size: 16px; line-height: 1.6; margin-top: 0;">Hi {{ $lead->name }},</p>
            <p style="font-size: 15px; line-height: 1.6; color: #475569;">
                Your moving request has been successfully transmitted directly to <strong>{{ $lead->company->name ?? 'your chosen moving company' }}</strong>. A representative from the company will review your parameters and get in touch with you shortly.
            </p>

            {{-- Success Notification Box --}}
            <div class="success-box">
                <div class="success-title">Status: Dispatched</div>
                <div class="success-subtitle">Direct Quote Request Sent</div>
                <p class="success-note">To: <strong>{{ $lead->company->name ?? 'Selected Moving Company' }}</strong></p>
            </div>

            {{-- Info Table --}}
            <div class="section-title">Your Moving Parameters</div>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Moving From</td>
                    <td class="info-value">{{ $lead->move_from }}</td>
                </tr>
                <tr>
                    <td class="info-label">Moving To</td>
                    <td class="info-value">{{ $lead->move_to }}</td>
                </tr>
                <tr>
                    <td class="info-label">Relocation Date</td>
                    <td class="info-value">
                        @if($lead->move_date instanceof \DateTimeInterface)
                            {{ $lead->move_date->format('F d, Y') }}
                        @else
                            {{ date('F d, Y', strtotime($lead->move_date)) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="info-label">Move Size</td>
                    <td class="info-value">{{ $lead->move_size }}</td>
                </tr>
                <tr>
                    <td class="info-label">Number of Rooms</td>
                    <td class="info-value">{{ $lead->num_rooms }}</td>
                </tr>
                <tr>
                    <td class="info-label">Packing Service</td>
                    <td class="info-value">{{ $lead->packing_service }}</td>
                </tr>
                <tr>
                    <td class="info-label">Storage Option</td>
                    <td class="info-value">{{ $lead->storage_option }}</td>
                </tr>
                @if($lead->message)
                <tr>
                    <td class="info-label">Special Instructions</td>
                    <td class="info-value" style="font-weight: normal; font-style: italic;">"{{ $lead->message }}"</td>
                </tr>
                @endif
            </table>

            {{-- Company details and vetted badge info --}}
            <div class="mover-info-box">
                <h4 class="mover-title"><i class="fas fa-shield-halved" style="color:#2563eb; margin-right: 5px;"></i> MoveSmooth Verified Mover</h4>
                <p class="mover-text">
                    <strong>{{ $lead->company->name }}</strong> is a vetted and verified member of the MoveSmooth network. 
                    @if($lead->company->phone)
                        You can also contact them directly at <strong>{{ $lead->company->phone }}</strong>.
                    @endif
                </p>
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
