<x-layout.main>
    @vite(['public/css/faq.css'])
<h1 class="FAQ">Frequently asked questions</h1>
    <a href="{{ route('faq.create') }}"><button class="create">Create new FAQ</button></a>
<section class="faq">

    @foreach($faqs as $faq)
        <details>
            <summary><a>{{ $faq['question'] }}</a></summary>
            <p class="answers"><a>{{ $faq['answer'] }}</a></p>
            <a href="{{ route('faq.edit', $faq) }}" class="button-edit"><button>Edit</button></a>
            <a href="{{ route('faq.delete', $faq) }}" class="button-delete"><button>Delete</button></a>
        </details>
    @endforeach

</section>
</x-layout.main>
