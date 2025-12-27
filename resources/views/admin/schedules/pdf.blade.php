<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Class Schedules</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9pt;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #667eea;
            font-size: 20pt;
        }
        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 9pt;
        }
        .info-box {
            background: #f8f9fa;
            padding: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
        }
        .info-box p {
            margin: 2px 0;
            font-size: 8pt;
        }
        .day-section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .day-header {
            background-color: #667eea;
            color: white;
            padding: 6px 10px;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th {
            background-color: #f8f9fa;
            color: #333;
            padding: 6px;
            text-align: left;
            font-size: 8pt;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        td {
            padding: 5px 6px;
            border: 1px solid #ddd;
            font-size: 8pt;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .time-col {
            white-space: nowrap;
            font-weight: bold;
            color: #667eea;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 7pt;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 3px;
        }
        .page-number:after {
            content: counter(page);
        }
        .no-data {
            text-align: center;
            padding: 15px;
            color: #999;
            font-style: italic;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Class Schedules</p>
    </div>

    <div class="info-box">
        <p><strong>Report Generated:</strong> {{ now()->format('F d, Y h:i A') }}</p>
        <p><strong>Total Classes:</strong> {{ $schedulesByDay->flatten()->count() }}</p>
    </div>

    @php
        $daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $sortedSchedules = $schedulesByDay->sortBy(function($item, $key) use ($daysOrder) {
            return array_search($key, $daysOrder);
        });
    @endphp

    @if($schedulesByDay->count() > 0)
        @foreach($sortedSchedules as $day => $schedules)
        <div class="day-section">
            <div class="day-header">{{ $day }}</div>

            @if($schedules->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 12%;">Time</th>
                        <th style="width: 18%;">Subject</th>
                        <th style="width: 18%;">Teacher</th>
                        <th style="width: 15%;">Grade/Section</th>
                        <th style="width: 12%;">Room</th>
                        <th style="width: 25%;">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules->sortBy('start_time') as $schedule)
                    <tr>
                        <td class="time-col">
                            {{ date('g:i A', strtotime($schedule->start_time)) }}<br>
                            <span style="font-size: 7pt; color: #666;">{{ date('g:i A', strtotime($schedule->end_time)) }}</span>
                        </td>
                        <td><strong>{{ $schedule->subject->subject_name ?? 'N/A' }}</strong></td>
                        <td>{{ $schedule->teacher->full_name ?? $schedule->teacher->name ?? 'TBA' }}</td>
                        <td>{{ $schedule->grade_level }} - {{ $schedule->section }}</td>
                        <td>{{ $schedule->room ?? 'TBA' }}</td>
                        <td style="font-size: 7pt; color: #666;">
                            {{ Str::limit($schedule->subject->description ?? '', 80) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="no-data">No classes scheduled for this day</div>
            @endif
        </div>
        @endforeach
    @else
    <p style="text-align: center; padding: 40px; color: #666;">No schedules found.</p>
    @endif

    <div class="footer">
        <p>{{ config('app.name') }} - Class Schedules | Generated on {{ now()->format('M d, Y') }} | Page <span class="page-number"></span></p>
    </div>
</body>
</html>
