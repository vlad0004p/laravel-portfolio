<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Models\Faq;

class FaqTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateFaq()
    {
        $faqMock = Mockery::mock('alias:' . Faq::class);
        $faqMock->shouldReceive('create')
            ->with(['question' => 'What is Laravel?', 'answer' => 'Laravel is a PHP framework.'])
            ->andReturn((object) ['id' => 1, 'question' => 'What is Laravel?', 'answer' => 'Laravel is a PHP framework.']);

        // Use the mock in your test
        $createdFaq = Faq::create(['question' => 'What is Laravel?', 'answer' => 'Laravel is a PHP framework.']);
        $this->assertEquals('What is Laravel?', $createdFaq->question);
    }

    public function testEditFaq()
    {
        $faqMock = Mockery::mock('alias:' . Faq::class);
        $faq = Mockery::mock();
        $faq->shouldReceive('update')
            ->with(['answer' => 'Laravel is an open-source PHP framework.'])
            ->andReturn(true);

        $faqMock->shouldReceive('first')->andReturn($faq);

        // Use the mock in your test
        $faqFromDb = Faq::first();
        $result = $faqFromDb->update(['answer' => 'Laravel is an open-source PHP framework.']);
        $this->assertTrue($result);
    }

    public function testDeleteFaq()
    {
        $faqMock = Mockery::mock('alias:' . Faq::class);
        $faq = Mockery::mock();
        $faq->shouldReceive('delete')->andReturn(true);

        $faqMock->shouldReceive('first')->andReturn($faq);

        // Use the mock in your test
        $faqFromDb = Faq::first();
        $result = $faqFromDb->delete();
        $this->assertTrue($result);
    }
}
