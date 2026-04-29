<?php

namespace App\Console\Commands;

use App\Models\Laporan;
use App\Models\Notification;
use Illuminate\Console\Command;

class CheckOverdueLaporan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-overdue-laporan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and mark overdue laporan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueLaporans = Laporan::where('is_overdue', false)
            ->whereNotIn('status', ['done'])
            ->where('deadline', '<', now())
            ->get();

        $count = 0;
        foreach ($overdueLaporans as $laporan) {
            $laporan->update(['is_overdue' => true]);

            // Notify pelapor
            Notification::create([
                'user_id' => $laporan->pelapor_id,
                'laporan_id' => $laporan->id,
                'title' => 'Laporan Overdue',
                'message' => "Laporan #{$laporan->ticket_number} telah melewati deadline.",
                'type' => 'overdue',
            ]);

            // Notify assigned teknisi if exists
            if ($laporan->assignment) {
                Notification::create([
                    'user_id' => $laporan->assignment->teknisi_id,
                    'laporan_id' => $laporan->id,
                    'title' => 'Laporan Overdue',
                    'message' => "Laporan #{$laporan->ticket_number} telah melewati deadline. Segera selesaikan!",
                    'type' => 'overdue',
                ]);
            }

            $count++;
        }

        $this->info("{$count} laporan marked as overdue.");

        return Command::SUCCESS;
    }
}
