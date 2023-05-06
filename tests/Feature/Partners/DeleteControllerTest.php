<?php

namespace Tests\Feature\Partners;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function test_the_application_returns_status_no_content(): void
    {
        $partner = Partner::factory()->create();

        $request = $this->delete("/api/partners/{$partner->public_id}");

        $request->assertNoContent();
    }

    /**
     * @test
     */
    public function test_the_application_not_found_for_deleted_partners(): void
    {
        $partner = Partner::factory()->create();

        $request = $this->delete("/api/partners/{$partner->public_id}");

        $request = $this->getJson("/api/partners/{$partner->public_id}");

        $request->assertNotFound();
    }

    /**
     * @test
     */
    public function test_the_application_deletes_partner_from_database(): void
    {
        $partner = Partner::factory()->create();

        $this->assertDatabaseHas('partners', [
            'id' => $partner->id,
        ]);

        $request = $this->delete("/api/partners/{$partner->public_id}");

        $request->assertNoContent();

        $this->assertDatabaseMissing('partners', [
            'id' => $partner->id,
        ]);
    }
}
