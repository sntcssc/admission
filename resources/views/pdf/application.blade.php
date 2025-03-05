<!DOCTYPE html>
<html>
<head>
    <title>Application Summary</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Application Summary</h2>
        <p>Application ID: {{ $application->application_number }}</p>
    </div>

    <div class="section">
        <h3>Personal Details</h3>
        <table>
            <tr><th>Name:</th><td>{{ $application->student->full_name }}</td></tr>
            <tr><th>Date of Birth:</th><td>{{ $application->student->dob->format('d/m/Y') }}</td></tr>
            <!-- Add more personal details -->
        </table>
    </div>

    <div class="section">
        <h3>Academic Qualifications</h3>
        <table>
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Institution</th>
                    <th>Year</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($application->academics as $academic)
                <tr>
                    <td>{{ $academic->level }}</td>
                    <td>{{ $academic->institute }}</td>
                    <td>{{ $academic->year_passed }}</td>
                    <td>{{ $academic->percentage }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add other sections -->
</body>
</html>