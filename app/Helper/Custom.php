<?php


define('STATUS',[
    1 => 'Pending',
    2 => 'In Progress',
    3 => 'Completed',
]);

define('STATUS_LABEL',[
    1 => '<span class="rounded-0 fw-normal badge badge-sm bg-danger">Pending</span>',
    2 => '<span class="rounded-0 fw-normal badge badge-sm bg-warning">In Progress</span>',
    3 => '<span class="rounded-0 fw-normal badge badge-sm bg-success">Completed</span>',
]);

define('PRIORITY',[
    1 => 'Urgent',
    2 => 'High',
    3 => 'Medium',
    4 => 'Low',
]);

define('PRIORITY_LABEL',[
    1 => '<span class="rounded-0 fw-normal badge badge-sm bg-danger">Urgent</span>',
    2 => '<span class="rounded-0 fw-normal badge badge-sm bg-warning">High</span>',
    3 => '<span class="rounded-0 fw-normal badge badge-sm bg-success">Medium</span>',
    4 => '<span class="rounded-0 fw-normal badge badge-sm bg-success">Low</span>',
]);

if(!function_exists('dateTimeFormat')){
    function dateTimeFormat($date, $format = 'd-m-Y h:i'){
        return date($format,strtotime($date));
    }
}
