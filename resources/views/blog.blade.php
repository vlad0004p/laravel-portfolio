<x-layout.main>
    @vite(['public/css/blog.css'])
    <h1 class="blog-header">My blogposts!</h1>
    <section>
        <article class="blogposts">
            <div class="post">
                <p>2023</p>
                <h3>Professions</h3>
                <p>Find out about three companies I dream to work for. See the reason behind it...</p>
                <a class="read-more" href="{{route('professions')}}">Read more</a>
            </div>
            <div class="post">
                <p>07/09/2023</p>
                <h3>First feedback</h3>
                <p>My expirience in the first two weeks at HZ, HBO-ICT. The things that I learnt and more...</p>
                <a class="read-more" href="{{route('first_feedback')}}">Read more</a>
            </div class="post">
            <div class="post">
                <p>09/2023</p>
                <h3>Programming experience</h3>
                <p>Here are some of the reasons why I started ICT and why I want to continue...</p>
                <a class="read-more" href="{{route('programming_expirience')}}">Read more</a>
            </div>
            <div class="post">
                <p>05/2023</p>
                <h3>Personal SWOT analysis</h3>
                <p>My strenghts, weaknesses, opportunities and threads...</p>
                <a class="read-more" href="{{route('swot_analysis')}}">Read more</a>
            </div>
            <div class="post">
                <p>12/2022</p>
                <h3>Study choice</h3>
                <p>Here is why I came to the Netherlands and decided to study ICT...</p>
                <a class="read-more" href="{{route('study_choice')}}">Read more</a>
            </div>
            <div class="post">
                <p>06/2024</p>
                <h3>Server Failure</h3>
                <p>A reflection on how things break, and what we learn when they do...</p>
                <a class="read-more" href="{{ route('trigger-500') }}">Read more</a>
            </div>
            {{--            <div class="post">--}}
{{--                <p>05/2024</p>--}}
{{--                <h3>Testing 404</h3>--}}
{{--                <p>This page does not exist and it triggers a 404 error</p>--}}
{{--                <a class="read-more" href="{{ route('trigger-404') }}">Read more</a>--}}
{{--            </div>--}}
{{--            <div class="post">--}}
{{--                <p>05/2024</p>--}}
{{--                <h3>Testing 500</h3>--}}
{{--                <p>This page does not exist and it triggers a 500 error</p>--}}
{{--                <a class="read-more" href="{{ route('trigger-500') }}">Read more</a>--}}
{{--            </div>--}}
        </article>
    </section>
</x-layout.main>
