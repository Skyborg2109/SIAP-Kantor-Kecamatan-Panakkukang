<?php

namespace Tests\Feature;

use App\Events\QueueCalled;
use App\Livewire\PetugasDashboard;
use App\Livewire\PublicDisplay;
use App\Models\Counter;
use App\Models\Queue;
use App\Models\Service;
use App\Models\User;
use App\Services\QueueService;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

class QueueServiceTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_generates_independent_numbers_for_each_queue_type(): void
    {
        $counter = Counter::create(['name' => 'Ruang Pelayanan', 'status' => true]);
        $ktpService = Service::create(['name' => 'Kartu Tanda Penduduk', 'code' => 'KTP', 'status' => true]);
        $ikdService = Service::create(['name' => 'Identitas Kependudukan Digital', 'code' => 'IKD', 'status' => true]);
        $queueService = app(QueueService::class);

        Event::fake([QueueCalled::class]);

        $ktpFirstQueue = $queueService->callNextQueue($counter->id, $ktpService->id);
        $ikdFirstQueue = $queueService->callNextQueue($counter->id, $ikdService->id);
        $ktpSecondQueue = $queueService->callNextQueue($counter->id, $ktpService->id);

        $this->assertSame('KTP-1', $ktpFirstQueue?->number);
        $this->assertSame('IKD-1', $ikdFirstQueue?->number);
        $this->assertSame('KTP-2', $ktpSecondQueue?->number);

        $this->assertDatabaseCount('queues', 3);
        $this->assertDatabaseHas('queues', ['number' => 'KTP-2', 'service_id' => $ktpService->id]);
        $this->assertDatabaseHas('queues', ['number' => 'IKD-1', 'service_id' => $ikdService->id]);
        Event::assertDispatched(QueueCalled::class, function (QueueCalled $event) use ($ikdFirstQueue): bool {
            return $event->queue->is($ikdFirstQueue);
        });
    }

    public function test_display_shows_the_current_number_for_ktp_and_ikd_separately(): void
    {
        $counter = Counter::create(['name' => 'Ruang Pelayanan', 'status' => true]);
        $ktpService = Service::create(['name' => 'Kartu Tanda Penduduk', 'code' => 'KTP', 'status' => true]);
        $ikdService = Service::create(['name' => 'Identitas Kependudukan Digital', 'code' => 'IKD', 'status' => true]);

        Queue::create([
            'number' => 'KTP-12',
            'service_id' => $ktpService->id,
            'counter_id' => $counter->id,
            'status' => 'SERVING',
            'called_at' => now(),
        ]);
        Queue::create([
            'number' => 'IKD-4',
            'service_id' => $ikdService->id,
            'counter_id' => $counter->id,
            'status' => 'SERVING',
            'called_at' => now(),
        ]);

        Livewire::test(PublicDisplay::class)
            ->assertSee('Tayangan Video Informasi')
            ->assertSee('Panggilan Antrean KTP')
            ->assertSee('Panggilan Antrean IKD')
            ->assertSee('KTP-12')
            ->assertSee('IKD-4')
            ->assertSee('Sedang Dilayani');
    }

    public function test_petugas_can_call_ikd_without_completing_the_active_ktp_queue(): void
    {
        $counter = Counter::create(['name' => 'Ruang Pelayanan', 'status' => true]);
        $petugas = User::factory()->create(['counter_id' => $counter->id, 'role' => 'PETUGAS']);
        $ktpService = Service::create(['name' => 'Kartu Tanda Penduduk', 'code' => 'KTP', 'status' => true]);
        $ikdService = Service::create(['name' => 'Identitas Kependudukan Digital', 'code' => 'IKD', 'status' => true]);
        $ktpQueue = Queue::create([
            'number' => 'KTP-12',
            'service_id' => $ktpService->id,
            'counter_id' => $counter->id,
            'status' => 'SERVING',
            'called_at' => now(),
        ]);

        Event::fake([QueueCalled::class]);

        Livewire::actingAs($petugas)
            ->test(PetugasDashboard::class)
            ->assertSee('Antrean Sedang Dilayani')
            ->assertSee('KTP-12')
            ->call('callNext', $ikdService->id)
            ->assertSee('IKD-1');

        $this->assertDatabaseHas('queues', ['id' => $ktpQueue->id, 'status' => 'SERVING']);
        $this->assertDatabaseHas('queues', ['number' => 'IKD-1', 'service_id' => $ikdService->id, 'status' => 'CALLED']);
        Event::assertDispatched(QueueCalled::class, function (QueueCalled $event) use ($ikdService): bool {
            return $event->queue->service_id === $ikdService->id;
        });
    }
}
