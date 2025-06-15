<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Faq;

class FaqTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateFaq()
    {
        $response = $this->post('/faqs', [
            'question' => 'What is Laravel?',
            'answer' => 'Laravel is a PHP framework.',
        ]);

        $response->assertStatus(302); // Assuming successful creation redirects
        $this->assertDatabaseHas('faqs', ['question' => 'What is Laravel?']);
    }

    public function testEditFaq()
    {
        $faq = Faq::factory()->create(); // Assuming you have a Faq model factory set up

        $response = $this->put('/faqs/'.$faq->id, [
            'answer' => 'Laravel is an open-source PHP framework.',
        ]);

        $response->assertStatus(302); // Assuming successful update redirects
        $this->assertDatabaseHas('faqs', ['answer' => 'Laravel is an open-source PHP framework.']);
    }

    public function testDeleteFaq()
    {
        $faq = Faq::factory()->create(); // Assuming you have a Faq model factory set up

        $response = $this->delete('/faqs/'.$faq->id);

        $response->assertStatus(302); // Assuming successful deletion redirects
        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);
    }
}
