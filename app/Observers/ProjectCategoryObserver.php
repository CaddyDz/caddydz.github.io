<?php

namespace App\Observers;

use App\Models\ProjectCategory;

class ProjectCategoryObserver
{
    /**
     * Handle the ProjectCategory "created" event.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return void
     */
    public function created(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Handle the ProjectCategory "updated" event.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return void
     */
    public function updated(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Handle the ProjectCategory "deleted" event.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return void
     */
    public function deleted(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Handle the ProjectCategory "restored" event.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return void
     */
    public function restored(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Handle the ProjectCategory "force deleted" event.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return void
     */
    public function forceDeleted(ProjectCategory $projectCategory)
    {
        //
    }
}
