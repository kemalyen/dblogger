<?php
namespace Gazatem\Glog\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log extends Model
{
    protected $softDelete = true;

    protected $guarded = array('id');  // Important

    public function getDateDiff()
    {
        $created = new Carbon($this->created_at);
        $now = Carbon::now();
        $difference = ($created->diff($now)->days < 1)
            ? 'today'
            : $created->diffForHumans($now, true);
        if ($difference == 'today') return $difference;
        return $difference . " ago"; //$cDate->diffInDays() . " days ago";
    }
}