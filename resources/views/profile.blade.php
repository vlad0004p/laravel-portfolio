<x-layout.main>
    @vite(['public/css/profile.css'])
<section class="banner-image">
    <img src="images/banner-home.jpg" alt="banner">
</section>

<section class="skills">
    <section class="soft-skills">
        <h2>Soft skills</h2>
        <p>Motivation</p>
        <div class="skill">
            <div class="skill_level" style="width: 100%"></div>
        </div>
        <p>Time management</p>
        <div class="skill">
            <div class="skill_level" style="width: 90%"></div>
        </div>
        <p>Communication</p>
        <div class="skill">
            <div class="skill_level" style="width: 70%"></div>
        </div>
        <p>Problem-solving</p>
        <div class="skill">
            <div class="skill_level" style="width: 80%"></div>
        </div>
        <p>Multitasking</p>
        <div class="skill">
            <div class="skill_level" style="width: 85%"></div>
        </div>
    </section>

    <section class="hard-skills">
        <h2>Hard skills</h2>
        <p>HTML, CSS</p>
        <div class="skill">
            <div class="skill_level" style="width: 75%"></div>
        </div>
        <p>Canva</p>
        <div class="skill">
            <div class="skill_level" style="width: 70%"></div>
        </div>
        <p>Language skills</p>
        <div class="skill">
            <div class="skill_level" style="width: 75%"></div>
        </div>
        <p>LightRoom</p>
        <div class="skill">
            <div class="skill_level" style="width: 90%"></div>
        </div>
        <p>GIS (geographical map)</p>
        <div class="skill">
            <div class="skill_level" style="width: 40%"></div>
        </div>
    </section>
</section>

<h1 class="hobby">My hobby</h1>
<section class="profile-hobby">
    <img src="images/acro.jpg" id="acro-image" alt="banner">
    <video controls>
        <source src="images/video.mp4" type="video/mp4">
    </video>
</section>
</x-layout.main>
