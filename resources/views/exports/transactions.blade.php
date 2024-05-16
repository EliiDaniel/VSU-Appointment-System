<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Export</title>
</head>
<body>
    <div>

        <img src="images/VSUAS LOGO.png" alt="" width="150px">
    </div>
    <table class="comicGreen" style="font-family: 'Times New Roman', Times, serif; border: 2px solid #4F7849; background-color: #EEEEEE; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
            <tr>
                <th colspan="5" style="font-size: 25px; font-weight: bold; text-align: center;" valign="middle">
                    VSU Appointment System Transactions Data
                </th>
            </tr>
            <tr>
                <th colspan="5" style="font-size: 12px; font-weight: bold; text-align: center;" valign="middle">
                    {{ $start->format('Y-m-d') . ' - ' . $end->format('Y-m-d') }}
                </th>
            </tr>
            <tr>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">ID</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">REQUEST TRACKING CODE</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">CHECKOUT ID</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">REFERENCE NO</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">CREATED</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white;">{{ $transaction->id }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white;">{{ $transaction->request->tracking_code }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white">{{ $transaction->checkout_id }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white">{{ $transaction->reference_no }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white">{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
