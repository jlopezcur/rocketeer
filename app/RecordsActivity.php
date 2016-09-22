<?php

namespace App;

use ReflectionClass;

trait RecordsActivity
{

    protected static function bootRecordsActivity()
    {
        foreach (static::getModelEvents() as $event) {

            static::$event(function ($model) use ($event) {
                $model->recordActivity($event, $model);
            });

        }
    }

    protected function getActivityName($action)
    {
        $name = strtolower((new ReflectionClass($this))->getShortName());
        return "{$action}_{$name}";
    }

    protected function getProjectId()
    {
        $name = strtolower((new ReflectionClass($this))->getShortName());
        if ($name == 'project') return $this->id;
        else if ($name == 'issuecomment') return $this->issue->project_id;
        return $this->project_id;
    }

    public function recordActivity($event, $model)
    {
        Activity::create([
            'subject_id' => $model->id,
            'subject_type' => get_class($model),
            'name' => $model->getActivityName($event),
            'project_id' => $model->getProjectId(),
            'user_id' => $model->user_id
        ]);
    }

    protected static function getModelEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return [
            'created', 'deleted', 'updated'
        ];
    }
}
