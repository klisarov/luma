<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    'nav' => [

        'home' => 'Luma home',

        'today' => 'Today',

        'work_log' => 'Work log',

        'fitness' => 'Fitness',

        'calendars' => 'Calendars',

        'categories' => 'Categories',

        'new_category' => 'New category',

        'category_name' => 'Category name',

        'add_category' => 'Add category',

        'profile' => 'Profile',

        'logout' => 'Log out',

        'open_navigation' => 'Open navigation',

        'close_navigation' => 'Close navigation',

        'delete_category' => 'Delete category',

        'delete_category_aria' => 'Delete :category',

        'delete_category_confirm' =>
            'Delete :category? Tasks will be kept, but removed from this category.',

    ],


    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    'notifications' => [

        'task_reminder_title' =>
            'Task reminder',

        'task_reminder_body' =>
            ':task is coming up.',

        'event_reminder_title' =>
            'Upcoming event',

        'event_reminder_body' =>
            ':event is coming up.',

        'morning_title' =>
            'Good morning',

        'afternoon_title' =>
            'Keep going',

        'evening_title' =>
            'Finish strong',

    ],


    /*
    |--------------------------------------------------------------------------
    | Common
    |--------------------------------------------------------------------------
    */

    'common' => [

        'add' => 'Add',

        'save' => 'Save',

        'remove' => 'Remove',

        'delete' => 'Delete',

        'cancel' => 'Cancel',

        'edit' => 'Edit',

        'work' => 'Work',

        'overdue' => 'Overdue',

        'no_deadline' => 'No deadline',

        'low' => 'Low',

        'medium' => 'Medium',

        'high' => 'High',

        'name' => 'Name',

        'email' => 'Email',

        'password' => 'Password',

        'location' => 'Location',

        'description' => 'Description',

        'notes' => 'Notes',

    ],


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    'dashboard' => [

        'title' =>
            'Today',

        'todays_plan' =>
            'Today\'s plan',

        'completion' =>
            ':percentage% of today\'s tasks are done.',


        /*
        |--------------------------------------------------------------------------
        | Tasks
        |--------------------------------------------------------------------------
        */

        'todays_obligations' =>
            'Today\'s obligations',

        'nothing_today' =>
            'Nothing on the books for today.',

        'remaining_obligations' =>
            'Remaining obligations',

        'remaining_description' =>
            'Upcoming, overdue and unscheduled tasks',

        'all_caught_up' =>
            'You\'re all caught up.',

        'task_count' =>
            '{1} :count task|[2,*] :count tasks',

        'task_singular' =>
            'task',

        'task_plural' =>
            'tasks',


        /*
        |--------------------------------------------------------------------------
        | Calendars
        |--------------------------------------------------------------------------
        */

        'calendars' =>
            'Calendars',

        'no_upcoming_events' =>
            'No upcoming events',

        'delete_calendar' =>
            'Delete calendar',

        'delete_calendar_aria' =>
            'Delete :name',

        'delete_calendar_confirm' =>
            'Delete :name and all events inside it?',


        /*
        |--------------------------------------------------------------------------
        | Device Setup
        |--------------------------------------------------------------------------
        */

        'add_to_iphone' =>
            'Add Luma to your iPhone',

        'recommended' =>
            'Recommended',

        'iphone_description' =>
            'Add Luma to your Home Screen for the full app experience, reminders and push notifications.',

        'share' =>
            'Share',

        'add_to_home_screen' =>
            'Add to Home Screen',

        'stay_on_track' =>
            'Stay on track',

        'allow_notifications_description' =>
            'Allow Luma to notify you about tasks, reminders and upcoming events.',

        'allow_notifications' =>
            'Allow notifications',


        /*
        |--------------------------------------------------------------------------
        | Notification States
        |--------------------------------------------------------------------------
        */

        'notifications_blocked' =>
            'Notifications are blocked',

        'notifications_blocked_iphone' =>
            'Notifications are blocked. Open your iPhone settings and allow notifications for Luma.',

        'notifications_blocked_browser' =>
            'Notifications are blocked in your browser settings.',

        'notifications_blocked_device' =>
            'Notifications are blocked in your device settings.',

        'notifications_enabled' =>
            'Notifications are enabled.',

        'enabling_notifications' =>
            'Enabling...',

        'connecting_notifications' =>
            'Connecting Luma notifications...',

        'enabled' =>
            'Enabled ✓',

        'unable_to_enable_notifications' =>
            'Unable to enable notifications.',


        /*
        |--------------------------------------------------------------------------
        | Push / Browser Errors
        |--------------------------------------------------------------------------
        */

        'service_workers_unsupported' =>
            'Service workers are not supported in this browser.',

        'push_keys_missing' =>
            'The browser did not return push encryption keys.',

        'notifications_unsupported' =>
            'Notifications are not supported in this browser.',

        'web_push_unsupported' =>
            'Web Push is not supported in this browser.',

        'vapid_missing' =>
            'VAPID public key is missing.',

        'notification_permission_not_granted' =>
            'Notification permission was not granted.',

        'unable_save_push_subscription' =>
            'Unable to save push subscription: :error',

    ],


    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    'categories' => [

        'subcategories' =>
            'Subcategories',

        'organize_tasks' =>
            'Organize tasks inside :category.',

        'subcategory' =>
            'Subcategory',

        'subcategory_name' =>
            'Subcategory name',

        'no_subcategory' =>
            'No subcategory',

        'no_subcategories' =>
            'No subcategories yet.',

        'tasks' =>
            'Tasks',

        'no_tasks' =>
            'No tasks in this category yet.',

        'delete_subcategory_confirm' =>
            'Delete this subcategory? Tasks will remain.',

        'task_count' =>
            '{1} :count task|[2,*] :count tasks',

        'add_task' =>
            'Add task',

        'add_task_description' =>
            'Create a new task inside :category.',

        'task_title' =>
            'Task title',

        'task_title_placeholder' =>
            'What needs to be done?',

        'priority' =>
            'Priority',

        'no_priority' =>
            'No priority',

        'due_at' =>
            'Due date',

        'reminder' =>
            'Reminder',

        'no_reminder' =>
            'No reminder',

        'reminder_15' =>
            '15 minutes before',

        'reminder_30' =>
            '30 minutes before',

        'reminder_60' =>
            '1 hour before',

        'reminder_day' =>
            '1 day before',

        'description_placeholder' =>
            'Optional details...',

        'work_related' =>
            'This is a work-related task',

    ],


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    'profile' => [

        'title' =>
            'Profile',

        'your_luma' =>
            'Your Luma',

        'account_active' =>
            'Account active',

        'change_password' =>
            'Change password',

        'password_description' =>
            'Keep your Luma account secure with a strong password.',

        'current_password' =>
            'Current password',

        'new_password' =>
            'New password',

        'confirm_password' =>
            'Confirm new password',

        'update_password' =>
            'Update password',

        'password_updated' =>
            'Password updated successfully.',

        'account_information' =>
            'Account information',

        'account_information_description' =>
            'Information associated with your Luma account.',

        'account_id' =>
            'Account ID',

        'member_since' =>
            'Member since',

        'timezone' =>
            'Timezone',

    ],


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    'login' => [

        'title' =>
            'Welcome back',

        'personal_os' =>
            'Your personal operating system',

        'your_day' =>
            'Your day,',

        'in_orbit' =>
            'in orbit.',

        'intro' =>
            'Plan what matters. Stay focused. Move forward. Luma brings your tasks, calendars, work, fitness and reminders into one calm daily system.',

        'focused_days' =>
            'Focused days',

        'focused_days_description' =>
            'See what matters today and track your progress.',

        'one_calendar' =>
            'Life in one calendar',

        'one_calendar_description' =>
            'Keep work, study and personal events together.',

        'stay_consistent' =>
            'Stay consistent',

        'stay_consistent_description' =>
            'Keep your weekly workouts beside the rest of life.',

        'never_lose_track' =>
            'Never lose track',

        'never_lose_track_description' =>
            'Smart reminders keep obligations from slipping away.',

        'one_place' =>
            'One place. Less noise. More momentum.',

        'intentional_days' =>
            'Built for intentional days.',

        'welcome_back' =>
            'Welcome back.',

        'welcome_description' =>
            'Your day is waiting. Pick up exactly where you left off.',

        'enter_password' =>
            'Enter your password',

        'show_password' =>
            'Show password',

        'keep_signed_in' =>
            'Keep me signed in',

        'enter_luma' =>
            'Enter Luma',

        'privacy' =>
            'Your plans stay yours. Luma keeps your personal system focused and private.',

        'motto' =>
            'Your day, in orbit.',

    ],


    /*
    |--------------------------------------------------------------------------
    | Calendar
    |--------------------------------------------------------------------------
    */

    'calendar' => [

        'title' =>
            'Calendars',

        'new_calendar' =>
            'New calendar',

        'calendar_name' =>
            'Calendar name',

        'new_event' =>
            'New event',

        'event_title' =>
            'Event title',

        'start' =>
            'Start',

        'end' =>
            'End',

        'all_day' =>
            'All day',

        'yearly' =>
            'Repeat yearly',

        'reminder' =>
            'Reminder',

        'add_event' =>
            'Add event',

        'delete_event' =>
            'Delete event',

        'no_events' =>
            'No events yet.',

    ],


    /*
    |--------------------------------------------------------------------------
    | Fitness
    |--------------------------------------------------------------------------
    */

'fitness' => [

    'title' =>
        'Fitness',

    'tracker' =>
        'Fitness tracker',

    'workout_plans' =>
        'Workout plans',

    'new_plan' =>
        'New workout plan',

    'todays_tip' =>
        'Today\'s tip',

    'profile_details_prompt' =>
        'Set your profile details to get personalized fitness tips.',

    'update_profile' =>
        'Update profile',

    'workout_type_placeholder' =>
        'e.g. Push day',

    'duration_placeholder' =>
        '60 min',

    'rest' =>
        'Rest',

    'minutes_short' =>
        'min',

    'exercise' =>
        'Exercise',

    'exercises' =>
        'Exercises',

    'sets' =>
        'Sets',

    'reps' =>
        'Reps',

    'weight' =>
        'Weight',

    'notes' =>
        'Notes',

    'days' => [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
    ],

    'days_short' => [
        0 => 'Sun',
        1 => 'Mon',
        2 => 'Tue',
        3 => 'Wed',
        4 => 'Thu',
        5 => 'Fri',
        6 => 'Sat',
    ],

],

    /*
|--------------------------------------------------------------------------
| Work Log
|--------------------------------------------------------------------------
*/

'work' => [

    'title' =>
        'Work log',

    'description' =>
        'Everything you\'ve flagged as work-related, most recent first.',

    'done' =>
        'Done',

    'open' =>
        'Open',

    'empty' =>
        'No work-related tasks logged yet.',

],

];