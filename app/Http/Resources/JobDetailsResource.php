<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "category" => $this->category,
            "course_check" => $this->course_check,
            "education" => $this->education,
            "gender" => $this->gender,
            "jobDetailsId" => $this->id,
            "interviewDate" => $this->interview_date,
            "jobDescription" => $this->job_description,
            "jobLocation" => $this->job_location,
            "jobTitle" => $this->job_title,
            "maxage" => $this->maxage,
            "minage" => $this->minage,
            "minexp" => $this->minexp,
            "openingNumber" => $this->opening_number,
            "organizationname" => $this->organizationname,
            "percentage" => $this->percentage,
            "physicalcheck" => $this->physicalcheck,
            "position" => $this->position,
            "salaryRange" => $this->salary_range,
            "servicetirm" => $this->servicetirm,
            "url" => $this->url,
            "user_id" => $this->user_id,
        ];
    }
}
