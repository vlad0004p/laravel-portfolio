<x-layout.main>
    //fix css
    @vite(['public/css/faq.css'])
    <form action="{{ route('faq.update', $faq) }}" method="POST">
        @csrf
        @method("PUT")
    <h1 class="FAQ">Frequently asked questions</h1>
    <label>Question</label>
    <div>
        <input type="text" name="question"
               class="input"
               value="{{ $faq->question }}">
    </div>
    <label>Answer</label>
    <div>
        <input type="text" name="answer"
               class="input"
               value="{{ $faq->answer }}">
    </div>
    <label>Link</label>
    <div>
        <input type="text" name="link"
               class="input"
               value="{{ $faq->link }}">
    </div>
    <button type="submit">Save</button>
    </form>
</x-layout.main>
