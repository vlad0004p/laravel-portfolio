<x-layout.main>
    @vite(['public/css/faq.css'])
    <div class="box">
        <!-- Form for deleting FAQ -->
        <form action="{{ route('faq.destroy', $faq) }}" method="POST">
            @csrf
            @method("DELETE")
            <h1 style="margin-top: 150px">Delete FAQ {{ $faq->id }}</h1>
            <br>
            <h2>
                Are you sure you want to delete?
            </h2>

            <div>
                <button type="submit">Yes</button>
            </div>
            <!-- Link to go back to previous page -->
            <div>
                <a href="{{ url()->previous() }}"><button type="button">No</button></a>
            </div>
        </form>
    </div>
</x-layout.main>
