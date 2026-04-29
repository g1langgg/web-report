<?php

namespace App\Console\Commands;

use App\Models\MaintenanceSchedule;
use App\Models\MaintenanceTask;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateMaintenanceTasks extends Command
{
    protected $signature = 'maintenance:generate-tasks {--date= : Specific date to generate for (Y-m-d)}';
    protected $description = 'Generate maintenance tasks from schedules based on frequency';

    public function handle()
    {
        $date = $this->option('date') ? Carbon::parse($this->option('date')) : Carbon::today();

        $this->info("Generating maintenance tasks for {$date->format('Y-m-d')}...");

        $schedules = MaintenanceSchedule::where('is_active', true)->get();
        $createdCount = 0;
        $skippedCount = 0;

        foreach ($schedules as $schedule) {
            // Check if task already exists for this date
            $exists = MaintenanceTask::where('schedule_id', $schedule->id)
                ->whereDate('tanggal_jadwal', $date)
                ->exists();

            if ($exists) {
                $this->line("  - Skipped: {$schedule->nama_tugas} (already exists)");
                $skippedCount++;
                continue;
            }

            // Check if task should be generated based on frequency
            if ($this->shouldGenerateTask($schedule, $date)) {
                MaintenanceTask::create([
                    'schedule_id' => $schedule->id,
                    'tanggal_jadwal' => $date,
                    'status' => 'pending',
                ]);

                $this->info("  + Created: {$schedule->nama_tugas}");
                $createdCount++;
            } else {
                $this->line("  - Skipped: {$schedule->nama_tugas} (not scheduled for today)");
            }
        }

        $this->newLine();
        $this->info("Done! Created: {$createdCount}, Skipped: {$skippedCount}");

        return 0;
    }

    /**
     * Determine if task should be generated based on schedule frequency.
     * - Daily: Every day at 17:00 (5 PM)
     * - Weekly: Every Monday
     * - Monthly: Last day of month
     */
    private function shouldGenerateTask(MaintenanceSchedule $schedule, Carbon $date): bool
    {
        switch ($schedule->frekuensi) {
            case 'daily':
                // Generate daily tasks (will be scheduled for today at 17:00)
                return true;

            case 'weekly':
                // Generate on Monday (day 1)
                return $date->dayOfWeek === 1; // Monday

            case 'monthly':
                // Generate on last day of month
                return $date->isLastOfMonth();

            default:
                return false;
        }
    }
}
