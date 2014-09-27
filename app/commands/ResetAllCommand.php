<?php

class ResetAllCommand extends \Illuminate\Console\Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'reset:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all including database.';

    /**
     * Create a new command instance.
     *
     * @return \ResetAllCommand
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $answer = $this->ask('Are you sure you want to reset everything?');

        if($answer != 'y') return;

        $this->call('drop:db');

        $this->call('migrate');

        $this->call('migrate', array('--package' => 'lifeentity/images'));

        $this->call('db:seed');

        $this->info('Everything is fresh now');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
        );
    }
} 