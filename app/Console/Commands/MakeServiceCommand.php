<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Crea una clase de servicio en app/Services';

    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path('Services');

        if (!File::exists($servicePath)) {
            File::makeDirectory($servicePath, 0755, true);
        }

        $filePath = "$servicePath/{$name}.php";

        if (File::exists($filePath)) {
            $this->error('El servicio ya existe.');
            return Command::FAILURE;
        }

        $stub = "<?php

namespace App\Services;

class {$name}
{
    //
}
";

        File::put($filePath, $stub);

        $this->info("Servicio {$name} creado en app/Services.");
        return Command::SUCCESS;
    }
}
