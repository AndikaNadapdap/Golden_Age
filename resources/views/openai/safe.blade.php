<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenAI (Safe) - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Paduan 1000 Hari</a>
        <div>
            <a class="btn btn-outline-secondary btn-sm" href="{{ url('/') }}">Beranda</a>
        </div>
    </div>
</nav>

<main class="container">
    <h1 class="mb-3">OpenAI (Safe)</h1>

    @if ($errors->has('openai'))
        <div class="alert alert-danger">{{ $errors->first('openai') }}</div>
    @endif

    @if (session('openai_response'))
        <div class="card mb-3"><div class="card-body">{{ session('openai_response') }}</div></div>
    @endif

    <form method="POST" action="{{ route('openai.safe.chat') }}">
        @csrf
        <div class="mb-3">
            <label for="prompt" class="form-label">Prompt</label>
            <textarea name="prompt" id="prompt" class="form-control" rows="4">{{ old('prompt') }}</textarea>
        </div>
        <button class="btn btn-primary">Send</button>
    </form>

</main>

<footer class="mt-5 py-4 text-center text-muted">
    &copy; {{ date('Y') }} Paduan 1000 Hari
</footer>

</body>
</html>
