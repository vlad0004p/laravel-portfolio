<x-layout.main>
    @vite(['public/css/error404.css'])
    <div class="error-items">
        <div class="error-text">
            <h1 class="number">404</h1>
            <h2 class="error-explain">The page says 'Meaw'.</h2>
            <h2 class="error-explain">Please go back.</h2>
            <a href="javascript:history.back()">
                <img class="arrow" src="{{ asset('images/arrow.png') }}" alt="Back">
            </a>
        </div>
        <img src="{{ asset('images/cat.png') }}" class="image1" alt="cat">
    </div>
</x-layout.main>
