<?php

namespace Fikrimi\Pipe\Policies;

use Illuminate\Foundation\Auth\User;
use Fikrimi\Pipe\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the credential.
     *
     * @param  \Fikrimi\Pipe\Models\User  $user
     * @param  \Fikrimi\Pipe\Models\Project  $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        if (config('pipe.auth.policies.projects.view_other')) {
            return true;
        }

        return $user->{config('pipe.auth.primary_key')} === $project->created_by;
    }

    /**
     * @param  \Fikrimi\Pipe\Models\User  $user
     * @param  \Fikrimi\Pipe\Models\Project  $project
     * @return mixed
     */
    public function build(User $user, Project $project)
    {
        if (config('pipe.auth.policies.projects.build_other')) {
            return true;
        }

        return $user->{config('pipe.auth.primary_key')} === $project->created_by;
    }

    /**
     * Determine whether the user can delete the credential.
     *
     * @param  \Fikrimi\Pipe\Models\User  $user
     * @param  \Fikrimi\Pipe\Models\Project  $credential
     * @return mixed
     */
    public function delete(User $user, Project $credential)
    {
        if (config('pipe.auth.policies.projects.delete_other')) {
            return true;
        }

        return $user->{config('pipe.auth.primary_key')} === $credential->created_by;
    }
}
