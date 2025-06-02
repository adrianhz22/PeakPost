<?php

use App\Models\ActivityLog;

test('The last 50 logs are deleted', function () {

    ActivityLog::factory()->count(100)->create();

    $this->artisan('logs:delete-last')
        ->expectsOutput('They were successfully removed 50 logs.')
        ->assertExitCode(0);

    $this->assertEquals(50, ActivityLog::count());
});

test('the message is displayed that there are no logs.', function () {

    ActivityLog::truncate();

    $this->artisan('logs:delete-last')
        ->expectsOutput('There are no logs to delete.')
        ->assertExitCode(0);
});
