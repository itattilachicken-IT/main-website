<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Investor;
use App\Models\Investment;

class MigrateInvestments extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'migrate:investments';

    /**
     * The console command description.
     */
    protected $description = 'Migrate investment data from investors table to investments table';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $investors = Investor::all();
        $createdCount = 0;
        $skippedCount = 0;

        foreach ($investors as $investor) {
            if (!empty($investor->contract_number)) {
                try {
                    // Avoid duplicates if command is rerun
                    $investment = Investment::firstOrCreate(
                        ['contract_number' => $investor->contract_number],
                        [
                            'investor_id' => $investor->id,
                            'investment_package' => $investor->investment_package,
                            'initial_investment_date' => $investor->initial_investment_date,
                            'total_amount_invested' => $investor->total_amount_invested,
                        ]
                    );

                    if ($investment->wasRecentlyCreated) {
                        $this->info("Created investment for investor {$investor->id} - {$investor->contract_number}");
                        $createdCount++;
                    } else {
                        $this->warn("Skipped existing contract: {$investor->contract_number}");
                        $skippedCount++;
                    }
                } catch (\Exception $e) {
                    $this->error("Failed for investor {$investor->id} - {$investor->contract_number}: " . $e->getMessage());
                }
            }
        }

        $this->info("Migration completed. Created: $createdCount, Skipped: $skippedCount");

        return 0;
    }
}
