<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NutryDairy</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    <!-- Vite (untuk Tailwind & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    /* Custom styling untuk konten Quill */
    .article-content {
        font-size: 1rem;
        line-height: 1.75;
        color: #1f2937;
    }
    
    /* Bullet list styling */
    .article-content ul {
        list-style-type: disc !important;
        padding-left: 2.5rem !important;
        margin: 1rem 0 !important;
    }
    
    .article-content ul li {
        display: list-item !important;
        margin: 0.5rem 0 !important;
    }
    
    /* Numbered list styling */
    .article-content ol {
        list-style-type: decimal !important;
        padding-left: 2.5rem !important;
        margin: 1rem 0 !important;
    }
    
    .article-content ol li {
        display: list-item !important;
        margin: 0.5rem 0 !important;
    }
    
    /* Nested lists */
    .article-content ul ul,
    .article-content ol ol,
    .article-content ul ol,
    .article-content ol ul {
        margin: 0.25rem 0 !important;
    }
    
    /* Headings */
    .article-content h1 {
        font-size: 2rem !important;
        font-weight: 700 !important;
        margin: 1.5rem 0 1rem !important;
    }
    
    .article-content h2 {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        margin: 1.25rem 0 0.75rem !important;
    }
    
    .article-content h3 {
        font-size: 1.25rem !important;
        font-weight: 600 !important;
        margin: 1rem 0 0.5rem !important;
    }
    
    /* Paragraphs */
    .article-content p {
        margin: 1rem 0 !important;
    }
    
    /* Links */
    .article-content a {
        color: #3b82f6 !important;
        text-decoration: underline !important;
    }
    
    /* Text formatting */
    .article-content strong {
        font-weight: 700 !important;
    }
    
    .article-content em {
        font-style: italic !important;
    }
    
    .article-content u {
        text-decoration: underline !important;
    }
    
    /* Quill specific classes */
    .article-content .ql-indent-1 {
        padding-left: 3rem !important;
    }
    
    .article-content .ql-indent-2 {
        padding-left: 6rem !important;
    }
</style>
</head>

<body class="">
    <x-navbar />

    <main class="min-h-screen">
        @yield('content')
    </main>

    <x-footer />
    @stack('scripts')

</body>

</html>