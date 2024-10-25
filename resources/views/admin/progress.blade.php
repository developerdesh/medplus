<!-- resources/views/batch/progress.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Progress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .progress {
            height: 40px;
            position: relative;
            border-radius: 20px;
        }

        .progress-bar {
            line-height: 40px; /* Vertically centers the text */
            font-weight: bold;
            font-size: 1.2em;
        }

        .progress-bar::after {
            content: attr(aria-valuenow) '%';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Batch Progress</h1>

        <div class="progress" role="progressbar" aria-label="Batch progress" aria-valuenow="{{ $batch->progress() }}" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $batch->progress() }}%">  {{ $batch->progress() }}%</div>
        </div>

        <p class="mt-3">Batch ID: {{ $batch->id }}</p>
        <p>Pending Jobs: {{ $batch->pendingJobs }}</p>
        <p>Processed Jobs: {{ $batch->processedJobs() }}</p>
        <p>Failed Jobs: {{ $batch->failedJobs }}</p>

        @if ($batch->progress() < 100)
            <script>
                // Refresh the page every 1 second if the progress is less than 100%
                setTimeout(function(){
                    location.reload();
                }, 1000); // 1000 milliseconds = 1 second
            </script>
        @else
            <p>Batch processing is complete.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
