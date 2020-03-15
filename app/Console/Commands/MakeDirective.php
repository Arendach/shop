<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDirective extends Command
{
    protected $signature = 'make:directive {name}';

    protected $description = 'Make blade directive';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');

        file_put_contents(app_path("Directives/{$name}Directive.php"), $this->getTemplate($name));

        $this->info("Success! {$name}Directive has been created!");
    }

    public function getTemplate($name)
    {
        $lower = lcfirst($name);

        return <<<EOL
        <?php
        
        namespace App\Directives;
        
        use Blade;
        
        class {$name}Directive 
        {
            public function register(): void
            {
                Blade::directive('$lower', function (\$expression) {
                    return "<?php echo \App\Directives\\{$name}Directive::apply(\$expression); ?>";
                });
            }
        
            public static function apply()
            {
                 
            }
        }
        EOL;
    }
}
