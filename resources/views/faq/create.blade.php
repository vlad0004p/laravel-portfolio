<x-layout.main>
    //fix css
    @vite(['public/css/faq.css'])
    <form action="{{ route('faq.store') }}" method="POST">
        @csrf
    <h1 class="FAQ">Frequently asked questions</h1>
    <label>Question</label>
    <div>
        <input type="text" name="question"
               class="input" placeholder="Please fill in the question"
               value="{{ old('question') }}" autocomplete="question">
    </div>
    <label>Answer</label>
    <div>
        <input type="text" name="answer"
               class="input" placeholder="Please fill in the answer"
               value="{{ old('answer') }}" autocomplete="answer">
    </div>
    <label>Link</label>
    <div>
        <input type="text" name="link"
               class="input" placeholder="Please fill in the link"
               value="{{ old('link') }}" autocomplete="link">
    </div>
    <button type="submit">Save</button>
    </form>
</x-layout.main>
