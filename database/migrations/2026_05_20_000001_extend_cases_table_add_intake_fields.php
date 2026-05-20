<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            // Child info
            $table->string('child_name')->nullable()->after('user_id');
            $table->unsignedTinyInteger('child_age')->nullable()->after('child_name');
            $table->string('child_age_unit')->default('years')->after('child_age'); // years|months
            $table->char('sex', 1)->nullable()->after('child_age_unit'); // M|F

            // Presenting complaint
            $table->string('title')->nullable()->after('sex');
            $table->string('body_location')->nullable()->after('title');
            $table->string('duration')->nullable()->after('body_location');
            $table->json('symptoms')->nullable()->after('duration');
            $table->unsignedTinyInteger('severity')->nullable()->after('symptoms');
            $table->text('additional_notes')->nullable()->after('severity');

            // Medical history
            $table->text('medications')->nullable()->after('additional_notes');
            $table->text('allergies')->nullable()->after('medications');
            $table->text('prior_conditions')->nullable()->after('allergies');
            $table->text('family_history')->nullable()->after('prior_conditions');

            // Doctor diagnosis (structured)
            $table->string('icd_code')->nullable()->after('family_history');
            $table->string('diagnosis_condition')->nullable()->after('icd_code');
            $table->text('diagnosis_summary')->nullable()->after('diagnosis_condition');
            $table->json('treatment_steps')->nullable()->after('diagnosis_summary');
            $table->string('follow_up')->nullable()->after('treatment_steps');
            $table->unsignedTinyInteger('severity_doctor')->nullable()->after('follow_up');

            // Info request flow
            $table->text('info_request')->nullable()->after('severity_doctor');
            $table->text('info_reply')->nullable()->after('info_request');

            // Expand status
            // submitted | needs_info | in_review | diagnosed | closed
            $table->dropColumn('status');
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->string('status')->default('submitted')->after('info_reply');
        });
    }

    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn([
                'child_name', 'child_age', 'child_age_unit', 'sex',
                'title', 'body_location', 'duration', 'symptoms', 'severity', 'additional_notes',
                'medications', 'allergies', 'prior_conditions', 'family_history',
                'icd_code', 'diagnosis_condition', 'diagnosis_summary', 'treatment_steps', 'follow_up', 'severity_doctor',
                'info_request', 'info_reply',
                'status',
            ]);
            $table->string('status')->default('pending')->after('treatment');
        });
    }
};
