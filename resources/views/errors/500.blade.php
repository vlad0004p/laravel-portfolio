<x-layout.main>
    @vite(['public/css/error500.css'])
    <h2>{{ $exception->getMessage() }}</h2>
    <div class="error-items">
        <div class="error-text">
            <h1 class="number">500</h1>
            <h2 class="error-explain">The server says 'Meaw'.</h2>
            <div class="text-and-button">
                    <h2 class="error-explain">Please reload the page</h2>
                <button type="button" onclick="location.reload()" style="background: none; border: none; padding: 0; cursor: pointer;">
                    <img class="reload" src="{{ asset('images/reload.png') }}" alt="Reload Page">
                </button>
            </div>
            <div class="text-and-button">
                <h2 class="error-explain">If the problem persist, return to the Homepage</h2>
                <button class="home">
                    <a href="{{route('index')}}">Return to Homepage</a>
                </button>
            </div>
        </div>
        <img src="{{ asset('images/cat.png') }}" class="image1" alt="cat">
    </div>
</x-layout.main>
