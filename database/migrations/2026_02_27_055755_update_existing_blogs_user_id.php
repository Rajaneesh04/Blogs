<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Blog;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing blogs to have the admin user as author
        $adminUser = User::where('role', User::ROLE_ADMIN)->first();
        if ($adminUser) {
            Blog::whereNull('user_id')->update(['user_id' => $adminUser->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse as this was just data migration
    }
};
