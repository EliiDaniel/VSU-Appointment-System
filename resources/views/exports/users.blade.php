<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Export</title>
</head>
<body>
    <div>

        <img src="images/VSUAS LOGO.png" alt="" width="150px">
    </div>
    <table class="comicGreen" style="font-family: 'Times New Roman', Times, serif; border: 2px solid #4F7849; background-color: #EEEEEE; width: 100%; text-align: center; border-collapse: collapse;">
        <thead>
            <tr>
                <th colspan="5" style="font-size: 25px; font-weight: bold; text-align: center;" valign="middle">
                    VSU Appointment System Users Data
                </th>
            </tr>
            <tr>
                <th colspan="5" style="font-size: 12px; font-weight: bold; text-align: center;" valign="middle">
                    {{ $start->format('Y-m-d') . ' - ' . $end->format('Y-m-d') }}
                </th>
            </tr>
            <tr>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">ID</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">NAME</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">EMAIL</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">JOINED</th>
                <th style="font-size: 14px; font-weight: bold; color: #FFFFFF; text-align: center; border-left: 4px solid #CEE0CC; background: #4F7849; background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%); background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%); border-bottom: 1px solid #444444;">ROLE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white;">{{ $user->id }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white;">{{ $user->name }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white">{{ $user->email }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white">{{ $user->created_at }}</td>
                    <td style="border: 1px solid #4F7849; padding: 3px 2px; font-size: 12px; color: #000000; background: white">{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
