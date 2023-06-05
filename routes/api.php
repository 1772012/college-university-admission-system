<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {

    //  Route group auth
    include __DIR__ . '/groups/api/auth.php';

    //  Route group users
    include __DIR__ . '/groups/api/users.php';

    //  Route group notifications
    include __DIR__ . '/groups/api/notifications.php';

    //  Route group applications
    include __DIR__ . '/groups/api/applications.php';

    //  Route group faculties
    include __DIR__ . '/groups/api/faculties.php';

    //  Route group study programs
    include __DIR__ . '/groups/api/study-programs.php';

    //  Route group study programs
    include __DIR__ . '/groups/api/grades.php';

});

