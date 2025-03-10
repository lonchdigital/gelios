<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    {{-- <title>Повідомлення</title> --}}
</head>
<body>
    @forelse(explode("\n", $message2) as $message3)
    <p>{{ $message3 }}</p><br>
    @empty
    @endforelse
    {{-- <p>{{ $message2 }}</p> --}}
</body>
</html>
