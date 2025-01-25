<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowTemplateTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'workflow_template_stage_id',
        'title',
        'description',
    ];

    // Define relationship with WorkflowTemplateStage
    public function stage()
    {
        return $this->belongsTo(WorkflowTemplateStage::class, 'workflow_template_stage_id');
    }
}
