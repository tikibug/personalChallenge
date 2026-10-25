<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $pageTitle }}</title>
</head>
<body>

<h1>{{ $pageTitle }}</h1>

<ul>
    <!-- Loop through the database collection -->
    @foreach ($genes as $gene)
        <li>{{ $gene->hgnc_id }} - {{ $gene->status }}</li>
    @endforeach
</ul>

</body>
</html>
