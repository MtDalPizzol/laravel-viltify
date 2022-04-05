<?php

namespace DalPizzol\Viltify\Console;

use App\Providers\ToastServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viltify:install
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Viltify resources';

    protected function runCommand($command, $errorMessage, $succesMessage, $directory = null)
    {
        $process = new Process($command);

        if ($directory) {
            $process->setWorkingDirectory($directory);
        }

        $process->setTimeout(null)
            ->setTty(true)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        if (!$process->isSuccessful()) {
            return $this->error($errorMessage);
        }

        return $this->info($succesMessage);
    }

    protected function installInertiaLaravel()
    {
        $this->requireComposerPackages('inertiajs/inertia-laravel');

        (new Filesystem)->copy(__DIR__ . '/../../stubs/app/Http/Middleware/HandleInertiaRequests.php', app_path('Http/Middleware/HandleInertiaRequests.php'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/config/inertia.php', config_path('inertia.php'));

        $this->installMiddlewareAfter('SubstituteBindings::class', '\App\Http\Middleware\HandleInertiaRequests::class');

        return $this->info('Inertia adapter registered successfully.');
    }

    protected function installZiggy()
    {
        $this->requireComposerPackages('tightenco/ziggy');

        return $this->info('Ziggy installed successfully.');
    }

    protected function copyRoutes()
    {
        (new Filesystem)->copy(__DIR__ . '/../../stubs/routes/web.php', base_path('routes/web.php'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/routes/auth.php', base_path('routes/auth.php'));

        return $this->info('Routes copied successfully.');
    }

    protected function createVueCliProject()
    {
        (new Filesystem)->copy(__DIR__ . '/../../stubs/vue-cli-preset.json', base_path('vue-cli-preset.json'));

        $this->runCommand(
            ['vue', 'create', '--preset', 'vue-cli-preset.json', '--packageManager', 'npm', 'resources-tmp'],
            'Couldn\'t create Vue CLI project.',
            'Vue CLI project created successfully.'
        );

        (new Filesystem)->delete(base_path('vue-cli-preset.json'));
    }

    protected function copyLanguageResources()
    {
        (new Filesystem)->moveDirectory(resource_path('lang'), base_path('resources-tmp/lang'), true);

        return $this->info('Language resources copied successfuly.');
    }

    protected function renameVueCliProject()
    {
        (new Filesystem)->moveDirectory(base_path('resources-tmp'), resource_path(), true);

        return $this->info('Vue CLI project renamed successfuly.');
    }

    protected function installVuetify()
    {
        return $this->runCommand(
            ['vue', 'add', 'vuetify'],
            'Couldn\'t install Vuetify.',
            'Vuetify installed successfully.',
            resource_path()
        );
    }

    protected function installTailwind()
    {
        return $this->runCommand(
            ['vue', 'add', 'tailwind'],
            'Couldn\'t install TailwindCSS.',
            'TailwindCSS installed successfully.',
            resource_path()
        );
    }

    protected function installInertiaJs()
    {
        return $this->runCommand(
            ['npm', 'install', '@inertiajs/inertia', '@inertiajs/inertia-vue', '@inertiajs/progress'],
            'Couldn\'t install Inertia.js.',
            'Inertia.js installed successfully.',
            resource_path()
        );
    }

    protected function installMaterialDesignIconsJs()
    {
        return $this->runCommand(
            ['npm', 'install', '@mdi/js', '-D'],
            'Couldn\'t install Meterial Design Icons.',
            'Material Design Icons installed successfuly',
            resource_path()
        );
    }

    protected function installVueNotification()
    {
        return $this->runCommand(
            ['npm', 'install', 'vue-notification@1.3.20'],
            'Couldn\'t install Vue Notification.',
            'Vue notification installed successfuly',
            resource_path()
        );
    }

    protected function installVueGithubButton()
    {
        return $this->runCommand(
            ['npm', 'install', 'vue-github-button@1'],
            'Couldn\'t install Vue Github Button.',
            'Vue Github Button installed successfuly',
            resource_path()
        );
    }

    protected function deleteDefaultVueCliTemplate()
    {
        (new Filesystem)->delete(resource_path('public/index.html'));
    }

    protected function copyBaseTemplate()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('src/templates'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/src/templates', resource_path('src/templates'), true);

        return $this->info('Base template copied successfuly.');
    }

    protected function addVueConfig()
    {
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/vue.config.js', resource_path('vue.config.js'));

        return $this->info('Vue config added successfuly.');
    }

    protected function addVueEnvFiles()
    {
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/.env.local', resource_path('.env.local'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/.env.production', resource_path('.env.production'));

        return $this->info('Vue environment files added successfuly.');
    }

    protected function configureViewPaths()
    {
        $this->replaceInFile("'paths' => [", "'paths' => (env('APP_ENV', 'production') !== 'production')\n\t? [\n\t\tresource_path('views/devserver'),\n\t\tresource_path('views'),\n\t]\n\t: [", config_path('view.php'));

        return $this->info('Configured views paths successfuly.');
    }

    protected function replaceVuetifyConfig()
    {
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/plugins/vuetify.js', resource_path('src/plugins/vuetify.js'));

        return $this->info('Vuetify config copied successfuly.');
    }

    protected function copyTailwindConfig()
    {
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/tailwind.config.js', resource_path('tailwind.config.js'));

        return $this->info('Tailwind config copied successfuly.');
    }

    protected function copyResources()
    {
        // Providers
        (new Filesystem)->copy(__DIR__ . '/../../stubs/app/Providers/RouteServiceProvider.php', app_path('Providers/RouteServiceProvider.php'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/app/Providers/ToastServiceProvider.php', app_path('Providers/ToastServiceProvider.php'));

        // Controllers
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Http/Controllers/Auth', app_path('Http/Controllers/Auth'), true);

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests/Auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Http/Requests/Auth', app_path('Http/Requests/Auth'));

        // Services...
        (new Filesystem)->ensureDirectoryExists(app_path('Services'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Services', app_path('Services'));

        // // Facades...
        (new Filesystem)->ensureDirectoryExists(app_path('Facades'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Facades', app_path('Facades'));

        // Replace User model
        (new Filesystem)->copy(__DIR__ . '/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // Favicon
        (new Filesystem)->copy(__DIR__ . '/../../stubs/public/favicon.ico', public_path('favicon.ico'));

        // JS Config
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/jsconfig.json', resource_path('jsconfig.json'));

        // Vetur
        (new Filesystem)->copy(__DIR__ . '/../../stubs/vetur.config.js', base_path('vetur.config.js'));

        // Assets
        (new Filesystem)->ensureDirectoryExists(resource_path('src/assets'));

        // Logo
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/assets/logo.png', resource_path('src/assets/logo.png'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/assets/logo-signature.png', resource_path('src/assets/logo-signature.png'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/assets/logo-text.png', resource_path('src/assets/logo-text.png'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/assets/logo-dark.png', resource_path('src/assets/logo-dark.png'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/assets/logo-dark-signature.png', resource_path('src/assets/logo-dark-signature.png'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/assets/logo-dark-text.png', resource_path('src/assets/logo-dark-text.png'));

        // Components
        (new Filesystem)->ensureDirectoryExists(resource_path('src/components'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/src/components', resource_path('src/components'), true);

        // Pages
        (new Filesystem)->ensureDirectoryExists(resource_path('src/pages'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/src/pages', resource_path('src/pages'));

        // Layouts
        (new Filesystem)->ensureDirectoryExists(resource_path('src/layouts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/src/layouts', resource_path('src/layouts'));

        // SCSS
        (new Filesystem)->ensureDirectoryExists(resource_path('src/scss'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/src/scss', resource_path('src/scss'));

        // Main JS
        (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/src/main.js', resource_path('src/main.js'));

        // Delete default Vue CLI App component
        (new Filesystem)->delete(resource_path('src/App.vue'));
    }

    protected function updateEslintRules()
    {
        $this->replaceInFile('rules: {', "rules: {\n\t\t'vue/multi-word-component-names': 'off',", resource_path('.eslintrc.js'));
    }

    protected function registerToastProvider()
    {
        $this->replaceInFile('App\Providers\RouteServiceProvider::class,', "App\Providers\RouteServiceProvider::class,\n\t\tApp\Providers\ToastServiceProvider::class,", config_path('app.php'));
    }

    protected function installTests()
    {
        $this->requireComposerPackages('pestphp/pest', 'pestphp/pest-plugin-laravel');

        (new Filesystem)->ensureDirectoryExists(base_path('tests/Feature/Auth'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/tests/Feature', base_path('tests/Feature/Auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/tests/Datasets', base_path('tests/Datasets'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/tests/Unit', base_path('tests/Unit'));
        (new Filesystem)->copy(__DIR__ . '/../../stubs/tests/Pest.php', base_path('tests/Pest.php'));

        return $this->info('Tests installed successfuly.');
    }

    protected function deleteMixFiles()
    {
        (new Filesystem)->delete(base_path('package.json'));
        (new Filesystem)->delete(base_path('webpack.mix.js'));
    }

    protected function ignoreDevServerFolders()
    {
        $this->replaceInFile('/vendor', "/vendor\n/public/dist-devserver/\n/resources/views/devserver/", base_path('.gitignore'));
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->installInertiaLaravel();
        $this->installZiggy();
        $this->copyRoutes();
        $this->configureViewPaths();
        $this->createVueCliProject();
        $this->copyLanguageResources();
        $this->renameVueCliProject();
        $this->installInertiaJs();
        $this->installMaterialDesignIconsJs();
        $this->installVueNotification();
        $this->installVueGithubButton();
        $this->deleteDefaultVueCliTemplate();
        $this->copyBaseTemplate();
        $this->addVueConfig();
        $this->addVueEnvFiles();
        $this->replaceVuetifyConfig();
        $this->copyTailwindConfig();
        $this->copyResources();
        $this->updateEslintRules();
        $this->registerToastProvider();
        $this->installTests();
        $this->ignoreDevServerFolders();
        $this->deleteMixFiles();

        $this->info('Viltify scaffolding installed successfully.');
    }

    /**
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param  string  $after
     * @param  string  $name
     * @param  string  $group
     * @return void
     */
    protected function installMiddlewareAfter($after, $name, $group = 'web')
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
        $middlewareGroup = Str::before(Str::after($middlewareGroups, "'$group' => ["), '],');

        if (!Str::contains($middlewareGroup, $name)) {
            $modifiedMiddlewareGroup = str_replace(
                $after . ',',
                $after . ',' . PHP_EOL . '            ' . $name . ',',
                $middlewareGroup,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $middlewareGroups,
                str_replace($middlewareGroup, $modifiedMiddlewareGroup, $middlewareGroups),
                $httpKernel
            ));
        }
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
